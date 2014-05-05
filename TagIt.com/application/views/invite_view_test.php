<div id="fb-root"></div>
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
        link: baseUrl+'fb/invitetest/'+inviting
      });
       /*
    FB.ui({
        method: 'apprequests',
        name: 'Pinterest clone',
        message: 'My Great Request'
        }, requestCallback);
    */
   //Step2 of inviting user. (step 1 in invite controller)
   //encode the inviting user fb id and current time stamp and pass the request.
   //step3 is in invite fb controller invite function
  }

  function requestCallback(response) {
      //alert("myObject is " + response.toSource());
      var output = '';
        for (property in response) {
            //output += property + ': ' + response[property]+'; ';
            if(property=='to')
            {
                output = response[property]
                //alert(output);
                insertInvitedId(output);

            }

        }
    // Handle callback here
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
<?php $this->load->view('header');?>
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
            //this is the php file that processes the data and send mail
            url: "<?php echo site_url('/invite/submit/');?>/",
            //POST method is used
            type: "POST",
            //pass the data
            data: dataString,
            dataType: 'json',
            //Do not cache the page
            cache: false,
            //success
            success: function (data) {
                //if success, show success message, hide errors and reset form
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
<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div class="container">
        <div class="invite_box" style="margin-top: 94px;">
            <div class="invite_insidebox">
                <div class="invite_form">

        <!--        <p>
                      <input type="button"  onclick="sendRequestToRecipients(); return false;" value="Send Request to Facebook Users Directly"/>
                      <input type="text" value="User ID" name="user_ids" />
                    </p>-->

                    <h3>Invite Your Friends to tagIt</h3>

                    <table>

                        <tr>
                            <td>Invite from facebook</td>
                            <td><input type="button" onclick="sendRequestViaMultiFriendSelector(); return false;" value="Facebook" class="Button2 Button13 WhiteButton"/></td>
                        </tr>
                        <form id="invite_form" method="post" action="<?php echo site_url('invite/submit');?>">
                            <tr>
                                <td><label>Email Address 1</label></td>
                                <td><input type="text" class="email inputform-field" id="email1" name="email1" style="margin-top: 5px;width:250px;"/></td>
                            </tr>
                            <tr>
                                 <td><label>Email Address 2</label></td>
                                <td> <input type="text" class="email inputform-field" id="email2" name="email2" style="margin-top: 5px;width:250px;"/></td>
                            </tr>

                            <tr>
                                <td><label>Email Address 3</label></td>
                                <td><input type="text" class="email inputform-field" id="email3" name="email3" style="margin-top: 5px;width:250px;"/></td>
                            </tr>
                            <tr>
                                <td><label>Email Address 4</label></td>
                                <td><input type="text" class="email inputform-field" id="email4" name="email4" style="margin-top: 5px;width:250px;"/></td>
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
<?php $this->load->view('footer');?>

</body>
</html>


