<div class="header2">

</div>
<?php $__env->startSection('content'); ?>
<?php if($user->go_online == 'true' && $user->is_admin ==1): ?>
<div class="on_air">
		<h4><img src="<?php echo e(asset('img-dist/icons/on-air.png')); ?>"> ON AIR</h4>
	</div>	
<?php endif; ?>
<?php if($errors->any()): ?>
	<div class="flash-msg">
		<h4><?php echo e($errors->first()); ?></h4>
	</div>	
<?php endif; ?>

<main class="game-wrapper">
	<section class="player-profile">
		<header class="player-profile__header u-text-center <?php if($user->is_admin==1): ?> player-profile-bg <?php endif; ?>" <?php if(!empty($user->background_img)): ?> style='background-image: url("<?php echo e(asset('images/pro_background')); ?>/<?php echo e($user->background_img); ?>")' <?php endif; ?> >

			

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
						   <a class="challenge-btn" href="<?php echo e(route('my-category')); ?>">Update Categories</a>
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
						<?php if($user->is_admin != 1): ?>
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
						<?php else: ?>
						<li>
						<div class="player-profile__header-stat">
							<p><div class="header-stat__number"><?php echo e(count($contests)); ?></div></p>
						<h4><div class="header-stat__label">Contests</div></h4>
						</div><!-- /header-stat-->
						</li>
						<li>
						<div class="player-profile__header-stat">
							<p><div class="header-stat__number"><?php echo e(count($events)); ?></div></p>
						<h4><div class="header-stat__label">Events</div></h4>
						</div><!-- /header-stat-->
						</li>
						
						<?php endif; ?>

					</ul>
				</div>
				
			</div>
			
		</header>
		<?php if(!empty($proUserAds) && !empty($proUserAds->ads)): ?>
					<div class="pro-ads">
						<a href="#" target="_blank">
							<img src="<?php echo e(asset('/img-dist/ads/'.$proUserAds->ads->image_url)); ?>">
						</a>
					</div>
				<?php endif; ?>
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
				<?php if($user->is_admin != 1): ?>
				<li class="player-profile__tab">
					<a data-toggle="tab" href="#tab3">
						<svg width="20" height="15" viewBox="0 0 20 15" xmlns="http://www.w3.org/2000/svg"><path d="M0 14.276h4.112v-9.13H0v9.13zm1.034-1.035h2.043V6.155H1.034v7.086zm4.086 1.035h4.112V0H5.121v14.276zm1.035-1.035h2.043V1.034H6.155V13.24zm4.113 1.035h4.111V4.112h-4.111v10.164zm1.033-1.008h2.044V5.147H11.3v8.12zm4.087 1.008H19.5V2.069h-4.112v12.207zm1.034-1.035h2.044V3.078h-2.044V13.24z" id="changecolor" fill="#8E8E93" fill-rule="evenodd"/></svg>
					</a>
				</li>
				<?php endif; ?>
				<?php if($user->is_admin == 1): ?>
				<li class="player-profile__tab">
					<a data-toggle="tab" href="#tab3">
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
  width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">
<path fill-rule="evenodd" clip-rule="evenodd" fill="#FFFFFF" stroke="#8E8E93" stroke-width="0.75" stroke-miterlimit="10" d="
 M18.525,7.872c-0.092-0.529-0.58-0.868-0.58-0.868c-0.309-0.214-0.481-0.684-0.383-1.043c0,0,0.15-0.568-0.122-1.034
 c-0.271-0.465-0.848-0.618-0.848-0.618c-0.363-0.098-0.69-0.479-0.723-0.85c0,0-0.054-0.587-0.47-0.932
 c-0.417-0.346-1.013-0.295-1.013-0.295c-0.377,0.033-0.813-0.218-0.975-0.555c0,0-0.252-0.532-0.764-0.715
 c-0.512-0.185-1.051,0.062-1.051,0.062c-0.344,0.157-0.843,0.071-1.109-0.191c0,0-0.423-0.415-0.968-0.415
 c-0.544,0-0.967,0.415-0.967,0.415C8.289,1.094,7.79,1.18,7.447,1.023c0,0-0.54-0.247-1.053-0.062
 C5.883,1.145,5.63,1.676,5.63,1.676C5.47,2.014,5.032,2.264,4.656,2.232c0,0-0.594-0.051-1.011,0.294
 c-0.417,0.345-0.47,0.932-0.47,0.932C3.142,3.83,2.815,4.211,2.452,4.309c0,0-0.575,0.153-0.848,0.618
 C1.332,5.393,1.484,5.961,1.484,5.961c0.098,0.359-0.077,0.83-0.384,1.043c0,0-0.488,0.338-0.583,0.868
 C0.423,8.4,0.764,8.884,0.764,8.884c0.215,0.306,0.215,0.803,0,1.107c0,0-0.341,0.485-0.247,1.013
 c0.095,0.529,0.583,0.868,0.583,0.868c0.307,0.214,0.482,0.683,0.384,1.041c0,0-0.152,0.568,0.119,1.034
 c0.273,0.467,0.848,0.618,0.848,0.618c0.364,0.099,0.69,0.48,0.723,0.852c0,0,0.053,0.587,0.47,0.932
 c0.417,0.346,1.011,0.295,1.011,0.295c0.376-0.032,0.814,0.218,0.975,0.555c0,0,0.253,0.531,0.764,0.718
 c0.513,0.183,1.054-0.065,1.054-0.065c0.342-0.156,0.841-0.068,1.108,0.192c0,0,0.421,0.416,0.966,0.416
 c0.545,0,0.968-0.416,0.968-0.416c0.267-0.261,0.766-0.349,1.109-0.192c0,0,0.539,0.248,1.051,0.065
 c0.512-0.187,0.764-0.718,0.764-0.718c0.161-0.337,0.598-0.587,0.975-0.555c0,0,0.596,0.05,1.013-0.295
 c0.416-0.346,0.47-0.932,0.47-0.932c0.032-0.371,0.359-0.753,0.723-0.852c0,0,0.576-0.151,0.848-0.618
 c0.272-0.466,0.122-1.034,0.122-1.034c-0.099-0.358,0.074-0.827,0.383-1.042c0,0,0.488-0.338,0.58-0.867
 c0.095-0.528-0.245-1.013-0.245-1.013c-0.216-0.304-0.216-0.801,0-1.108C18.28,8.883,18.62,8.4,18.525,7.872z"/>
<text transform="matrix(1 0 0 1 3.5835 15.375)" fill="#8E8E93" font-family="'Lato-Regular'" font-size="15">%</text>
</svg>
					</a>
				</li>
				<li class="player-profile__tab" id="tab_contest_h1">
					<a data-toggle="tab" href="#tab4">
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
  width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve">
<path id="Fill-6" fill="#818181" d="M14.238,13.305h2.716l-2.716,2.467V13.305z M13.32,7.639c-0.156,0.008-0.303,0.071-0.408,0.177
 l-4.617,4.446l-2.242-2.037c-0.228-0.214-0.604-0.219-0.839-0.012c-0.234,0.208-0.241,0.549-0.012,0.762
 c0.005,0.006,0.01,0.011,0.017,0.016l2.669,2.425c0.23,0.211,0.605,0.214,0.839,0.004c0.004-0.004,0.009-0.009,0.014-0.013
 l5.043-4.85c0.231-0.211,0.229-0.552-0.002-0.762C13.661,7.685,13.491,7.628,13.32,7.639z M1.187,5.223h16.611v7.005h-4.153
 c-0.019-0.001-0.037-0.001-0.055,0c-0.307,0.025-0.54,0.261-0.539,0.538v3.772H1.187V5.223z M13.941,2.259
 c-0.328,0-0.594,0.241-0.594,0.54c0,0.297,0.266,0.538,0.594,0.538c0.327,0,0.593-0.241,0.593-0.538
 C14.534,2.5,14.269,2.259,13.941,2.259z M5.043,2.259c-0.328,0-0.594,0.241-0.594,0.54c0,0.297,0.266,0.538,0.594,0.538
 c0.327,0,0.593-0.241,0.593-0.538C5.636,2.5,5.37,2.259,5.043,2.259z M1.187,4.145h16.611V1.451H1.187V4.145z M0.537,0.374
 C0.232,0.399-0.001,0.633,0,0.913v16.165c0,0.298,0.266,0.539,0.594,0.539h13.051c0.156-0.002,0.307-0.059,0.417-0.16l4.746-4.311
 c0.111-0.1,0.176-0.236,0.176-0.38V0.913c0-0.298-0.265-0.539-0.593-0.539H0.594C0.575,0.373,0.556,0.373,0.537,0.374z"/>
</svg>
						
					</a>
				</li>
				<?php endif; ?>


			</ul>
		  	
	
		  	<div class="tab-content"> 
		  		<?php if($user->is_admin != 1): ?>
				<div id="tab1" class="tab-pane fade in active player-profile__tab-content">
					<?php $i=0; ?>
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
				<?php else: ?>
				<div id="tab1" class="tab-pane fade in active player-profile__tab-content">

						<?php $i=0; ?>
						
					<?php if(!empty($prodebates)): ?>
						<?php $__currentLoopData = $prodebates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($debate->status=="active" && $user->id==$debate->getDebatequestion->getquestionAuther->id): ?>
								<div class="dashboard-item user-detial-bottom" data-debate="<?php echo e($debate->id); ?>">
									<?php echo $__env->make('game.debates.partials._debate-pro-' . $debate->status, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
				<?php endif; ?>
				<?php if($user->is_admin != 1): ?>
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
				<?php else: ?>
				<div id="tab2" class="tab-pane fade in player-profile__tab-content">
					<?php $i=0; 
					$now = Carbon\Carbon::now();
					?>
					<?php if(!empty($prodebates)): ?>
						<?php $__currentLoopData = $prodebates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
							$expire_at = new \Carbon\Carbon($debate->getDebatequestion->expire_at);
							$publish_at = new \Carbon\Carbon($debate->getDebatequestion->publish_at);
						?>
						<?php if($expire_at<=$now && $user->id==$debate->getDebatequestion->getquestionAuther->id): ?>
							<div class="dashboard-item" data-debate="<?php echo e($debate->id); ?>">
						    	<?php echo $__env->make('game.debates.partials._debate-pro-'.$debate->status, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						    	<?php $i++; ?>
						    </div>
						    <?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>					
					<?php endif; ?>
					<?php if($i=='0'): ?>
						<h3 class="h3-title empty-title"><span>There are no Past Debates.</span></h3>
					<?php endif; ?>
					<?php unset($i); ?>

				</div>
				<div id="tab3" class="tab-pane fade in player-profile__tab-content new-cat-tab">
					<div class="point-sec">
						
					      <?php if(count($contests) > 0): ?>
					      	
					      	<ul class="contest-tab">
						        <?php $__currentLoopData = $contests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						        <li>
						            <span>
						            	<a href="<?php echo e(route('publicContestClick', $contest->id)); ?>" target="_blank" class="contest-img">
						            		<img class="lazy" data-original="<?php echo e(route('publicContestImpression', $contest->id)); ?>" src="<?php echo e(asset('img-dist/contests')); ?>/<?php echo e($contest->image_url); ?>"/>
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
				
	
				<?php if($user->is_admin == 1): ?>
				<div id="tab4" class="tab-pane fade in player-profile__tab-content">
										<div class="point-sec">

						 <?php if(count($events) > 0): ?>
					      	
					      	<ul class="event-tab">
						        <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						        <li>
						            <span>
						            	<a href="<?php echo e(route('publicEventClick', $event->id)); ?>" target="_blank" class="contest-img">
						            		<img class="lazy" data-original="<?php echo e(route('publicEventImpression', $event->id)); ?>" src="<?php echo e(asset('img-dist/events')); ?>/<?php echo e($event->image_url); ?>"/>
						            	</a>
						            </span>
						            <span>
						            	<a href="<?php echo e(route('publicEventClick', $event->id)); ?>" target="_blank"><?php echo e($event->name); ?></a>
						            </span>
						            <span>
						              <?php if(strlen($event->description) > 200 ): ?>
						                
						                <div class="show-more">
						                  <?php echo e(substr($event->description ,0, 200)); ?>

						                  <a href="#" class="show-more-link">...Show more</a>
						                </div>


						                <div class="show-less"  style="display: none">
						                  <?php echo e($event->description); ?>

						                  <a href="#" class="show-more-link">Show less</a>
						                </div>
						                
						              <?php else: ?>
						                <?php echo e($event->description); ?>


						              <?php endif; ?>
						            </span>
						        </li>
						        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					    	</ul>
					        <?php else: ?>
					        	<h3 class="h3-title empty-title"><span>There are no Events.</span></h3>
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