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
			'author_id' => $authorId,
			'category_id' => $this->input->post('category'),
			'views' => 0];
		$this->db->insert('articles', $data);
		return $data['slug'];
	}
	
	public function getAll()
	{
		$this->db->select('articles.id, articles.title, articles.slug, articles.content, articles.creation_date, articles.views, users.username, users.first_name, users.last_name, count(comments.id) comments, categories.name category_name, categories.slug category_slug');
		$this->db->join('users', 'articles.author_id = users.id');
		$this->db->join('comments', 'articles.id = comments.article_id', 'left');
		$this->db->join('categories', 'articles.category_id = categories.id');
		$this->db->group_by('articles.id');
		$this->db->order_by('articles.id', 'desc');
		$query = $this->db->get('articles');
		return $query->result_array();
	}
	
	public function getBySlug($slug)
	{
		$this->db->select('articles.id, articles.title, articles.slug, articles.content, articles.creation_date, articles.views, users.username, users.first_name, users.last_name, categories.name category_name, categories.slug category_slug');
		$this->db->join('users', 'articles.author_id = users.id');
		$this->db->join('categories', 'articles.category_id = categories.id');
		$this->db->where('articles.slug', $slug);
		$query = $this->db->get('articles');
		return $query->row_array();
	}
	
	public function getLatest($limit)
	{
		$this->db->select('articles.id, articles.title, articles.slug, articles.content, articles.creation_date, articles.views, users.username, users.first_name, users.last_name, count(comments.id) comments, categories.name category_name');
		$this->db->join('users', 'articles.author_id = users.id');
		$this->db->join('comments', 'articles.id = comments.article_id', 'left');
		$this->db->join('categories', 'articles.category_id = categories.id');
		$this->db->group_by('articles.id');
		$this->db->order_by('articles.id', 'desc');
		$query = $this->db->get('articles', $limit);
		return $query->result_array();
	}
	
	public function read($article)
	{
		$this->db->where('slug', $article['slug']);
		$this->db->update('articles', ['views' => $article['views'] + 1]);
	}
	
	public function search($category, $tags)
	{
		$this->db->select('articles.id, articles.title, articles.slug, articles.content, articles.creation_date, users.username, users.first_name, users.last_name, count(comments.id) comments, categories.name category_name, categories.slug category_slug');
		$this->db->join('articles', 'tagged_as.article_id = articles.id');
		$this->db->join('users', 'articles.author_id = users.id');
		$this->db->join('comments', 'articles.id = comments.article_id', 'left');
		$this->db->join('categories', 'articles.category_id = categories.id');
		$condition = '';
		if (!is_null($category))
			$condition = 'articles.category_id = ' . $category['id'];
		if (count($tags) > 0)
		{
			if (!empty($condition))
				$condition .= ' AND ';
			$condition .= 'tagged_as.tag_id IN (';
			for ($i = 0; $i < count($tags); $i++)
			{
				if ($i > 0)
					$condition .= ', ';
				if (!is_null($tags[$i]))
					$condition .= $tags[$i]['id'];
				else
					$condition .= '0';
			}
			$condition .= ')';
		}
		if (!empty($condition))
			$this->db->where($condition);
		$this->db->group_by('articles.id');
		$this->db->order_by('articles.id', 'desc');
		return $this->db->get('tagged_as')->result_array();
	}
}
