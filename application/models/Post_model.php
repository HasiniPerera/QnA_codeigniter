<?php
class Post_model extends CI_Model
{
    public function __construct()
    {
        // Load the database
        $this->load->database();
    }

    // Retrieve posts from the database
    public function get_posts($id = FALSE)
    {
        if ($id === FALSE) {
            // Get all posts ordered by creation date in descending order
            $this->db->order_by("created_at", "DESC");
            $query = $this->db->select('p.id, p.title, p.body, p.user_id, p.created_at, p.upvotes, p.downvotes, p.comments')
                              ->from('posts as p')
                              ->join('users as u', 'p.user_id = u.id')
                              ->get();
            return $query->result_array();
        }
        // Get a single post by ID
        $query = $this->db->select('p.id, p.title, p.body, p.user_id, p.created_at, p.upvotes, p.downvotes, p.comments, u.fname')
                          ->from('posts as p')
                          ->where('p.id', $id)
                          ->join('users as u', 'p.user_id = u.id')
                          ->get();
    
        return $query->row_array();
    }
    

    // Retrieve posts created by the logged-in user
    public function get_post_by_user()
    {
        $id = $this->session->userdata('user_id'); 
        // Get posts by user ID ordered by creation date in descending order
        $this->db->order_by("created_at", "DESC");
        $query = $this->db->get_where('posts', array('user_id' => $id));
        return $query->result_array();
    }

    // Create a new post in the database
    public function create_post()
    {
        // Generate a URL-friendly ID from the post title
        $id = url_title($this->input->post('title'));

        // Prepare the data for insertion
        $data = array(
            'title' => $this->input->post('title'),
            'id' => $id,
            'body' => $this->input->post('body'),
            'user_id' => $this->session->userdata('user_id'), 
            'hashtags' => $this->input->post('hashtags'),
        );

        // Insert the data into the posts table
        return $this->db->insert('posts', $data);
    }

    // Delete a post from the database
    public function delete_question($id)
    {
        // Specify the post ID for deletion
        $this->db->where('id', $id);
        // Delete the post from the posts table
        $this->db->delete('posts');
        return true;
    }

    // Update an existing post in the database
    public function update_post()
    {
        // Prepare the data for update
        $data = array(
            'title' => $this->input->post('title'),
            'body' => $this->input->post('body'),
        );

        // Specify the post ID for update
        $this->db->where('id', $this->input->post('id'));
        // Update the post in the posts table
        return $this->db->update('posts', $data);
    }

    // Increment the vote count for a post
    public function increment_vote($post_id, $column) {
        // Increment the specified column (upvotes or downvotes) by 1
        $this->db->set($column, "$column+1", FALSE);
        $this->db->where('id', $post_id);
        $this->db->update('posts');

        // Log the last query executed for debugging
        log_message('debug', $this->db->last_query());
    }

    // public function get_post_comments_count($post_id) {
    //     $this->db->where('post_id', $post_id);
    //     $this->db->from('comments');
    //     return $this->db->count_all_results();
    // }
}
