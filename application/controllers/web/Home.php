<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	
	public $page_data = [];
	
	public function __construct(){
		parent::__construct();
		$this->load->model('post_model');
	}
	
	public function index()
	{
		$posts = $this->post_model->getAllPost();
		// pr($posts,1);
		$this->page_data['title'] = 'Home';
		$this->page_data['posts'] = $posts;
		frontend('web/home',$this->page_data);
	}
	
}
