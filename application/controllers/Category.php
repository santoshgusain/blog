<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public $page_data = [];
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
	}
	public function index()
	{
		echo'welcome to admin controller';
	}


	// show category listing
	public function category_listing(){

		if( $this->input->method() == 'get' ){
			
			$this->page_data['pagetitle'] = 'Manage Categories';
			backend('category/admin_category_listing',$this->page_data);
		}else{

			// pr($_POST,1);
			$postData = $this->input->post();
            $data = $this->category_model->category_listing($postData);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));

		}
	}

	// show category listing
	public function manage_category(){

		if( $this->input->method() == 'get' ){

			$this->page_data['pagetitle'] = 'Add Category';
			backend('category/category',$this->page_data);
		}else{

			$config = array(
				array(
						'field' => 'vCategoryName',
						'label' => 'Category Name',
						'rules' => 'required'
				)
			);
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			// run validation
			if ($this->form_validation->run() == FALSE){
				$this->page_data['pagetitle'] = 'Add Category';
				return backend('category/category',$this->page_data);
			}


			
			
			$post = sanitizeInput($this->input->post());

			// pr($post,1);
			
			$category['vCategoryName'] 	= $post['vCategoryName'];
			$sub_category 				= empty($post['vSubCategoryName'])?[]:$post['vSubCategoryName'];

			// $vSubCategoryName 			= empty($post['vSubCategoryName']) ? [] : array_map(function($val){
			// 	return ['vSubCategoryName'=>$val];
			// },$post['vSubCategoryName']);
			
			// pr($category);
			// pr($vSubCategoryName);
			$status  = $this->category_model->addCategory($category,$sub_category);
			if($status){
				echo "success";
			}else{
				echo "failed";
			}
		}
	}
}
