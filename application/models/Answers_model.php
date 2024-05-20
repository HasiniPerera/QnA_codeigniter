<?php
	class Answers_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }
        public function add_answers($post_id){
			$data = array(
				'post_id' => $post_id,
				'body' => $this->input->post('answer'),
				'created_at' => date('Y-m-d H:i:s'),
                'upvotes' => 0, 
                'downvotes' => 0 
			);

			return $this->db->insert('answers', $data);
		}

        public function get_answer($post_id){
            $query = $this->db->get_where('answers', array('post_id' => $post_id));
			return $query->result_array();
        }

		public function update_vote($answer_id, $type) {
			$this->db->set($type, "$type + 1", FALSE);
			$this->db->where('id', $answer_id);
			$this->db->update('answers');
	
			$this->db->select($type);
			$this->db->where('id', $answer_id);
			$query = $this->db->get('answers');
			return $query->row()->$type;
		}
}