<?php

    class HomeModel extends CI_Model{
        
        //creates function that will connect to database and return the desired table
        public function getData(){
            //"practice" is the name of the table and "db" is the database variable in config/database.php
            $query = $this->db->get('practice');
            return $query->result();
            
        }

    }