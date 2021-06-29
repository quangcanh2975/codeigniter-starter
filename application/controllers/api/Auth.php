<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Auth extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
    }

    public function createJWTPayload($username)
    {
        $issueAtTime = time();
        $expiredTime = $issueAtTime + $this->config->item('jwt_expire_time');
        return array(
            'username' => $username,
            'iat' => $issueAtTime,
            'exp' => $expiredTime
        );
    }

    public function login_post()
    {
        $username = $this->input->post('username');
        $enc_password  = md5($this->input->post('password'));

        $username =  $this->user_model->login($username, $enc_password);

        if ($username) {
            $this->response(Authorization::generateToken($this->createJWTPayload($username)), REST_Controller::HTTP_OK);
            if ($this->agent->is_browser()) {
                $user_data = array('username' => $username, 'logged_in' => true);
                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('user_loggedin', 'You are now logged in');
                redirect();
            }
        } else {
            $this->response('Login failed', REST_Controller::HTTP_BAD_REQUEST);
            if ($this->agent->is_browser()) {
                redirect();
            }
        }
    }

    public function register_post()
    {
        $username = $this->input->post('username');
        $enc_password = md5($this->input->post('password'));
        $this->user_model->register($enc_password);
        $this->response(Authorization::generateToken($this->createJWTPayload($username)), REST_Controller::HTTP_OK);
        if ($this->agent->is_browser()) {
            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            redirect('users/login');
        }
    }
}
