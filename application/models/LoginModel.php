<?php

    class LoginModel extends CI_Model{
        public function login($username, $password){
			//get salt from database
			$this->db->select('salt');
			$this->db->from('authentication');
			$this->where('username', $username);
	
			$query = $this->db->get();
			$row = $query->row();

			if (isset($row))
			{
					$salt = $row->salt;
					//hash the password with the returned salt
					$hash = crypt($password, $salt);
			}
			
            //selecting username and password from members table
            $this->db->select('username', 'password');
            $this->db->from('authentication');
            $this->db->where('username', $username);
            $this->db->where('password_hash', $hash);
            
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