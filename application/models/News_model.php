<?php
class News_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	}

	public function get_news($slug = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($slug == FALSE) {
			$this->db->order_by('news.id', 'DESC');
			$this->db->join('categories', 'categories.id = news.category_id');
			$query = $this->db->get('news');
			return $query->result_array();
		}
		$query = $this->db->get_where('news', array('slug' => $slug));
		return $query->row_array();
	}

	public function set_news($post_image)
	{
		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			"title"	=> $this->input->post('title'),
			"slug" => $slug,
			"text" => $this->input->post('text'),
			"category_id" => $this->input->post('category_id'),
			"post_image" => $post_image == NULL ? 'noimage.jpg' : $post_image
		);

		return $this->db->insert('news', $data);
	}

	public function delete_news($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('news');
		return true;
	}

	public function update()
	{
		$slug = url_title($this->input->post('title'), 'dash', TRUE);
		$id = $this->input->post('id');

		$data = array(
			"title"	=> $this->input->post('title'),
			"slug" => $slug,
			"text" => $this->input->post('text'),
			"category_id" => $this->input->post('category_id')
		);

		$this->db->where('id', $id);
		return $this->db->update('news', $data);
	}

	public function	get_categories($category_id = NULL)
	{
		if ($category_id != NULL) {
			$category = $this->db->query('SELECT * FROM categories WHERE id = ' . $category_id . ';')->row();
			$result = array(
				"id" => $category->id,
				"name" => $category->name,
				"create_date" => $category->create_date
			);
			return $result;
		}
		$query = $this->db->get('categories');
		return $query->result_array();
	}
}
