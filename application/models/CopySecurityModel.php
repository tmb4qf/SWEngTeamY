<?php
    class CopySecurityModel extends CI_Model{
	
		/*
			Retrieves the id of the employee the user wants to copy 
		*/
		public function get_id($pawprint){
		
			$this->db->select('id');
			$this->db->from('person');
            $this->db->where('pawprint', $pawprint);
            
			$query = $this->db->get();
			return $query->result();
		}
		
		/*
			Retrieves all the chosen admission tests of the employee the user wants to copy 
		*/
		public function get_admissionsTests($copyID){
		
			$this->db->select('admTypeID');
			$this->db->from('admissionsTestRequest');
			$this->db->join('application', 'admissionsTestRequest.applicationID = application.id', 'inner');
            $this->db->where('application.id', $copyID);
            
			$query = $this->db->get();
			return $query;
		}
	
		/*
			Retrieves all the chosen role requests of the employee the user wants to copy 
		*/
		public function get_roleAccessRequest($copyID){
		
			$this->db->select('roleId', 'isViewRequest', 'isUpdateRequest');
			$this->db->from('roleAccessRequest');
			$this->db->join('application', 'roleAccessRequest.appId = application.id', 'inner');
            $this->db->where('application.id', $copyID);
            
			$query = $this->db->get();
			return $query;
		}
	
		/*
			Retrieves all the chosen career tests of the employee the user wants to copy 
		*/
		public function get_requestedCareerTypes($copyID){
		
			$this->db->select('typeID');
			$this->db->from('requestedCareerTypes');
            $this->db->where('id', $copyID);
            
			$query = $this->db->get();
			return $query;
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
	}
?>