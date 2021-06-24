<?php
require_once 'routes.php';
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
	public function	__construct()
	{
		parent::__construct();
		$this->load->language('blog');
		$this->load->model('comment_model');
	}

	function index($offset = 0)
	{
		// config for pagination
		$config['base_url'] = base_url() . BLOG;
		$config['total_rows'] = $this->db->count_all('posts');
		$config['per_page'] = 3;
		$config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'pagination-link');

		$this->pagination->initialize($config);
		$data['posts']	= $this->posts_model->get_posts(FALSE, $config['per_page'], $offset);

		$this->load->view(TEMPLATE_HEADER, $data);
		$this->load->view(BLOG_INDEX, $data);
		$this->load->view(TEMPLATE_FOOTER);
	}

	function view($slug = NULL)
	{
		$data['post'] = $this->posts_model->get_posts($slug);
		$data['post_comments'] = $this->comment_model->get_comments($slug);

		if (empty($data['post'])) {
			show_404();
		}

		$data['title'] = $data['post']['title'];
		$data['id'] = $data['post']['id'];
		$category_id = $data['post']['category_id'];
		$category = $this->posts_model->get_categories($category_id);
		$data['post']['category'] = $category['name'];

		$this->load->view(TEMPLATE_HEADER, $data);
		$this->load->view(BLOG_VIEW, $data);
		$this->load->view(TEMPLATE_FOOTER);
	}

	function checkUserLoggedIn()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect(USER_LOGIN);
		}
	}

	public function create()
	{
		$this->checkUserLoggedIn();
		$data['title'] = 'Create post';
		$data['categories'] = $this->posts_model->get_categories();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('content', 'Content', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view(TEMPLATE_HEADER, $data);
			$this->load->view(BLOG_CREATE, $data);
			$this->load->view(TEMPLATE_FOOTER);
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
			$this->posts_model->set_post($post_image);
			$this->session->set_flashdata('post_created', 'Your post created');
			redirect(BLOG);
		}
	}

	public function delete($id)
	{
		$this->checkUserLoggedIn();
		$this->posts_model->delete_post($id);
		$this->session->set_flushdata('post_deleted', 'Your post has been deleted');
		redirect(BLOG);
	}

	public function edit($slug)
	{
		$data['title'] = 'Edit post';
		$data['categories'] = $this->posts_model->get_categories();

		$this->form_validation->set_rules('title', 'Title', 'required');
		// $this->form_validation->set_rules('content', 'Content', 'required');

		$data['post'] = $this->posts_model->get_posts($slug);

		if (empty($data['post'])) {
			return show_404();
		}
		if ($this->form_validation->run() === FALSE) {
			$this->load->view(TEMPLATE_HEADER, $data);
			$this->load->view(BLOG_EDIT, $data);
			$this->load->view(TEMPLATE_FOOTER);
		} else {
			$this->posts_model->update();
			$this->session->set_flashdata('post_updated', 'Your post has been updated');
			redirect(BLOG);
		}
	}
}
