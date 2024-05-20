<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('pages/Login');
        $this->load->view('template/footer');
    }

    public function userLogin()
    {
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header');
            $this->load->view('pages/Login');
            $this->load->view('template/footer');
        } else {
            $this->load->model('User_model');
            $result = $this->User_model->userLogin();
    
            if ($result != false) {
                $user_data = array(
                    'user_id' => $result->id,
                    'fname' => $result->fname,
                    'lname' => $result->lname,
                    'email' => $result->email,
                    'logged_in' => TRUE
                );
    
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('welcome', "User Login Successful....");
                redirect('posts');
            } else {
                $this->session->set_flashdata('loginMessage', "Invalid Email or Password... Please try again...");
                redirect('Login');
            }
        }
    }

    public function userLogout()
    {
        // clearing data in the session table
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('fname');
        $this->session->unset_userdata('lname');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('logged_in');
        redirect('Login');
    }
}
