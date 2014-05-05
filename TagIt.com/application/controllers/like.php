<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 Class: Like controller to handles the likes of a user
* @author Amit
*/
class Like extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function display all likes of a user
     * @param  : <Int> $id
     * @author : Amit
     * @return
     */
     public function index($id=false)
	 {
         $data['title']          = "Like";
         $data['id']             = ($id)?$id:$this->session->userdata('login_user_id');//logged user id
         $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id

         if(empty ($userDetails))
            redirect();

         $this->load->view('like_view',$data);
     }
}