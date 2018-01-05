<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	}
	
	public function create($authorId)
	{
		$data = [
			'title' => $this->input->post('title'),
			'slug' => url_title($this->input->post('title'), '-', true),
			'content' => $this->input->post('content'),
			'creation_date' => date('Y-m-d'),
			'author_id' => $authorId];
		$this->db->insert('articles', $data);
		return $data['slug'];
	}
	
	public function getAll()
	{
		$this->db->select('articles.id, articles.title, articles.slug, articles.content, articles.creation_date, users.username, users.first_name, users.last_name, count(comments.id) comments');
		$this->db->join('users', 'articles.author_id = users.id');
		$this->db->join('comments', 'articles.id = comments.article_id', 'left');
		$this->db->group_by('articles.id');
		$this->db->order_by('articles.id', 'desc');
		$query = $this->db->get('articles');
		return $query->result_array();
	}
	
	public function getBySlug($slug)
	{
		$this->db->join('users', 'articles.author_id = users.id');
		$this->db->where('slug', $slug);
		$query = $this->db->get('articles');
		return $query->row_array();
	}
	
	public function getLatest($limit)
	{
		$this->db->select('articles.id, articles.title, articles.slug, articles.content, articles.creation_date, users.username, users.first_name, users.last_name, count(comments.id) comments');
		$this->db->join('users', 'articles.author_id = users.id');
		$this->db->join('comments', 'articles.id = comments.article_id', 'left');
		$this->db->group_by('articles.id');
		$this->db->order_by('articles.id', 'desc');
		$query = $this->db->get('articles', $limit);
		return $query->result_array();
	}
}
