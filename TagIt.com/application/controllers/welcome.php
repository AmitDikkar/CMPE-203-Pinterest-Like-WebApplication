<?php

/**
  Class: Welcome controller for user invite and register
 * @author Amit
 */
class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('pinterest_helper');
        $this->load->library('tank_auth');
        $this->load->model('editprofile_model');
    }

    /**
     * Function handle home and welcome page of a logged user
     * @param   :
     * @author  : Amit
     * @return
     */
    function index() { 
        $userID = false;
        $order = false;
        $limit = $this->config->item('pin_load_limit');
        $page = $this->uri->segment(3, 1);
        
        $nextOffset = ($page -1) * $limit;
        $nextPage = $page +1;
        $sql = "SELECT *
                    FROM
                        pins";

        if ($userID)
            $sql .= " WHERE
                        user_id= $userID ";

        if ($order) {
            $sql .= " ORDER BY
                        ' $order'";
        } else {
            //$sql .= " ORDER BY
            // RAND()";
            $sql .= " ORDER BY time DESC";
        }
        $sql .= " LIMIT $nextOffset,$limit";

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->result();
        }

        if (!empty($row))
            $data['row'] = $row;
        else
            $data['row'] = false;

        $data['title'] = 'Welcome';
        //if a valid login
        if (($this->session->userdata('login_user_id'))) {
            $fb_data = $this->session->userdata('fb_data');
            $this->load->model('Facebook_model');
            $data = array('fb_data' => $fb_data); //facebook data
            $data['id'] = $this->session->userdata('login_user_id'); //logged user id
            $data['userDetails'] = $userDetails = userDetails($data['id']); //logged user details from user id
            if (!empty($row))
                $data['row'] = $row;
            else
                $data['row'] = false;
            $data['offset'] = $nextOffset;
            $data['page'] = $nextPage;
            $this->load->view('welcome', $data);
        }
        //if invalid entry in db , call logout function by passing a paramter to set the invalid login message
        else {
            if ($this->session->userdata('noentry_message')) {
                $data['invalid'] = $this->session->userdata('noentry_message');
                $this->session->unset_userdata('noentry_message');
            }
            $data['offset'] = $nextOffset;
            $data['page'] = $nextPage;
            $this->load->view('welcome', $data);
        }
    }

    /*
     * Function to load the most liked pins page
     * @param   :
     * @author  : Amit
     * @return
     */

    function mostLiked() {
        $this->load->model('action_model');
        $data['title'] = 'Most liked';
        $userID = false;
        $order = false;
        
        $limit = $this->config->item('pin_load_limit');
        $page = $this->uri->segment(3, 1);
        
        $nextOffset = ($page -1) * $limit;
        $nextPage = $page +1;


        $result = $this->action_model->get_most_liked($limit, $nextOffset);
        $data['pins'] = $result;
        $data['page'] = $nextPage;
        $this->load->view('mostliked_view', $data);
    }

    /*
     * Function to load the most repined pins page
     * @param   :
     * @author  : Amit
     * @return
     */

    function mostRepinned() {
        $this->load->model('action_model');
        $data['title'] = 'Most Repinned';
        $userID = false;
        $order = false;
        
        $limit = $this->config->item('pin_load_limit');
        $page = $this->uri->segment(3, 1);
        
        $nextOffset = ($page -1) * $limit;
        $nextPage = $page +1;

        $result = $this->action_model->get_most_repinned($limit, $nextOffset);
        $data['pins'] = $result;
        $data['page'] = $nextPage;
        $this->load->view('mostrepin_view', $data);
    }

    /*
     * Function to load the underconstruction page
     * @param   :
     * @author  : Amit
     * @return
     */

    function underconstruction() {
        $this->sitelogin->entryCheck();
        $data['title'] = 'Under construction';
        $this->load->view('construction_view', $data);
    }

    /*
     * Function not in use
     * @param   :
     * @author  : Amit
     * @return
     */

    function topsecret() {
        $fb_data = $this->session->userdata('fb_data');
        if ((!$fb_data['uid']) or (!$fb_data['me']))
            redirect('home');
        else {
            $data = array(
                'fb_data' => $fb_data,
            );
            $this->load->view('topsecret', $data);
        }
    }
}
?>