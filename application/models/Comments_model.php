<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comments_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	}
	
	public function create($articleId, $authorId)
	{
		$data = [
			'article_id' => $articleId,
			'content' => $this->input->post('comment'),
			'creation_date' => date('Y-m-d'),
			'author_id' => $authorId];
		return $this->db->insert('comments', $data);
	}
	
	public function delete($articleId, $id)
	{
		$this->db->delete('comments', ['id' => $id, 'article_id' => $articleId]);
	}

	public function getByArticle($slug)
	{
		$this->db->select('comments.id id, comments.article_id article_id, comments.content content, comments.creation_date creation_date, comments.author_id author_id, users.username username, users.first_name first_name, users.last_name last_name');
		$this->db->join('users', 'comments.author_id = users.id');
		$this->db->join('articles', 'article_id = articles.id');
		$this->db->where('slug', $slug);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('comments');
		return $query->result_array();
	}

	public function getById($articleId, $id)
	{
		$this->db->select('comments.id id, comments.article_id article_id, comments.content content, comments.creation_date creation_date, comments.author_id author_id, users.username username, users.first_name first_name, users.last_name last_name, articles.slug slug');
		$this->db->join('users', 'comments.author_id = users.id');
		$this->db->join('articles', 'article_id = articles.id');
		$this->db->where(['comments.id' => $id, 'article_id' => $articleId]);
		$query = $this->db->get('comments');
		return $query->row_array();
	}
}
