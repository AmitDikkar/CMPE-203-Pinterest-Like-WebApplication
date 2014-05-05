<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Activity extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    
     public function index($id=false)
	 {
         $data['title']          = "Activity";
         $data['id']             = ($id)?$id:$this->session->userdata('login_user_id');
         $data['userDetails']    = $userDetails = userDetails($data['id']);
         if(empty ($userDetails))
            redirect();

         $this->load->view('activity_view',$data);
     }
     
     function latestFeeds($userId)
     {   $data['title']          = "Latest feeds";
         $data['id']             = ($userId)?$userId:$this->session->userdata('login_user_id');
         $data['userDetails']    = $userDetails = userDetails($data['id']);
         $this->load->view('followingsActivity_view',$data);
     }
}