<?php 


/**
* @author Sunny Roy
* @date December 24th 2020
* @description function to load view files of back end with header and footer
* @param $viewName file name to load array and $data as array
**/
if(!function_exists('backend')){
	
	function backend($viewName,$data=array(),$sidebar=true){
		$instance_CI = & get_instance();
        // $data['sessionData'] = $instance_CI->session->is_admin;
		$instance_CI->load->view('common/header',$data);
        
		if($sidebar){
			$instance_CI->load->view('common/sidebar',$data);
		}
		$instance_CI->load->view($viewName,$data);
		$instance_CI->load->view('common/footer',$data);
	}
}

if(!function_exists('frontend')){
	
	function frontend($viewName,$data=array()){

		$instance_CI = & get_instance();
		$instance_CI->load->view('common/web_header',$data);

		$instance_CI->load->view($viewName,$data);
		$instance_CI->load->view('common/web_footer',$data);
	}
}

function pr($data,$die=false){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
	if($die){
		die;
	}
}

function sanitizeInput($data){

	$ci =& get_instance();
	return $ci->security->xss_clean($data);
}


/**
 *
 * for base64 encoding
 */
function encode($id)
{
    return base64_encode($id);
}

/**
 * for base 64 decoding
 */
function decode($id)
{
    return base64_decode($id);
}


/**
 * Redirect back one page
 * @param  -
 * @return -
 */

if (!function_exists('redirect_back')) {
    function redirect_back($get = null)
    {
        $param = ($get == null) ? "" : $get;
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . $param);
        } else {
            header('Location: http://' . $_SERVER['SERVER_NAME'] . $param);
        }
        exit;
    }
}


function getAdminSession($key=null){

	$ci =& get_instance();
	if($key !== null)
	return $ci->session->is_admin->$key;
	else
	return $ci->session->is_admin??[];
}