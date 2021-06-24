<?php
class Comment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_comments($slug)
    {
        $query = $this->db->query('SELECT comments.id, comments.user_id, comments.post_id, comments.content, comments.email, comments.create_at FROM comments LEFT JOIN posts ON comments.post_id = posts.id WHERE posts.slug = ? ORDER BY comments.create_at DESC;', array($slug));
        return $query->result_array();
    }

    public function set_comment($user_id)
    {
        $data = array(
            "post_id" => $this->input->post('post_id'),
            "email" => $this->input->post('email'),
            "content" => $this->input->post('comment_content'),
            "user_id" => $user_id
        );
        $query = $this->db->insert('comments', $data);
        print_r($query);
    }
}
