<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 Class: Search controller to handles the search
* @author Amit
*/
class Search extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->sitelogin->entryCheck();
	}

    /**
     * Function to search the site based on the filter(pins) and search item
     * @param  : $filter , $searchItem
     * @author : Amit
     * @return
     */
     public function filter($filter=false,$searchItem=false)
	 {
          $searchItem               = $this->input->post('q')?$this->input->post('q'):$searchItem;
          $searchItem               = str_replace('%20', ' ', $searchItem);
          $filter                   = ($filter)?$filter:'pin';
          $data['result']           =  $searchResult  = $this->action_model->search($filter,$searchItem);
          $data['title']            = 'Search';
          $data['filter']           = $filter;
          $data['searchItem']       = $searchItem;
          $this->load->view('header',$data);
          if($filter=='pin')
            $this->load->view('search_pin_view',$data);
          elseif($filter=='user')
              $this->load->view('search_user_view',$data);
          elseif ($filter=='board') {
              $this->load->view('search_board_view',$data);
          }
     }
}