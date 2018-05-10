<?php $__env->startSection('content'); ?>
<div class="admin-content__body u-background-light">
  <!-- <div class="admin-content__table-header">
    <h2 class="admin-content__table-title"> Stats for May 1, 2017 - May 7, 2017 </h2>
  </div> -->
  <div class="header-title">
  <div class="ques-info">
    <label for="text">Ad Creative</label>
    <p class="field-description">This is what users see when scrolling through the main feed</p>
  </div>
 
</div>
<div class="admin-content__form ad-main">
      <div class="field ad-field">
        <div class="field-inner">
        <div class="admin-content__section-header sche-header quest-view1">
        <div><h3 style="font-weight:500;"><?php echo e($editad->name); ?></h3></div>
        <div><p class="admin-content__section-desc">
<form method="POST" action="/partners/ads/edit/<?php echo e($editad->id); ?>">
                        <input type="hidden" name="ad_id" value="<?php echo e($editad->id); ?>">
                        <button type="submit" class="white-button">Modify Ad</button>
                    </form>
          </p></div>
          <!----></div>
          </div>
      </div>
      <div class="ranged">
        <div class="field field__left">
          <div class="ad-img"><img src="<?php echo e(asset('img-dist/ads/'.$editad->image_url)); ?>" /></div>          
        </div>
        <div class="field field__right">
          <p class="field-description first-line"><strong>Uploading the Right Creative</strong></p>
          <p class="field-description">Sided uses IAB Standard Ad Units for display ads that appear in our question feed and details. </p>
          <p class="field-description">We currently support 320x50 Smartphone Banner in questions.</p>
          <p class="field-description"><a href="" id="open_adportfolio">https://www.iab.com/newadportfolio/</a></p>
        </div>
      </div> 
      <div class="ad-bottom-deact-sec">
      <span>Author: <?php echo e(Auth::user()->name); ?></span> <span>Published: <?php echo e(\Carbon\Carbon::parse($editad->publish_at)->format('M d, Y')); ?> </span><span>
        <form method="POST" action="/partners/ads/deactivate/<?php echo e($editad->id); ?>">
                        <input type="hidden" name="ad_id" value="<?php echo e($editad->id); ?>">
                        <button type="submit" name="status" value="deactive" class="white-button"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                    </form></span>
      </div>
  </div>
<section class="admin-content__section"><h3 class="admin-content__section-headline">Stat Totals</h3> <p class="admin-content__section-desc">
                Highlevel numbers for this ad
            </p> <div class="admin-content__stats u-background-white"><div class="admin-content__stat"><h4 class="admin-content__stat-label">
                        Impressions
                    </h4> <span class="admin-content__stat-number">
                        <?php echo e($editad->impressions()->count()); ?>

                    </span></div>  <div class="admin-content__stat"><h4 class="admin-content__stat-label">
                        Ad Clicks
                    </h4> <span class="admin-content__stat-number">
                        <?php echo e($editad->clicks()->count()); ?>

                    </span></div>
                  <div class="admin-content__stat"><h4 class="admin-content__stat-label">
                        Questions
                    </h4> <span class="admin-content__stat-number">
					<?php echo e(count($adAssociatedQuestions)); ?>

                    </span></div></div></section> <section class="admin-content__section"><h3 class="admin-content__section-headline">Data Breakdown</h3> <p class="admin-content__section-desc">
                Explore data for this ad
            </p> <div class="admin-content__chart u-background-white">
                <question-chart :impressions="[300, 403, 112, 400, 480, 442, 108]"  :ads="[41, 29, 15, 34, 12, 5, 88]"></question-chart>
            </div></section>
            <section class="admin-content__section"><div class="admin-content__section-header">
            <div class="header-title">
            <div class="ques-info">
            <h3 class="admin-content__section-headline">Questions</h3> <p class="admin-content__section-desc">
                        A list of questions that have this ad attached to them
                    </p>
                    </div>
                  </div>
                  </div> 
				  
				  <div class="table-main-scroll"><table class="admin-content__table ad-promo-table"><thead><tr>
                        <th class="">
                        QUESTION
            </th><th class="">
            AUTHOR
            </th><th class="">
            CATEGORY
            </th><th class="">
                    IMPRESSIONS
            </th><th class="">
            ENGAGEMENT
            </th>
            <th class="">
            EXPIRES
            </th>
        <th class="">
            </th></tr></thead> <tbody>

            <?php $__currentLoopData = $adAssociatedQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <tr class="clickable-row">
                    <td>
                    <?php  
                        $created = new \Carbon\Carbon($question->expire_at);
                            $now = \Carbon\Carbon::now();
                        /*if($question->status=="draft")
                        { 
                            echo "<p class='qus-draft'>Draft</p>";
                        }
                        elseif ($question->expire_at <= $now ) 
                        {
                            echo "<p class='qus-expired'>Expired</p>";
                        }
                        elseif($question->publish_at > $now){
                            echo "<p class='qus-scheduled'>Scheduled</p>";
                        }
                        else
                        {
                            echo "<p class='qus-live'>Live</p>";
                        }*/
                    ?>
                    <?php echo e($question->name); ?>

                    </td> 
                    <td>
                        <?php echo e(Auth::user()->name); ?>

                    </td>
                    <td class="">
                    <?php echo e(($question) ? ($question->category) ? $question->category->name: '' : ''); ?>

                    </td>
                    <td class="admin-table__large-cell">
                        
                    </td>
                    <td class="admin-table__large-cell">
                        
                    </td>
                    <td class="">
                    <?php  
                        if($question->status=="draft")
                        { 
                            echo "Draft";
                        }
                        elseif ($question->expire_at <= $now ) 
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
                    ?>
                    </td>
                    <td>
                        <form method="POST" action="/partners/questions/view/<?php echo e($question->id); ?>">
                            <input type="hidden" name="ad_id" value="<?php echo e($question->id); ?>">
                            <button type="submit"><i class="fa fa-caret-right" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($adAssociatedQuestions->count() == 0): ?>
                <tr><td colspan="8">No record found.</td></tr>

            <?php endif; ?>
            </table></div></section>
          </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>