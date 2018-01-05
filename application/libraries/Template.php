<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
	private $ci;
	
	public function __construct()
	{
		$this->ci = &get_instance();
	}
	
	public function load($view = null, $data = null, $template = null)
	{
		if (!is_null($view))
		{
			if (file_exists(APPPATH . 'views/' . $view . '.php'))
				$viewPath = $view;
			else
				show_error('Unable to load the requested file: ' . $view. '.php');
			$body = $this->ci->load->view($viewPath, $data, true);
			if (is_null($data))
				$data = ['body' => $body];
			else if (is_array($data))
				$data['body'] = $body;
			else if (is_object($data))
				$data->body = $body;
		}
		if (is_null($template))
			$template = 'default';
		if (!file_exists(APPPATH . 'views/templates/' . $template . '.php'))
			show_error('Unable to load the requested file: templates/' . $template . '.php');
		$this->ci->load->view('templates/' . $template, $data);
	}
}