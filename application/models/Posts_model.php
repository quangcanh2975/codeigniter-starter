<?php
class Posts_model extends CI_Model
{
	public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE)
	{
		if ($limit) {
			$this->db->limit($limit, $offset);
		}
		if ($slug == FALSE) {
			$this->db->order_by('posts.id', 'DESC');
			$this->db->join('categories', 'categories.id = posts.category_id');
			$query = $this->db->get('posts');
			return $query->result_array();
		}
		$query = $this->db->get_where('posts', array('slug' => $slug));
		return $query->row_array();
	}

	public function create_multiple_posts()
	{
		$input = array();
		$str = "What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).";

		for ($i = 0; $i < 100; $i++) {
			$item = array(
				"title"	=> 'Test ' . $i,
				"slug"	=> 'test-' . $i,
				"content"	=> $str,
				"category_id"	=> 1,
				"post_image"	=> 'noimage.jpg'
			);
			array_push($input, $item);
		}
		for ($i = 0; $i < count($input); $i++) {
			$data = array(
				"title"	=> $input[$i]['title'],
				"slug"	=> $input[$i]['slug'],
				"content"	=> $input[$i]['content'],
				"category_id"	=> $input[$i]['category_id'],
				"post_image"	=> 'noimage.jpg'
			);
			$this->db->insert('posts', $data);
		}
	}
	public function set_post($post_image)
	{
		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			"title"	=> $this->input->post('title'),
			"slug" => $slug,
			"content" => $this->input->post('content'),
			"category_id" => $this->input->post('category_id'),
			"post_image" => $post_image == NULL ? 'noimage.jpg' : $post_image
		);

		return $this->db->insert('posts', $data);
	}

	public function delete_post($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('posts');
		return true;
	}

	public function update()
	{
		$slug = url_title($this->input->post('title'), 'dash', TRUE);
		$id = $this->input->post('id');

		$data = array(
			"title"	=> $this->input->post('title'),
			"slug" => $slug,
			"content" => $this->input->post('content'),
			"category_id" => $this->input->post('category_id')
		);

		$this->db->where('id', $id);
		return $this->db->update('posts', $data);
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
