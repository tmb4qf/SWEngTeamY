<?php

class HomeController extends CI_Controller{
    public function index(){

        //basically creates a "HomeModel" object...
        $this->load->model("HomeModel");
        //puts the data returned from getData() into an array called data with a value of 'records'
        $data['records'] = $this->HomeModel->getData();
        
        //loads the HomeView and passes the "data" variable to the view
        $this->load->view("HomeView", $data);
        
        
    }
    
    
    public function test(){
        print "this is our test function";
    }
    
}

 

?>