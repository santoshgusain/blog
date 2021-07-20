<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	
	public $page_data = [];
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		// pr($_SESSION,1);
	}
	
	public function index()
	{
		echo 'welcome to admin controller';
	}

	// login
	public function login()
	{
		$method = $this->input->method();
		// echo ASSESTS_URL;die;
		if ($method == 'get') {

			if( !empty(getAdminSession()) ){
				return redirect('admin/dashboard');
			}
			$this->load->view('admin/admin_login');
		} else {
			// pr($_POST);

			$config = array(
				array(
						'field' => 'vEmail',
						'label' => 'Email',
						'rules' => 'required'
				),
				array(
						'field' => 'vPassword',
						'label' => 'Password',
						'rules' => 'required'
				)
			);
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			// run validation
			if ($this->form_validation->run() == FALSE){

				return $this->load->view('admin/admin_login');
			}

			$post 	= sanitizeInput($this->input->post());
			extract($post);
			$user_detail = $this->db->where('vEmail',$vEmail)->get('admin')->row();
			// pr($user_detail,1);



			// check password
			if($user_detail->vPassword === md5($vPassword)){
				$res['status'] = 'success';
				$res['msg'] = 'Logged In Success';
				unset($user_detail->vPassword);
				$this->session->set_userdata('is_admin',$user_detail);
				$this->session->set_flashdata('success','Login success');
				return redirect('admin/dashboard');
				// echo "login success";
				// return print(json_encode($res));
			}else{
				$res['status'] = 'error';
				$res['msg'] = 'Incorrect Email Or Password2';
				
				$this->session->set_flashdata('error','Incorrect email or password');
				return redirect('admin/login');
	
			}

			// $status = $this->admin_model->addUser($post);

		}
	}

	// show dashboard
	public function dashboard()
	{
		backend('admin/admin_dashboard');
	}

	// show user listing
	public function user_listing()
	{

		if( $this->input->method() == 'get' ){
			
			$this->page_data['pagetitle'] = 'Manage Users';
			backend('admin/admin_user_listing', $this->page_data);
		}else{

			// pr($_POST,1);
			$postData = $this->input->post();
            $data = $this->admin_model->user_listing($postData);
            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($data));

		}

	}

	// show user listing
	public function user()
	{
		if( $this->input->method() == 'get' ){

			$this->page_data['pagetitle'] = 'Add User';
			backend('admin/user', $this->page_data);
		}else{
			// pr($_POST,1);
			

			$config = array(
				array(
						'field' => 'vFirstName',
						'label' => 'First Name',
						'rules' => 'required'
				),
				array(
						'field' => 'vLastName',
						'label' => 'Last Name',
						'rules' => 'required'
				),
				array(
						'field' => 'vEmail',
						'label' => 'Email',
						'rules' => 'required'
				),
				array(
						'field' => 'vMobile',
						'label' => 'Mobile',
						'rules' => 'required'
				),
				array(
						'field' => 'tAddress',
						'label' => 'Address',
						'rules' => 'required'
				),
				array(
						'field' => 'vPassword',
						'label' => 'Password',
						'rules' => 'required'
				),
			);
		
			$this->load->library('form_validation');
			$this->form_validation->set_rules($config);
			// run validation
			if ($this->form_validation->run() == FALSE){
				$this->page_data['pagetitle'] = 'Add User';
				return backend('admin/user', $this->page_data);
			}

			$post 	= sanitizeInput($this->input->post());
			$status = $this->admin_model->addUser($post);

			if($status){
				echo "success";
			}else{
				echo "failed";
			}

		}
	}
	

	// log out the user
	function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('success','Logged out successfully');
		redirect('admin/login');
	}
}
