<?php
    class UserDataModel extends CI_Model{
        
        public function insert_data($allInfo){
            
            //$applicant = array("id"=>$pawprint, "isStudentWorker" => $studentWorker, "organization" => $organization);
            //$address = array("addID" => $pawprint, "city" => $city, "street" => $street, "zip" => $zip);
            //$ferpaScores = array("id" => $pawprint, "score" => $FERPA);
            
            //pulling out the data from the array and storing it in a individual variable to make writing the insert
            //statements easier. this will have to be done for all of the arrays in the function parameter

            $appID = $this->session->userdata['username'];
            $isStuWorker = $allInfo['studentWorker'] ? 1 : 0;
            $orgID = $allInfo['organization'];	
            //$addrID = $address['addrID'];
            $street = $allInfo['street'];
            $city = $allInfo['city'];
            //$state = $allInfo['state'];
            //$country = $allInfo['country'];
            $zip = $allInfo['zip'];	
            $score = $allInfo['FERPA'];
            $pawprint = $allInfo['pawprint'];
            $phone = $allInfo['phone'];
            $title = $allInfo['title'];
            $type = $allInfo['requestType'];
            $careerType = $allInfo['careerType'];
            $careerValue = 0;
            $org = $allInfo['organization'];
            $desc = $allInfo['description'];
            $fname = $allInfo['fname'];
            $lname = $allInfo['lname'];
            
            foreach($careerType as $value){
                $careerValue += $value;
            }
            
            $this->db->query("UPDATE address SET street = '$street', city = '$city', zipcode = '$zip' WHERE addrID = (SELECT addrID FROM person where id = '$appID')");
            $this->db->query("UPDATE person SET fname = '$fname', lname = '$lname', pawprint = '$pawprint', phone_number = '$phone', title = '$title' WHERE id = '$appID'");
            $this->db->query("UPDATE ferpaScores SET score = $score WHERE id = '$appID'");

            

            
            switch ($type){
                case "new":
                    $this->db->query("INSERT into application(id, app_type, status, description) VALUES ('$appID', (SELECT typeID FROM applicationTypes"
                    . " WHERE type = '$type'), 1, $desc)");
                    
                    $this->db->query("INSERT into applicant VALUES('$appID', $org+1, $isStuWorker) ");
                                        $this->db->query("INSERT INTO requestedCareerTypes VALUES ((SELECT appID FROM application WHERE id = '$appID'), '$appID', "

                    . "$careerValue)");                    
                    break;
                case "additional":
                    $this->db->query("UPDATE application SET app_type = 2, status = 1, description = '$desc' WHERE id = '$appID'");
                    $this->db->query("UPDATE requestedCareerTypes SET typeID = $careerValue WHERE id = '$appID'");
                    $this->db->query("update applicant SET organizationID = $org+1 , isStudentWorker = $isStuWorker 
                                WHERE id ='$appID'");
                    break;
                default:
                    break;
                    
            }
            


            
        }        

            
        
        
        public function get_address($id){
            //this function should probs be renamed to get address_data
            //other functions like this will need to be developed to return other necessary auto-populating data
//            $this->db->select('*');
//            $this->db->from('address');
            //using the addrID 1 as a test because I know it exists in the DB. it should really be the unique, user
            //identifier that can be accessed from session data
//            $this->db->where('addrid', 1);
//            $query = $this->db->get();
            $query = $this->db->query("SELECT * FROM address WHERE addrID ="
                    . "(SELECT addrID FROM person WHERE id = '$id')");
            return $query->result();
        }
        
        public function get_person($id){
            $query = $this->db->query("SELECT * FROM person WHERE id = '$id'");
            return $query->result();
        }
        
        public function get_ferpa($id){
            $query = $this->db->query("SELECT * FROM ferpaScores WHERE id = '$id'");
            return $query->result();
        }
        
        public function get_applicant($id){
            $query = $this->db->query("SELECT * FROM applicant WHERE id = '$id'");
            return $query->result();
        }
        
        public function get_appData($id){
            $query = $this->db->query("SELECT * FROM application WHERE id = '$id'");
            return $query->result();
        }
        
        public function get_dropdown(){
            $query = $this->db->query("SELECT name FROM organization");
            return $query->result();
        }
        
        public function get_loginData(){
            //this function should return the unique identifier of the applicant so that way its value
            //can be used to both auto-populate the form and submit the form
            $userID = $this->session->userdata('username');
            return $userID;  
        }
		
		//Gets the application id needed to insert the data into the database
		public function get_applicationID($emplID, $requestType){
			$this->db->select('appID');
			$this->db->from('application');
            $this->db->where('emplID', $emplID);
			$this->db->where('app_type', $requestType);
            
			$query = $this->db->get();
			return $query->result();
		}
		
		//Inserts all the information into the database
		public function insert_info($emplID, $organization, $studentWorker, $requestType, $desc, $staffID, $admTests, $roles, $careers){
			$this->load->model('CopySecurityModel');
			
			//Loads data into the application and applicant table
			$this->insert_applicant($emplID, $organization, $studentWorker);
			$this->insert_application($emplID, $requestType, $desc);
			$appID = $this->get_applicationID($emplID, $requestType);
			
			//If the user wants to copy the security of another employee, this code runs
			if($this->input->post('staffMember')){
				$this->CopySecurityModel->copySecurity($staffID, $appID);
			}
			else{	//If they don't want to copy security, this code runs
				//There could be more than one admission test checked or none at all
				if ($admTests->num_rows() > 0){
				   foreach ($admTests as $row)
				   {
						$this->insert_admissionsTestRequests($appID, $row->admTypeID);
				   }
				}
				//There could be more than one role checked or none at all
				if ($roles->num_rows() > 0){
				   foreach ($roles as $row)
				   {
						$this->insert_roleAccessRequest($appID, $row->roleId, $row->isViewRequest, $row->isUpdateRequest);
				   }
				}
				//There could be more than one career checked or none at all
				if ($careers->num_rows() > 0){
				   foreach ($careers as $row)
				   {
						$this->insert_requestedCareerTypes($appID, $emplID, $row->typeID);
				   }
				}
			}
		}
		
		public function insert_applicant($emplID, $organization, $studentWorker)
		{
			$data = array(
				'id' => $emplID ,
				'origanizationid' => $organization ,
				'isStudentWorker' => $studentWorker
			);

			$this->db->insert('applicant', $data); 

			// Produces: INSERT INTO applicant (id, organizationid, isStudentWorker) VALUES ($emplID, $orginization, $studentWorker)
		}

		public function insert_application($emplID, $requestType, $desc)
		{
			$data = array(
				'appID' => 'DEFAULT',
				'id' => $emplID ,
				'app_type' => $requestType ,
				'desc' => $desc
			);

			$this->db->insert('application', $data); 

			// Produces: INSERT INTO application (appID, id, app_type, desc) VALUES (DEFAULT, $emplID, $requestType, $desc)
		}

		public function insert_requestedCareerTypes($appID, $emplID, $typeID)
		{
			$data = array(
				'appID' => $appID,
				'id' => $emplID ,
				'typeID' => $typeID
			);

			$this->db->insert('requestedCareerTypes', $data); 

			// Produces: INSERT INTO requestedCareerTypes (appID, id, typeID) VALUES ($appID, $emplID, $tpyeID)
		}

		public function insert_roleAccessRequest($appID, $roleId, $isVR, $isUR)
		{
			$data = array(
				'roleAccessID' => 'DEFAULT' ,
				'appId' => $appID,
				'roleId' => $roleId ,
				'isViewRequest' => $isVR ,
				'isUpdateRequest' => $isUR
			);

			$this->db->insert('roleAccessRequest', $data); 

			// Produces: INSERT INTO roleAccessRequest (roleAccessID, appId, roleId, isViewRequest, isUpdateRequest) VALUES (DEFAULT, $appId, $roleId, $isVR, $isUR)
		}

		public function insert_admissionsTestRequests($appID, $admTypeID)
		{
			$data = array(
				'admTestID' => 'DEFAULT',
				'applicationID' => $appID ,
				'admTypeID' => $admTypeID 
			);

			$this->db->insert('admissionsTestRequest', $data); 

			// Produces: INSERT INTO admissionsTestRequest (admTestID, applicationID, admTypeID) VALUES (DEFAULT, $appID, $admTypeID)
		}
    }
?>
 