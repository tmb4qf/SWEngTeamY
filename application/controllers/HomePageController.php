<?php
    class HomePageController extends CI_Controller{
        public function index(){
            //loading the data model and creating a data array that will be passed to the home.php view
            //within the home.php view, the data array may be accessed using the ['value'] of the $data array.
            //in this case, it is "$records"
            $this->load->model('UserDataModel');
            $data['records'] = $this->UserDataModel->get_data();
            //passing data array to home view
            $this->load->view('home', $data);
            
            
            print_r($data['records']);
        }
       
        
        public function checkUserData(){
			$this->load->model('UserDataModel');
			
            //all of the post data on form submission
            $FERPA = $this->input->post('ferpa');
            $username = $this->input->post('username');
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
			
			//Loads data into the application and applicant table
			$this->UserDataModel->insert_applicant($emplID, $organization, $studentWorker);
			$this->UserDataModel->insert_application($emplID, $requestType);
			
			//If the user wants to copy the security of another employee, this code runs
			if($this->input->post('staffMember'){
				
				$this->copySecurity($staffID);
				
			}
			else{
				$this->UserDataModel->insert_admissionsTestRequests();
				$this->UserDataModel->insert_roleAccessRequest();
				$this->UserDataModel->insert_requestedCareerTypes();
			}
			
            //this array is just used for testing...you can print this array to check all of the data if you want
            $allInfo = array( "FERPA" => $FERPA,"username" => $username, "pawprint" =>$pawprint, "empID" =>$emplID, "title" =>$title,
                "organization" =>$organization, "street" =>$street, "street2" =>$street2, "city" =>$city,
                "zip" =>$zip, "phone" =>$phoneNumber, "studentWorker" =>$studentWorker, "requestType" =>$requestType,
                 "undergraduate" =>$undergraduate, "graduate" =>$graduate,
                "medicine" =>$medicine, "vet" =>$veterinarymedicine, "law" =>$law, "staff" =>$staffMember, "former staff" =>$fstaffMember,
                "staffName" =>$staffName, "staffPosition" =>$staffPosition,
                "staffID" =>$staffID, "staffEmplID" =>$staffEmplID);
            
            //these arrays are filled with data specific to the table that the data will be inserted into
            $applicant = array("id"=>$pawprint, "isStudentWorker" => $studentWorker, "orgID" => $organization);
            $address = array("addID" => $pawprint, "city" => $city, "street" => $street, "zip" => $zip);
            $ferpaScores = array("id" => $pawprint, "score" => $FERPA);
            
            //calling the insert_data function in the UserDataModel and passing it the arrays that can be used to insert
            //data into the corresponding table
            $this->UserDataModel->insert_data($applicant, $address, $ferpaScores);
            
            //testing...
            print_r($allInfo);

        }
		
		public function checkUserData($staffID){
			$this->load->model('CopySecurityModel');
				
			//Grabs the security of the desired employee
			$staffID = $this->CopySecurityModel->get_id($staffID);
			$admTests = $this->CopySecurityModel->get_admissionsTests($staffID);
			$roles = $this->CopySecurityModel->get_roleAccessRequest($staffID);
			$careers = $this->CopySecurityModel->get_requestedCareerTypes($staffID);
		
			//Copies the security into the current user
			//There could be more than one admission test checked
			if ($admTests->num_rows() > 0){
			   foreach ($admTests as $row)
			   {
					$this->UserDataModel->insert_admissionsTestRequests($appID, $row->admTypeID)
			   }
			}
			//There could be more than one role checked
			if ($roles->num_rows() > 0){
			   foreach ($roles as $row)
			   {
					$this->UserDataModel->insert_roleAccessRequest($appID, $row->roleId, $row->isViewRequest, $row->isUpdateRequest)
			   }
			}
			//There could be more than one career checked 
			if ($careers->num_rows() > 0){
			   foreach ($careers as $row)
			   {
					$this->UserDataModel->insert_requestedCareerTypes($appID, $emplID, $row->typeID)
			   }
			}
		}
		
	public function autoPop($employID){
            $this->load->model('AppChoicesModel');

            $person = $this->AppChoicesModel->get_person($employID);
            $addrID = $person['addrID'];
            $address = $this->AppChoicesModel->get_address($addrID);

            $this->load->view('home', $person, $address);
	}
       
    }
?>