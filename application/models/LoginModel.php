<?php

    class LoginModel extends CI_Model{
        public function login($username, $password){

            //selecting username and password from members table
            $this->db->select('username', 'password');
            $this->db->from('members');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            
            $query = $this->db->get();
            
            //checking to see if the query returns a unique row
            if($query->num_rows() == 1){
                //assigning user data to the session
                $newdata = array(
                                    'username'  => $username,
                                    'logged_in' => TRUE
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