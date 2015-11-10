<?php
    class AppChoicesModel extends CI_Model{

		public function get_roles(){
			$this->db->query("SELECT * FROM roles INNER JOIN roleType ON roleType=typeID;");
			$query = $this->db->get();
			return $query->result();
		}

		public function get_app_types(){
			$this->db->query("SELECT * FROM applicationTypes;");
			$query = $this->db->get();
			return $query->result();
		}

		public function get_adm_types(){
			$this->db->query("SELECT * FROM admissionsTestTypes;");
			$query = $this->db->get();
			return $query->result();
		}

		public function get_career_types(){
			$this->db->query("SELECT * FROM careerTypes;");
			$query = $this->db->get();
			return $query->result();
		}
	}
?>