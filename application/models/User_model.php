<?php

class User_model extends CI_Model
{

    public function  userdataInsert()
    {

        $data = array(

            'fname' => $this->input->post('fname', TRUE),
            'lname' => $this->input->post('lname', TRUE),
            'email' => $this->input->post('email', TRUE),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)

        );

        return $this->db->insert('users', $data);
    }

    public function  createQuestion()
    {

        $data = array(

            'title' => $this->input->post('title', TRUE),
            'body' => $this->input->post('body', TRUE),

        );

        return $this->db->insert('posts', $data);
    }


    function userLogin()
    {
        $email = $this->input->post('email', TRUE);
        $res = $this->db->get_where('users', array('email' => $email));
        $password = $this->input->post('password');


        $row = $res->row();
        if (password_verify($password,$row->password)) {
            return $row;
        } else {
            return false;
        }

    }
}
