<?php
/**
 Class: Fb controller for facebook landing page
* @author Anup
*/
class Fb extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->helper('url');
		$this->load->library('tank_auth');
        $this->load->library('tweet');
		$this->load->model('Facebook_model');
	}

    /**
     * Function to show the landing page in facebook after successful invite.
     * @param   :
     * @author  : Anup 
     * @return
     */
	function index()
	{
			$this->load->view('fblogin_page');
	}
     /**
     * Function to handle the user invite
     * @param   :
     * @author  : Anup 
     * @return
     */
    function invite($inviting,$timestamp=false)
    {   
        
        $data['invited_user']  = $invited_user = base64_decode($inviting);
        $data['invited_time'] = $invited_time = base64_decode($timestamp);
        if(is_numeric($invited_user))
        {
            if(isInvitedUserExist($invited_user))
            {
                if( (strtotime("+24 hours", base64_decode($timestamp))>time() ) )
                {   
                    if($this->config->item('need_invite')==1)
                    {   $this->session->set_userdata('invited_user',$invited_user);
                        $this->session->set_userdata('compulsory_invite',true);
                    }
                    else{
                        $this->session->set_userdata('invited_user',$invited_user);

                    }
                    $this->load->view('fblogin_page');
                }
                else{
                    $message    =  'Invalid facebook invite request or request time expired';
                    redirect('auth/logout/noentry/'.$message);
                    break;
                }
            }
            else{
                $message    =  'Invalid facebook invite request or request time expired';
                redirect('auth/logout/noentry/'.$message);
            break;
            }
        }
        else{
            $message    =  'Invalid facebook invite request or request time expired';
            redirect('auth/logout/noentry/'.$message);
            break;
        }

        
       
    }
    function invitetest($inviting,$timestamp=false)
    {   //step 3 of inviting user
        //get invition send user fb id and send time stamp
        $data['invited_user']  = $invited_user = base64_decode($inviting);
        $data['invited_time'] = $invited_time = base64_decode($timestamp);
        if(is_numeric($invited_user))
        {
            if(isInvitedUserExist($invited_user))
            {
                if( (strtotime("+24 hours", base64_decode($timestamp))>time() ) )
                {  
                    if($this->config->item('need_invite')==1)
                    {   $this->session->set_userdata('invited_user',$invited_user);
                        $this->session->set_userdata('compulsory_invite',true);
                    }
                    else{
                        $this->session->set_userdata('invited_user',$invited_user);

                    }
                    $this->load->view('fblogin_page_test');
                }
                else{
                    $message    =  'Invalid facebook invite request or request time expired';
                    redirect('auth/logout/noentry/'.$message);
                    break;
                }
            }
            else{
                $message    =  'Invalid facebook invite request or request time expired';
                redirect('auth/logout/noentry/'.$message);
            break;
            }
        }
        else{
            $message    =  'Invalid facebook invite request or request time expired';
            redirect('auth/logout/noentry/'.$message);
            break;
        }
       
        
    }
    /**
     * Function post fb updates from the site
     * @param   :
     * @author  : Anup 
     * @return
     */
    function fbpost()
    {
        $config = array(
						'appId'  => $this->config->item('facebook_app_id'),
						'secret' => $this->config->item('facebook_app_secret'),
						'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
						);

		$this->load->library('Facebook', $config);
        $this->load->model('Facebook_model');
        $access_token = $this->facebook->getAccessToken();
        $fb_data    = $this->session->userdata('fb_data');
       
        $wall_post = array(
                //'access_token' => $access_token,
                'message' => 'this is my message',
                'name' => 'This is FB App!',
                'caption' => "Caption of the Post",
                'link' => 'http://mylink.com',
                'description' => 'this is a description',
                'picture' => 'http://static.adzerk.net/Advertisers/d18eea9d28f3490b8dcbfa9e38f8336e.jpg',
                'actions' => array(array('name' => 'Get Search',
                'link' => 'http://www.google.com'))
                );
        $result = $this->facebook->api('/me/feed/', 'post', $wall_post);
        echo "<pre>";
        print_r($result) ;
        echo "</pre>";
    }

    
    /**
     * Function not in use
     * @param <type> $data
     */
    /*function facebook($data=false) {

    //$CI =& get_instance();

    //$CI->load->model('fk_model');
    $token = array(
						'appId'  => $this->config->item('facebook_app_id'),
						'secret' => $this->config->item('facebook_app_secret'),
						'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
						);

    $attachment =  array(
        'access_token'  => '',
        'message'       => 'test',
        'link'          => 'http://mylink.com'
    );
    $fb_data = $this->session->userdata('fb_data');
    echo $fb_data['uid'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,'https://graph.facebook.com/' .$fb_data['uid']  . '/feed');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
    $result = curl_exec($ch);
    curl_close($ch);
    }

	/**
     * Function post twitter updates from the site
     * @param   :
     * @author  : Anup 
     * @return
     */
    /*function twitter()
    {
        $this->load->library('twitter');
        $this->load->library('tank_auth');
       
        $this->tweet->enable_debug(TRUE);
        $result = $this->tweet->call('post', 'statuses/update', array('status' => 'my CI application test'));

    }*/
}
?>