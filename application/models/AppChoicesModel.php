<?php
    class AppChoicesModel extends CI_Model{

		/*
			Retrieves all the info for roles, including their type 
		*/
		public function get_roles(){
			$this->db->query("SELECT * FROM roles;");
			$query = $this->db->get();
			return $query->result();
		}

		/*
			Retrieves all the role types (Student Records Access, Reserved Access, etc)
		*/
		public function get_role_types(){
			$this->db->query("SELECT * FROM roleType;");
			$query = $this->db->get();
			return $query->result();
		}
		
		/*
			Retrieves all the different application types (ie new or additional)
		*/
		public function get_app_types(){
			$this->db->query("SELECT * FROM applicationTypes;");
			$query = $this->db->get();
			return $query->result();
		}

		/*
			Retrieves all the admission test types (SAT, ACT, etc)
		*/
		public function get_adm_types(){
			$this->db->query("SELECT * FROM admissionsTestTypes;");
			$query = $this->db->get();
			return $query->result();
		}

		/*
			Retrieves all the career types (MED, UGRAD, LAW)
		*/
		public function get_career_types(){
			$this->db->query("SELECT * FROM careerTypes;");
			$query = $this->db->get();
			return $query->result();
		}
		
		/*
			Retreieves address corresponding to $addrID
		*/
		public function get_address($addrID){
			$sql = "SELECT * FROM database.address WHERE addrID = ?";
			$this->db->query($sql, array($addrID));
			$query = $this->db->get();
			return $query->result();
		}
		
		/*
			Retrieves 
		*/
		public function get_person($id){
			$sql = "SELECT * FROM database.person WHERE id = ?";
			$this->db->query($sql, "user_bio", array($id));
			$query = $this->db->get();
			return $query->result();
		}
	}
?>