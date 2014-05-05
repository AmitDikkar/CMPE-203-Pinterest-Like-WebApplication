<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
User controller for other users page view
* @author Pawan
*/
class User extends CI_Controller {


    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}
    /**
     * Function load the the user page from the user id
     * @param   : $id
     * @author  : Pawan
     * @return
     */
     public function index($id)
	 {        
        if($id)
             $data['id'] = $id; // user id
        else
            redirect(); // no user for given id load the home page

        $data['userDetails']    = $userDetails = userDetails($data['id']);//logged user details from user id
        $data['title']          = $userDetails['name'];
        if(empty ($userDetails))
            redirect();
        
        $this->load->view('home', $data);
	 }
}