<?php
class Post_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_posts($id = FALSE)
    {
        if ($id === FALSE) {
            $this->db->order_by("created_at", "DESC");
            $query = $this->db->select('p.id, p.title, p.body, p.user_id, p.created_at, p.upvotes, p.downvotes, p.comments')
                              ->from('posts as p')
                              ->join('users as u', 'p.user_id = u.id')
                              ->get();
            return $query->result_array();
        }
        $query = $this->db->select('p.id, p.title, p.body, p.user_id, p.created_at, p.upvotes, p.downvotes, p.comments, u.fname')
                          ->from('posts as p')
                          ->where('p.id', $id)
                          ->join('users as u', 'p.user_id = u.id')
                          ->get();
    
        return $query->row_array();
    }
    

    public function get_post_by_user()
    {
        $id = $this->session->userdata('user_id'); 
        $this->db->order_by("created_at", "DESC");
        $query = $this->db->get_where('posts', array('user_id' => $id));
        return $query->result_array();
    }

    public function create_post()
    {
        $id = url_title($this->input->post('title'));

        $data = array(
            'title' => $this->input->post('title'),
            'id' => $id,
            'body' => $this->input->post('body'),
            'user_id' => $this->session->userdata('user_id'), 
            'hashtags' => $this->input->post('hashtags'),
        );

        return $this->db->insert('posts', $data);
    }

    public function delete_question($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('posts');
        return true;
    }

    public function update_post()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'body' => $this->input->post('body'),
        );

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('posts', $data);
    }

    public function increment_vote($post_id, $column) {
        $this->db->set($column, "$column+1", FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('posts');

        log_message('debug', $this->db->last_query());
    }

    public function get_post_comments_count($post_id) {
        $this->db->where('post_id', $post_id);
        $this->db->from('comments');
        return $this->db->count_all_results();
    }
}
