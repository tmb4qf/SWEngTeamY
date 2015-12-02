<?php

    class LoginController extends CI_Controller{
        public function index(){
            $this->load->view('login');
        }
        
        public function checkLogin(){
            
            $this->form_validation->set_rules('username', 'username', 'required');
            $this->form_validation->set_rules('password', 'password', 'required|callback_verifyUser');
    
            if($this->form_validation->run() == false){
                $this->load->view('login');
            }else{
                //print_r($this->session->all_userdata());
                if($this->session->userdata('processor') == 1){
                    redirect('ApplicantProcessor/index');
                }else{
                    redirect('HomePageController/index');
                }
            }
            
            
        }
        
        public function verifyUser(){
            $name = $this->input->post('username');
            $password = $this->input->post('password');
            
            $this->load->model('LoginModel');
            
            if($this->LoginModel->login($name, $password)){
                return true;
            }else{
                $this->form_validation->set_message('verifyUser', 'Incorrect username or password. Try again');
                return false;
            }
        }
    }

?>