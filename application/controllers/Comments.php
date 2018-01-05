<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller
{
	public function delete($articleId, $id)
	{
		$this->load->model('articles_model');
		$this->load->model('comments_model');
		$data['comment'] = $this->comments_model->getById($articleId, $id);
		if (isset($this->session->deleteCommentConfirmation) && $this->session->deleteCommentConfirmation)
		{
			$this->comments_model->delete($articleId, $id);
			redirect('/' . $data['comment']['slug']);
		}
		else
		{
			$this->session->set_flashdata('deleteCommentConfirmation', true);
			$data['title'] = 'Delete a comment';
			$this->template->load('deleteComment', $data);
		}
	}
}
