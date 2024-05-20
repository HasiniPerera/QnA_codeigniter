<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function register() {
        $data = json_decode(file_get_contents('php://input'), true);

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            $response = array('status' => 'error', 'message' => validation_errors());
        } else {
            $insert_response = $this->User_model->userdataInsert($data);
            if ($insert_response) {
                $response = array('status' => 'success', 'message' => 'You are registered successfully. Please login.');
            } else {
                $response = array('status' => 'error', 'message' => 'Something went wrong. Please try again.');
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function login() {
        $data = json_decode(file_get_contents('php://input'), true);

        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response = array('status' => 'error', 'message' => validation_errors());
        } else {
            $result = $this->User_model->userLogin($data);

            if ($result != false) {
                $response = array(
                    'status' => 'success', 
                    'message' => 'Login successful', 
                    'user' => array(
                        'user_id' => $result->id,
                        'fname' => $result->fname,
                        'lname' => $result->lname,
                        'email' => $result->email
                    )
                );
            } else {
                $response = array('status' => 'error', 'message' => 'Invalid Email or Password');
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
}
