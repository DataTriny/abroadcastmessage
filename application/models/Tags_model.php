<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	}
	
	public function create($articleId, $tag)
	{
		$data = [
			'name' => url_title($this->input->post('tag'), '-', true),
			'name' => $this->input->post('category')];
		return $this->db->insert('categories', $data);
	}

	public function getAllFor($articleId)
	{
		$this->db->select('id, name');
		$this->db->join('tagged_as', 'tags.id = tagged_as.tag_id');
		$this->db->where('tagged_as.article_id', $articleId);
		$this->db->order_by('name');
		return $this->db->get('tags')->result_array();
	}
}
