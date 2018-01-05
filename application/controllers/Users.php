<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('users_model');
	}
	
	public function logIn()
	{
		if (isset($this->session->userId))
			redirect('/');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if (!$this->form_validation->run())
			$this->template->load('users/logIn', ['title' => 'Log in']);
		else
		{
			$user = $this->users_model->getByUsername($this->input->post('username'));
			if (!$user || !password_verify($this->input->post('password'), $user['password']))
				$this->template->load('users/logIn', ['title' => 'Log in', 'hasError' => true]);
			else
			{
				$this->session->userId = $user['id'];
				$this->session->fullName = $user['first_name'] . ' ' . $user['last_name'];
				$this->session->isAdmin = $user['is_admin'];
				redirect('/');
			}
		}
	}
	
	public function logOut()
	{
		session_destroy();
		redirect('/');
	}
	
	public function signUp()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[30]|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('passwordConfirmation', 'Confirm password', 'required|matches[password]');
		$this->form_validation->set_rules('firstName', 'First name', 'max_length[30]');
		$this->form_validation->set_rules('lastName', 'Last name', 'max_length[30]');
		if (!$this->form_validation->run())
			$this->template->load('users/signUp', ['title' => 'Sign up']);
		else
		{
			$this->users_model->create();
			$user = $this->users_model->getByUsername($this->input->post('username'));
			$this->session->userId = $user['id'];
			$this->session->fullName = $user['first_name'] . ' ' . $user['last_name'];
			$this->session->isAdmin = $user['is_admin'];
			redirect('/');
		}
	}
}
