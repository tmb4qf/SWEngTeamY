<?php
    class CopySecurityModel extends CI_Model{
	
		public function get_ID($pawprint){
		
			$this->db->select('id');
			$this->db->from('person');
            $this->db->where('pawprint', $pawprint);
            
			$query = $this->db->get();
			return $query->result();
		}
		/*
			Retrieves all the chosen admission tests of the employee the user wants to copy 
		*/
		public function get_AdmissionsTests($copyID){
		
			$this->db->select('admTypeID');
			$this->db->from('admissionsTestRequest');
			$this->db->join('application', 'admissionsTestRequest.applicationID = application.id', 'inner');
            $this->db->where('application.id', $copyID);
            
			$query = $this->db->get();
			return $query->result();
		}
	
		/*
			Retrieves all the chosen role requests of the employee the user wants to copy 
		*/
		public function get_RoleAccessRequest($copyID){
		
			$this->db->select('roleId', 'isViewRequest', 'isUpdateRequest');
			$this->db->from('roleAccessRequest');
			$this->db->join('application', 'roleAccessRequest.appId = application.id', 'inner');
            $this->db->where('application.id', $copyID);
            
			$query = $this->db->get();
			return $query->result();
		}
	
		/*
			Retrieves all the chosen career tests of the employee the user wants to copy 
		*/
		public function get_RequestedCareerTypes($copyID){
		
			$this->db->select('typeID');
			$this->db->from('requestedCareerTypes');
            $this->db->where('id', $copyID);
            
			$query = $this->db->get();
			return $query->result();
		}
		
		/*
			Inserts into the database the applicationID of the current user
			and the admission test of the employee the user is copying
		*/
		public function set_AdmissionsTests($appID, $admTest){
			$data = array(
				'applicationID' => $appID,
				'admTestID' => $admTest
			);

			$this->db->insert('admissionsTestRequest', $data); 
		}
		
		/*
			Inserts into the database the applicationID of the current user 
			and the roleID, isViewable, and isUpdatable of the role of the employee the user is copying
		*/
		public function set_RoleAccessRequest($appID, $roleID, $view, $update){
			$data = array(
				'appI' => $appID,
				'roleId' => $roleID,
				'isViewRequest' => $view,
				'isUpdateRequest' => $update
			);

			$this->db->insert('roleAccessRequest', $data); 
		}
		
		/*
			Inserts into the database the applicationID and empID of the current user 
			and the career type of the employee the user is copying
		*/
		public function set_RequestedCareerTypes($appID, $userID, $typeID){
		
			$data = array(
				'appID' => $appID,
				'id' => $userID,
				'typeID' => $typeID
			);

			$this->db->insert('requestedCareerTypes', $data); 
		}
	}
?>