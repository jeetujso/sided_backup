<div class="header2">

</div>
<?php $__env->startSection('content'); ?>
<div class="marg-top seperate-page-voter">
<?php $now = \Carbon\Carbon::now(); ?>
<?php if(!empty($debate)): ?>
<?php if($now<=$debate->ends_at): ?>
  <?php if($debate->status == 'needs_opponent'): ?>
    <?php $debate_user = (new \App\Helpers\DebateUsers)->get_user($debate->id); ?>
      <div class="btn-set">
      <form method="POST" action="<?php echo e(route('joinDebate')); ?>" id="joinDebate">
        <input type="hidden" name="debate_id" value="<?php echo e($debate->id); ?>">
        <input type="hidden" id="dbt-arguments" name="debate_argument" value="">
		<input type="hidden" id="question_ID" name="question_ID" value="<?php echo e($debate->question->id); ?>">
        <?php if($debate_user->user_id == auth()->user()->id): ?>
          <button id="challengeRefreshPopup" type="button" data-toggle="modal" data-target="#mychallengeModal">Challenge</button>
        <?php else: ?>
          <button type="button" data-toggle="modal" data-target="#popupJoinDebate">Join Debate</button>
          <!-- <input type="submit" style="display: none;"> -->

          <!-- <button type="submit"> Join Debate</button> -->
        <?php endif; ?>
      </form>
    </div>
  <?php endif; ?>
 <?php endif; ?>
 <?php endif; ?>
  <?php if(Session::has('message')): ?>
    <div class="flash-msg"><?php echo e(Session::get('message')); ?></div>
  <?php endif; ?>


  <div class="flash-msg" style="display: none;">
    <h4>You voted successfully</h4>
  </div>
   
  <div class="marginb game-wrapper">


    <?php if(!Session::has('shareboxdebate')): ?>

      <div class="top-head">
      <div class="debate-preview u-background-white">
        <div class="new-share-sec-debate">

          <div class="share-head">
            <h4 class="u-white-text">Share this Debate</h4>
            <a href="#" class="shareebate-close"><i class="fa fa-times" aria-hidden="true"></i></a>
          </div>
     
          <p class="debate-preview__question-text">Invite others to this debate to grow the discussion, get more votes, and earn more points. </p>

          <span>Learn more about points and status.</span>
          
          <div class="addthis_inline_share_toolbox"></div>
        
        </div>

      </div>
    </div>
    <?php endif; ?>
 
    <!-- debate component loading -->
    
    <input type="hidden" id="event_type" name="event_type" value="debate_view">
    <input type="hidden" id="event_id" name="event_id" value="<?php echo e($debate->id); ?>">




    <debate :debate="<?php echo e($debate); ?>"></debate>

  </div>
  <!-- /.game-wrapper -->



  <div class="modal fade" id="inviteToVote" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button>
            </div>
            <div class="modal-body">
              <h4 class="modal-title">Invite Friend To Vote/Comment</h4>
              <p>Send this debate to a friend who might have something to say.</p>
            </div>
            <div class="modal-footer">
              <button type="button" data-toggle="modal" data-target="#mychallengeModal" data-dismiss="modal">Send to a Friend</button>
              <p data-dismiss="modal">or Cancel</p>
            </div>
          </div>
        </div>
  </div>





  <div class="modal fade" id="mychallengeModal" role="dialog">  
    <div class="modal-dialog">    
      <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div>

          <div class="tab-section">
            <div class="modal-body">
              <h4 class="modal-title"><?=($debate->status == 'needs_opponent')?"Challenge":"Invite"?></h4>
              <p>Select opponents from your network or challenge out to your friends via email.</p>
              <p>Invite as many as you like. First one in gets to debate</p>
            </div>

            <ul class="nav nav-tabs">
              <!-- <li class="active"><a data-toggle="tab" href="#home">Favorites</a></li> -->
              <?php $is_fav_enabled = "0";?>
              <?php $__currentLoopData = $my_sided_network; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_sided): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($my_sided->is_favourite =='1'): ?>
                <?php $is_fav_enabled = "1"; ?>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php if($is_fav_enabled =='1'): ?>
              <li class="active"><a data-toggle="tab" href="#home">Favorites</a></li>

              <?php endif; ?>

              <?php if($is_fav_enabled =='0'): ?>
                <li class="active"><a data-toggle="tab" href="#menu1">My Sided Network</a></li>
              <?php else: ?>
                <li><a data-toggle="tab" href="#menu1">My Sided Network</a></li>
              <?php endif; ?>
              
              <li><a data-toggle="tab" href="#invite_by_email">Invite Others</a></li>
            </ul>

            <div class="tab-content">
              <!-- tab 1-->
              <?php if($is_fav_enabled =='1'): ?>
              <div id="home" class="tab-pane fade in active">
                <form method="POST" action="<?php echo e(route('challengeForDebate')); ?>" id="challengeForDebate">
                  
                <div class="dashboard-item">
                  <div class="debate-preview u-background-white">
                    <div class="follow-player-sec mylogic">

                       <?php $__currentLoopData = $my_sided_network; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_sided): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
                $front_user = DB::table('users')
                        ->where('id', $my_sided->user_id)
                        ->first();
            
                ?>
                        <?php if($my_sided->is_favourite =='1'): ?>
                          <?php
                          $user = App\User::findOrfail($my_sided->user_id);
              if($front_user->is_admin!=1){
                          ?>

                          
                            <div class="debate-preview__players follow-players">

                              <label for="fav<?php echo e($user->id); ?>">
                              <div class="debate-select-img">
                               <img width="128" height="128" alt="" src="<?php echo e(asset('images')); ?>/<?php echo e($user->avatar_url); ?>">
                              </div>
                              <div class="debate-select-name">
                                <h4 class="debate-preview__player-name"><a class="u-link-black" href="<?php echo e(route('publicPlayerShow',$user->handle)); ?>" target="_blank"> <?php echo e($user->handle); ?></a></h4>
                                  <small> <?php echo e($user->name); ?> </small>
                              </div>

                              <div class="debate-tick">
                               <input type="checkbox" id="fav<?php echo e($user->id); ?>" name="invite[]" value="<?php echo e($user->id); ?>" />
                                <label for="fav<?php echo e($user->id); ?>"><span></span></label>
                <input type="hidden" name="challenger_name" value="<?php echo e(Auth::user()->name); ?>">
                <input type="hidden" name="take_a_dare_name_<?php echo e($user->id); ?>" value="<?php echo e($user->name); ?>">
                              </div>
                              </label>
                            </div>
                          <?php } ?>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
          <input type="hidden" name="debate_id" value="<?php echo e($debate->id); ?>">
                  <input type="submit" class="green-btn" value="Confirm">
                  <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                </div>

                </form>
              </div>

               <?php endif; ?>

              
              <!-- tab 2-->
              <?php if($is_fav_enabled =='0'): ?>
                  <div id="menu1" class="tab-pane fade in active">
                  
                <?php else: ?>
                  <div id="menu1" class="tab-pane fade">

                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('challengeForDebate')); ?>" id="challengeForDebate">

                  <div class="dashboard-item">
                    <div class="debate-preview u-background-white">
                    
                        <div class="follow-player-sec mylogic">
                        <?php $hasFollowers = 0; ?>
                        <?php $__currentLoopData = $my_sided_network; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_sided): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                            $front_user = DB::table('users')
                                        ->where('id', $my_sided->user_id)
                                        ->first();
                            
                          ?>
                          <?php if($my_sided->status =='follow'): ?>
                            <?php
                              $user = App\User::findOrfail($my_sided->user_id);
                              if($front_user->is_admin!=1){
                                $hasFollowers = 1; 
                            ?>
                              <div class="debate-preview__players follow-players">  
                                <label for="<?php echo e($user->id); ?>">
                                  <div class="debate-select-img">
                                  <img width="128" height="128" alt="" src="<?php echo e(asset('images')); ?>/<?php echo e($user->avatar_url); ?>">
                                </div>
                                <div class="debate-select-name">
                                  <h4 class="debate-preview__player-name"><a class="u-link-black" href="<?php echo e(route('publicPlayerShow',$user->handle)); ?>"> <?php echo e($user->handle); ?></a></h4>
                                    <small> <?php echo e($user->name); ?> </small>
                                </div>

                              <div class="debate-tick">
                               <input type="checkbox" id="<?php echo e($user->id); ?>" name="invite[]" value="<?php echo e($user->id); ?>" />
                                <label  for="<?php echo e($user->id); ?>"><span></span></label>
                                <input type="hidden" name="challenger_name" value="<?php echo e(Auth::user()->name); ?>">
                                  <input type="hidden" name="take_a_dare_name_<?php echo e($user->id); ?>" value="<?php echo e($user->name); ?>">
  
                                </div>
                              </div>
                            <?php } ?>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($hasFollowers == 0): ?>
                        <p>No one is added in your sided network.</p>
                        <button type="button" data-toggle="modal" data-target="#popupFollowUsers" data-backdrop="static" data-keyboard="false" id="show-followers-popup" data-dismiss="modal">Follow Users</button>
						<script>
							$(document).ready(function(){
									$(".mylogic").addClass("network-tab-content");
							});
						</script>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                  <?php if($hasFollowers > 0): ?>
                    <input type="hidden" name="debate_id" value="<?php echo e($debate->id); ?>">
                    <input type="submit" class="green-btn" value="Confirm">
                    <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                  <?php else: ?>
                     <div><p data-dismiss="modal" class="inner-cancel">Cancel</p></div>
                  <?php endif; ?>
                  </div>
                </form>
              </div>

              <!-- tab 3-->
              <div id="invite_by_email" class="tab-pane fade">
                <div class="sided-net-content">
                  <h4 class="modal-title">Invite by Email</h4>
                  <p>Add the email addresses of up to three friends you want to debate. We'll invite them into the ring.</p>
                  <div class="email-address-form">
                    <form name="invite_email" action="<?php echo e(route('inviteInner')); ?>" method="post">

                      <div class="dashboard-item">

                        <input type="email" placeholder="Your friends email address…"  name="email[]" required>
                        <input type="email" placeholder="Your friends email address…" name="email[]">
                        <input type="email" placeholder="Your friends email address…" name="email[]">
                      </div>

                      <div class="modal-footer">
                          <input type="hidden" name="debate_id" value="<?php echo e($debate->id); ?>">
                          <input type="submit" class="green-btn" value="Confirm">
                          <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
              <!-- tab 3-->
          </div>
        </div>
      </div>
    </div>
  </div>



    <div class="modal fade new-popup" id="popupJoinDebate" role="dialog">  
      <div class="modal-dialog">   

        <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            
            <div class="modal-body">
              <h4 class="modal-title">Join Debate</h4>
              <p>You are about to join this debate.please submit your argument.</p>
              <textarea rows="8" name="join_debate_argument" id="join-debate-argument" placeholder="What do you think?"></textarea>
			  <input type="hidden" name="question_ID" value="<?php echo e($debate->question->id); ?>">
            </div>
            <div class="modal-footer">
              <button type="button" class="join-submit-btn" disabled>Join</button>
              <p data-dismiss="modal">Cancel</p>
            </div>


          </div>
        </div>
    </div>
  </div>


<div class="modal fade" id="mychallengeModal" role="dialog">  
    <div class="modal-dialog">    
      <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
          </div>

          <div class="tab-section">
            <div class="modal-body">
              <h4 class="modal-title"><?=($debate->status == 'needs_opponent')?"Challenge":"Invite"?></h4>
              <p>Select opponents from your network or challenge out to your friends via email.</p>
              <p>Invite as many as you like. First one in gets to debate</p>
            </div>

            <ul class="nav nav-tabs">
              <!-- <li class="active"><a data-toggle="tab" href="#home">Favorites</a></li> -->
              <?php $is_fav_enabled = "0";?>
              <?php $__currentLoopData = $my_sided_network; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_sided): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($my_sided->is_favourite =='1'): ?>
                <?php $is_fav_enabled = "1"; ?>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php if($is_fav_enabled =='1'): ?>
              <li class="active"><a data-toggle="tab" href="#home">Favorites</a></li>

              <?php endif; ?>

              <?php if($is_fav_enabled =='0'): ?>
                <li class="active"><a data-toggle="tab" href="#menu1">My Sided Network</a></li>
              <?php else: ?>
                <li><a data-toggle="tab" href="#menu1">My Sided Network</a></li>
              <?php endif; ?>
              
              <li><a data-toggle="tab" href="#invite_by_email">Invite Others</a></li>
            </ul>

            <div class="tab-content">
              <!-- tab 1-->
              <?php if($is_fav_enabled =='1'): ?>
              <div id="home" class="tab-pane fade in active">
                <form method="POST" action="<?php echo e(route('challengeForDebate')); ?>" id="challengeForDebate">
                  
                <div class="dashboard-item">
                  <div class="debate-preview u-background-white">
                    <div class="follow-player-sec mylogic">

                       <?php $__currentLoopData = $my_sided_network; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_sided): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php
                $front_user = DB::table('users')
                        ->where('id', $my_sided->user_id)
                        ->first();
            
                ?>
                        <?php if($my_sided->is_favourite =='1'): ?>
                          <?php
                          $user = App\User::findOrfail($my_sided->user_id);
              if($front_user->is_admin!=1){
                          ?>

                          
                            <div class="debate-preview__players follow-players">

                              <label for="fav<?php echo e($user->id); ?>">
                              <div class="debate-select-img">
                               <img width="128" height="128" alt="" src="<?php echo e(asset('images')); ?>/<?php echo e($user->avatar_url); ?>">
                              </div>
                              <div class="debate-select-name">
                                <h4 class="debate-preview__player-name"><a class="u-link-black" href="<?php echo e(route('publicPlayerShow',$user->handle)); ?>" target="_blank"> <?php echo e($user->handle); ?></a></h4>
                                  <small> <?php echo e($user->name); ?> </small>
                              </div>

                              <div class="debate-tick">
                               <input type="checkbox" id="fav<?php echo e($user->id); ?>" name="invite[]" value="<?php echo e($user->id); ?>" />
                                <label for="fav<?php echo e($user->id); ?>"><span></span></label>
                <input type="hidden" name="challenger_name" value="<?php echo e(Auth::user()->name); ?>">
                <input type="hidden" name="take_a_dare_name_<?php echo e($user->id); ?>" value="<?php echo e($user->name); ?>">
                              </div>
                              </label>
                            </div>
                          <?php } ?>
                        <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
          <input type="hidden" name="debate_id" value="<?php echo e($debate->id); ?>">
                  <input type="submit" class="green-btn" value="Confirm">
                  <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                </div>

                </form>
              </div>

               <?php endif; ?>

              
              <!-- tab 2-->
              <?php if($is_fav_enabled =='0'): ?>
                  <div id="menu1" class="tab-pane fade in active">
                  
                <?php else: ?>
                  <div id="menu1" class="tab-pane fade">

                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('challengeForDebate')); ?>" id="challengeForDebate">

                  <div class="dashboard-item">
                    <div class="debate-preview u-background-white">
                        <div class="follow-player-sec mylogic">
                        <?php $__currentLoopData = $my_sided_network; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $my_sided): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                            $front_user = DB::table('users')
                                        ->where('id', $my_sided->user_id)
                                        ->first();
                            
                          ?>
                          <?php if($my_sided->status =='follow'): ?>
                            <?php
                              $user = App\User::findOrfail($my_sided->user_id);
                              if($front_user->is_admin!=1){
                            ?>
                              <div class="debate-preview__players follow-players">  
                                <label for="<?php echo e($user->id); ?>">
                                  <div class="debate-select-img">
                                  <img width="128" height="128" alt="" src="<?php echo e(asset('images')); ?>/<?php echo e($user->avatar_url); ?>">
                                </div>
                                <div class="debate-select-name">
                                  <h4 class="debate-preview__player-name"><a class="u-link-black" href="<?php echo e(route('publicPlayerShow',$user->handle)); ?>"> <?php echo e($user->handle); ?></a></h4>
                                    <small> <?php echo e($user->name); ?> </small>
                                </div>

                              <div class="debate-tick">
                               <input type="checkbox" id="<?php echo e($user->id); ?>" name="invite[]" value="<?php echo e($user->id); ?>" />
                                <label  for="<?php echo e($user->id); ?>"><span></span></label>
                                <input type="hidden" name="challenger_name" value="<?php echo e(Auth::user()->name); ?>">
                                  <input type="hidden" name="take_a_dare_name_<?php echo e($user->id); ?>" value="<?php echo e($user->name); ?>">
  
                                </div>
                              </div>
                            <?php } ?>
                          <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="hidden" name="debate_id" value="<?php echo e($debate->id); ?>">
                    <input type="submit" class="green-btn" value="Confirm">
                    <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                  </div>
                </form>
              </div>

              <!-- tab 3-->
              <div id="invite_by_email" class="tab-pane fade">
                <div class="sided-net-content">
                  <h4 class="modal-title">Invite by Email</h4>
                  <p>Add the email addresses of up to three friends you want to debate. We'll invite them into the ring.</p>
                  <div class="email-address-form">
                    <form name="invite_email" action="<?php echo e(route('inviteInner')); ?>" method="post">

                      <div class="dashboard-item">

                        <input type="email" placeholder="Your friends email address…"  name="email[]" required>
                        <input type="email" placeholder="Your friends email address…" name="email[]">
                        <input type="email" placeholder="Your friends email address…" name="email[]">
                      </div>

                      <div class="modal-footer">
                          <input type="hidden" name="debate_id" value="<?php echo e($debate->id); ?>">
                          <input type="submit" class="green-btn" value="Confirm">
                          <div><p data-dismiss="modal" class="inner-cancel">or Cancel</p></div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
              <!-- tab 3-->
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal -->
<div id="popupFollowUsers" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header"><button type="button" data-dismiss="modal" class="btn-default closed-follow-popup"><i aria-hidden="true" class="fa fa-times"></i></button></div>
      <div class="modal-body">
        <h4 class="modal-title">Follow Users</h4>
		<div class="follow-overflow">
      <div class="user-count" style="display:none;"><?php echo e(count($followUsers)); ?></div>
      <div class="no-user-let-for-follow"></div>
      <?php $__currentLoopData = $followUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="debate-preview__players follow-players">
          <div class="debate-follow-img">
            <img src="<?php echo e(asset('/images/'.$user->avatar_url)); ?>" width="128" height="128" alt="">
          </div>
          <div class="debate-follow-name">
            <h4 class="debate-preview__player-name"><a href="<?php echo e(route('publicPlayerShow', $user->handle)); ?>" class="u-link-black"><?php echo e($user->name); ?></a></h4>
            <small> <?php echo e($user->handle); ?> </small>
          </div> 
          <div class="debate-follow-btn"><button value="<?php echo e($user->id); ?>" class="follow-btn">Follow</button></div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      </div>
      <div class="modal-footer">
        <div><a class="follow-user-back" href="/debates/<?php echo e($debate->id); ?>?r=t">Back</a></div>
      </div>
    </div>

  </div>
</div>

  <!-- Modal -->
  <button style="display:none;" id="voteForUsersPopupId" type="button" data-toggle="modal" data-target="#voteForUsersPopup"></button>
  <div id="voteForUsersPopup" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="<?php echo e(route('voteBythirdUsers')); ?>">
      <div class="modal-content">
        <div class="modal-header"><button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button></div>
        <div class="modal-body">
          <p>Please select an option before you leave the page</p>
          <input id="vote_debate_id" type="hidden" name="debate_id" value="">
          <input id="vote_voter_id" type="hidden" name="voter_id" value="">
          <input id="vote_fingerprint_string" type="hidden" name="fingerprint_string" value="">
          <input id="vote_redirect_url" type="hidden" name="redirect_url" value="">
          <div class="radio-vote-section">
            <ul>
              <li><input id="vote_user_id_left" type="radio" name="user_id" value="" required><label class="vote_user_name_left"></label></li>
              <li><input id="vote_user_id_right" type="radio" name="user_id" value="" required><label class="vote_user_name_right"></label></li>
              <li><input type="radio" name="user_id" value="none" required><label>I don't want to vote right now</label></li>
            </ul>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="green-btn" value="Submit">
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>