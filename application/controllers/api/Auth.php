<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
class Auth extends REST_Controller
{
    private  $JWT_TIME_TO_LIVE = 3600;
    private  $JWT_SECRET_KEY = 'kzUf4sxss4AeG5uHkNZAqT1Nyi1zVfpz';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('jwt');
        $this->load->library('user_agent');
    }

    public function login_post()
    {
        $username = $this->input->post('username');
        $enc_password  = md5($this->input->post('password'));

        $username =  $this->user_model->login($username, $enc_password);

        if ($username) {
            $this->response($this->getSignedJWTForUser($username), REST_Controller::HTTP_OK);
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

    function getSignedJWTForUser($username)
    {
        $issuedAtTime = time();
        $tokenExpiration = $issuedAtTime + $this->JWT_TIME_TO_LIVE;
        $payload = array(
            'username' => $username,
            'iat' => $issuedAtTime,
            'exp' => $tokenExpiration
        );
        $jwt = JWT::encode($payload, $this->JWT_SECRET_KEY);
        return $jwt;
    }

    function validateJWTFromRequest($encoded_token)
    {
        $decodeToken = JWT::decode($encoded_token, $this->JWT_SECRET_KEY);
        $isValid = $this->user_model->check_username_exists($decodeToken->username);
        return $isValid;
    }

    public function register_post()
    {
        $username = $this->input->post('username');
        $enc_password = md5($this->input->post('password'));
        $this->user_model->register($enc_password);
        $this->response($this->getSignedJWTForUser($username), REST_Controller::HTTP_OK);
        if ($this->agent->is_browser()) {
            $this->session->set_flashdata('user_registered', 'You are now registered and can log in');
            redirect('users/login');
        }
    }
}
