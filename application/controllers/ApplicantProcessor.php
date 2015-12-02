<?php

class ApplicantProcessor extends CI_Controller {

    public function index(){
        //print_r($this->session->all_userdata());
        $id = $this->session->userdata['username'];
        $this->load->model('ProcessorModel');
        $data['requests'] = $this->ProcessorModel->getRequests();
        
        $this->load->view('processor.php', $data);
    }
   
}
