<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	public $page_data = [];
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('post_model');
		// pr(getAdminSession('iAdminId'),1);
	}
	
	public function index()
	{
		echo'welcome to admin controller';
	}


	// show post listing
	public function post_listing(){
		if( $this->input->method() == 'get' ){
			
			$this->page_data['pagetitle'] = 'Manage Posts';
			backend('post/admin_post_listing',$this->page_data);
		}else{

			// pr($_POST,1);
			$postData = $this->input->post();
            $data = $this->post_model->post_listing($postData);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));

		}
	}

	// show post listing
	public function manage_post(){

		if( $this->input->method() == 'get' ){

			if( isset($_GET['edit'])){

				$token = unserialize(decode($_GET['token']));
				extract($token);
				if(empty($iPostId)){
					return redirect_back();
				}

				$category = $this->post_model->getCategories();
				$subcategory = $this->post_model->getSubCategories();
				$post = $this->post_model->getAllPost($iPostId);
				$this->page_data['pagetitle'] = 'Manage Posts';
				$this->page_data['post'] = $post;
				$this->page_data['category'] = $category;
				$this->page_data['subcategory'] = $subcategory;
				$this->page_data['iPostId'] = $iPostId;

				// pr($this->page_data,1);
				backend('post/post',$this->page_data);
			}else{

				$category = $this->post_model->getCategories();
				$subcategory = $this->post_model->getSubCategories();

				$this->page_data['pagetitle'] = 'Manage Posts';
				$this->page_data['category'] = $category;
				$this->page_data['subcategory'] = $subcategory;

				// pr($category,1);
				backend('post/post',$this->page_data);
			}

		}else{

			// pr($_POST,1);
			$config = array(
				array(
						'field' => 'vTitle',
						'label' => 'Title',
						'rules' => 'required'
				),
				array(
						'field' => 'iCategoryId',
						'label' => 'Category',
						'rules' => 'required'
				),
				array(
						'field' => 'tContent',
						'label' => 'Content',
						'rules' => 'required'
				)
			);
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			// run validation
			if ($this->form_validation->run() == FALSE){
				$category = $this->post_model->getCategories();
				$this->page_data['pagetitle'] = 'Manage Posts';
				$this->page_data['category'] = $category;
				return backend('post/post',$this->page_data);
			}

			$post 	= sanitizeInput($this->input->post());

			if( isset($post['iPostId']) ){

				// upload profile pic
				if ($_FILES['vFeaturedImage']['name']) {
					$type = explode("/", $_FILES['vFeaturedImage']['type']);
					$_FILES['vFeaturedImage']['name'] = "featured_img_" . time() . "." . $type[1];
					$image_uploded = $this->upload_files($type);
	
					if (isset($image_uploded['file_name']) && !empty($image_uploded['file_name'])) {
						
						$post['vFeaturedImage'] = $image_uploded['file_name'];
					}
				}
	
				$status = $this->post_model->update_post($post);
	
				if($status){
					$this->session->set_flashdata('success','Post updated successfully');
					redirect('post/post-listing');
				}else{
					$this->session->set_flashdata('error','Technical error');
					redirect_back();
				}
			}else{

				// upload profile pic
				if ($_FILES['vFeaturedImage']['name']) {
					$type = explode("/", $_FILES['vFeaturedImage']['type']);
					$_FILES['vFeaturedImage']['name'] = "featured_img_" . time() . "." . $type[1];
					$image_uploded = $this->upload_files($type);
	
					if (isset($image_uploded['file_name']) && !empty($image_uploded['file_name'])) {
						
						$post['vFeaturedImage'] = $image_uploded['file_name'];
					}
				}
	
				$status = $this->post_model->manage_post($post);
	
				if($status){
					$this->session->set_flashdata('success','Post created successfully');
					redirect('post/post-listing');
				}else{
					$this->session->set_flashdata('error','Technical error');
					redirect_back();
				}
			}
		}
	}


	 /**
	 * Function to upload resume of candidate
	 * @return      null
	 * 
	 */
	public function upload_files($type)
	{
		// $this->load->library('upload');
		$upload_data = array();
		$config['upload_path']          = FEATURED_IMAGE_PATH;
		$config['allowed_types']        = 'png|jpeg|jpg';
		$config['max_size']             = 10000;

		$this->load->library('upload', $config);
		 
		if (!$this->upload->do_upload('vFeaturedImage')) {
			$error['msg'] = $this->upload->display_errors();
		}
		$data_img = $this->upload->data();
        return $data_img;
	}

	public function delete_post(){
		$token = unserialize(decode($_GET['token']));
		extract($token);

		if(empty($iPostId)){
			return false;
		}
		$set['dDeletedDate'] = date('Y-m-d H:i:s');
		$this->db->where('iPostId',$iPostId)->update('post',$set);
		redirect_back();
	}

	public function getSubCategory(){

		$get = $this->input->get();
		extract($get);
		$data = $this->post_model->getSubCategories($id);

		$html = "<option value=''>-select-</option>";
		if( !empty($data) ){

			foreach($data as $row){
				$html .= "<option value='$row->iSubCategoryId'>".ucwords($row->vSubCategoryName)."</option>";
			}
		}
		echo $html;
	}


	public function edit_podst(){


		if( $this->input->method() == 'get' ){


			$token = unserialize(decode($_GET['token']));
			extract($token);
			if(empty($iPostId)){
				return redirect_back();
			}

			$category = $this->post_model->getCategories();
			$subcategory = $this->post_model->getSubCategories();
			$post = $this->post_model->getAllPost($iPostId);
			$this->page_data['pagetitle'] = 'Manage Posts';
			$this->page_data['post'] = $post;
			$this->page_data['category'] = $category;
			$this->page_data['subcategory'] = $subcategory;
			$this->page_data['iPostId'] = $iPostId;
			// pr($this->page_data,1);
			backend('post/post',$this->page_data);
		}else{

			// pr($_POST,1);
			$config = array(
				array(
						'field' => 'vTitle',
						'label' => 'Title',
						'rules' => 'required'
				),
				array(
						'field' => 'iCategoryId',
						'label' => 'Category',
						'rules' => 'required'
				),
				array(
						'field' => 'tContent',
						'label' => 'Content',
						'rules' => 'required'
				)
			);
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			// run validation
			if ($this->form_validation->run() == FALSE){
				$category = $this->post_model->getCategories();
				$this->page_data['pagetitle'] = 'Manage Posts';
				$this->page_data['category'] = $category;
				return backend('post/post',$this->page_data);
			}

			$post 	= sanitizeInput($this->input->post());

			// upload profile pic
			if ($_FILES['vFeaturedImage']['name']) {
				$type = explode("/", $_FILES['vFeaturedImage']['type']);
				$_FILES['vFeaturedImage']['name'] = "featured_img_" . time() . "." . $type[1];
				$image_uploded = $this->upload_files($type);

				if (isset($image_uploded['file_name']) && !empty($image_uploded['file_name'])) {
					
					$post['vFeaturedImage'] = $image_uploded['file_name'];
				}
			}

			$status = $this->post_model->manage_post($post);

			if($status){
				$this->session->set_flashdata('success','Post created successfully');
				redirect('post/post-listing');
			}else{
				$this->session->set_flashdata('error','Technical error');
				redirect_back();
			}
		}
	}
}
