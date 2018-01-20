<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('markdown');
		$this->load->model('articles_model');
		$this->load->model('categories_model');
		$this->load->model('tags_model');
	}
	
	public function create()
	{
		if (!isset($this->session->isAdmin) || !$this->session->isAdmin)
		{
			redirect('/');
		}
		$this->form_validation->set_rules('title', 'Title', 'required|max_length[255]');
		$this->form_validation->set_rules('content', 'Content', 'required');
		$this->form_validation->set_rules('category', 'Category', 'required');
		if (!$this->form_validation->run())
			$this->template->load('articles/create', ['categories' => $this->categories_model->getAll(), 'title' => 'Create a new article']);
		else
		{
			$slug = $this->articles_model->create($this->session->userId);
			redirect('/' . $slug);
		}
	}
	
	public function index()
	{
		$data['articles'] = $this->articles_model->getAll();
		$data['categories'] = $this->categories_model->getAll();
		$data['title'] = 'All articles';
		$this->template->load('articles/search', $data);
	}
	
	public function read($slug)
	{
		echo $slug;
		$data['article'] = $this->articles_model->getBySlug($slug);
		if (is_null($data['article']))
			show_404();
		$data['authorName'] = $data['article']['username'];
		if (!is_null($data['article']['first_name']) && !is_null($data['article']['last_name']))
			$data['authorName'] = $data['article']['first_name'] . ' ' . $data['article']['last_name'];
		$data['article']['content'] = $this->markdown->parse($data['article']['content']);
		$this->load->model('tags_model');
		$data['tags'] = $this->tags_model->getAllFor($data['article']['id']);
		$data['title'] = $data['article']['title'];
		$this->load->model('comments_model');
		if (isset($this->session->fullName))
		{
			$this->form_validation->set_rules('comment', 'Comment', 'required');
			if ($this->form_validation->run())
				$this->comments_model->create($data['article']['id'], $this->session->userId);
		}
		$data['comments'] = $this->comments_model->getByArticle($slug);
		$this->template->load('articles/read', $data);
	}
	
	public function search()
	{
		$tags = $this->tags_model->get($this->input->get('query'));
		$data['articles'] = $this->articles_model->search($this->categories_model->get($this->input->get('category')), $tags);
		$data['categories'] = $this->categories_model->getAll();
		$data['search'] = true;
		$data['title'] = 'Search results';
		$this->template->load('articles/search', $data);
	}
}
