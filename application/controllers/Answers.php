<?php
	class Answers extends CI_Controller{
		public function create($post_id){
			$id = $this->input->post('id');
			$data['post'] = $this->Post_model->get_posts($id);
			$this->form_validation->set_rules('answer', 'answer', 'required');


			if($this->form_validation->run() === FALSE){
				$this->load->view('template/header');
				$this->load->view('posts/view', $data);
				$this->load->view('template/footer');
			} else {
				$this->Answers_model->add_answers($post_id);
				redirect('posts/'.$id);
			}
		}

		
	}