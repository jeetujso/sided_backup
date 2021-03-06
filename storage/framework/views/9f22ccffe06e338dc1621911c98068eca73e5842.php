<?php $__env->startSection('content'); ?>
<div class="admin-content__body u-background-light">
  <!-- <div class="admin-content__table-header">
    <h2 class="admin-content__table-title"> Stats for May 1, 2017 - May 7, 2017 </h2>
  </div> -->
  <div class="header-title">
  <div class="ques-info">
    <label for="text">Contest Creative</label>
    <p class="field-description">This is what users see when scrolling through the main feed</p>
  </div>
  <div class="dropdown-main2">
      <select id="filter_days" name="filter_days"  class="dropdown-button">
          <option value="" <?=(!isset($_GET['filter_days']))?"selected":""?>>All</option>
          <option value="7" <?=(isset($_GET['filter_days']) && $_GET['filter_days']=='7')?"selected":""?>>Last 7 Days</option>
          <option value="30" <?=(isset($_GET['filter_days']) && $_GET['filter_days']=='30')?"selected":""?>>Last 30 Days</option>
          <option value="180" <?=(isset($_GET['filter_days']) && $_GET['filter_days']=='180')?"selected":""?>>Last 180 Days</option>
      </select>

</div>
</div>
<div class="admin-content__form ad-main">
      <div class="field ad-field">
        <div class="field-inner">
        <div class="admin-content__section-header sche-header quest-view1">
        <div><h3 style="font-weight:500;"><?php echo e($editad->name); ?></h3></div>
        <div><p class="admin-content__section-desc">
<form method="POST" action="/partners/contests/edit/<?php echo e($editad->id); ?>">
                        <input type="hidden" name="ad_id" value="<?php echo e($editad->id); ?>">
                        <button type="submit" class="white-button">Modify Contest</button>
                    </form>
          </p></div>
          <!----></div>
          </div>
      </div>
      <div class="ranged">
        <div class="field field__left">
          <div class="ad-img"><img src="<?php echo e(asset('img-dist/contests/'.$editad->image_url)); ?>" /></div>          
        </div>
        <div class="field field__right">
                <p class="field-description first-line"><strong>About Contests</strong></p>
                <p class="field-description">Many stations and podcasts run contests. Use this section to integrate you current contests into your pro profile to help listeners find and participate in these rewards. </p>

                </div>
      </div> 
      <div class="ad-bottom-deact-sec">
      <span>Author: <?php echo e(Auth::user()->name); ?></span> <span>Published: <?php echo e(\Carbon\Carbon::parse($editad->publish_at)->format('M d, Y')); ?> </span><span>
        <form method="POST" action="/partners/contests/deactivate/<?php echo e($editad->id); ?>">
                        <input type="hidden" name="ad_id" value="<?php echo e($editad->id); ?>">
                        <button type="submit" name="status" value="deactive" class="white-button"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                    </form></span>
      </div>
  </div>
<section class="admin-content__section"><h3 class="admin-content__section-headline">Stat Totals</h3> <p class="admin-content__section-desc">
                Highlevel numbers for this contest
            </p> <div class="admin-content__stats u-background-white"><div class="admin-content__stat"><h4 class="admin-content__stat-label">
                        Impressions
                    </h4> <span class="admin-content__stat-number">
                        
                        <?php echo e($editad->impressions()->count()); ?>

                    </span></div>  <div class="admin-content__stat"><h4 class="admin-content__stat-label">
                        Contest Clicks
                    </h4> <span class="admin-content__stat-number">
                        <?php echo e($editad->clicks()->count()); ?>

                    </span></div>
                 </div></section> <section class="admin-content__section"><h3 class="admin-content__section-headline">Data Breakdown</h3> <p class="admin-content__section-desc">
                Explore data for this contest
            </p> <div class="admin-content__chart u-background-white">
                <question-chart :impressions="[300, 403, 112, 400, 480, 442, 108]"  :ads="[41, 29, 15, 34, 12, 5, 88]"></question-chart>
            </div></section>
            <section class="admin-content__section"><div class="admin-content__section-header">
            <div class="header-title">
            <div class="ques-info">
            <h3 class="admin-content__section-headline">Recently Added Contests</h3> <p class="admin-content__section-desc">
                        Explore data of all live contests
                    </p>
                    </div>
<div class="dropdown-main2">

                  <input type="text" name="search_text" placeholder="Search..." id="search_text">
                    <input type="hidden" name="search_days" value="<?=isset($_GET['filter_days'])?$_GET['filter_days']:'7'?>" id="search_days">

                    <a href="#" id="view-ads-search-filter">Search</a>

                    <?php $url=strtok($_SERVER["REQUEST_URI"],'?'); ?>
                    <a href="<?php echo e($url); ?>"> Reset</a>


</div>
                  </div>
                  </div> <table class="admin-content__table ad-promo-table"><thead><tr>
                        <th class="">
                    CREATIVE
            </th><th class="">
                    AUTHOR
            </th><th class="">
                    IMPRESSIONS
            </th><th class="">
                    CLICKS
            </th>
        <th class="">
            </th></tr></thead> <tbody>

            <?php $__currentLoopData = $contests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <tr class="clickable-row">
               <td>
                <img width="100px" src="<?php echo e(asset('img-dist/contests')); ?>/<?php echo e($contest->image_url); ?>" alt="<?php echo e($contest->name); ?>"> <?php echo e($contest->name); ?>

            </td> <td>
                <?php echo e(Auth::user()->name); ?>

            </td>  <td class="admin-table__large-cell">
                
                <?php echo e($contest->impressions()->count()); ?>

            </td>
            <td class="admin-table__large-cell">
                <?php echo e($contest->clicks()->count()); ?>

            </td>
                <td>
                    <form method="POST" action="/partners/contests/show/<?php echo e($contest->id); ?>">
                        <input type="hidden" name="ad_id" value="<?php echo e($contest->id); ?>">
                        <button type="submit"><i class="fa fa-caret-right" aria-hidden="true"></i></button>
                    </form>
                </td>
            </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

               
            </tbody></table></section>
          </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>