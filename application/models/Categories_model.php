<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model
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
			'slug' => url_title($this->input->post('category'), '-', true),
			'name' => $this->input->post('category')];
		return $this->db->insert('categories', $data);
	}

	public function get($slug)
	{
		return $this->db->get_where('categories', ['slug' => $slug])->row_array();
	}
	
	public function getAll()
	{
		$this->db->order_by('name');
		return $this->db->get('categories')->result_array();
	}
}
