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
