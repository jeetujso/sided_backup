<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>" xmlns="w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if(isset($user)){ ?>
	<meta property="og:title" content="<?php echo e($user->name); ?>" />
    <meta property="og:image" content="<?php echo e(asset('images/'.$user->avatar_url)); ?>" />
    <meta property="og:description" content="<?php echo e($user->handle); ?>" />  
    <meta property="og:url" content="<?php echo e(url()->full()); ?>" />
    <?php } ?>

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Sided')); ?></title>
    <script src="<?php echo e(asset('js/tracking.js')); ?>"></script>
    <!-- Scripts -->
		<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::User(),
            'signedIn' => Auth::check(),
            'uid' => ''
        ]); ?>;

    </script>


   
    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
    <!-- Styles -->

    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/flexslider.css')); ?>" rel="stylesheet" type="text/css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    

<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59edd23175103073"></script>



</head>
<body>
    
    <div class="loader-bg">
        <div class="loader"></div>
    </div>
    <div id="app">
        <nav class="primary-nav">
            <div class="u-container">
                <div class="primary-nav__left">
                     <a class="" href="<?php echo e(route('publicDashboardIndex')); ?>">
                        <img class="primary-nav__logo" src="<?php echo e(asset('img-dist/brand/logo_black.svg')); ?>" alt="Sided Logo">
                    </a>
					<div class="topnav" id="myTopnav">
                    <?php if(!empty(auth()->user()->name)): ?>
                    <a href="<?php echo e(route('publicDashboardIndex')); ?>" class="primary-nav__dropdown-link u-link-black">
                          Feed
                      </a>
                      <a href="<?php echo e(route('publicDebateCreate')); ?>" class="primary-nav__dropdown-link u-link-black">
                          Start new debate
                      </a>
                    
                    
					<a href="javascript:void(0);" style="font-size:25px;" class="icon" onclick="myFunction()"><span></span></a>
                    <?php endif; ?>
					</div>
                </div>
                
				<div class="primary-nav__center">
                    <?php if(!empty(auth()->user()->name)): ?>
                        <!--button class="toggle-plus" type="button" data-toggle="modal" data-target="#openPopUp"></button--> 
                    <?php endif; ?>
         </div>
         
                <div class="primary-nav__right">
                    <!--form action="<?php echo e(url('/logout')); ?>" method="POST">
                        <input type='search' class='search-input' placeholder="Search Sided for your favorite topics">
                    </form-->
                     <?php if(!empty(auth()->user()->name)): ?>
                    <dropdown-nav inline-template>
                        <div class="primary-nav__dropdown">
                            <a class="primary-nav__dropdown-toggle" @click.sub="toggleVisibility">
                                <?php if(!empty(auth()->user()->avatar_url)): ?>
                                    <img class="u-rounded primary-nav__avatar" src="<?php echo e(asset('images')); ?>/<?php echo e(auth()->user()->avatar_url); ?>">
                                <?php else: ?>
                                    <img class="u-rounded primary-nav__avatar" src="http://lorempixel.com/100/100/cats/?80538">
                                <?php endif; ?>
                            </a>
                            <ul :class="{'u-display-block' : isVisible}">
                                <span class="primary-nav__dropdown-arrow primary-nav__dropdown-arrow--outer"></span>
                                <span class="primary-nav__dropdown-arrow primary-nav__dropdown-arrow--inner"></span>
                                <!-- <a href="<?php echo e(url('/editprofile')); ?>" class="primary-nav__dropdown-link u-link-black">
                                    Profile
                                </a> -->

                                
                                <a href="<?php echo e(url('/players/'.auth()->user()->handle )); ?>" class="primary-nav__dropdown-link u-link-black">
                                    Profile
                                </a>                                

                                <a href="#" class="primary-nav__dropdown-link u-link-black" data-toggle="modal" data-target="#inviteFriends">
                                    Invite Friends
                                </a>

                                
                                <a href="<?php echo e(route('playerChangePassword')); ?>" class="primary-nav__dropdown-link u-link-black">
                                    Change Password
                                </a>
                                
  
                                <a href="<?php echo e(url('/logout')); ?>"
                                    onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"
                                     class="primary-nav__dropdown-link u-link-black">
                                    Sign Out
                                </a>
                                <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </ul>
                        </div>
                    </dropdown-nav>
                    <?php endif; ?>
                </div><!-- /primary-nav__right-->
            </div>
        </nav>

<div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
                  <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->          
        </div>
        <div class="modal-body">
        <h4 class="modal-title">Debate a Friend</h4>
          <p>Send this debate to a friend who might have something to say.</p>
        </div>
        <div class="modal-footer">
         <button type="button" data-toggle="modal" data-target="#mychallengeModal"  data-dismiss="modal">Send to a Friend</button>
         <p  data-dismiss="modal">or Cancel</p>
        </div>
      </div>
      
    </div>
</div>




  <!--end-select-apponnent-modal-->
        <?php echo $__env->yieldContent('content'); ?>

        <div class="js-flash-msg flash-msg" style="display: none">
                <h4 style="padding: 10px"></h4>
            </div>

             <?php if(Session::has('message')): ?>
                <div class="flash-msg message_editprofile"><?php echo e(Session::get('message')); ?></div>
            <?php endif; ?>
            

        <?php /*
        @if($errors->any())
            <div class="flash-msg">
                <h4 style="padding: 10px">{{ $errors->first() }}</h4>
            </div>
            
        @endif
        */ ?>

        <div class="game-footer u-text-center">
            &copy; <?php echo e(date('Y')); ?>, Sided, Inc.
        </div>




        <div class="modal fade" id="inviteFriends" role="dialog">
            <div class="modal-dialog">    
                <!-- Modal content-->
                <div class="modal-content">

                    <form method="POST" action="<?php echo e(route('inviteFriends')); ?>">
                        <input type="hidden" name="fingerprint_string" id="fingerprint_string">
                        <div class="modal-header">
                            <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                        <div class="modal-body">
                            <h4 class="modal-title">Invite Friends </h4>
                        </div>
                        <div id="home" class="invite-box">
                            <div>
                                <label for="email">Enter Email</label>
                                <input type="email" required name="email">
                                <!-- pattern="^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$"  -->
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="submit" value="Send Invite" class="debate-btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>


    <script>
        $(document).ready(function(){
            $('.loader-bg').hide();
            // on question select 
            $('body').on('click', '.share-close', function() {
                //$('.new-share-main').fadeOut('300');


                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('hideDashboardSharebox')); ?>",
                    data: {  } ,
                    success: function (msg) {
                        $('.new-share-main').fadeOut('300');
                    },
                    error: function (msg) {
                        
                    }
                });
                return false;
            });


            $(".session-flash").delay(15000).fadeOut(500);
            $(".flash-msg").delay(15000).fadeOut(500);
            

            


            // ajax follow request from dashboard
            $('body').on('click', '.debate-follow-btn > .follow-btn', function() {
                var ele = $(this);
                var ele_count = $(this).parent().parent().parent().children().length;
                var user_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('publicAjaxFollow')); ?>",
                    data: {
                        "user_id": user_id
                    },
                    success: function(msg) {
                        //console.log(msg);
                        if (ele_count == '1') {
                            ele.parent().parent().parent().append('<div class="load-more"><button onclick="load_more_suggestions()">Load more</button></div>');
                        }


                        ele.parent().parent().remove('div');
                        

                    },
                    error: function(msg) {
                        console.log('error');
                        // alert(msg.status);
                    }
                });
            });


            // on category click
            /*$('.onboarding-category').click(function(){
                $("#category-listing").hide();
                $('.onboarding-category').removeClass('is-selected');
                $(this).addClass('is-selected');
                var cat_name = $(this).children( ".onboarding-category__name").text();
                var cat_id = $(this).children( ".onboarding-category__name").attr("data-cat-id");

                $.ajax({
                   type: "POST",
                   //url: "./debates/get_questions",
                   url: "<?php echo e(route('getQuestions')); ?>",
                   data: { "category_id": cat_id, "_token": "<?php echo e(csrf_token()); ?>"} ,
                   success: function (resp) {
                        //var resp = $.parseJSON(msg);
                        if(resp.length == 0){
                            alert('No question in this category');
                            $("#category-listing").show();
                            return false;
                        }

                        $("#category-wise-questions").html("<div class='close-sec'>View all questions in  <span>"+cat_name+ "</span> <a id='close-btn' href='#' onclick='show_categories(); '><i class='fa fa-times'></i></a></div>");    

                        $.each(resp, function( index, value ) {
                            var resp_html = '<div class="dashboard-item questions">'+
                            '<div ques-id="'+ value.id +'" class="question_id"></div>'+

                            '<div class="debate-preview u-background-white"><div class="debate-preview__header"><div class="debate-haeder-top"><h4 class="debate-preview__category"> Submitted In <strong class="u-text-black">'+ value.category.name +'</strong></h4> <span>'+
                                '<img alt="" src="../img-dist/dot.svg"></span></div> <p class="debate-preview__question-text">'+ value.name +'</p> <small class="debate-preview__question-source">Source from <strong class="u-text-black"><a href="'+ value.source_url +'" target="_blank">'+ value.source +'</a></strong></small></div></div></div>';
                            $("#category-wise-questions").append(resp_html);
                        });
                   },
                   error: function (msg) {
                       //alert(msg.status + ' ' + msg.statusText);
                   }
               });    
            });*/


            
            $('#cat-tab').click(function(){
                $("#question_id").val('');
                $("input[type='submit']").attr('disabled', true);
                $("input[type='submit']").addClass('disabled');
            });



            // vote module 
             $('a#vote_for_debate').click(function(){
                //alert("<?php echo e(route('publicDebateVoteStore')); ?>");
                
                var debate_id = $(this).attr('data-debate-id');
                var user_id = $(this).attr('data-user-id');

                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('publicDebateVoteStore')); ?>",
                    data: { "debate_id": debate_id, "user_id": user_id } ,
                    success: function (msg) {
                        // var response = $.parseJSON(msg);
                        // console.log(msg.status);
                        
                        $(".flash-msg").html(msg.response);
                        $(".flash-msg").show();

                        setTimeout(function() {
                            $('.flash-msg').fadeOut('fast');
                        }, 20000); // <-- time in milliseconds


                        if(msg.status =='success'){
                            setTimeout(function() {
                                location.reload();
                            }, 5000); // <-- time in milliseconds
                        }


                   },
                   error: function (msg) {
                       //alert(msg.status + ' ' + msg.statusText);
                   }
                });
            });
        });


        function show_categories(){
            $("#category-listing").show();
            $("#category-wise-questions").html("");

            $("#question_id").val('');
            //$("input[type='submit']").attr('disabled', true);
            //$("input[type='submit']").addClass('disabled');
            
            return false;
        }



        $(".debate-preview__question-source").find('a').click(function(e) {
            window.open($(this).attr('href'),'myWindow', "width=800, height=800");
            e.stopPropagation();
        });


        $('.make-favorite').click(function(){
            //alert('clicked on fav icon');
            var user_id = $(this).attr('data-user');
            var ele = $(this);
            $.ajax({
                type: "POST",
                url: "<?php echo e(route('ajaxMakeFavorite')); ?>",
                data: { "user_id": user_id } ,
                success: function (msg) {

                    if(msg._code == '1'){
                       ele.children('img').attr('src', '/img/favorite-heart-button-red.svg')
                    }else{
                        ele.children('img').attr('src', '/img/favorite-heart-button.svg')
                    }

                    $(".js-flash-msg").html(msg.response);
                    $(".js-flash-msg").show();

                    setTimeout(function() {
                        $('.js-flash-msg').fadeOut('fast');
                    }, 15000); // <-- time in milliseconds
					window.setTimeout(function(){ document.location.reload(true); }, 8000);
               },
               error: function (msg) {
                   //alert(msg.status + ' ' + msg.statusText);
               }
            });
			//location.reload();
        });

    </script>
    
    <script>
        $(document).ready(function(){
            var uid = fp.get();
            $('#fingerprint_string').val(uid);
            

            var event_type = $("#event_type").val();
            var event_id = $("#event_id").val();
            if(event_type){
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('ontrackingFingerprintStore')); ?>",
                    data: { "fingerprint_string": uid , "event_type":event_type, "event_id":event_id } ,
                    success: function (msg) {
                        // alert('here');
                    },
                    error: function (msg) {
                        
                    }
                });    
            }
            
        });




    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#img-preview').attr('src', e.target.result).width(150).height(100);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    // $("#avatar_url").change(function() {
    //     $('#img-preview').show();
    //   readURL(this);
    // });
    $("#avatar_url").change(function() {
        var input = $("input[name=avatar_url]");
        $('.img-size-err').text('');
        if(this.files[0].size/1024/1024 > 2){
            $('.img-size-err').show();
            input.val('');
            $('.img-size-err').text('Please upload only max 2MB of image.');
            $('#img-preview').hide();
        }else{
            $('#img-preview').show();
            $('.img-size-err').hide();
            readURL(this);
        }
    });





    </script>


<script>
    
    function load_more_suggestions(){
        //alert('publicFollowSuggestions');

        $.ajax({
            type: "POST",
            url: "<?php echo e(route('publicFollowSuggestions')); ?>",
            data: {  },
            success: function(response) {
                //console.log(response);

                if(response.response_code == '0'){
                    alert('No more suggestions.');
					location.reload();
                    return false;
                }else{

                    //alert('loading');

                    $(".follow-player-sec").html('');
                    $.each(response.response, function( index, value ) {
                            var resp_html = '<div class="debate-preview__players follow-players">'+
                            '<div class="debate-follow-img"><img src="<?php echo e(asset('images')); ?>/'+value.avatar_url+'" width="128" height="128" alt=""></div>'+
                            '<div class="debate-follow-name">'+
                                '<h4 class="debate-preview__player-name">'+
                                '<a href="players/'+value.handle+'" class="u-link-black">'+
                                value.name+
                                '</a></h4>'+

                                '<small>'+value.handle+'</small>'+
                            '</div>'+
                            '<div class="debate-follow-btn">'+
                                '<button class="follow-btn" value="'+value.id+'">Follow</button>'+
                            '</div>'+
                        '</div>';
                            $(".follow-player-sec").append(resp_html);
                        });
                }
            },
            error: function(response) {
                //alert(msg.status);
            }
        });

    }


    $(document).ready(function(){
       $('.onboarding-category').toggleClass('is-selected');
    });

    </script>
        <script src="<?php echo e(asset('js/jquery.flexslider.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>

    <script>
        $(function(){
            $(".contest-img img.lazy").lazyload( {
               effect: "fadeIn"
            });
        });




        $('a[data-toggle="tab"]').click(function(){
            var contest_tab=$(this).parent().attr('id');
            if(contest_tab == 'tab_contest_h1'){
                $("img.lazy:lt(1)").trigger('appear');
            }
            //alert(a);
        });

        $(function(){
            $('.upper-ad-box > .flexslider').flexslider({
                touch: true,
                slideshow: false,
                controlNav: true,
                slideshowSpeed: 7000,
                animationSpeed: 600,
                initDelay: 0,
                start: function(slider) { // fires when the slider loads the first slide
                  var slide_count = slider.count - 1;
                    
                    $(".upper-ad-box .flexslider img.lazy:eq(0)").lazyload( {
                        effect: "fadeIn"
                    } );                    
                },
                before: function (slider) { // fires asynchronously with each slider animation
                  var slides = slider.slides,
                    index = slider.animatingTo,
                    $slide = $(slides[index]),
                    $img = $slide.find('img[data-src]'),
                    current = index,
                    nxt_slide = current + 1,
                    prev_slide = current - 1;


                    $('.upper-ad-box .flexslider img.lazy:eq(' + current + '), .upper-ad-box .flexslider img.lazy:eq(' + prev_slide + '), .upper-ad-box .flexslider img.lazy:eq(' + nxt_slide + ')').lazyload( {
                       effect: "fadeIn"
                    } );
                }
            });


            $('.lower-ad-box > .flexslider').flexslider({
                touch: true,
                slideshow: false,
                controlNav: true,
                slideshowSpeed: 7000,
                animationSpeed: 600,
                initDelay: 0,
                start: function(slider) { // fires when the slider loads the first slide
                  var slide_count = slider.count - 1;
                 // alert('second one');

                    $(".lower-ad-box img.lazy:eq(0)").lazyload( {
                        effect: "fadeIn"
                    } );
                },
                before: function (slider) { // fires asynchronously with each slider animation
                  var slides = slider.slides,
                    index = slider.animatingTo,
                    $slide = $(slides[index]),
                    $img = $slide.find('img[data-src]'),
                    current = index,
                    nxt_slide = current + 1,
                    prev_slide = current - 1;


                    $('.lower-ad-box img.lazy:eq(' + current + '), .lower-ad-box img.lazy:eq(' + prev_slide + '), .lower-ad-box img.lazy:eq(' + nxt_slide + ')').lazyload( {
                       effect: "fadeIn"
                    } );
                }
            });


        });
    </script>

    </body>
</html>
