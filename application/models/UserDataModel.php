<?php
    class UserDataModel extends CI_Model{
        
        public function insert_data($applicant, $address, $ferpaScores){
            //this will successfully insert a row into the person table
//            $this->db->query('INSERT INTO person(id, addrid, fname, lname, pawprint, phone_number, title)'
//                    . ' VALUES (\'jrf\', 1, \'Jack\', \'Fay\', \'jrf5x8\', \'5734246735\', \'MR\')');
            
			
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
			
            
            //executing an insert statement
            $this->db->query("INSERT INTO applicant(id, isStudentWorker, organizationID) VALUES($appID, $isStuWorker, $orgID)");
            
            $this->db->query("INSERT INTO address(addrId, street, city, state, country, zip_code) VALUES($addrId, $street, $city, $state, $country, $zip)");
			
			$this->db->query("INSERT INTO ferpaScores(id, score) VALUES($appID, $score)");
        }
?>