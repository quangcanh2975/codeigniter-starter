<?php
require_once 'routes.php';

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('posts_model');
        $this->load->language('blog');
    }

    public function posts()
    {
        $data = array();
        $data['search_results'] = $this->posts_model->search_post();
        $this->load->view(TEMPLATE_HEADER);
        $this->load->view(BLOG_SEARCH, $data);
        $this->load->view(TEMPLATE_FOOTER);
    }
}
