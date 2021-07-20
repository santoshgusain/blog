<?php

class Admin_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }

    function addUser($data){

        // pr($data,1);
        $admin['vFirstName'] = $data['vFirstName']; 
        $admin['vLastName']  = $data['vLastName']; 
        $admin['vEmail']     = $data['vEmail']; 
        $admin['vMobile']    = $data['vMobile']; 
        $admin['tAddress']   = $data['tAddress']; 
        $admin['vPassword']  = md5($data['vPassword']); 
        return $this->db->insert('admin',$admin);
    }


    function user_listing($postData = null)
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
                $searchQuery .= " (CONCAT_WS(' ',vFirstName, vLastName) like '%" . $searchValue . "%' ";
                $searchQuery .= " or vEmail like'%" . $searchValue . "%' ";
                $searchQuery .= " or vPhone like'%" . $searchValue . "%' ";
                $searchQuery .= " or tAddress like'%" . $searchValue . "%' ";
                // $searchQuery .= " or DATE(dCreatedDateTime) like'%" . date_format(date_create(convertTimeZone(date('Y-m-d H:i:s', strtotime($searchValue)), 'US/Central', 'UTC')), 'Y-m-d') . "%'  ";
                $searchQuery .= " ) ";
            }

            //  Total number of records without filtering
            $this->db->select('count(*) as allcount');
            $this->db->from("admin");
            $query = $this->db->get();
            $records = $query->row();
            $totalRecords = $records->allcount;

            // Total number of record with filtering
            $this->db->select('count(*) as allcount');
            $this->db->from("admin");
            if ($searchQuery != '') {
                $this->db->where($searchQuery);
            }
            $records = $this->db->get()->row();
            $totalRecordwithFilter = $records->allcount;

            // Fetch records
            $this->db->select("admin.*,CONCAT_WS(' ',vFirstName,vLastName) vFullName");
            $this->db->from("admin");
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

                $token       = ["iAdminId"    => $record->iAdminId];
                $token       = serialize($token);
                $token       = encode($token);
                $edit_url    = base_url("admin/agent/add-agent?token=") . $token;
                $delete_url  = base_url("admin/agent/delete-agent?token=") . $token;

                $buttons = "<div class=''>  "; //action btn started

                //delete btn
                $buttons .= "<a title='Delete' data-id='".$token."' data-deleted='1' href='$delete_url' class='btn btn-danger btn-sm btn-flat delete-agent'> " . "<i class='fa fa-trash' aria-hidden='true'></i>" . " </a>";

                //edit btn
                $buttons .= " <a title='Edit' href='$edit_url' class='  btn btn-primary btn-sm btn-flat'> " . "<i class='fa fa-edit' aria-hidden='true'></i>" . " </a>  ";

                $buttons .= "</div>"; // action btn ended

                $data[] = array(
                    $i++,
                    $buttons,
                    empty($record->vFullName) ? "-" : ucwords($record->vFullName) ?? "-",
                    empty($record->vEmail) ? "-" : ucwords($record->vEmail) ?? "-",
                    empty($record->vMobile) ? "-" : ucwords($record->vMobile) ?? "-",
                    empty($record->tAddress) ? "-" : ucwords($record->tAddress) ?? "-",
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

}