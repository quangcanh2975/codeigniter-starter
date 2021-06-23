<?php

require_once 'routes.php';

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
    }

    public function index()
    {
        $categories = $this->category_model->get_categories();
        $data['categories'] = $categories;

        $this->load->view(TEMPLATE_HEADER);
        $this->load->view(CATEGORY_INDEX, $data);
        $this->load->view(TEMPLATE_FOOTER);
    }

    public function set_category()
    {
        return $this->category_model->set_category();
    }
}
