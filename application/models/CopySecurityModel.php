<?php
    class CopySecurityModel extends CI_Model{
	
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
			Retrieves all the chosen admission tests of the employee the user wants to copy 
		*/
		public function get_RequestedCareerTypes($copyID){
		
			$this->db->select('typeID');
			$this->db->from('requestedCareerTypes');
            $this->db->where('id', $copyID);
            
			$query = $this->db->get();
			return $query->result();
		}
	}
?>