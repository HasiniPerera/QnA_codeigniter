<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    // Constructor to initialize required models and libraries
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    // Register method to handle user registration
    public function register() {

        // Decode the JSON input to PHP array
        $data = json_decode(file_get_contents('php://input'), true);

        // Set form validation rules
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('fname', 'First Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        // Check if form validation passes
        if ($this->form_validation->run() == FALSE) {

            
            $response = array('status' => 'error', 'message' => validation_errors());// If validation fails, set error response
        } else {
            $insert_response = $this->User_model->userdataInsert($data);// If validation succeeds, insert user data into database
            if ($insert_response) {
                
                $response = array('status' => 'success', 'message' => 'You are registered successfully. Please login.');// If insertion is successful, set success response
            } else {
                
                $response = array('status' => 'error', 'message' => 'Something went wrong. Please try again.');// If insertion fails, set error response
            }
        }

        // Output the response in JSON format
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    
    public function login() {
       
        $data = json_decode(file_get_contents('php://input'), true);

        
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        // Check if form validation passes
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
