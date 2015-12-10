<?php
    class HomePageController extends CI_Controller{
        public function index(){
            //loading the data model and creating a data array that will be passed to the home.php view
            //within the home.php view, the data array may be accessed using the ['value'] of the $data array.
            //in this case, it is "$records"
            $id = $this->session->userdata['username'];
            $this->load->model('UserDataModel');
            $data['address'] = $this->UserDataModel->get_address($id);
            $data['person'] = $this->UserDataModel->get_person($id);
            $data['applicant'] = $this->UserDataModel->get_applicant($id);
            $data['app'] = $this->UserDataModel->get_application($id);
            $data['ferpa'] = $this->UserDataModel->get_ferpa($id);
            $data['application'] = $this->UserDataModel->get_appData($id);
            $data['dropdown'] = $this->UserDataModel->get_dropdown();
            $data['careerType'] = $this->UserDataModel->get_careers($id);
            $data['admissions'] = $this->UserDataModel->get_admissions();
            $data['studentrecords'] = $this->UserDataModel->get_student_records_access();
            $data['studentaid'] = $this->UserDataModel->get_student_aid();
            $data['reserved'] = $this->UserDataModel->get_reserved_access();
            $data['studentChecks'] = $this->UserDataModel->get_checkboxes("studentRecordsAccess", $id, 1);
            $data['admissionsChecks'] = $this->UserDataModel->get_admissions_checkboxes($id);
            $data['financialChecks'] = $this->UserDataModel->get_checkboxes("studentFinancialAidAccess", $id, 3);
            $data['reservedChecks'] = $this->UserDataModel->get_checkboxes("reservedAccess", $id, 4);
            

            //passing data array to home view
            $this->load->view('home', $data);

           // print_r($data['records']);
            //print_r($this->session->userdata['username']);
        }
       
        
        public function checkUserData(){
			$this->load->model('UserDataModel');
			
            //all of the post data on form submission
            $FERPA = $this->input->post('ferpa');
            $username = $this->input->post('username');
            $fname = $this->input->post('fname');
            $lname = $this->input->post('lname');
            $pawprint = $this->input->post('pawprint');
            $emplID = $this->input->post('emplID');
            $title = $this->input->post('title');
            $organization = $this->input->post('organization');
            $street = $this->input->post('street');
            $street2 = $this->input->post('street2');
            $city = $this->input->post('city');
            $zip = $this->input->post('zip');
            $phoneNumber = $this->input->post('phoneNumber');
            $studentWorker = $this->input->post('studentWorker');
            $requestType = $this->input->post('requestType');
            $undergraduate = $this->input->post('undergraduate');
            $graduate = $this->input->post('graduate');
            $medicine = $this->input->post('medicine');
            $veterinarymedicine = $this->input->post('veterinarymedicine');
            $law = $this->input->post('law');
	//Instead of these, maybe staffMember, fname, lname, staffPawprint? Or just staffPawprint?
            $staffMember = $this->input->post('staffMember');
            $fstaffMember = $this->input->post('fstaffMember');
			$staffName = $this->input->post('staffName');
            $staffPosition = $this->input->post('staffPosition');
			$staffID = $this->input->post('staffID');
            $staffEmplID = $this->input->post('staffEmplID');

            $careerType = ["UGRAD" => $undergraduate, "GRAD" => $graduate, "MED" => $medicine, "LAW" => $law, "VET" => $veterinarymedicine];
            $desc = $this->input->post('description');
            $admissions = $this->get_admissions_value();
            $students = $this->get_records_value();
            $reserved = $this->get_reserved_value();
            $financial = $this->get_financialAid_value();
            
            //this array is just used for testing...you can print this array to check all of the data if you want
            $allInfo = array( "FERPA" => $FERPA,"username" => $username, "pawprint" =>$pawprint, "empID" =>$emplID, "title" =>$title,
                "organization" =>$organization, "street" =>$street, "street2" =>$street2, "city" =>$city,
                "zip" =>$zip, "phone" =>$phoneNumber, "studentWorker" =>$studentWorker, "requestType" =>$requestType,
                 "careerType" => $careerType, "staff" =>$staffMember, "former staff" =>$fstaffMember,
                "staffName" =>$staffName, "staffPosition" =>$staffPosition,
                "staffID" =>$staffID, "staffEmplID" =>$staffEmplID, "description" => $desc, "fname" => $fname, "lname" => $lname,
                "admissions" => $admissions, "students"=>$students, "reserved" => $reserved, "financial" => $financial);
            
            //testing...
            //print_r($allInfo);
            //print "$organization";
            
            //calling the insert_data function in the UserDataModel and passing it the arrays that can be used to insert
            //data into the corresponding table
            $this->load->model('UserDataModel');
 
            $this->UserDataModel->insert_data($allInfo);
            
            $this->load->view('success');
            


        }
		
        public function autoPop($employID){
            $this->load->model('AppChoicesModel');

            $person = $this->AppChoicesModel->get_person($employID);
            $addrID = $person['addrID'];
            $address = $this->AppChoicesModel->get_address($addrID);


            $this->load->view('home', $person, $address);
	}
        
        function pdf(){
            $this->output->cache(0);
            $this->load->helper('pdf_helper');
            $this->load->model('UserDataModel');
            
            $id = $this->session->userdata['username'];

            $data['address'] = $this->UserDataModel->get_address($id);
            $data['person'] = $this->UserDataModel->get_person($id);
            $data['applicant'] = $this->UserDataModel->get_applicant($id);
            $data['ferpa'] = $this->UserDataModel->get_ferpa($id);
            $data['application'] = $this->UserDataModel->get_appData($id);
            $data['dropdown'] = $this->UserDataModel->get_dropdown();
            
            
            $this->load->view('pdfreport', $data);
        }
        
        public function get_admissions_value(){
            $this->load->model('UserDataModel');
            $admissionsCountArray = $this->UserDataModel->count_admissions();
            $admissionsCount = $admissionsCountArray[0]->value;
            $a = 1;
            $admissions = 0;
            while($a <= $admissionsCount){
                $admissions += $this->input->post("admissions$a");
                $a++;
                
            }
            
            return $admissions;
        }
        
        public function get_records_value(){
            $this->load->model('UserDataModel');
            $recordsCountArray = $this->UserDataModel->count_records();
            $recordsCount = $recordsCountArray[0]->value;
            $r = 1;
            $recordsV = 0;
            $recordsU = 0;
            while($r <= $recordsCount){
                $recordsU += $this->input->post("studentupdate$r");
                $recordsV += $this->input->post("studentview$r");
                $r++;
                
            }
            
            return $recordsV + $recordsU;
        }
        
        public function get_reserved_value(){
            $this->load->model('UserDataModel');
            $reservedCountArray = $this->UserDataModel->count_reserved();
            $reservedCount = $reservedCountArray[0]->value;
            $begIDArray = $this->UserDataModel->reserved_BegID();
            $begID = $begIDArray[0]->roleID;
            $reservedV = 0;
            $reservedU = 0;
            
            $re=0;
            while($re <= $reservedCount){
                $reservedU += $this->input->post("reservedupdate$begID");
                $reservedV += $this->input->post("reservedview$begID");
                $re++;
                $begID++;
                
            }
            
            return $reservedV + $reservedU;
        }
        
        public function get_financialAid_value(){
            $this->load->model('UserDataModel');
            $financialCountArray = $this->UserDataModel->count_financialAid();
            $financialCount = $financialCountArray[0]->value;
            $fbegIDArray = $this->UserDataModel->financial_BegID();
            $fbegID = $fbegIDArray[0]->roleID;
            $fi = 0;
            $financialV = 0;
            $financialU = 0;
            while($fi < $financialCount){
                $financialU += $this->input->post("financialupdate$fbegID");
                $financialV += $this->input->post("financialview$fbegID");
                $fi++;
                $fbegID++;
                
            }
            
            return $financialV + $financialU;
        }
       
    }
?>