<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php if($this->session->userdata('login_user_id')):?>
        <?php $loggedUserDetails = userDetails();?>
    <?php endif;?>
    <title><?php echo (isset($title))?$title:'TagIt ';?></title>

    <!-- For facebook like button-og meta tags -->
    <?php if((isset($pinId))&&(isset($boardId))):?>
        <?php $pinDetails = getPinDetails($pinId,$boardId)?>
        <?php if(!empty($pinDetails)):?>
            <meta property="og:title" content="<?php echo $pinDetails->description;?>"/>
            <meta property="og:image" content="<?php echo $pinDetails->pin_url;?>"/>
            <meta property="og:site_name" content="TagIt"/>
            <meta property="og:type" content="album"/>
            <meta property="og:url" content="<?php echo current_url();?>"/>
            <meta property="og:description" content="<?php echo $pinDetails->description;?>"/>
            <meta property="fb:app_id" content="<?php echo  $this->config->item('facebook_app_id')?>"/>
        <?php endif;?>
        <?php else:?>
             <meta property="og:title" content="TagIt"/>
            <meta property="og:image" content="<?php echo site_url('application/ui/images/logo_big.png');?>"/>
            <meta property="og:site_name" content="Pinterest"/>
            <meta property="og:type" content="album"/>
            <meta property="og:url" content="<?php echo current_url();?>"/>
            <meta property="og:description" content="TagIt "/>
            <meta property="fb:app_id" content="<?php echo  $this->config->item('facebook_app_id')?>"/>
    <?php endif;?>
    <!--[if IE]>
     <style>
        .form-field-input , .header_links-box,.nav ul , .pinit_button , .pro-blue-button , .edit-prof-button , .banner-white-bg , .banner_bluebg_left , .banner_bluebg_right, .latest-updates_heddbox , .latest-updates_box, .Following_heddbox , .Following_box , .profile_image , .sortboard_right-corn , .pin_no , .sortboard-blue-button , .editprofile_insidebox , .pin_item , .action , .buttonLogin , .info_bar , .popup_login  .more {
                     behavior: url(<?php echo base_url(); ?>application/ui/css/PIE.htc);
     }
     </style>
     <![endif]-->

    <link rel="icon" href="<?php echo base_url(); ?>application/ui/images/favicon.ico" type="image/x-icon" />
    <link href="<?php echo base_url(); ?>application/ui/css/tagit.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>application/ui/css/style1.css" rel="stylesheet" type="text/css" />

    <script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
    <script type="text/javascript">if (window.location.hash == '#_=_')window.location.hash = '';</script>

    <?php if($this->session->userdata('login_user_id')):?>
    <script type="text/javascript">
        var baseUrl = '<?php echo base_url() ?>';
        var logName = '<?php echo $loggedUserDetails['name'] ?>';
        var logImage = '<?php echo $loggedUserDetails['image'] ?>';
        var logId = '<?php echo $loggedUserDetails['userId'] ?>';
    </script>
    <?php endif;?>


    <script src="<?php echo base_url(); ?>application/scripts/pinterest_clone.js" type="text/javascript" ></script>

    <script src="<?php echo base_url(); ?>application/scripts/jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>application/src/facebox.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
          $('a[rel*=facebox]').facebox({
            loadingImage : '<?php echo base_url(); ?>application/src/loading.gif',
            closeImage   : '<?php echo base_url(); ?>application/src/closelabel.png'
          })
        })
    </script>

    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery.cog.infi.min.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery.livequery.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/jquery/jquery.cog.mass.min.js"></script>

     <!--facebox  -->
    <link href="<?php echo base_url(); ?>application/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>application/ui/css/example.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
  app_id   = '<?php echo $this->config->item('facebook_app_id');?>';
  FB.init({
    //appId  : '399160855575',
     appId    : app_id,
    frictionlessRequests:true
  });

  function sendRequestToRecipients() {
    var user_ids = document.getElementsByName("user_ids")[0].value;
    FB.ui({method: 'apprequests',
      message: 'My Great Request',
      to: user_ids
    }, requestCallback);
  }

  function sendRequestViaMultiFriendSelector() {
   inviting = '<?php echo $inviting_user.'/'.base64_encode(time());?>'
    FB.ui({
        method:'send',
        name: 'TagIt',
        link: baseUrl+'fb/invite/'+inviting
      });
       
  }

  function requestCallback(response) {
      var output = '';
        for (property in response) {
            if(property=='to')
            {
                output = response[property]
                insertInvitedId(output);
            }
        }
  }
  function insertInvitedId(id)
  {   dataString = 'ids='+id;
      $.ajax({
        url: "<?php echo site_url('login/insertInvitedId');?>",
        type: "POST",
        data: dataString,
        dataType: 'json',
        cache: false,
        success: function (data) {
        //alert(data);

    }
    });
  }
</script>
<link href="<?php echo base_url(); ?>application/ui/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    function invite()
    {
        dataString = $("#invite_form").serialize();
        var email1                 = $("input#email1").val();
        var email2                 = $("input#email2").val();
        var email3                 = $("input#email3").val();
        var email4                 = $("input#email4").val();
        $('#error').html("") ;
        if((email1=='')&&(email2=='')&&(email3=='')&&(email4==''))
        {
                $('#error').html("Please provide atleast one email!") ;
                return false;
        }
        $("#loading").show();
        $.ajax({
            url: "<?php echo site_url('/invite/submit/');?>/",
            //POST method is used
            type: "POST",
            //pass the data
            data: dataString,
            dataType: 'json',
            cache: false,
            //success
            success: function (data) {
                $("#message_added").show();
                if(data){
                    $("#loading").hide();
                    $('#message_added').html("invited successfully!") ;
                    $('.error').html("")
                    document.getElementById('invite_form').reset()
                 }
                else
                  $('#message_added').html("Error occured!") ;
                 //hide the success message after 3 secs
                 setTimeout(function() {
                    $('#message_added').fadeOut("slow");
                }, 5000);
            }
    });
    }

</script>


</head>


<body>
    
    <div class="outer">
        <div class="header_home"><!-- starting Header -->
            <div class="container"><!-- starting container -->
                <div class="header_box">


                    <!--Search box-->
                    <?php if($this->session->userdata('login_user_id')):?>
                    <div class="">
                       TagIt-Click it n Pin it..
                    </div>
                    <?php endif;?>


                    <div class="logo" style="margin-right: 47px;"><a href="<?php echo site_url();?>"><img src="<?php echo site_url()?>/application/ui/images/tagit/logo.png"/></a></div>

                    <!--Login button -->
                    <?php if(!$this->session->userdata('login_user_id')):?>
                        <span class="buttonLogin">
                            <a href="<?php echo site_url();?>login/handleLogin">Login</a>
                        </span>
                    <?php endif;?>

                    <?php if(!$this->session->userdata('login_user_id')):?>
                        <?php $style ="style='width:325px'";?>
                    <?php else:?>
                        <?php $style ="";?>
                    <?php endif;?>

                    <?php $this->load->view('popup_js');?>
                    <div class="header_links-box" <?php echo $style;?>>
                        <ul class="nav">
                            <!-- Menu if not login -->
                            <?php if(!$this->session->userdata('login_user_id')):?>
                                <li>
                                    <a href="<?php echo site_url('welcome/index')?>">Everything</a></li>
                                <li>
                                    <a href="<?php echo site_url('welcome/mostLiked')?>">Most Liked</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('welcome/mostRepinned')?>">Most Repined</a>
                                </li>
                             <?php endif;?>

                            <!-- Menu if  login -->
                            <?php if($this->session->userdata('login_user_id')):?>
                                <li>
                                    <a class="nav-about" href="<?php echo site_url('welcome/index')?>">Home</a>
                                    <ul>
                                        <li>
                                            <a href="<?php echo site_url('welcome/mostLiked')?>">Most Liked</a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('welcome/mostRepinned')?>">Most Repinned</a>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('pins/videos')?>">Videos</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('gift/index/0/100')?>">Gifts</a>
                                   <!-- <ul>
                                        <li><a href="<?php echo site_url('gift/index/0/100')?>">$0 - $100</a></li>
                                        <li><a href="<?php echo site_url('gift/index/100/500')?>">$100 - $500</a></li>
                                        <li><a class="divider" href="<?php echo site_url('gift/index/500/1000')?>">$500 - $1000</a></li>
                                        <li><a href="<?php echo site_url('gift/index/1000/10000')?>">$1000 - $10000</a></li>
                                        <li><a href="<?php echo site_url('gift/index/10000/50000')?>">$10000 - $50000</a></li>
                                        <li><a class="divider" href="<?php echo site_url('gift/index/50000/100000')?>">$50000 - $100000</a></li>
                                        <li><a href="<?php echo site_url('gift/index/100000/above')?>">$100000 above</a></li>
                                    </ul>
									-->
                                </li>
                            <li>
                                <a class="nav-add" href="#">Add</a>
                                <ul>
                                    <li><a href="<?php echo site_url('board/add')?>" class="ajax" >New board</a></li>
                                    <li class="beforeDivider"><a href="<?php echo site_url('pins/uploadPins')?>" class="ajax" >Upload a pin</a></li>
                                </ul>
                            </li>

<!--                        <li>
                                <a class="nav-about" href="<?php //echo site_url();?>welcome/underconstruction">About</a>
                                <ul>
                                    <li><a href="<?php //echo site_url();?>welcome/underconstruction">Help</a></li>
                                    <li><a href="<?php //echo site_url();?>welcome/underconstruction">Pin it button</a></li>
                                    <li><a href="<?php //echo site_url();?>welcome/underconstruction">Team</a></li>
                                    <li><a href="<?php //echo site_url();?>welcome/underconstruction">Blog</a></li>

                                </ul>
                            </li>-->

                            <li class="float-right">
                                <span class="profile-thumb-nav">
                                    <a href="<?php echo site_url('user/index/'.$loggedUserDetails['userId']);?>"><img src="<?php echo $loggedUserDetails['image']; ?>?type=large" alt="Profile Picture of <?php echo $loggedUserDetails['name']; ?>" width="24" height="24" />
                                    </a>
                                </span>
                            </li>
                            <a href="<?php echo site_url('user/index/'.$loggedUserDetails['userId']);?>"><?php $first_name = explode(' ', $loggedUserDetails['name']);?></a>
                            <li>
                                <a class="nav-about" href="<?php echo site_url('user/index/'.$loggedUserDetails['userId']);?>"><?php echo $first_name[0]; ?></a>
                                <ul>
                                    <li><a href="<?php echo site_url()?>invite">Invite Friends</a></li>
<!--                                    <li class="beforeDivider"><a href="<?php //echo site_url()?>invite">Find Friends</a></li>-->
                                    <li class="divider"><a href="<?php echo site_url('user/index/'.$loggedUserDetails['userId']);?>">Boards</a></li>

                                    <li><a href="<?php echo site_url()?>pins">Pins</a></li>
                                    <li><a href="<?php echo site_url()?>like">Likes</a></li>
                                    <li class="divider"><a href="<?php echo site_url()?>editprofile/">Settings</a></li>
                                    <li><a href="<?php echo site_url()?>auth/logout/">Logout</a></li>
                                </ul>
                            </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </div><!-- closing container -->
    </div><!-- closing Header -->

    <!--TOP NAVIGATION ENDS HERE -->












<div id="fb-root"></div>

<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div class="container">
        <div class="invite_box" style="margin-top: 94px;">
            <div class="invite_insidebox">
                <div class="invite_form">
                    
        

                    <h3>Invite Your Friends to TagIt</h3>

                    <table>

                        <tr>
                            <td>Invite from facebook</td>
                            <td><input type="button" onclick="sendRequestViaMultiFriendSelector(); return false;" value="Facebook" class="Button2 Button13 WhiteButton"/></td>
                        </tr>
                        <!--<form id="invite_form" method="post" action="/ci/pinterest/invite/submit">-->
                        <form id="invite_form" method="post" action="<?php echo site_url(); ?>invite/submit">
                            <tr>
                                <td><label>Email Address </label></td>
                                <td><input type="text" class="email inputform-field" id="email1" name="email1" style="margin-top: 5px;width:250px;"/></td>
                            </tr>
                           
                            <tr>
                                <td><label>note (optional):</label></td>
                                <td><textarea name="message"  name="description" class="inputform_field_textarea"></textarea></td>
                            </tr>
                            <tr>
                                <td><input type="button" name="submit"  value="Invite" id="SendInvites" class="Button2 Button13 WhiteButton" onclick="invite()"/></td>
                            </tr>
                    </form>
                 </table>
                 <div id="message_added" style="color: #d20000;"></div>
                 <div id="error" style="color: #d20000;"></div>
                 <div id="loading" style="display:none"><img src="<?php echo site_url();?>/application/ui/images/admin/loading.gif"/></div>
            </div>
        </div>
    </div>
</div>
</div>
    </div>
<?php $this->load->view('footer');?>

</body>
</html>


<!--<p><fb:login-button autologoutlink="true"></fb:login-button></p>
    <p><fb:like></fb:like></p>
<div id="fb-root"></div>

<script>
  window.fbAsyncInit = function() {FB.init({appId: '399160855575', status: true, cookie: true,xfbml: true});FB.Event.subscribe('auth.sessionChange', function(response) {if (response.session) {FB.ui({method: 'apprequests', title:'Invite your friends to my cool site!', message: 'You have been invited to this cool site'});} else {}}); };(function() {
    var e = document.createElement('script');
    e.type = 'text/javascript';
    e.src = document.location.protocol +
      '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>-->

 

