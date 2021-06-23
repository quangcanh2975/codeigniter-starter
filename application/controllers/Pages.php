<?php

require_once 'routes.php';

class Pages extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->language('blog');
	}

	public function view($page = 'home')
	{
		if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
			show_404();
		}


		if ($page == 'home') {
			$config['base_url'] = base_url() . BLOG;
			$config['total_rows'] = $this->db->count_all('posts');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'pagination-link');

			$this->pagination->initialize($config);
			$data['posts']	= $this->posts_model->get_posts(FALSE, $config['per_page'], FALSE);
			$this->load->view(TEMPLATE_HEADER, $data);
			$this->load->view(BLOG_INDEX, $data);
			$this->load->view(TEMPLATE_FOOTER);
		} else {
			$data['title'] = ucfirst($page);
			$this->load->view(TEMPLATE_HEADER, $data);
			$this->load->view('pages/' . $page, $data);
			$this->load->view(TEMPLATE_FOOTER);
		}
	}
}
