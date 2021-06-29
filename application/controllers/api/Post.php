<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Post extends REST_Controller
{
    public function index_get()
    {
        $header = $this->input->get_request_header('Authorization');
        if ($header) {
            $token = explode(' ', $header)[1];
            if ($token && Authorization::validateTimestamp($token)) {
                $posts =  $this->posts_model->get_posts();
                return $this->response($posts, REST_Controller::HTTP_OK);
            }
        }
        $this->response('Access denied', REST_Controller::HTTP_UNAUTHORIZED);
    }
}
