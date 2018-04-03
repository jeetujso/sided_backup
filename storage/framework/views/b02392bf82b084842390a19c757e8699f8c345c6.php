<div class="header2">

</div>
<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
	<div class="flash-msg">
		<h4><?php echo e($errors->first()); ?></h4>
	</div>	
<?php endif; ?>

<main class="game-wrapper">
	<section class="player-profile">
		<header class="player-profile__header u-text-center" <?php if(!empty($user->background_img)): ?> style='background-image: url("<?php echo e(asset('images/pro_background')); ?>/<?php echo e($user->background_img); ?>")' <?php endif; ?> >

			

			<div class="pick-sec">
				<div class="following-sec">
					<input type="hidden" name="event_type" id="event_type" value="profile_view">
                    <input type="hidden" name="event_id" id="event_id" value="<?php echo e($user->id); ?>">

		  			<?php if(!empty(auth()->user()->name) && auth()->user()->id != $user->id): ?>
						<form method="POST" action="<?php echo e($action); ?>">
							<?php if($method == 'PUT'): ?>
		                        <?php echo e(method_field('PUT')); ?>

		                    <?php endif; ?>
							<input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
							<input type="hidden" name="status" value="<?php echo e($status); ?>">
							<button name="follow" value="follow" class="following-btn" type="submit" style="height: 26px; width: 26%;"><?php echo e($btn_text); ?></button>
						</form>

						
					<?php endif; ?>

					<?php if(!empty(auth()->user()->name) && auth()->user()->id != $user->id && $user->is_admin!=1): ?>
						<div class="challenge-sec">
						   <button class="challenge-btn" type="button" data-toggle="modal" data-target="#myModal">Challenge</button>    
						</div>
					<?php endif; ?>
					
					<?php if(!empty(auth()->user()->name) && auth()->user()->id == $user->id): ?>
						<!-- <div class="following-sec"> -->
						   <div>
						   	<a class="challenge-btn" href="<?php echo e(route('profile.edit', auth()->user()->id )); ?>">Update Profile</a>
						   </div>
						   <a class="challenge-btn" href="<?php echo e(route('my-category')); ?>">Update Category</a>
						<!-- </div> -->

					<?php endif; ?>
					
  				</div>


  					
<div class="make-main">
   				<?php if(!empty(auth()->user()->name) && auth()->user()->id != $user->id): ?>
   				<div class="make-favorite" title="" data-user="<?php echo e($user->id); ?>">
   					<?php if($is_favourite == '1'): ?>
		  				<img src="/img/favorite-heart-button-red.svg" class="fav-active">
		   			<?php else: ?>
   						<img src="/img/favorite-heart-button.svg" class="fav-active">
   					<?php endif; ?>	   				
   				</div>
   				<?php endif; ?>
   			


	  			<?php if($user->avatar_url ==''): ?>
					<img class="player-profile__header-avatar pick-image" src="<?php echo e(asset('images')); ?>/user_icon.png" alt="<?php echo e($user->name); ?>" height="200px">
				<?php else: ?>
					<img class="player-profile__header-avatar pick-image" src="<?php echo e(asset('images')); ?>/<?php echo e($user->avatar_url); ?>" alt="<?php echo e($user->name); ?>" height="200px">
				<?php endif; ?>
</div>


				<div class="dropdown profile-name">
					<h2 class="player-profile__header-name"><?php echo e($user->name); ?></h2>
				</div>
			</div>
			<span class="player-profile__header-meta title-caption">
				<?php echo e($user->handle); ?>

				|
				<?php echo e($user->rank); ?>

			</span>

			<?php if($user->is_admin==1 && !empty(auth()->user()->name)): ?>
				<div class="feedback-sec2"><button class="challenge-btn" type="button" data-toggle="modal" data-target="#openPopUp">Feedback</button> </div>
				<!-- <div class="contest-sec">
						<a href="<?php echo e(route('publicPlayerContest', $user->id)); ?>">View Contest</a>
				</div> -->
				<?php if(!empty($proUserAds) && !empty($proUserAds->ads)): ?>
					<div class="pro-ads">
						<a href="#" target="_blank">
							<img src="<?php echo e(asset('/img-dist/ads/'.$proUserAds->ads->image_url)); ?>">
						</a>
					</div>
				<?php endif; ?>
			<?php endif; ?>
					
			<div class="player-profile__header-stats">
				<div class="profile-detial">
					<ul>
						<li>		
	
						<div class="player-profile__header-stat">
							<p><div class="header-stat__number"><?php echo e($follower_count); ?></div></p>
						<h4><div class="header-stat__label">Followers</div></h4>
						</div><!-- /header-stat-->
						</li>
						<li>
						<div class="player-profile__header-stat">
							<p><div class="header-stat__number"><?php echo e($total_points); ?></div></p>
						<h4><div class="header-stat__label">Points</div></h4>
						</div><!-- /header-stat-->
						</li>
						<li>
						<div class="player-profile__header-stat">
							<p><div class="header-stat__number"><?php echo e($user->categories()->count()); ?></div></p>
						<h4><div class="header-stat__label">Categories</div></h4>
						</div><!-- /header-stat-->
						</li>
					</ul>
				</div>
				
			</div>
		</header>

		<div class="profile-tab">
 			<ul class="player-profile__tabs nav nav-tabs">
				<li class="player-profile__tab active">
					<a data-toggle="tab" href="#tab1">
						<svg width="11" height="18" viewBox="0 0 11 18" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><path id="a" d="M0 17.088V.208h10.995v16.88z"/></defs><g fill="none" fill-rule="evenodd"><mask id="b" fill="#fff"><use xlink:href="#a"/></mask><path d="M3.945 7.442l1.77-6.45S5.886.38 5.38.233c-.444-.127-.674.264-.725.369l-4.56 9.26c-.104.237-.37 1.029.934.969l5.658-.263-2.059 5.811c0-.003-.106.372.289.627.396.251.8-.156.804-.161l5.065-8.613c.623-1.058-.31-1.102-.554-1.094l-6.286.304z" id="changecolor" fill="#8E8E93" mask="url(#b)"/></g></svg>
					</a>
				</li>
				<li class="player-profile__tab">
					<a data-toggle="tab" href="#tab2">
						<svg width="18" height="15" viewBox="0 0 18 15" xmlns="http://www.w3.org/2000/svg"><path d="M14.059 1l2.831 1.923c-1.656 2.261-2.51 4.7-2.564 7.317v3.631H9.412v-3.097c0-1.816.432-3.613 1.296-5.394.863-1.78 1.98-3.24 3.35-4.38zM5.647 1l2.83 1.923c-1.655 2.261-2.51 4.7-2.563 7.317v3.631H1v-3.097c0-1.816.432-3.613 1.295-5.394C3.159 3.6 4.275 2.14 5.647 1z" stroke="#8E8E93" id="changecolor" stroke-width="1.14" fill="none"/></svg>
					</a>
				</li>
				<li class="player-profile__tab">
					<a data-toggle="tab" href="#tab3">
						<svg width="20" height="15" viewBox="0 0 20 15" xmlns="http://www.w3.org/2000/svg"><path d="M0 14.276h4.112v-9.13H0v9.13zm1.034-1.035h2.043V6.155H1.034v7.086zm4.086 1.035h4.112V0H5.121v14.276zm1.035-1.035h2.043V1.034H6.155V13.24zm4.113 1.035h4.111V4.112h-4.111v10.164zm1.033-1.008h2.044V5.147H11.3v8.12zm4.087 1.008H19.5V2.069h-4.112v12.207zm1.034-1.035h2.044V3.078h-2.044V13.24z" id="changecolor" fill="#8E8E93" fill-rule="evenodd"/></svg>
					</a>
				</li>

				<?php if($user->is_admin == 1): ?>
				<li class="player-profile__tab" id="tab_contest_h1">
					<a data-toggle="tab" href="#tab4">
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="20px" height="20px" viewBox="0 0 11 11" enable-background="new 0 0 11 11" xml:space="preserve">
<g>
	<path fill="#8E8E93" id="changecolor" d="M5.667,5.705c-1.028,0-1.865,0.836-1.865,1.864c0,1.029,0.836,1.865,1.865,1.865
		c1.029,0,1.865-0.837,1.865-1.865S6.695,5.705,5.667,5.705z M5.667,8.707c-0.627,0-1.137-0.511-1.137-1.138s0.51-1.138,1.137-1.138
		c0.627,0,1.137,0.511,1.137,1.138S6.294,8.707,5.667,8.707z"/>
	<path fill="#8E8E93" id="changecolor" d="M10.708,0.195C10.646,0.075,10.521,0,10.386,0H7.468c-0.119,0-0.23,0.059-0.299,0.156L5.667,2.321
		L4.164,0.156C4.096,0.059,3.984,0,3.865,0H0.948c-0.135,0-0.26,0.075-0.322,0.195C0.563,0.315,0.572,0.46,0.649,0.571l2.54,3.659
		C3.056,4.285,2.962,4.415,2.962,4.567c0,0.201,0.163,0.364,0.364,0.364h0.253C2.8,5.549,2.3,6.502,2.3,7.569
		c0,1.856,1.51,3.366,3.366,3.366s3.367-1.51,3.367-3.366c0-1.067-0.5-2.021-1.278-2.638h0.253c0.201,0,0.363-0.163,0.363-0.364
		c0-0.152-0.094-0.283-0.227-0.337l2.54-3.659C10.762,0.46,10.771,0.315,10.708,0.195z M3.675,0.728l1.549,2.231L4.36,4.204H4.056
		L1.644,0.728H3.675z M8.305,7.569c0,1.455-1.184,2.639-2.638,2.639S3.028,9.024,3.028,7.569c0-1.454,1.184-2.638,2.638-2.638
		S8.305,6.115,8.305,7.569z M7.277,4.204H5.246l2.412-3.476H9.69L7.277,4.204z"/>
</g>
</svg>
						<!-- <svg width="20" height="15" viewBox="0 0 20 15" xmlns="http://www.w3.org/2000/svg"><path d="M0 14.276h4.112v-9.13H0v9.13zm1.034-1.035h2.043V6.155H1.034v7.086zm4.086 1.035h4.112V0H5.121v14.276zm1.035-1.035h2.043V1.034H6.155V13.24zm4.113 1.035h4.111V4.112h-4.111v10.164zm1.033-1.008h2.044V5.147H11.3v8.12zm4.087 1.008H19.5V2.069h-4.112v12.207zm1.034-1.035h2.044V3.078h-2.044V13.24z" id="changecolor" fill="#8E8E93" fill-rule="evenodd"/></svg> -->
					</a>
				</li>
				<?php endif; ?>


			</ul>
		  	
	
		  	<div class="tab-content"> 
				<div id="tab1" class="tab-pane fade in active player-profile__tab-content">
					<?php $i=0;?>
					<?php if(is_object($debates) && !empty($debates)): ?>
						<?php $__currentLoopData = $debates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($debate->status=="active"): ?>
								<div class="dashboard-item user-detial-bottom" data-debate="<?php echo e($debate->id); ?>">
									<?php echo $__env->make('game.debates.partials._debate-' . $debate->status, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</div>
								<?php $i++; ?>
							<?php endif; ?>

						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>

					<?php if($i=='0'): ?>
						<h3 class="h3-title empty-title"><span>There are no Live Debates.<span></h3>
					<?php endif; ?>
					<?php unset($i); ?>
				</div>


				<div id="tab2" class="tab-pane fade in player-profile__tab-content">
					<?php $i=0;?>
					<?php if(is_object($debates) && !empty($debates)): ?>
						<?php $__currentLoopData = $debates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="dashboard-item" data-debate="<?php echo e($debate->id); ?>">
						    	<?php echo $__env->make('game.debates.partials._debate-'.$debate->status, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						    	<?php $i++; ?>
						    </div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>					
					<?php endif; ?>
					<?php if($i=='0'): ?>
						<h3 class="h3-title empty-title"><span>There are no Past Debates.</span></h3>
					<?php endif; ?>
					<?php unset($i); ?>

				</div>

				<div id="tab3" class="tab-pane fade in player-profile__tab-content new-cat-tab">
					<div class="point-sec">

						<?php if(isset($userpoints) && count($userpoints)>0): ?>
						<h3 class="h3-title">Points Breakdown</h3>
						<ul>							
							<?php $__currentLoopData = $userpoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $static_points): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							
								<li><span><?php echo e(date('F', mktime(0, 0, 0, $static_points->m, 10))); ?> <?php echo e($static_points->y); ?></span><span><?php echo e($static_points->p); ?> points </span></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
						<?php else: ?>
							<h3 class="h3-title empty-title"><span>No Points recorded yet.</span></h3>
							

						<?php endif; ?>	

					</div>
				</div>
	
				<?php if($user->is_admin == 1): ?>
				<div id="tab4" class="tab-pane fade in player-profile__tab-content">
					<div class="point-sec">
						

						
					      <?php if(count($contests) > 0): ?>
					      	
					      	<ul>
						        <?php $__currentLoopData = $contests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						        <li>
						            <span>
						            	<a href="<?php echo e(route('publicContestClick', $contest->id)); ?>" target="_blank" class="contest-img">
						            		<img class="lazy" data-original="<?php echo e(route('publicContestImpression', $contest->id)); ?>"/>
						            	</a>
						            </span>
						            <span>
						            	<a href="<?php echo e(route('publicContestClick', $contest->id)); ?>" target="_blank"><?php echo e($contest->name); ?></a>
						            </span>
						            <span>
						              <?php if(strlen($contest->description) > 200 ): ?>
						                
						                <div class="show-more">
						                  <?php echo e(substr($contest->description ,0, 200)); ?>

						                  <a href="#" class="show-more-link">...Show more</a>
						                </div>


						                <div class="show-less"  style="display: none">
						                  <?php echo e($contest->description); ?>

						                  <a href="#" class="show-more-link">Show less</a>
						                </div>
						                
						              <?php else: ?>
						                <?php echo e($contest->description); ?>


						              <?php endif; ?>
						            </span>
						        </li>
						        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    	</ul>
					        <?php else: ?>
					        	<h3 class="h3-title empty-title"><span>There are no Contests.</span></h3>
					        <?php endif; ?>
					</div>
				</div>
				<?php endif; ?>



			</div>
		</div>

		<!-- POPUP option -->
		<?php if(!empty(auth()->user()->name)): ?>
		<div class="modal fade" id="openPopUp" role="dialog">
	
          <div class="modal-dialog">    
				<div class="modal-header">
				<button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button>
				</div>
                <div class="modal-content question-form tab-section">
				       <h4 class="modal-title" style="text-align:center;">Got a question or feedback</h4>
          <p style="text-align:center;">If you have feedback on the show or a question you'd like to see debated, tell us below</p>
						   <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#suggest-tab1">Propose a Question</a></li>
          <li><a data-toggle="tab" href="#suggest-tab2">Offer Feedback</a></li>
        </ul>
		<div class="tab-content">
		 <div id="suggest-tab1" class="tab-pane fade in active">
          <div class="sided-net-content">
             <h4 class="modal-title">Offer Scott & BR Feedback</h4>
              <div class="email-address-form">
                <form name="invite_email" action="/players/proposequestionemail/<?php echo e($user->email); ?>" method="post">
                  <div class="dashboard-item">
                    <!-- <input type="text" placeholder="The Scott & BR Show" name="email[]"> -->
                    <input type="text" placeholder="Question Category" name="category" required>
                    <input type="hidden" name="pro_email" value="<?php echo e($user->email); ?>">
					<input type="hidden" name="pro_user" value="<?php echo e($user->name); ?>">
					<input type="hidden" name="user_name" value="<?php echo e(auth()->user()->name); ?>">
                    <textarea placeholder="Enter your Question..." name="question_text" required></textarea>
                  </div>
                
				<div class="modal-footer">
                    <input type="submit" value="Send Feedback" class="green-btn">
                    <div>
                      <p data-dismiss="modal" class="inner-cancel">or Cancel</p>
                    </div>
                  </div>
				  </form>
              </div> 
            </div>
              </div>
 <div id="suggest-tab2" class="tab-pane fade">
          <div class="sided-net-content">
              <h4 class="modal-title">Offer Scott & BR Feedback</h4>
              <div class="email-address-form">
                <form name="invite_email" action="/players/offerfeedbackemail/<?php echo e($user->email); ?>" method="post">
                  <div class="dashboard-item">
                  <input type="text" value="<?php echo e(auth()->user()->name); ?>" name="user_name" required>
                  <input type="hidden" name="pro_email" value="<?php echo e($user->email); ?>">
				  <input type="hidden" name="user_name" value="<?php echo e(auth()->user()->name); ?>">
				  <input type="hidden" name="pro_user" value="<?php echo e($user->name); ?>">
                    <input type="text" placeholder="Subject" name="subject" required>
                    <textarea placeholder="Enter your feedback..." name="feedback_text" required></textarea>
                  </div>                  
                
				<div class="modal-footer">
                    <input type="submit" value="Send Feedback" class="green-btn">
                    <div>
                      <p data-dismiss="modal" class="inner-cancel">or Cancel</p>
                    </div>
                  </div>
				  </form>
              </div>
            </div>
              </div>			  
		</div>

                </div>
            </div>
        </div>
		<?php endif; ?>
	

        <div class="modal fade new-contest" id="openContest" role="dialog">
        	<div class="modal-dialog">    
				<div class="modal-header">
					<button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button>
				</div>
                <div class="modal-content question-form tab-section">
			       	<h4 class="modal-title" style="text-align:center;">Contest list</h4>
      				<p style="text-align:center;">description</p>

      				<?php $contests = App\Contest::where('publish_at', '<=', Carbon\Carbon::now())->where([['expire_at', '>=', Carbon\Carbon::now()], ['partner_id', '=', $user->id], ['status', '!=', 'draft'],])->where('status', '!=', 'deactive')->get(); ?>
      				<ul>
	      				<?php $__currentLoopData = $contests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	      				<li><a href="<?php echo e($contest->website_url); ?>" target="_blank"><?php echo e($contest->name); ?></a></li>
	      				
	      				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	      			</ul>

                </div>
            </div>
        </div>
	</section>

	<?php if(!empty(auth()->user()->name)): ?>
	<div class="modal fade" id="myModal" role="dialog">
	 	<div class="modal-dialog">  
	 		<form method="POST" action="<?php echo e(route('challengeForDebate')); ?>">  
      			<!-- Modal content-->
      			<div class="modal-content">
	        		<div class="modal-header">
	                	<button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
	          			<!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
	          		</div>
	        		<div class="modal-body">
	        			<h4 class="modal-title">Challenge <?php echo e($user->name); ?></h4>
	          			<p>Choose a Debate and Challenge.</p>
	          			<div>
	          				<?php $debates = (new \App\Helpers\Points)->get_debates(); ?>
	          				
	          				<?php if(count($debates) > 0): ?>
		          			<select name="debate_id" class="dropdown">
		          				<?php $__currentLoopData = $debates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		          					<option value="<?php echo e($debate->debate_id); ?>"><?php echo e((new \App\Helpers\Points)->get_question($debate->question_id)->text); ?></option>
		          				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		          			</select>
		          			<?php else: ?>
		          				<h4>You have no debate which need opponent</h4>
		          				<small><a href="<?php echo e(route('publicDebateCreate')); ?>" class="agree-blue">Create new debate</a></small>
		          			<?php endif; ?>
		          		</div>

	        		</div>
	        		<div class="modal-footer">
	        			<input type="hidden" name="invite[]" value="<?php echo e($user->id); ?>">
						<input type="hidden" name="challenger_name" value="<?php echo e(Auth::user()->name); ?>">
				  <input type="hidden" name="take_a_dare_name_<?php echo e($user->id); ?>" value="<?php echo e($user->name); ?>">
	        			<?php if(count($debates) > 0): ?>
	        			<input type="submit" value="Challenge" class="debate-btn">
	        			<?php endif; ?>
	        		</div>
	      		</div>
      		</form>
      	</div>
    </div>

    <?php endif; ?>


</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>