<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	}
	
	public function create()
	{
		$data = [
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'first_name' => $this->input->post('firstName'),
			'last_name' => $this->input->post('lastName'),
			'is_admin' => 0];
		return $this->db->insert('users', $data);
	}
	
	public function getById($id)
	{
		$query = $this->db->get_where('users', ['id' => $id]);
		return $query->row_array();
	}
	
	public function getByUsername($username)
	{
		$query = $this->db->get_where('users', ['username' => $username]);
		return $query->row_array();
	}
}
