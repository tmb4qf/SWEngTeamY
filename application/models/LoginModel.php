<?php

    class LoginModel extends CI_Model{
        public function login($username, $password){

            //selecting username and password from members table
//            $this->db->select('username', 'password');
//            $this->db->from('members');
//            $this->db->where('username', $username);
//            $this->db->where('password', $password);
            
            $this->db->select('id', 'password_hash', 'isProcessor');
            $this->db->from('authentication');
            $this->db->where('id', $username);
            $this->db->where('password_hash', $password);
            
            $query = $this->db->query("SELECT * FROM authentication WHERE id='$username' AND password_hash = '$password'");
            
            
            //checking to see if the query returns a unique row
            if($query->num_rows() == 1){
                foreach($query->result() as $row){
                    $proccessor = $row->isProcessor;
                }
                //assigning user data to the session
                $newdata = array(
                                    'username'  => $username,
                                    'logged_in' => TRUE,
                                    'processor' => $proccessor
                    
               );

                //sets user session data
                $this->session->set_userdata($newdata);
                return true;
            }else{
                return false;
            }
        }
        
        
    }


?>