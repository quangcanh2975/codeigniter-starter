<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	function index()
	{
		if ($this->verify_min_level(1)) {
			$this->setup_login_form(TRUE);
		} else {
			$data['news']	= $this->news_model->get_news();
			$data['title'] = 'Latest posts';

			$this->load->view('templates/header', $data);
			$this->load->view('news/index', $data);
			$this->load->view('templates/footer');
		}
	}

	function view($slug = NULL)
	{
		$data['news_item'] = $this->news_model->get_news($slug);

		if (empty($data['news_item'])) {
			show_404();
		}

		$data['title'] = $data['news_item']['title'];
		$data['id'] = $data['news_item']['id'];
		$category_id = $data['news_item']['category_id'];
		$category = $this->news_model->get_categories($category_id);
		$data['news_item']['category'] = $category['name'];

		$this->load->view('templates/header', $data);
		$this->load->view('news/view', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$data['title'] = 'Create news item';
		$data['categories'] = $this->news_model->get_categories();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'Text', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('news/create', $data);
			$this->load->view('templates/footer');
		} else {

			// configure for upload file
			$config['upload_path']          = './assets/images/posts';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userfile')) {
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
				$post_image = 'noimage.jpg';
			} else {
				$data = array('upload_data' => $this->upload->data());
				print_r($_FILES);
				$post_image = $_FILES['userfile']['name'];
			}
			print_r($post_image);
			$this->news_model->set_news($post_image);
			redirect('/news');
		}
	}

	public function delete($id)
	{
		$this->news_model->delete_news($id);
		redirect('news');
	}

	public function edit($slug)
	{
		$data['title'] = 'Edit news';
		$data['categories'] = $this->news_model->get_categories();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('text', 'Text', 'required');

		$data['news_item'] = $this->news_model->get_news($slug);

		if (empty($data['news_item'])) {
			return show_404();
		}
		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', $data);
			$this->load->view('news/edit', $data);
			$this->load->view('templates/footer');
		} else {
			$this->news_model->update();
			redirect('/news');
		}
	}
}
