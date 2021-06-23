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

        if ($this->form_validation->run() == FALSE) {
            $this->load->view(TEMPLATE_HEADER);
            $this->load->view(USER_REGISTER, $data);
            $this->load->view(TEMPLATE_FOOTER);
        } else {
            $enc_password = md5($this->input->post('password'));

            $this->user_model->register($enc_password);

            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');

            redirect('/blog');
        }
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

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view(TEMPLATE_HEADER);
            $this->load->view(USER_LOGIN, $data);
            $this->load->view(TEMPLATE_FOOTER);
        } else {
            $username = $this->input->post('username');
            $enc_password = md5($this->input->post('password'));

            $user_id = $this->user_model->login($username, $enc_password);

            if ($user_id) {
                $user_data = array('user_id' => $user_id, 'username' => $username, 'logged_in' => true);
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect('/blog');
            } else {
                $this->session->set_flashdata('login_failed', 'Your username or password is not correct');
                redirect();
            }
        }
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
