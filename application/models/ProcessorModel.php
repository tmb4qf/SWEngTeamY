<?php


class ProcessorModel extends CI_Model {

    public function getRequests(){
        $query = $this->db->query("SELECT * FROM application");
        return $query->result();
    }
    
    public function accepted($id){
        $this->db->query("UPDATE application SET status = 2 WHERE id = '$id'");
    }
    
}
