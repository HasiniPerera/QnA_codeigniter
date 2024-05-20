<?php
class Posts extends CI_Controller {
    public function index() {
        $this->load->model('Post_model');
        $data['posts'] = $this->Post_model->get_posts();
        $data['title'] = 'Latest Questions';

        $this->load->view('template/header', $data);
        $this->load->view('posts/index', $data);
        $this->load->view('template/footer');
    }

    public function view($post_id = NULL) {
        $this->load->model('Answers_model');
        $data['post'] = $this->Post_model->get_posts($post_id);
        $data['answers'] = $this->Answers_model->get_answer($post_id);

        if (empty($data['post'])) {
            show_404();
        }

        $this->load->view('template/header');
        $this->load->view('posts/view', $data);
        $this->load->view('template/footer');
    }

    public function user_post() {
        $data['posts'] = $this->Post_model->get_post_by_user();

        $this->load->view('template/header');
        $this->load->view('pages/My_question', $data);
        $this->load->view('template/footer');
    }

    public function create() {
		if (!$this->session->userdata('logged_in')) {
			redirect('Login');
		}
		
        $data['title'] = 'Post Question';

        // form validation
        $this->form_validation->set_rules('title', 'title', 'required');
        $this->form_validation->set_rules('body', 'body', 'required');
        $this->form_validation->set_rules('hashtags', 'hashtags', 'trim');

        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('template/header');
            $this->load->view('posts/create', $data);
            $this->load->view('template/footer');
        } else {
            $this->Post_model->create_post();
            redirect('posts');
        }
    }

    public function delete($id) {
        $this->Post_model->delete_question($id);
        redirect('posts');
    }

    public function edit($id) {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('Login');
        }

        $data['post'] = $this->Post_model->get_posts($id);

        if (empty($data['post'])) {
            show_404();
        }

        $data['title'] = 'Edit Post';

        $this->load->view('template/header');
        $this->load->view('posts/edit', $data);
        $this->load->view('template/footer');
    }

    public function update() {
        // Check login
        if (!$this->session->userdata('logged_in')) {
            redirect('Login');
        }

        $this->Post_model->update_post();

        // Set message
        $this->session->set_flashdata('post_updated', 'Your post has been updated');

        redirect('posts');
    }

    public function upvote($id) {
        $this->load->model('Post_model');
        $post = $this->Post_model->get_posts($id); // Fetch the single post
        $new_count = $post['upvotes'] + 1;

        $this->db->where('id', $id);
        $this->db->update('posts', array('upvotes' => $new_count));

        echo json_encode(['count' => $new_count]);
    }

    public function downvote($id) {
        $this->load->model('Post_model');
        $post = $this->Post_model->get_posts($id); // Fetch the single post
        $new_count = $post['downvotes'] + 1;

        $this->db->where('id', $id);
        $this->db->update('posts', array('downvotes' => $new_count));

        echo json_encode(['count' => $new_count]);
    }

    public function vote_answer($answer_id, $type) {
        $this->load->model('Answers_model');
        $count = $this->Answers_model->update_vote($answer_id, $type);
        echo json_encode(['count' => $count]);
    }

    public function search() {
        echo "Search method called"; // 
        $this->load->model('Post_model');
        $query = $this->input->get('q');
        $data['posts'] = $this->Post_model->search_posts($query);
        $data['title'] = 'Search Results';

        $this->load->view('templates/header', $data);
        $this->load->view('posts/index', $data);
        $this->load->view('templates/footer');
    }

}
?>
