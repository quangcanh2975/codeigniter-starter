<?php

require_once 'routes.php';

class Users extends CI_Controller
{
    public function register()
    {
        $data['title'] = "Sign Up";

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Confirm password', 'matches[password]');

        $this->load->view(TEMPLATE_HEADER);
        $this->load->view(USER_REGISTER, $data);
        $this->load->view(TEMPLATE_FOOTER);
    }

    function check_username_exists($username)
    {
        $this->form_validation->set_message('check_username_exists', 'That username is taken, please select another one');
        if ($this->user_model->check_username_exists($username)) {
            return TRUE;
        }
        return FALSE;
    }

    function check_email_exists($email)
    {
        $this->form_validation->set_message('check_email_exists', 'That username is taken, please select another one');
        if ($this->user_model->check_email_exists($email)) {
            return TRUE;
        }
        return FALSE;
    }

    public function login()
    {

        $data['title'] = "Sign In";

        $this->form_validation->set_rules('usr', 'Username', 'required');
        $this->form_validation->set_rules('pwd', 'Password', 'required');

        $this->load->view(TEMPLATE_HEADER);
        $this->load->view(USER_LOGIN, $data);
        $this->load->view(TEMPLATE_FOOTER);
    }

    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('username');

        $this->session->set_flashdata('logged_out', 'You has been logged out');
        redirect(USER_LOGIN);
    }
}
