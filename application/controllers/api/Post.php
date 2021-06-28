<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Exception;

require APPPATH . 'libraries/REST_Controller.php';


class Post extends REST_Controller
{
    private  $JWT_SECRET_KEY = 'kzUf4sxss4AeG5uHkNZAqT1Nyi1zVfpz';
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('jwt');
    }
    public function list_get()
    {
        echo 'runing';
    }
    public function index_get()
    {
        if ($this->checkAuthorization()) {
            $posts =  $this->posts_model->get_posts();
            $this->response($posts, REST_Controller::HTTP_OK);
        } else {
            $this->response('Access denied', REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function checkAuthorization()
    {
        try {
            $header = $this->input->get_request_header('Authorization');
            if (!$header) {
                return false;
            }
            $payload = explode(' ', $header)[1];
            $data = JWT::decode($payload, $this->JWT_SECRET_KEY);
            return $data;
        } catch (Exception $ex) {
            print_r($ex->getMessage());
            return false;
        }
    }
}
