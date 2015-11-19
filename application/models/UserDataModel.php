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
            $state = $address['state'];
            $country = $address['country'];
            $zip = $address['zip_code'];	
            $score = $ferpaScores['score'];
			
            $this->db->query("INSERT INTO address(addrId, street, city, state, country, zip_code) VALUES($addrId, $street, $city, $state, $country, $zip)");
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
		
		public function get_applicationID($emplID, $requestType){
			$this->db->select('appID');
			$this->db->from('application');
            $this->db->where('emplID', $emplID);
			$this->db->where('app_type', $requestType);
            
			$query = $this->db->get();
			return $query->result();
		}
		
		//Copies the security of a desired employee
		public function copySecurity($staffID){
			$this->load->model('CopySecurityModel');
				
			//Grabs the security of the desired employee
			$staffID = $this->CopySecurityModel->get_id($staffID);
			$admTests = $this->CopySecurityModel->get_admissionsTests($staffID);
			$roles = $this->CopySecurityModel->get_roleAccessRequest($staffID);
			$careers = $this->CopySecurityModel->get_requestedCareerTypes($staffID);
		
			//Copies the security into the current user
			//There could be more than one admission test checked
			if ($admTests->num_rows() > 0){
			   foreach ($admTests as $row)
			   {
					$this->insert_admissionsTestRequests($appID, $row->admTypeID)
			   }
			}
			//There could be more than one role checked
			if ($roles->num_rows() > 0){
			   foreach ($roles as $row)
			   {
					$this->insert_roleAccessRequest($appID, $row->roleId, $row->isViewRequest, $row->isUpdateRequest)
			   }
			}
			//There could be more than one career checked 
			if ($careers->num_rows() > 0){
			   foreach ($careers as $row)
			   {
					$this->insert_requestedCareerTypes($appID, $emplID, $row->typeID)
			   }
			}
		}
		
		//Inserts all the information into the database
		public function insert_info($emplID, $organization, $studentWorker, $requestType, $staffID, $admTests, $roles, $careers){
			//Loads data into the application and applicant table
			$this->insert_applicant($emplID, $organization, $studentWorker);
			$this->insert_application($emplID, $requestType);
			$appID = $this->get_applicationID($emplID, $requestType);
			
			//If the user wants to copy the security of another employee, this code runs
			if($this->input->post('staffMember'){
				$this->copySecurity($staffID);
			}
			else{	//If they don't want to copy security, this code runs
				//There could be more than one admission test checked
				if ($admTests->num_rows() > 0){
				   foreach ($admTests as $row)
				   {
						$this->insert_admissionsTestRequests($appID, $row->admTypeID)
				   }
				}
				//There could be more than one role checked
				if ($roles->num_rows() > 0){
				   foreach ($roles as $row)
				   {
						$this->insert_roleAccessRequest($appID, $row->roleId, $row->isViewRequest, $row->isUpdateRequest)
				   }
				}
				//There could be more than one career checked 
				if ($careers->num_rows() > 0){
				   foreach ($careers as $row)
				   {
						$this->insert_requestedCareerTypes($appID, $emplID, $row->typeID)
				   }
				}
			}
		}
    }
?>
