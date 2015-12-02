<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewRequestController
 *
 * @author Jack
 */
class ViewRequestController extends CI_Controller {

    public function index(){
        //print_r($this->input->get());
        $id = $this->input->get('applicantID');
        $this->load->model('UserDataModel');
            $data['address'] = $this->UserDataModel->get_address($id);
            $data['person'] = $this->UserDataModel->get_person($id);
            $data['applicant'] = $this->UserDataModel->get_applicant($id);
            $data['ferpa'] = $this->UserDataModel->get_ferpa($id);
            $data['application'] = $this->UserDataModel->get_appData($id);
            $data['dropdown'] = $this->UserDataModel->get_dropdown();
            $data['id'] = $id;
            //passing data array to home view
            $this->load->view('ProcessorApplicationView', $data);
    }
    
    public function acceptRequest(){
            //$id = $this->input->get('applicantID');
            $id = $this->input->post('id');
            $this->load->model('ProcessorModel');
            $this->ProcessorModel->accepted($id);
            
            $this->load->view('success');

    }
    
    
}
