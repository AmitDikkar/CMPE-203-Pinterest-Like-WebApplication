<?php $this->load->view('header'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $("a.act_uncomment").hide();
        $(".enter_comm").hide();

    });

    function comment(pinid)
    {
        var $alpha = $('#alpha');
        var $alpha = $('#Container'+'#alpha');
        $alpha.masonry({
            itemSelector: '.pin_item',
            isFitWidth: true,
            isAnimatedFromBottom: true
        });
        var getComment=$('#comment_'+pinid).val();
        $('#'+pinid).hide();
        $('a#uncomment-'+pinid).hide();
        $('a#comment-'+pinid).show();

        val = 'id='+pinid+'&comment='+getComment;
        $.ajax({
            url: baseUrl+"board/addComment",
            type: "POST",
            data: val,
            dataType: 'json',
            success: function(data){
                var commentinfo=new Array();
                $('#comment_'+pinid).val('');
                //commentinfo=data.split("_");
                commentinfo[0] = logName;
                commentinfo[1] =getComment;
                if(commentinfo[1]!=0)
                {
                    //comment count
                    $("#comment_count_"+pinid).empty();
                    $("#comment_count_"+pinid).html(data[0]+" Comment");
                    $("#count_comment_"+pinid).empty();
                    $("#count_comment_"+pinid).html("<a href=http://products.cogzidel.com/pinterest-clone/con_home/viewpin/"+pinid+">All "+commentinfo[4]+" Comments...</a>");
                    $("div[id=comments_box_"+pinid+"]:last").append("<div class='convo_blk comments'><a class='convo_img' href='#'><img src="+logImage+" height='50' width='50'/></a><a href="+baseUrl+"'user/index/'"+logId+"><strong>"+commentinfo[0]+" </strong></a>"+commentinfo[1]+"</div> ");
                    var $alpha = $('#alpha');
                    $alpha.imagesLoaded( function(){
                        $alpha.masonry({
                            itemSelector: '.pin_item',
                            isFitWidth: true,
                            isAnimatedFromBottom: true

                            //isAnimated: true
                        });
                    });

                }
            }
        })
    }
    function showbutton(board_id)
    {
        $comment = $('#comment_'+board_id).val();
        if($comment!="" && $('#comment_'+board_id).val().length >=1)
        {
            $('#comment_button_'+board_id).show();
        }
        else
        {
            $('#comment_button_'+board_id).hide();
        }
    }
    
    function doAction(userid,pinid,type)
    {   val = 'pin_id='+pinid+'&source_user_id='+userid+'&like_user_id='+logId;
        if(type=="like")
        {
            $.ajax({
                url: baseUrl+"pins/saveLikes",
                type: "POST",
                data: val,
                dataType: 'json',
                success: function(datas){
                    //var status=parseInt(data);
                    var status=parseInt(datas)
                    $('#like1-'+pinid).html(status+' Likes');
                    if(status)
                    {
                        $('a#unlike-'+pinid).show();
                        $('a#like-'+pinid).hide();
                        $('#showUnLike'+pinid).show();
                        $('#showLike'+pinid).hide();
                        $('#like_action'+pinid).hide();
                    }
                    else
                    {
                        $('a#unlike-'+pinid).hide();
                        $('a#like-'+pinid).show();
                        $('#showUnLike'+pinid).hide();
                        $('#showLike'+pinid).show();
                        $('#like_action'+pinid).hide();

                    }
                }	    })
        }
        if(type=="unlike")
        {
            $.ajax({
                url: baseUrl+"pins/unLike",
                type: "POST",
                data: val,
                dataType: 'json',
                success: function(data){

                    $('#like1-'+pinid).html(data+' Likes');
                    if(data)
                    {
                        $('a#unlike-'+pinid).hide();
                        $('a#like-'+pinid).show();
                        $('#showUnLike'+pinid).hide();
                        $('#showLike'+pinid).show();
                        $('#like_action'+pinid).hide();
                    }
                    else
                    {
                        $('a#unlike-'+pinid).show();
                        $('a#like-'+pinid).hide();
                        $('#showUnLike'+pinid).show();
                        $('#showLike'+pinid).hide();
                        $('#like_action'+pinid).hide();
                    }
                }
            })
        }
    }
</script>
<?php if ($this->session->userdata('login_user_id')) { ?>
    <script type="text/javascript">
      
        $(".act_comment").live("click", function() {
            var string = $(this).attr('id');
            var substr = string.split('-');
            var board_id = substr[1];
            $('#'+board_id).html("<a href='#' class='convo_img'><img src="+logImage+" alt='image' /></a><textarea name='comment_"+board_id+"' id='comment_"+board_id+"' onkeyup='showbutton("+board_id+")'  cols=20 rows=1 ></textarea><p class='txt_right_align'><button class='button4' type='button' name='comment_button' id='comment_button_"+board_id+"' onclick='comment("+board_id+")'><span class='counter'><span>Comment</span></span></button> </p>");
            $('#comment_button_'+board_id).hide();
            $('a#comment-'+board_id).hide();
            $('a#uncomment-'+board_id).show();
            $('#'+board_id).show();
            
            $('#comment_'+board_id).focus();
            var $alpha = $('#alpha');
            $alpha.imagesLoaded( function(){
                $alpha.masonry({
                    itemSelector: '.pin_item',
                    isFitWidth: true,
                    isAnimatedFromBottom: true
                    //isAnimated: true
                });
            });
        });
      
        $(".act_uncomment").live("click", function() {
            var string = $(this).attr('id');
            var substr = string.split('-');
            var board_id = substr[1];
            $(".enter_comm").hide();
            $('#'+board_id).empty();
            $('a#comment-'+board_id).show();
            $('a#uncomment-'+board_id).hide();
            
            $('#comment_'+board_id).focus();
            var $alpha = $('#alpha');
            $alpha.imagesLoaded( function(){
                $alpha.masonry({
                    itemSelector: '.pin_item',
                    isFitWidth: true,
                    isAnimatedFromBottom: true
                    //isAnimated: true
                });
            });
        });
    </script>
<?php } ?>
<?php $this->load->view('popup_js'); ?>
<div class="white_strip"></div>
<div class="middle-banner_bg"><!-- staing middlebanner -->

    <!-- Display the information about the page-->
    <div class="info_bar">
        <div class="left">
            <div class="right">
                <div class="mid">

                    <div id="image"> <label><a href="<?php echo site_url(); ?>user/index/<?php echo $userDetails['userId'] ?>"><img src="<?php echo $userDetails['image'] ?>" width="50px" height="50px"></a></label></div>
                    <div id="info"><label>Pins of <?php echo $userDetails['name'] ?></label></div>
                </div>
            </div>
        </div>
    </div>
    <?php $empty = 0; ?>
    <div id="Container">
        <div id="alpha" class="container Mcenter clearfix transitions-enabled">
            <?php $board = getUserBoard($userDetails['userId']); ?>
            <?php if (is_array($board)): ?>
                <?php foreach ($board as $key => $value): ?>
                    <?php $boardPin = getEachBoardPins($value->id); ?>
                    <?php if (!empty($boardPin)): ?>
                        <?php $empty = 1; ?>
                        <?php foreach ($boardPin as $boardPinKey => $boardPinValue): ?>
                            <?php $comments = getPinComments($boardPinValue->id); ?>
                            <div class="pin_item">
                                <!--Display the like/comment/repin actions -->
                                <div class="action">
                                    <?php $likeId = 'like-' . $boardPinValue->id ?>
                                    <?php $unlikeId = 'unlike-' . $boardPinValue->id ?>
                                    <?php $like = $boardPinValue->user_id ?>
                                    <span id="like_action<?php echo $boardPinValue->id; ?>">
                                        <?php if ($boardPinValue->user_id == $this->session->userdata('login_user_id')): ?>
                                            <a href="<?php echo site_url('board/pinEdit/' . $boardPinValue->board_id . '/' . $boardPinValue->id) ?>" class="act_repin"><span>Edit</span></a>
                                        <?php else: ?>
                                            <?php if (!isLiked($boardPinValue->id, $this->session->userdata('login_user_id'))): ?>
                                                <a class="act_like" id="<?php echo $likeId ?>" href="javascript:;"  onClick="doAction(<?php echo $like; ?>,<?php echo $boardPinValue->id; ?>,'like')"><span>Like</span></a>
                                            <?php else: ?>
                                                <a class="act_unlike" id="<?php echo $unlikeId ?>" href="javascript:;"   onClick="doAction(<?php echo $like; ?>,<?php echo $boardPinValue->id; ?>,'unlike')"><span>UnLike</span></a>
                                            <?php endif ?>
                                        <?php endif ?>
                                    </span>
                                    <div id="showLike<?php echo $boardPinValue->id ?>" style="display: none;float:left;width: 64px;">
                                        <?php $like = $boardPinValue->user_id ?>
                                        <a class="act_like" id="<?php echo $likeId ?>" href="javascript:;"  onClick="doAction(<?php echo $like; ?>,<?php echo $boardPinValue->id; ?>,'like')"><span>Like</span></a>
                                    </div>
                                    <div id="showUnLike<?php echo $boardPinValue->id ?>" style="display: none;float:left;width: 64px;">
                                        <?php $like = $boardPinValue->user_id ?>
                                        <a class="act_unlike" id="<?php echo $unlikeId ?>" href="javascript:;"   onClick="doAction(<?php echo $like; ?>,<?php echo $boardPinValue->id; ?>,'unlike')"><span>UnLike</span></a>
                                    </div>

                                    <a class="ajax" href="<?php echo site_url('repin/load/' . $boardPinValue->id) ?>" >Repin</a>


                                    <?php $commentId = 'comment-' . $boardPinValue->id ?>
                                    <?php $uncommentId = 'uncomment-' . $boardPinValue->id ?>
                                <!--                <a class="act_comment" id="<?php //echo $commentId  ?>" href="javascript:;" onClick="addComment(<?php //echo $boardPinValue->id;  ?>,'comment')" ><span>Comment</span></a>
                                                    <a class="act_uncomment" id="<?php //echo $uncommentId  ?>" href="javascript:;" onClick="addComment(<?php //echo $boardPinValue->id;  ?>,'uncomment')" ><span>Uncomment</span></a>-->
                                    <a class="act_comment" id="<?php echo $commentId ?>" href="javascript:void(0);" ><span>Comment</span></a>
                                    <a class="act_uncomment" id="<?php echo $uncommentId ?>" href="javascript:void(0);" ><span>Uncomment</span></a>
                                </div>

                                <!--Display pin image -->
                                <div class="pin_img">
                                    <?php if ($boardPinValue->type == 'video'): ?>
                                    <div class="video" style="top:21%;left:5%;"><a href="<?php echo site_url() ?>board/pins/<?php echo $boardPinValue->board_id . '/' . $boardPinValue->id; ?>/view" class="ajax">&nbsp;</a></div>
                                    <?php endif ?>
                                    <a href="<?php echo site_url() ?>board/pins/<?php echo $boardPinValue->board_id . '/' . $boardPinValue->id; ?>/view" class="ajax"><img src="<?php echo $boardPinValue->pin_url; ?>"  /></a>
                                </div>


                                <!--Display the likes/comments/repins count -->
                                <div class="comm_des">
                                    <p class="des"><?php echo $boardPinValue->description; ?></p>
                                    <p class="comm_like">
                                        <?php $commentCountId = 'comment_count_' . $boardPinValue->id; ?>
                                        <?php $likeCountId = 'like1-' . $boardPinValue->id; ?>
                                        <span id="<?php echo $likeCountId; ?>"><?php echo getPinLikeCount($boardPinValue->id); ?> Likes</span>
                                        <span id="<?php echo $commentCountId; ?>"> <?php echo count($comments) ?> Comments</span>

                                        <?php $repinCount = getRepinCount('from_pin_id', $boardPinValue->id); ?>
                                        <?php $repinCountId = 'repin_count_' . $boardPinValue->id; ?>
                                        <span id="<?php echo $repinCountId; ?>"><?php echo $repinCount; ?> Repins</span>
                                    </p>
                                </div>

                                <div class="convo_blk attribution">
                                    <?php $userDetails = userDetails($boardPinValue->user_id); ?>
                                    <a href="<?php echo site_url('user/index/' . $boardPinValue->user_id) ?>" class="convo_img">
                                        <img src="<?php echo $userDetails['image'] ?>" alt="user" />
                                    </a>
                                    <p>
                                        <?php $source = GetDomain($boardPinValue->source_url); ?>
                                        <?php $boardDetails = getBoardDetails($boardPinValue->board_id); ?>
                                        <a href="<?php echo site_url('user/index/' . $boardPinValue->user_id) ?>"><?php echo $userDetails['name'] ?></a>
                                        <?php if ($boardPinValue->source_url != ""): ?>
                                            Via <a target="_blank" href="<?php echo $boardPinValue->source_url; ?>"><?php echo $source; ?></a>
                                        <?php endif; ?>
                                        onto <a   href="<?php echo site_url('board/index/' . $boardDetails->id) ?>">
                                            <?php echo $boardDetails->board_name; ?></a>
                                    </p>
                                </div>

                                <?php $commentBoxId = 'comments_box_' . $boardPinValue->id; ?>
                                <?php if (!empty($comments)): ?>
                                    <?php foreach ($comments as $key => $cmt): ?>
                                        <?php $commentuser = userDetails($cmt->user_id) ?>
                                        <div id="<?php echo $commentBoxId; ?>">
                                            <!-- Comment List -->
                                            <div class="convo_blk comments">
                                                <a href="<?php echo site_url('user/index/' . $cmt->user_id) ?>" class="convo_img">
                                                    <img src="<?php echo $commentuser['image'] ?>" alt="user" />
                                                </a>
                                                <p>
                                                    <a href="<?php echo site_url('user/index/' . $cmt->user_id) ?>"><?php echo $commentuser['name'] ?></a> <?php echo $cmt->comments ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div id="<?php echo $commentBoxId; ?>"></div>
                                <?php endif ?>
                                <div class="convo_blk enter_comm" id="<?php echo $boardPinValue->id; ?>"></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif ?>
        </div> <!-- #alpha -->
        <?php if ($empty == 0): ?>
            <div class="alert_messgae">
                <h2>No pins found</h2>
            </div>
        <?php endif; ?>


    </div>
</div><!-- closing middlebanner -->
<?php $this->load->view('footer'); ?>

<script type="text/javascript">
    $(function(){
        // alert($('.pin_item').length);
        var $alpha = $('#alpha');
        $alpha.imagesLoaded( function(){
            $alpha.masonry({
                itemSelector: '.pin_item',
                isFitWidth: true,
                isAnimatedFromBottom: true
                //isAnimated: true
            });
        });
        $alpha.infinitescroll({
            navSelector  : '#page-nav',    // selector for the paged navigation
            nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
            itemSelector : '.pin_item',     // selector for all items you'll retrieve

            loading: {

                finishedMsg: 'No more pages to load.',
                img: '<?php echo site_url(); ?>/application/assets/images/ajax_loader_blue.gif'
            }
        },
        // trigger Masonry as a callback
        function( newElements ) {
            // hide new items while they are loading
            var $newElems = $( newElements ).css({ opacity: 0 });
            // ensure that images load before adding to masonry layout
            $newElems.imagesLoaded(function(){
                // show elems now they're ready
                $newElems.animate({ opacity: 1 });
                $alpha.masonry( 'appended', $newElems, true );
            });
        }
    );

    });
</script>
<div class="scroll_top" style="display: none;">
    <a href="#top">Back to Top</a>
</div>
<nav id="page-nav">
    <a href="http://products.cogzidel.com/pinterest-clone/con_home/scroll/2"></a>
</nav>
<script type="text/javascript">

    $(function() {
        $(window).scroll(function() {
            if($(this).scrollTop() != 0) {
                $('.scroll_top').fadeIn();
            } else {
                $('.scroll_top').fadeOut();
            }
        });
    });
</script>
</body>
</html>