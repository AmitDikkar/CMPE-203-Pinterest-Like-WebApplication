<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-EN">
<head>
<link rel="icon" href="<?php echo base_url(); ?>application/ui/images/favicon.ico" type="image/x-icon" />
<script src="http://products.cogzidel.com/pinterest-clone/js/admin/jquery-1.2.1.min.js" type="text/javascript"></script>
<script src="http://ajax.microsoft.com/ajax/jquery/jquery-1.4.2.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>application/scripts/jquery-ui-1.8.1.custom.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function initMenu() {
  $('#menu ul').hide();
  $('#menu ul:first').hide();
  $('#menu li a').click(
    function() {
      var checkElement = $(this).next();
      if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        return false;
        }
      if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        $('#menu ul:visible').slideUp('normal');
        checkElement.slideDown('normal');
        return false;
        }
      }
    );
  }
$(document).ready(function() {initMenu();});
</script>
<script type="text/javascript">
    var baseUrl = '<?php echo base_url() ?>';
</script>

<link href="<?php echo base_url(); ?>application/ui/css/admin.css" rel="stylesheet" type="text/css" />

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<!--facebox  -->
<link href="<?php echo base_url(); ?>application/src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>application/ui/css/example.css" media="screen" rel="stylesheet" type="text/css" />
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

<script type='text/javascript' src='<?php echo base_url(); ?>application/scripts/jquery-autocomplete/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/scripts/jquery-autocomplete/jquery.autocomplete.css" />



<title><?php echo $title;?></title>
<style scoped>
#background {
    width: 254px;
    height: 250px;
    margin: 30px auto;
    padding: 69px 0 0 11px;
    background: url('../../../css/admin/images/calendar.png') transparent no-repeat 0 0;
}
#calendar {
    width: 241px;
}
</style>
</head>
<body>
<div id="Header">
	<div class="head_top">
    	<div class="head_inner">
    		<ul id="Navigation">
                <li>
                    <a class="nav link1" class="fancyboxForm" href="<?php echo site_url();?>" id="add_pin"> Site Home</a>
                </li>
                <?php if($this->session->userdata('admin_login')):?>
                    <li>
                        <a class="nav link1" class="fancyboxForm" href="<?php echo site_url('administrator/logout');?>" id="add_pin"> Logout</a>
                    </li>
                <?php endif;?>
                 
      </ul>
      	</div>

    </div>
	<div class="head_bttm">
    	<div class="head_inner">
    		<h1>Welcome to admin panel</h1>

        </div>
    </div>
</div>



   