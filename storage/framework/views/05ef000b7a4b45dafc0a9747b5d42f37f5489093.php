<?php $__env->startSection('content'); ?>

<!--new=sec-->
<div class="admin-content__body u-background-light">
<div class="ques-info">
  <label for="text">Question Text</label>
  <p class="field-description">This is what users see when scrolling through the main feed</p>

</div>

<div class="admin-content-new">
  <div class="row">
    <div class="col-md-12">
      <div class="col-md-10">
        <h3 class="admin-content-title"><?php echo e($questions->text); ?></h3>
      </div>
      <div class="col-md-2 admin-content-button">
        <p>
          <form method="POST" action="/partners/questions/<?php echo e($questions->id); ?>">
                        <input type="hidden" name="question_id" value="<?php echo e($questions->id); ?>">
                        <button type="submit" class="white-button">Modify Question</button>
                    </form>
        </p>
        <p>
          <form method="POST" action="/partners/questions/update/<?php echo e($questions->id); ?>">
                        <input type="hidden" name="question_id" value="<?php echo e($questions->id); ?>">
                        <button type="submit" name="question_status" value="deactive" class="white-button">Close Question</button>
                    </form>
        </p>
      </div>
    </div>

    <div class="col-md-12">
      <ul class="admin-content-inner">
        <li>
          <p>Created: <?php echo e(auth()->user()->name); ?></p>
          <p>Category: <?php echo e($questions->category->name); ?></p>
        </li>
        <li>
          <p>Published: <?php echo e(\Carbon\Carbon::parse($questions->publish_at)->format('M d, Y')); ?></p>
          <p>Ad attachment: <?php echo e(($questions) ? ($questions->allAds) ?  $questions->allAds->name : 'No Ad Attached' : 'No Ad Attached'); ?></p>
        </li>
        <li>
          <p>Expires: <?php echo e(\Carbon\Carbon::parse($questions->expire_at)->format('M d, Y')); ?></p>
         <p>Time Remaining: 
               <?php  
               $created = new \Carbon\Carbon($questions->expire_at);
                  $now = \Carbon\Carbon::now();
               if($questions->status=="draft")
               { 
                  echo "Draft";
                }
                elseif ($questions->expire_at <= $now ) 
                {
                  echo "Expired";
                }
                else
                {
                  if($created->diff($now)->days < 1)
                  {
                    echo 'today';
                  }
                  else
                  {
                    echo 'in '.$created->diffInDays($now).' days';
                  }
}
?></p>
        </li>
        <li>
         <form method="POST" action="/partners/questions/update/<?php echo e($questions->id); ?>">
                        <input type="hidden" name="question_id" value="<?php echo e($questions->id); ?>">
                        <button type="submit" name="question_status" value="deactive"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                    </form>
        </li>
      </ul>
    </div>
  </div>



</div>


<div class="admin-content__section-header sche-header quest-view1" style="margin-top:15px;">
  <div class="combine-main">
    <h3 class="admin-content__section-headline">Stat Totals</h3>
    <p class="admin-content__section-desc">Explore data this questions has collected by toggling on and off each data point</p>
  </div>
  <div class="combine-main">

    <p class="admin-content__section-desc combine-button">
      <a data-modal-id="attachAdsPopUp" href="#" class="js-open-modal white-button">
       <?php echo e(($questions) ? ($questions->allAds) ?  'Edit Ad' : 'Attach Ad' : 'Attach Ad'); ?>

      </a>
      <?php if(isset($questions) && isset($questions->allAds)): ?>
      <a href="<?php echo e(route('partnerQuestionUnattach',$questions->allAds->id)); ?>" class="js-open-modal white-button">
      Remove Ad
      </a>
      <?php endif; ?>
    </p>
  </div>
</div>

<div class="admin-content__stats u-background-white">
  <div class="admin-content__stat">
    <h4 class="admin-content__stat-label"> Impressions</h4>
    <span class="admin-content__stat-number"> 
      <?php 
    echo $impression = $questions->QuesImpressions()->count();

    

    ?>
  </span> </div>
  <!-- /admin-content__stat-->
  <div class="admin-content__stat">
    <h4 class="admin-content__stat-label"> Clicks </h4>
    <span class="admin-content__stat-number"> <?php echo e($questions->clicks()->count()); ?> </span> </div>
  <!-- /admin-content__stat-->
  <div class="admin-content__stat">
    <h4 class="admin-content__stat-label"> User Engagement </h4>
    <span class="admin-content__stat-number"> 
      <?php
      $user_enganged[$questions->id] = array_unique($user_enganged[$questions->id]);
      echo count($user_enganged[$questions->id]);
       ?>


    </span> </div>
  <!-- /admin-content__stat-->
  <div class="admin-content__stat">
    <h4 class="admin-content__stat-label"> Ad Clicks </h4>
    <span class="admin-content__stat-number"> N/A </span> </div>
  <!-- /admin-content__stat-->
  <div class="admin-content__stat stat-ad-banner" style="background-color:#f5f5f5;"> 
    <?php
        if(!empty($questions) && !empty($questions->allAds)){ ?>
             <img class="placeholder_banner" src="<?php echo e(($questions) ? ($questions->allAds) ? asset('img-dist/ads/'.$questions->allAds->image_url) : asset('img/ad-banner.jpg') : asset('img/ad-banner.jpg')); ?>" />
        <?php }else{ ?>
             <img class="placeholder_banner" src="<?php echo e(($questions) ? ($questions->allAds) ? asset('img-dist/ads/'.$questions->allAds->image_url) : asset('img/ad-banner.jpg') : asset('img/ad-banner.jpg')); ?>" />
        <?php }
    ?>
   

  </div>
  <!-- /admin-content__stat--> 
</div>


<div class="row">
  <div class="col-md-12 activity">
    <div class="col-md-8">
      <div class="admin-content__section-header edit-title">
        <div>
          <h3 class="admin-content__section-headline">Data Breakdown</h3>
        </div>
        <div>
          <p class="admin-content__section-desc">Explore data this questions has collected by toggling on and off each data point</p>
        </div>
      </div>
      <div class="admin-content__chart u-background-white">
        <question-chart :impressions="[8,10]" :clicks="[120,55]" :engagement="[45,11]" :ads="[41,55]"></question-chart>
      </div>
    </div>
    <!--end-col-md-8-->
    <div class="col-md-4">
      <div class="admin-content__section-header sche-header edit-activity">
        <div>
          <h3 class="admin-content__section-headline">Recent Activity</h3>
          <p class="admin-content__section-desc">See how users are interacting with your question</p>
        </div>
        <div>
          <p class="admin-content__section-desc">
            <a data-modal-id="popup1" href="#" class="js-open-modal white-button2">Moderate</a>            
          </p>          
        </div>
        <div> </div>
      </div>
      
      <div class="active-list-box u-background-white">
        <ul class="activity-list">
          <?php $prew = "";?>
             <?php $__currentLoopData = $recent_arguments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arguments_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
             <?php $__currentLoopData = $arguments_user->argumentPro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $argument_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php $current = $argument_user->user->handle; ?>
          <h3><?php echo e(\Carbon\Carbon::parse($argument_user->created_at)->format('M d')); ?></h3>
          <li>        
            <span><img src="<?php echo e(asset('images/')); ?>/<?php echo e($argument_user->user->avatar_url); ?>" /></span><span><span><strong><?php echo e($argument_user->user->name); ?></strong> <?php if($current != $prew): ?> started a debate <?php elseif($current == $prew): ?> added a argument  <?php else: ?> joined a debate <?php endif; ?></span>

            <span>
            <p>    <?php
             echo $argument_user->created_at; ?> 
             <?php if($argument_user->status=="deactivate"): ?> <a href="#" class="u-link-red">Deleted</a> <?php endif; ?>
              </p>

			
            </span></span> 
			</li>
            <?php $prew = $current; ?>
            
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
         <ul class="activity-list">
             <?php $__currentLoopData = $recent_comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comments_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <?php $__currentLoopData = $comments_user->commentPro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <h3><?php echo e(\Carbon\Carbon::parse($comment_user->created_at)->format('M d')); ?></h3>
          <li><span><img src="<?php echo e(asset('images/')); ?>/<?php echo e($comment_user->user->avatar_url); ?>" /></span><span><span><strong><?php echo e($comment_user->user->name); ?></strong> added a comment</span><span>
            <p><?php

                echo $comment_user->created_at->diffForHumans();
                 
                ?>
                  <?php if($comment_user->status=="deactivate"): ?> <a href="#" class="u-link-red">Deleted</a> <?php endif; ?> 
                </p>
                 
            </span></span></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    </div>
  </div>



<div class="col-md-12">
    <section class="admin-content__section">
      <div class="admin-content__section-header">
        <div>
          <h3 class="admin-content__section-headline">Debates Created</h3>
          <p class="admin-content__section-desc"> Track the debates that users started from your question</p>
        </div>       
      </div>
      <div class="col-md-12 exp-table-left table-main-scroll">
      <div class="table-main-scroll"><table class="admin-content__table">
        <thead>
            <tr class="clickable-row">
              <th style="display:none"></th>
              <th> DEBATE STATUS</th>
              <th> PLAYER 1 </th>
              <th> PLAYER 1 VOTES </th>
              <th> PLAYER 2 </th>
              <th> PLAYER 2 VOTES </th>
              <th class=""> Comments </th>
              <th style="display:none"></th>
            </tr>
        </thead>
        <tbody>
          <?php
          //$_obj_debate  = new App\Debate;
          //$debates      = $_obj_debate->with(['users','arguments','comments'])->where('question_id',$questions->id)->get();
          ?>
          <?php $__currentLoopData = $debates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $single_debate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="clickable-row">
              <td style="display:none"></td>
              <td><p><?php echo e(ucfirst(str_replace('_',' ',$single_debate->status))); ?></p><span> </span></td>

              <?php $__currentLoopData = $single_debate->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <td>
                <ul class="activity-list">
                  <li>
                    <span><img src="<?php echo e(asset('images/'.$user->avatar_url)); ?>"></span>
                    <span>
                      <span>
                        <strong><?php echo e($user->name); ?></strong>
                      </span>
                      <span><p><?php echo e($single_debate->argumentPro->where('user_id', $user->id)->count()); ?> responses</p></span>
                    </span>
                  </li>
                </ul>
              </td>
              <td class="admin-table__large-cell"><?php echo e($user->pivot->votes); ?></td>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <?php if($single_debate->users->count() < 2): ?>
                <td class="admin-table__large-cell">N/A</td>
                <td class="admin-table__large-cell">0</td>
              <?php endif; ?>
              <td class="admin-table__large-cell"><?php echo e($single_debate->commentPro->count()); ?></td>
              <td style="display:none"></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>      
    </div>
    </section>
  </div>



  <div class="col-md-12">
    <section class="admin-content__section">
      <div class="admin-content__section-header">
        <div>
          <h3 class="admin-content__section-headline">Users</h3>
          <p class="admin-content__section-desc">See a list of all users who have engaged with your question</p>
        </div>
      </div>
	  <div class=" table-main-scroll">
      <div class="table-main-scroll"><table class="admin-content__table">
        <thead>
          <tr class="clickable-row">
            <th style="display:none"></th>
            <th class="">USER</th>
            <th class="">NAME</th>
            <th class="">LAST NAME</th>
            <th class="">LOCATION</th>
            <th class="">INTERESTS</th>
            <th class=""></th>
          </tr>
        </thead>
        <tbody>
          <?php
          //print_r($user_enganged);
          //$user_enganged[$questions->id] = array_unique($user_enganged[$questions->id]);
          foreach($user_enganged[$questions->id] as $user_id){
           $_obj_categoey  = new App\DebateCategoryUser;
          $cat_user = $_obj_categoey->with('category','user')->where('user_id',$user_id)->get();
         /* echo "<pre>";
          print_r($cat_user); 
          die(); */
            $user = App\User::where('id', $user_id)->first();
            ?>

            <tr class="clickable-row"> 
              <td style="display:none"></td>
			<td><img src="<?php echo e(asset('images/')); ?>/<?php echo e($user->avatar_url); ?>" class="category-listing-icon">
                     <?php echo e($user->handle); ?>

            </td>			
            <td> <?php echo e($user->name); ?> </td>
            <td class="">N/A</td>
            <td class=""> N/A</td>
            <td class="">
			<?php 
      $myArray = array();
			foreach($cat_user as $interest_cat)
			{
					$myArray[] = '<span>'.ucfirst($interest_cat->category->name).'</span>';
			}
			if(!empty($myArray))
			{
				echo implode( ', ', $myArray );
			}
			else
			{
				echo "No interest";
			}
			?>
			</td>
            <td class=""> <a href="/players/<?php echo e($user->handle); ?>" target="_blank" alt="<?php echo e($user->handle); ?>"> <i class="fa fa-caret-down" aria-hidden="true"></i></button>
                    </a></td>
          </tr>
            <?php
          }
          ?>


                                            
        </tbody>
      </table>
	  </div>
    </section>    
  </div>
</div>
</div>

<div id="popup1" class="modal-box">
  <header> <a href="#" class="js-modal-close close">×</a>
    <h3>Moderate this Question</h3>
    <p class="modal-box-header-content">Review and remove any comments or debate responses you deem inappropriate.</p>
    <h4>Messages</h4>
  </header>
  <div class="modal-body">
    <?php $__currentLoopData = $recent_arguments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arguments_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <?php $__currentLoopData = $arguments_user->argumentPro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $argument_user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="debate-main">
   <div class="debate-preview__players follow-players">
   <div class="debate-select-img"><img width="128" height="128" alt="" src="<?php echo e(asset('images/')); ?>/<?php echo e($argument_user->user->avatar_url); ?>"></div> 
   <div class="debate-select-name">
   <h4 class="debate-preview__player-name">
   <a href="#" class="u-link-black"><?php echo e($argument_user->user->handle); ?></a>
   </h4>
   <small><?php echo e($argument_user->user->name); ?></small>
   </div> 
   <?php if($argument_user->status=="active"): ?>
   <div class="debate-tick"><form method="POST" action="/partners/questions/destroyargument/<?php echo e($argument_user->id); ?>">
                        <input type="hidden" name="comment_id" value="<?php echo e($argument_user->id); ?>">
                        <button type="submit"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                    </form></div>
					<?php else: ?>
						<a href="#" class="u-link-red">Deleted</a>
					<?php endif; ?>
  </div>
     <div class="debate-bottom-content">
      <?php $__currentLoopData = $side; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debate_side): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($debate_side->user_id == $argument_user->user->id): ?>
    <p><a href="#" class="<?php echo e(strtolower($debate_side->side)); ?>-btn"><?php echo e($debate_side->side); ?></a></p>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <p><?php echo e($argument_user->argument); ?></p>
   </div>
   </div>
   
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $recent_comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentscomment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $recentscomment->commentPro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recentcomment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="debate-main">
   <div class="debate-preview__players follow-players">
   <div class="debate-select-img"><img width="128" height="128" alt="" src="<?php echo e(asset('images/')); ?>/<?php echo e($recentcomment->user->avatar_url); ?>"></div> 
   <div class="debate-select-name">
   <h4 class="debate-preview__player-name">
   <a href="#" class="u-link-black"><?php echo e($recentcomment->user->handle); ?></a>
   </h4>
   <small><?php echo e($recentcomment->user->name); ?></small>
   </div> 
   <?php if($recentcomment->status=="active"): ?>
   <div class="debate-tick">
 <form method="POST" action="/partners/questions/destroycomment/<?php echo e($recentcomment->id); ?>">
                        <input type="hidden" name="argument_id" value="<?php echo e($recentcomment->id); ?>">
                        <button type="submit"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                    </form></div>
                    <?php else: ?>
            <a href="#" class="u-link-red">Deleted</a>
          <?php endif; ?>
  </div>
     <div class="debate-bottom-content">
   <p><a href="#" class="comment-btn">COMMENT</a></p>
   <p><?php echo e($recentcomment->comment); ?></p>
   </div>
   </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>



<div class="modal-box" id="attachAdsPopUp" role="dialog">
  <header> <a href="#" class="js-modal-close close">×</a>
    <h3>Attach Ad to this Question</h3>
  </header>

  <div class="modal-body">
    <?php if(count($ads)): ?>
      <p><small>Please select one of the Ads</small></p>
    <?php else: ?>
      <span class="no-ads"><span>There are no Ads in your account</span></span>
    <?php endif; ?>


    <?php if(count($ads)): ?>
      <form method="POST" action="<?php echo e(route('attachAdsToQues')); ?>">
        <select name="attached_ads_id" id="add-change" style="width: 100%;">
          <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $class =''; 
              if($questions->ads_id == $ad->id){
                $class = 'active';
              }
            ?>
            <option <?php if($questions->ads_id == $ad->id) { echo "selected"; }?> img-path="<?php echo e($ad->image_url); ?>" value="<?php echo e($ad->id); ?>" class="<?php echo e($class); ?>"><?php echo e($ad->name); ?> </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <input type="hidden" name="question_id" value="<?php echo e($questions->id); ?>">

        
          <div class="add-img-preview">
            <small>Ad preview</small>
            <img  src="#" width="500" height="200">
          </div>
          <div class="attach-submit"><input type="submit" value="Attach Ad"></div>
      </form>
    <?php endif; ?>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>