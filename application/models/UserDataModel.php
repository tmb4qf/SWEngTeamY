<?php
    class UserDataModel extends CI_Model{
        
        public function insert_data($allInfo){
            
            //$applicant = array("id"=>$pawprint, "isStudentWorker" => $studentWorker, "organization" => $organization);
            //$address = array("addID" => $pawprint, "city" => $city, "street" => $street, "zip" => $zip);
            //$ferpaScores = array("id" => $pawprint, "score" => $FERPA);
            
            //pulling out the data from the array and storing it in a individual variable to make writing the insert
            //statements easier. this will have to be done for all of the arrays in the function parameter
            $appID = $this->session->userdata['username'];
            $isStuWorker = $allInfo['studentWorker'] ? 1 : 0;
            $orgID = $allInfo['organization'];	
            //$addrID = $address['addrID'];
            $street = $allInfo['street'];
            $city = $allInfo['city'];
            //$state = $allInfo['state'];
            //$country = $allInfo['country'];
            $zip = $allInfo['zip'];	
            $score = $allInfo['FERPA'];
            $pawprint = $allInfo['pawprint'];
            $phone = $allInfo['phone'];
            $title = $allInfo['title'];
            $type = $allInfo['requestType'];
            $careerType = $allInfo['careerType'];
            $careerValue = 0;
            $org = $allInfo['organization'];
            $desc = $allInfo['description'];
            
            foreach($careerType as $value){
                $careerValue += $value;
            }
            
            $this->db->query("UPDATE address SET street = '$street', city = '$city', zipcode = '$zip' WHERE addrID = (SELECT addrID FROM person where id = '$appID')");
            $this->db->query("UPDATE person SET fname = 'JACK', lname = 'FAY', pawprint = '$pawprint', phone_number = '$phone', title = '$title' WHERE id = '$appID'");
            $this->db->query("UPDATE ferpaScores SET score = $score WHERE id = '$appID'");

            

            
            switch ($type){
                case "new":
                    $this->db->query("INSERT into application(id, app_type, status, description) VALUES ('$appID', (SELECT typeID FROM applicationTypes"
                    . " WHERE type = '$type'), 1, $desc)");
                    
                    $this->db->query("INSERT into applicant VALUES('$appID', $org+1, $isStuWorker) ");
                                        $this->db->query("INSERT INTO requestedCareerTypes VALUES ((SELECT appID FROM application WHERE id = '$appID'), '$appID', "

                    . "$careerValue)");                    
                    break;
                case "additional":
                    $this->db->query("UPDATE application SET app_type = 2, status = 1, description = '$desc' WHERE id = '$appID'");
                    $this->db->query("UPDATE requestedCareerTypes SET typeID = $careerValue WHERE id = '$appID'");
                    $this->db->query("update applicant SET organizationID = $org+1 , isStudentWorker = $isStuWorker 
                                WHERE id ='$appID'");
                    break;
                default:
                    break;
                    
            }
            


            
        }        

            
        
        
        public function get_address($id){
            //this function should probs be renamed to get address_data
            //other functions like this will need to be developed to return other necessary auto-populating data
//            $this->db->select('*');
//            $this->db->from('address');
            //using the addrID 1 as a test because I know it exists in the DB. it should really be the unique, user
            //identifier that can be accessed from session data
//            $this->db->where('addrid', 1);
//            $query = $this->db->get();
            $query = $this->db->query("SELECT * FROM address WHERE addrID ="
                    . "(SELECT addrID FROM person WHERE id = '$id')");
            return $query->result();
        }
        
        public function get_person($id){
            $query = $this->db->query("SELECT * FROM person WHERE id = '$id'");
            return $query->result();
        }
        
        public function get_ferpa($id){
            $query = $this->db->query("SELECT * FROM ferpaScores WHERE id = '$id'");
            return $query->result();
        }
        
        public function get_applicant($id){
            $query = $this->db->query("SELECT * FROM applicant WHERE id = '$id'");
            return $query->result();
        }
        
        public function get_appData($id){
            $query = $this->db->query("SELECT * FROM application WHERE id = '$id'");
            return $query->result();
        }
        
        public function get_dropdown(){
            $query = $this->db->query("SELECT name FROM organization");
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
 