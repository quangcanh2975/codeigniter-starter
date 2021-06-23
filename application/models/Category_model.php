<?php
class Category_model extends CI_Model
{
    public function get_categories()
    {
        $query = $this->db->get('categories');
        return $query->result_array();
    }

    public function set_category()
    {
        $data = array(
            'name' => $this->input->post('name'),
        );
        return $this->db->insert('categories', $data);
    }
}
