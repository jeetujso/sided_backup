<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>" xmlns="w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if(isset($debate)){ ?>
    <meta property="og:title" content="<?php echo e($debate->question->name); ?>" />
    <meta property="og:image" content="<?php echo e(asset('img-dist/category/'.$debate->question->category->image_url)); ?>" />
    <meta property="og:description" content="<?php echo e($debate->question->text); ?>" />  
    <meta property="og:url" content="<?php echo e(url()->full()); ?>" />
    <?php } ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Sided')); ?></title>

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
        //var debateId = <?php echo e(Request::segment(2)); ?>

        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'is_debate_user' => App\DebateUser::where('user_id', Auth::user()->id)->count(),
            'debate_users_count' => App\DebateUser::where('debate_id', Request::segment(2))->count(),
            'debate_users' => App\DebateUser::with('users')->where('debate_id', Request::segment(2))->get(),
            'signedIn' => Auth::check(),
            'is_voted' => App\Vote::where('voter_id', Auth::user()->id)->count(),
            'voted'=>'0',
            'voterSide'=>'0',
        ]); ?>;
    </script>


    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">
    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59edd23175103073"></script>
</head>

<body>
    <!-- loader -->
    <div class="loader-bg">
        <div class="loader"></div>
    </div>

    <button id="restictUser" type="button" data-toggle="modal" data-target="#restictionModel" style="display:none"></button>
    <!-- /.loader -->

    <!-- #app -->
    <div id="app">
        <!-- primary-nav -->
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

                    

                    <!--a class="primary-nav__link" href="#">
                        <button class="toggle-plus" type="button"></button> 
                    </a-->

                    
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
                                
  
                                <a href="#" class="primary-nav__dropdown-link u-link-black" id="signout">
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
        <!-- /.primary-nav -->


        <?php echo $__env->yieldContent('content'); ?>


        <?php if(Session::has('message')): ?>
                <div class="flash-msg"><?php echo e(Session::get('message')); ?></div>
            <?php endif; ?>


        <div class="js-flash-msg flash-msg" style="display: none">
            <h4 style="padding: 10px"></h4>
        </div>

        <div class="game-footer u-text-center">
            &copy; <?php echo e(date('Y')); ?>, Sided, Inc.
        </div>

<?php $now = \Carbon\Carbon::now(); ?>
<?php if($now<=$debate->ends_at): ?>

        <!-- models #myModal3 -->
        <div class="modal fade" id="myModal3" role="dialog">

            <div class="modal-dialog">    
                <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>         
                </div>
                <div class="modal-body">
                <h4 class="modal-title">Debate a Friend</h4>
                    <p>Send this debate to a friend who might have something to say.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-toggle="modal" data-target="#mychallengeModal"  data-dismiss="modal">Send to a Friend</button>
                    <p data-dismiss="modal">or Cancel</p>
                </div>
              </div>
            </div>
        </div>
        <!-- end #myModal3 -->
<?php endif; ?>
        <!-- model #inviteFriends -->
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
                                <label>Enter Email</label>
                                <input type="email" required name="email" placeholder="Please Enter Email">
                                <!-- pattern="^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},*[\W]*)+$"  -->
                            </div>
                        </div>

                        <div class="modal-footer">
                            <input type="hidden" name="debate_id" value="<?php echo e($debate->id); ?>">
                            <input type="submit" value="Send Invite" class="debate-btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end model #inviteFriends -->



        <!-- model #inviteFriends -->
        <div class="modal fade" id="restictionModel" role="dialog">
            <div class="modal-dialog">    
                <!-- Modal content-->
                <div class="modal-content">

                    <form method="POST" action="<?php echo e(route('inviteFriends')); ?>">
                        <div class="modal-header">
                            <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                        </div>
                        <div class="modal-body">
                            <h4 class="modal-title">Take a side before going to other page</h4>
                        </div>
                        

                        <div class="modal-footer">
                            <a href="">Ok</a>
                            <a>Cancel and leave a page </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end model #inviteFriends -->

    </div>
    

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

<script src="<?php echo e(asset('js/tracking.js')); ?>"></script>

    <script>
        $(document).ready(function(){
            
            if($("#home .follow-player-sec").children().length < 1){
                $("#home .follow-player-sec").html("<h3>No one is in my favorite list </h3>");
            }

            // if($("#menu1 .follow-player-sec").children().length < 1){
            //     $("#menu1 .follow-player-sec").html("<h3>No one added in my sided network.</h3>");
            // }




            // wrap vote-showingline into p tag
            $('.debate-preview.u-background-white')
              .contents() // get all child node including text and comment 
              .filter(function() { // filter the text node which is not empty
                return this.nodeType === 3 && $.trim(this.textContent).length
              }).wrap('<p class="vote-show-line"></p>'); // wrap filtered element with p


            // enable enter form submit for comment and argument
            $(".resp-text-box").keydown(function(event) {
                if (event.keyCode === 13) {
                    if($(this).val() !=''){
                        $(this).next('button[type="submit"]').click();
                    }else{
                        return false;
                    }
                }
            });
            


            if( $('.vote-count-0-not-given-disabled').length == '2'){  
                $.each( $('.voter-sec').find('span') , function( key, value ) {
                    $(this).html('');
                });
            }

            if($('.not-given').length > 0 && $('.not-given-disabled').length > 0){
                $('.not-given').children('li').children('span').hide();
                $('.not-given-disabled').children('li').children('span').hide();
            }


            if( $('.vote-count-0-my-debate-disabled').length == '2')
            {  
                $.each( $('.voter-sec').find('span') , function( key, value ) {
                    $(this).html('');
                });
            }
            if( $('.my-debate-disabled').length == '2'  ){
                $.each( $('.voter-sec').find('a') , function( key, value ) {
                    $(this).removeClass();
                    $(this).addClass('gray-in');
                    $(this).css( 'cursor', 'default' );
                    $(this).closest( "span" ).css( "color", "red" );
                });
            }

            if($('.not-mine-disagree-1').length > 0){
                $('.not-mine-disagree-1').prev().css('color', '#D8D8D8');
            }
            if($('.not-mine-agree-2').length > 0){
                $('.not-mine-agree-2').next().css('color', '#D8D8D8');
            }

            if($('.not-mine-agree-1').length > 0){
                $('.not-mine-agree-1').prev().css('color', '#D8D8D8');
            }

            if($('.not-mine-disagree-2').length > 0){
                $('.not-mine-disagree-2').next().css('color', '#D8D8D8');
            }
            
            

            $('.loader-bg').hide();
            $('body').on('click', '.shareebate-close', function() {
                //$('.new-share-main').fadeOut('300');
                    
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('debateSharebox')); ?>",
                    data: {  } ,
                    success: function (msg) {
                        $('.new-share-sec-debate').fadeOut('300');
                    },
                    error: function (msg) {
                        
                    }
                });
                return false;
            });
            $(".session-flash").delay(15000).fadeOut(500);
            $(".flash-msg").delay(15000).fadeOut(500);
            

            
            // vote module 

            


             $('a#vote_for_debate').click(function(){
                var fingerprint_string = fp.get();
                var debate_id = $(this).attr('data-debate-id');
                var user_id = $(this).attr('data-user-id');
                $.ajax({
                    type: "POST",
                    url: "<?php echo e(route('publicDebateVoteStore')); ?>",
                    data: { "debate_id": debate_id, "user_id": user_id, "fingerprint_string": fingerprint_string } ,
                    success: function (msg) {
                        // var response = $.parseJSON(msg);
                        //console.log(msg);
                        if(msg.status == 'success'){
                            // alert('here');
                            window.Laravel.voted ='1';

                            location.reload();

                            /*
                            setTimeout(function() {
                                location.reload();
                            }, 5000); // <-- time in milliseconds
                            */
                        }
                        

                        $(".flash-msg").html(msg.response);
                        $(".flash-msg").show();

                        setTimeout(function() {
                            $('.flash-msg').fadeOut('fast');
                        }, 20000); // <-- time in milliseconds
                    },
                    error: function (msg) {
                       //alert(msg.status + ' ' + msg.statusText);
                    }
                });
            });

        });

        $("#signout").click(function(event){
            if(window.Laravel.voted == '1' ){
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }
        });

        

        $(document).on('click', '.topnav > a, .primary-nav__logo, .u-display-block > a , .u-link-black', function(e) {

            var is_modal = $(this).attr('data-toggle');
            if(is_modal=='modal'){
                return true;
            }
           
            var href= $(this).attr('href');
            if (typeof href === "undefined") {
                href = $(this).parent('a').attr('href');
            }else if(href == '#'){
                href = $("#logout-form").attr('action');
            }
            //alert(href);
            console.log(window.Laravel);
            var fingerprint_string = fp.get();
            var voteForA = window.Laravel.debate_users[0].users.handle;
            var voteForB = window.Laravel.debate_users[1].users.handle;
            //console.log(voteForA, voteForB);
            if(window.Laravel.is_debate_user == 0 && window.Laravel.debate_users_count == 2 && window.Laravel.is_voted == 0){
                $.confirm({
                    title: 'You have not taken a side! Press ok to take a side.',
                    content: ' ',
                    buttons: {
                        // Ok: function () {
                        //     e.preventDefault();
                        // }

                        VoteForA: {
                            text: 'Vote for '+voteForA,
                            btnClass: 'btn-green',
                            action: function(){
                                $.ajax({
                                    'type': 'POST',
                                    'url': "<?php echo e(route('voteBythirdUsers')); ?>",
                                    'data': {'debate_id': <?php echo e(Request::segment(2)); ?>, 'voter_id': window.Laravel.user.id, 'user_id': window.Laravel.debate_users[0].users.id, 'fingerprint_string': fingerprint_string },
                                    success: function(res){
                                        if(res.status == 'success'){
                                            location.href = href;
                                        }else{
                                            alert('Error!');
                                        }
                                    }
                                });
                            }
                        },
                        VoteForB: {
                            text: 'Vote for '+voteForB,
                            btnClass: 'btn-blue',
                            action: function(){
                                $.ajax({
                                    'type': 'POST',
                                    'url': "<?php echo e(route('voteBythirdUsers')); ?>",
                                    'data': {'debate_id': <?php echo e(Request::segment(2)); ?>, 'voter_id': window.Laravel.user.id, 'user_id': window.Laravel.debate_users[1].users.id, 'fingerprint_string': fingerprint_string },
                                    success: function(res){
                                        if(res.status == 'success'){
                                            location.href = href;
                                        }else{
                                            alert('Error!');
                                        }
                                    }
                                });
                            }
                        },
                        VoteForNone: {
                            text: 'Vote For None',
                            btnClass: 'btn-red',
                            action: function(){
                                location.href = href;
                            }
                        }

                        /*,
                        Later: function () {
                            // return true;
                            // $.alert(href);
                            window.location = href;
                            //$.alert('I will Give later !');
                        }
                        */
                    }
                });
                return false;

            }else{
                if($(this).attr('id') =='signout'){
                    event.preventDefault();
                    document.getElementById('logout-form').submit();
                }
                return true;
            }
        });


         var total_comments = $('.debate-comment').length;
         
         //alert(total_comments);

         $('.debate-comment').each(function(i1,obj) {
                if(i1 > (total_comments-6) ){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            

            /*if(total_comments - 5 > 5){
                if(i1 < 5){
                    $(this).hide();
                }else{
                    $(this).show();
                }
            }else{
                if(i1 < 5){
                    $(this).hide();
                }else{
                    $(this).show();
                }
            }
            */
         });

         $(".view-comment").click(function(){
                $('.debate-comment').show();
                var str = $(this).text();
                var res = str.replace("Showing last 5 comments. Click to view", "Showing");
                $(this).text(res);
         });
         

    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
    
    <script>
        $(document).ready(function(){
            var uid = fp.get();
            $("#fingerprint_string").val(uid);
            
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
            

           
            /* FOllow user */

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
                        ele.parent().parent().remove('div');
                    },
                    error: function(msg) {
                        console.log('error');
                    }
                });
            });
            $("body").on('click', '.close.closed-follow-popup', function(){
                location.reload();
            });

        });

        

        function openpopup(){
            $("#joinDebate > button").click();
        }

        $(".join-submit-btn").click(function(){
            $("#joinDebate").submit();
        });
        
        $("#join-debate-argument").keyup(function(){
            var argLength = $(this).val();
            if($.trim(argLength).length){
                $(".join-submit-btn").prop('disabled', false);
                $("#dbt-arguments").val(argLength);
            }else{
                $(".join-submit-btn").prop('disabled', true);
                $("#dbt-arguments").val("");
            }
        });
        
        
         $('.debate-ads img.lazy').lazyload( {
                effect: "fadeIn"
            });


    </script>


</body>
</html>