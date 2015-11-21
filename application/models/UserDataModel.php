<?php
    class UserDataModel extends CI_Model{
        
        public function insert_data($applicant, $address, $ferpaScores){
            //pulling out the data from the array and storing it in a individual variable to make writing the insert
            //statements easier. this will have to be done for all of the arrays in the function parameter
            $appID = $applicant['id'];
            $isStuWorker = $applicant['isStudentWorker'];
            $orgID = $applicant['orgID'];	
            $addrID = $address['addrId'];
            $street = $address['street'];
            $city = $address['city'];
            // $state = $address['state'];
            // $country = $address['country'];
            $zip = $address['zip'];	
            $score = $ferpaScores['score'];
			
            $this->db->query("INSERT INTO address(street, city, zip_code) VALUES($street, $city, $zip)");
            $this->db->query("INSERT INTO ferpaScores(id, score) VALUES($appID, $score)");
            
            //executing an insert statement
            //$this->db->query("INSERT INTO applicant(id, isStudentWorker, organizationID) VALUES($appID, $isStuWorker, $orgID)");
        }

            
        
        
        public function get_data(){
            //this function should probs be renamed to get address_data
            //other functions like this will need to be developed to return other necessary auto-populating data
//            $this->db->select('*');
//            $this->db->from('address');
            //using the addrID 1 as a test because I know it exists in the DB. it should really be the unique, user
            //identifier that can be accessed from session data
//            $this->db->where('addrid', 1);
//            $query = $this->db->get();
            $query = $this->db->query("SELECT * FROM address WHERE addrID = 1");
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
