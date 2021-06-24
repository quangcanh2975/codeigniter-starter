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
        $slug = $this->input->post('post_slug');
        $user_id = null;
        $user_data = $this->session->userdata();
        print_r($user_data);
        if ($user_data && array_key_exists('user_id', $user_data)) {
            $user_id = $user_data['user_id'];
        }
        $this->comment_model->set_comment($user_id);
        redirect(base_url() . 'blog/' . $slug);
    }
}
