<?php
class Comment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('comment_model');
    }

    public function create()
    {
        $email = null;
        $user_id = null;
        $slug = $this->input->post('post_slug');
        $user_data = $this->session->userdata();
        if ($user_data && array_key_exists('user_id', $user_data)) {
            $user_id = $user_data['user_id'];
            $email = $user_data['username'];
        } else {
            $email  = $this->input->post('email');
        }
        $this->comment_model->set_comment($user_id, $email);
        redirect(base_url() . 'blog/' . $slug);
    }
}
