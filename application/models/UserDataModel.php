<?php

    class UserDataModel extends CI_Model{
        
        public function insert_data($applicant, $address, $ferpaScores){
            //this will successfully insert a row into the person table
//            $this->db->query('INSERT INTO person(id, addrid, fname, lname, pawprint, phone_number, title)'
//                    . ' VALUES (\'jrf\', 1, \'Jack\', \'Fay\', \'jrf5x8\', \'5734246735\', \'MR\')');
            
            //pulling out the data from the array and storing it in a individual variable to make writing the insert
            //statements easier. this will have to be done for all of the arrays in the function parameter
            $appID = $applicant['id'];
            $isStuWorker = $applicant['isStudentWorker'];
            $orgID = $applicant['orgID'];
            
            //executing an insert statement
            $this->db->query("INSERT INTO applicant(id, isStudentWorker, organizationID) VALUES($appID, $isStuWorker, $orgID)");
            
            
        }
        
        public function get_data(){
            //this function should probs be renamed to get address_data
            //other functions like this will need to be developed to return other necessary auto-populating data
            $this->db->select('*');
            $this->db->from('address');
            //using the addrID 1 as a test because I know it exists in the DB. it should really be the unique, user
            //identifier that can be accessed from session data
            $this->db->where('addrid', 1);
            $query = $this->db->get();
            return $query->result();
        }
        
        public function get_loginData(){
            //this function should return the unique identifier of the applicant so that way its value
            //can be used to both auto-populate the form and submit the form
            $userID = $this->session->userdata('username');
            return $userID;
        }
        
    }

?>
