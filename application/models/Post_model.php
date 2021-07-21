<?php

class Post_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function manage_post($data){

        $post['vTitle']             = $data['vTitle']; 
        $post['tContent']           = $data['tContent']; 
        $post['iSubCategoryId']     = $data['iSubCategoryId']; 
        $post['iAuthorId']          = getAdminSession('iAdminId'); 

        if(isset($data['iSubCategoryId']))
        $post['iCategoryId']        = $data['iCategoryId']; 
        if(isset($data['vFeaturedImage']))
        $post['vFeaturedImage']     = $data['vFeaturedImage']; 

        return $this->db->insert('post',$post);
    }
    
    function update_post($data){

        extract($data);
        $set['vTitle']             = $data['vTitle']; 
        $set['tContent']           = $data['tContent']; 
        $set['iSubCategoryId']     = $data['iSubCategoryId']; 
        $set['iAuthorId']          = getAdminSession('iAdminId'); 

        if(isset($data['iSubCategoryId']))
        $set['iCategoryId']        = $data['iCategoryId']; 
        if(isset($data['vFeaturedImage']))
        $set['vFeaturedImage']     = $data['vFeaturedImage']; 

        if( isset($iPostId) ){
            return $this->db->where('iPostId',$iPostId)->update('post',$set);
        }
        return false;
    }


    function post_listing($postData = null)
    {

        try {
            $response = array();
            $draw = $postData['draw'];
            $start = $postData['start'];
            $rowperpage = $postData['length']; // Rows display per page
            $columnIndex = $postData['order'][0]['column']; // Column index
            $columnName = $postData['columns'][$columnIndex]['name']; // Column name
            $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
            $searchValue = $postData['search']['value']; // Search value

            // Search
            $searchQuery = "";
            if ($searchValue != '') {

                $searchValue = $this->db->escape_str($searchValue);
                $searchQuery .= " (vTitle like '%" . $searchValue . "%' ";
                $searchQuery .= " ) ";
            }

            //  Total number of records without filtering
            $this->db->select('count(*) as allcount');
            $this->db->from("post");
            $this->db->where("dDeletedDate IS NULL");
            $query = $this->db->get();
            $records = $query->row();
            $totalRecords = $records->allcount;

            // Total number of record with filtering
            $this->db->select('count(*) as allcount');
            $this->db->from("post");
            $this->db->where("dDeletedDate IS NULL");
            if ($searchQuery != '') {
                $this->db->where($searchQuery);
            }
            $records = $this->db->get()->row();
            $totalRecordwithFilter = $records->allcount;

            // Fetch records
            $this->db->select(" post.* ");
            $this->db->from("post");
            $this->db->where("dDeletedDate IS NULL");
            if ($searchQuery != '') {
                $this->db->where($searchQuery);
            }
            if (!empty($columnName)) {
                $this->db->order_by($columnName, $columnSortOrder);
            }
            if ($rowperpage != -1) {
                $this->db->limit($rowperpage, $start);
            }
            $records = $this->db->get()->result();
            // pr($records,1);

            //creating array of all data to be listed
            $data = array();
            $i = $start + 1;
            foreach ($records as $record) {

                // $newcreatedDate = convertTimeZone($record->dCreatedDate, 'UTC', $this->user_data["timezone"]);
                // $createdDate = !empty($newcreatedDate) ? date('m/d/Y h:i A', strtotime($newcreatedDate)) : "";

                $image = FEATURED_IMAGE_PATH.$record->vFeaturedImage;
                // $image = file_exists(FEATURED_IMAGE_URL.$record->vFeaturedImage);
                if( file_exists($image) && !empty($record->vFeaturedImage) ){
                    $image = FEATURED_IMAGE_URL.$record->vFeaturedImage;
                    $image = "<img width='50' src='$image' alt='featured image'/>";
                }else{
                    $image = "-";
                }

                $token       = ["iPostId"    => $record->iPostId];
                $token       = serialize($token);
                $token       = encode($token);
                $edit_url    = base_url("post/edit-post?edit=1&token=") . $token;
                $delete_url  = base_url("post/delete-post?token=") . $token;

                $buttons = "<div class=''>  "; //action btn started

                if( $record->iAuthorId == getAdminSession('iAdminId')){
                    //delete btn
                    $buttons .= "<a title='Delete' data-id='".$token."' data-deleted='1' href='$delete_url' class='btn btn-danger btn-sm btn-flat delete-agent'> " . "<i class='fa fa-trash' aria-hidden='true'></i>" . " </a>";
                    //edit btn
                    $buttons .= " <a title='Edit' href='$edit_url' class='  btn btn-primary btn-sm btn-flat'> " . "<i class='fa fa-edit' aria-hidden='true'></i>" . " </a>  ";
                }


                $buttons .= "</div>"; // action btn ended

                $data[] = array(
                    $i++,
                    $buttons,
                    $image,
                    empty($record->vTitle) ? "-" : ucwords($record->vTitle) ?? "-",
                );
            }
            // Response
            $response = array(
                "draw"                 => intval($draw),
                "iTotalRecords"        => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData"               => $data,
                "name"                 => [$columnName, $columnSortOrder],
            );
            return $response;
        } catch (Exception $e) {
            // custom_error_log('US/Central', 'Error Occured while list past payment history info on datatable = ' . ' \n Error Message : ' . $e->getMessage() . ' \n', __FILE__, __CLASS__, __FUNCTION__);
            return false;
        }
    }


    // To get all the posts
    function getAllPost($id=null){

        if($id === null ){

            return $this->db->select('*, CONCAT_WS(" ",a.vFirstName,a.vLastName) author')
                     ->from('post p')
                     ->join('admin a','p.iAuthorId=a.iAdminId','left')
                     ->where("dDeletedDate IS NULL")
                     ->get()->result();
        }

        return $this->db->select('*')
                     ->from('post')
                     ->where("iPostId",$id)
                     ->get()->row();
        
    }

    function getCategories($id=null){

            return $this->db->select('*')
                     ->from('category')
                     ->get()->result();
    }

    function getSubCategories($id=null){
        if( $id === null ){

            return $this->db->select('*')
                     ->from('subcategory')
                     ->get()->result();
        }
        return $this->db->select('*')
                 ->from('subcategory')
                 ->where('iCategoryId',$id)
                 ->get()->result();
    }
}