<?php $__env->startSection('content'); ?>
    <header class="admin-content__header u-bg-white">
        <div class="admin-content__header-mast u-flex-center">
            <h2 class="admin-content__header-title">
                <?php echo $title;?>
            </h2>
            <div class="admin-content__header-actions">
                <div class="admin-content__date-group sch-group">
                    <?php if($view=="live"): ?>
                        <!-- <a href="?filter_days=7">Last 7 Days</a>
                        <a href="?filter_days=30">Last 30 Days</a>
                        <a href="?filter_days=180">Last 180 Days</a> -->

                        <select id="filter_days" name="filter_days" class="dropdown-button">
                            <option value="" <?=(!isset($_GET['filter_days']))?"selected":""?>>All</option>
                          <option value="7" <?=(isset($_GET['filter_days']) && $_GET['filter_days']=='7')?"selected":""?>>Last 7 Days</option>
                          <option value="30" <?=(isset($_GET['filter_days']) && $_GET['filter_days']=='30')?"selected":""?>>Last 30 Days</option>
                          <option value="180" <?=(isset($_GET['filter_days']) && $_GET['filter_days']=='180')?"selected":""?>>Last 180 Days</option>
                      </select>

                    <?php endif; ?>                

                <a href="<?php echo e(route('partnerAdCreate')); ?>" class="btn btn-green">Add Advertisement</a>
                 </div>
            </div>
        </div>
        <div class="admin-content__header-nav">
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/ads') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerAdIndex')); ?>">
                Live
            </a>
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/ads/scheduled') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerScheduledAdIndex')); ?>">
                Scheduled
            </a>
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/ads/expired') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerExpiredAdIndex')); ?>">
                Expired
            </a>
             <!--a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/ads/draft') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerDraftAdIndex')); ?>">
                Draft
            </a-->
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/ads/deactivated') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerDeactivatedAdIndex')); ?>">
                Deactivated
            </a>
        </div>
    </header>

    <main class="admin-content__body">
        <?php if($view=="live"): ?>
        <section class="admin-content__section">
            <h3 class="admin-content__section-headline">Stat Totals</h3>
            <p class="admin-content__section-desc">
               
                Total statistics for all live ads <?=(isset($_GET['filter_days']))?"over the last ".$_GET['filter_days']." days":""?>
            </p>
            <div class="admin-content__stats u-background-white">
                <div class="admin-content__stat">
                    <h4 class="admin-content__stat-label">
                        Impressions
                    </h4>
                    <span class="admin-content__stat-number" id="impression__no">
                        
                    </span>
                </div><!-- /admin-content__stat-->
                <div class="admin-content__stat">
                    <h4 class="admin-content__stat-label">
                        Ad Clicks
                    </h4>
                    <span class="admin-content__stat-number" id="clicks__no">
                        
                    </span>
                </div><!-- /admin-content__stat-->
            </div>
        </section><!-- /section-->

        <section class="admin-content__section">
            <h3 class="admin-content__section-headline">Data Breakdown</h3>
            <p class="admin-content__section-desc">
               
                Explore data of all live ads <?=(isset($_GET['filter_days']))?"over the last ".$_GET['filter_days']." days":""?>
            </p>

            <div class="admin-content__chart u-background-white">
                <question-chart :impressions="[300, 403, 112, 400, 480, 442, 108]" :ads="[41, 29, 15, 34, 12, 5, 88]"></question-chart>
            </div>
        </section><!-- /section-->
        <?php endif; ?>



       <section class="admin-content__section">
        <div class="admin-content__section-header">
            <div class="ques-info">

                <?php if($view=="live"): ?>
                <h3 class="admin-content__section-headline">Recently Added Ads</h3>
                <p class="admin-content__section-desc">
                    Explore data of all Live Ads <?=(isset($_GET['filter_days']))?"over the last ".$_GET['filter_days']." days":""?>
                 </p>
                 <?php elseif($view=="scheduled"): ?>
                 <h3 class="admin-content__section-headline"> Explore data of all Scheduled Ads <?=(isset($_GET['filter_days']))?"over the last ".$_GET['filter_days']." days":""?></h3>
                <p class="admin-content__section-desc"></p>

                <?php elseif($view=="expired"): ?>
                 <h3 class="admin-content__section-headline"> Explore data of all Expired Ads <?=(isset($_GET['filter_days']))?"over the last ".$_GET['filter_days']." days":""?></h3>
                <p class="admin-content__section-desc"></p>
				
				<?php elseif($view=="deactivated"): ?>
                 <h3 class="admin-content__section-headline"> Explore data of all Deactivated Ads <?=(isset($_GET['filter_days']))?"over the last ".$_GET['filter_days']." days":""?></h3>
                <p class="admin-content__section-desc"></p>

                 <?php endif; ?>
				 
				 


            </div>          
            
        </div>
        <div class="table-main-scroll"><table class="admin-content__table ad-table3 ad-table2"><thead><tr>
            <th></th>
            <th class="">
                    CREATIVE
            </th><th class="">
                    AUTHOR
            </th><th class="">
                    QUESTIONS
            </th><th class="">
                    IMPRESSIONS
            </th><th class="">
                    CLICKS
            </th>
        <th class="">
            </th></tr></thead>


             <tbody>
                <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <tr class="clickable-row">
                    <td>
                        <form method="POST" action="/partners/ads/deactivate/<?php echo e($ad->id); ?>">
                        <input type="hidden" name="ad_id" value="<?php echo e($ad->id); ?>">
                        <button type="submit" name="status" value="deactive"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                    </form>
                </td>
                    
                    <td>
                        <img width="100px" src="<?php echo e(asset('img-dist/ads')); ?>/<?php echo e($ad->image_url); ?>" alt="<?php echo e($ad->name); ?>"> <?php echo e($ad->name); ?>

                    </td>
                    <td>
                        <?php echo e(Auth::user()->name); ?>

                    </td>
                    <td class="admin-table__large-cell">
                        12
                    </td>
                    <td class="admin-table__large-cell ads-impressions">
                        <?php echo e($ad->impressions()->count()); ?>

                    </td>
                    <td class="admin-table__large-cell ads-clicks">
                        <?php echo e($ad->clicks()->count()); ?>

                    </td>
                    <td>
                        <form method="POST" action="/partners/ads/show/<?php echo e($ad->id); ?>">
                            <input type="hidden" name="ad_id" value="<?php echo e($ad->id); ?>">
                            <button type="submit"><i class="fa fa-caret-right" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($ads->count() == 0): ?>
                <tr><td colspan="8">No record found.</td></tr>

                <?php endif; ?>
            </table></div></section>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>