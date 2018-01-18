<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller
{
	public function create()
	{
		if (!isset($this->session->isAdmin) || !$this->session->isAdmin)
		{
			redirect('/log-in');
		}
		$this->load->library('form_validation');
		$this->load->model('categories_model');
		$this->form_validation->set_rules('category', 'Name', 'required');
		if ($this->form_validation->run())
		{
			$this->categories_model->create();
			redirect('/');
		}
		else
			$this->template->load('createCategory', ['title' => 'Create a category']);
	}
}
