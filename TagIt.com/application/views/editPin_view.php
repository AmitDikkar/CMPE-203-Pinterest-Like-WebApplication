<?php $this->load->view('header') ?>
<link href="<?php echo base_url(); ?>application/assets/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    function deletePin()
    {
        pinId = '<?php echo $pinId ?>';
        dataString = 'pinId=' + pinId;
        $.ajax({
            url: "<?php echo site_url('board/deletePin'); ?>",
            type: "POST",
            data: dataString,
            dataType: 'json',
            cache: false,
            success: function(data) {
            }
        });
    }
</script>
<script type="text/javascript">
    function addGift()
    {
        gifted = '<?php echo $result->gift; ?>';
        if (gifted == 0)
            slow = "slow";
        else
            slow = null;
        if ($('textarea#description_pin_edit').val() == null)
        {
            $(".PriceContainer").hide();
        }
        else {
            if ($('textarea#description_pin_edit').val() == '')
            {
                $(".PriceContainer").hide();
            }
            else {
                str = $('textarea#description_pin_edit').val();
                dollor = str.lastIndexOf("$");
                pound = str.lastIndexOf("\u00A3");
                if (dollor > pound)
                {
                    symbol = "$";
                }
                else {
                    symbol = "\u00A3";
                }
                if (str.lastIndexOf(symbol) != -1)
                {
                    var myString = str.substr(str.lastIndexOf(symbol) + 1)
                    if (myString != '')
                    {
                        splitString = myString.split(" ");
                        if (splitString[0])
                        {
                            if (!isNaN(splitString[0])) {
                                $(".PriceContainer").show(slow);
                                $('.PriceContainer').html(symbol + ' ' + splitString[0]);
                                $('input#gift').val(splitString[0]);
                            }
                            else {
                                $(".PriceContainer").hide(slow);
                            }
                        }
                        else {
                            $(".PriceContainer").hide(slow);
                        }
                    }
                    else {
                        $(".PriceContainer").hide(slow);
                    }
                }
                else {
                    $(".PriceContainer").hide(slow);
                }
            }
            $("#postDescription").html(str);
        }
    }
    $('#id_link').live('blur', function() {
        var link = $(this).val();
        var pin = $("#pinId").val();
        var board = $("#boardId").val();
        var gift_value = $("#gift_amount").val();
        var desc = $("#description_pin_edit").val();
        //alert(desc);
        $.ajax({
            url: baseUrl + "board/getImage",
            type: "POST",
            data: {'url': link, 'desc': desc, 'gift': gift_value, 'pinId': pin, 'boardId': board},
            dataType: "json",
            success: function(response) { 
                obj = eval(response);
                if (obj.content) {
                    $('.hideAll').show();
                    $('.hideError').hide();
                    $("#PinEditPreview").html(obj.content);
                    $('img#1').fadeIn(); 
                    $('#current_img').val(1);
                    $('#current_img_src').val($("img#1").attr("src"));
                }
                else {
                    $('.hideAll').hide();
                    $('.hideError').show();
                    $('#error_image').html("sorry, we didn't find any images in the url")
                }
            }
        });
    });



    $('#next').live("click", function() {

        var firstimage = $('#current_img').val(); // get the numeric value of the current image
        if (firstimage <= $('#total_images').val() - 1) // as long as last image has not been reached
        {
            $('img#' + firstimage).hide(); // hide the current image to be able to display the next image
            firstimage = parseInt(firstimage) + parseInt(1); // Increment image no so that next image no. can be displayed
            $('#current_img').val(firstimage); // Incremented in input tag
            $('#current_img_src').val($("img#" + firstimage).attr("src"));
            $('img#' + firstimage).show(); // show second image
        }
        $('#totalimg').html(firstimage + ' of ' + $('#total_images').val()); // Update the current image no display value
    });


    $('#prev').live("click", function() { // When user clicks on Previous Button

        var firstimage = $('#current_img').val();


        if (firstimage >= 2) {
            $('img#' + firstimage).hide();
            firstimage = parseInt(firstimage) - parseInt(1);
            $('#current_img').val(firstimage);
            $('#current_img_src').val($("img#" + firstimage).attr("src"));
            $('img#' + firstimage).show();
        }
        $('#totalimg').html(firstimage + ' of ' + $('#total_images').val());
    });

</script>
<?php $this->load->view('popup_js'); ?>
<div class="middle-banner_bg"><!-- staing middlebanner -->
    <div class="FixedContainer">
        <div class="editPin_div" style="margin-top: 135px;">
            <div class="editprofile_insidebox">
                <?php if (!empty($result)): ?>

                    <span class="hideAll" >
                        <div id="PinEditPreview" class="pin" style="margin-top: 105px; margin-right:25px;">
                            <strong class="PriceContainer" id="priceDiv"></strong>

                            <?php if ($result->gift != 0): ?>
                                <strong class="PriceContainer_gift" id="priceDiv_gift">$ <?php echo $result->gift; ?></strong>
                            <?php endif ?>

                            <a href="<?php echo site_url('board/pins/' . $boardId . '/' . $pinId) ?>"><img style="height: 144px;width:190px;" src="<?php echo $result->pin_url; ?>" /></a>

                            <div class="editDescription">
                                <p id="postDescription" class="desc_preview"><?php echo $result->description; ?></p>
                            </div>
                            <span id="gift_span"></span>
                        </div>
                    </span>
                    <span class="hideError" style="display: none;">
                        <div id="image" class="pin" style="margin-top: 200px; margin-left:650px; font-weight: bold;">
                            <div class="msg"><p id="error_image" style="font-family:arial;color:red;font-size:12px;" class="desc_preview"></p></div>
                        </div>  
                    </span>

                    <form id="PinEdit"  class="Form StaticForm" action="<?php echo site_url('board/savePin'); ?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
                        <h3>Edit Pin</h3>
                        <ul>
                            <input  name="gift_amount" id="gift_amount" type="hidden" value="<?php echo $result->gift; ?>"/> 
                            <input  name="pinid" id="pinId" type="hidden" value="<?php echo $result->id; ?>"/>
                            <input  name="board" id="boardId" type="hidden" value="<?php echo $result->board_id; ?>"/>
                            <input  name="current_img_src" id="current_img_src" type="hidden" value="<?php echo $result->pin_url; ?>"/>  
                            <input  name="current_img" id="current_img" type="hidden"/>  

                            <input type="hidden" name="type" value="<?php echo $result->type; ?>" id="type"/>
                            <li>
                                <label>Description</label>
                                <div class="Right">
                                    <div id="ta_holder" class="editable_shadow pin_edit">
                                        <textarea rows="2" name="details" maxlength="500" id="description_pin_edit" cols="40" class="expand autocomplete_desc" onkeyup="addGift()" style="width:150px;height: 100px;"><?php echo $result->description; ?></textarea>
                                    </div>
                                    <div id="errordetails" style="color:red;font-size:15px;"></div>
                                    <span class="CharacterCount colorless hidden">500</span>
                                </div>
                            </li>
                            <li>
                                <label for="id_link">Link</label>
                                <div class="Right">
                                    <input type="text" name="link" value="<?php echo $result->source_url; ?>" id="id_link" />
                                    <div id="errorlink" style="color:red;font-size:15px;"></div>
                                </div>
                            </li>
                            <li>
                                <label for="id_board">Board</label>
                                <div class="Right">
                                    <?php $userBoards = getUserBoard($userId); ?>
                                    <select name="board" id="id_board">
                                        <?php foreach ($userBoards as $boardKey => $boardValues): ?>
                                            <?php $selected = ($boardValues->id == $boardId) ? 'selected' : ''; ?>
                                            <option <?php echo $selected; ?> value="<?php echo $boardValues->id; ?>"><?php echo $boardValues->board_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </li>
                            <li>
                                <label>Delete</label>
                                <div class="Right">
                                    <a href="<?php echo site_url('pins/confirmDelete/' . $result->board_id . '/' . $result->id); ?>"  id="delete" class="Button WhiteButton Button18 deleteButton ajax" ><strong>Delete Pin</strong><span></span></a>
                                </div>
                            </li>
                        </ul>
                        <input type="hidden" name="oldBoardId" value="<?php echo $boardId; ?>" id="oldBoardId" />
                        <input type="hidden" name="pinId" value="<?php echo $pinId; ?>" id="pinId" />
                        <div class="Submit">
                            <p>
                               
                                 <input type="submit" name="submit" value="Save pin" id="submit" class="Button2 Button13 WhiteButton" onClick="return pinEditFn();"/>
                                <input type="button" name="Cancel" value="cancel" id="cancel" class="Button2 Button13 WhiteButton" onClick="window.location = '<?php echo site_url('board/pins/' . $boardId . '/' . $pinId) ?>'"/>
                            </p>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert_messgae">
                        <h2>No pins found</h2>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer'); ?>
<script type="text/javascript">
     function pinEditFn()
     {
        dataString = $("#PinEdit").serialize();
        
        var o = {};
        var a = $("#PinEdit").serializeArray();
        $.each(a, function() {
        
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        //check for validation
        for (key in o) {
        
            if (o[key] == "") {
               if (key == 'link')
                {
                    source = '<?php echo $result->source_url; ?>';
                    if (source == '')
                    {

                    }
                    else {
                        $('#error' + key).html("please enter image link!")
                        var failed = true;
                    }
                }
                else if(key == 'details') {
                    $('#error' + key).html("please enter description!")
                    var failed = true;
                }

            } else {
                $('#error' + key).html("")
            }

        }
        //return false on validation failure
        if (failed == true)
            return false;
        else
            return true;
    }
</script>