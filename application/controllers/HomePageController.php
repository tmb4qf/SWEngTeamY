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
        }
		
		public function autoPop($employID){
			$this->load->model('AppChoicesModel');
			$person = $this->AppChoicesModel->get_person($employID);
			$addrID = $person['addrID'];
			$address = $this->AppChoicesModel->get_address($addrID);
		}
       
        
       
    }
?>