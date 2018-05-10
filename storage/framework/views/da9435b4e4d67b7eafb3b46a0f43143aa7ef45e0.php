<?php $__env->startSection('content'); ?>
    <header class="admin-content__header u-bg-white">
        <div class="admin-content__header-mast u-flex-center">
            <h2 class="admin-content__header-title">
                <?php echo $title;?>
            </h2>
            <div class="admin-content__header-actions">
                <div class="admin-content__date-group sch-group">
                <a href="<?php echo e(route('partnerQuestionCreate')); ?>" class="btn btn-green">Create a Question</a>
                </div>
            </div>
        </div>
        <div class="admin-content__header-nav">
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/questions/live') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerLiveQuestionIndex')); ?>">
                Live
            </a>
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/questions/scheduled') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerScheduledQuestionIndex')); ?>">
                Scheduled
            </a>
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/questions/expired') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerExpiredQuestionIndex')); ?>">
                Expired
            </a>
             <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/questions/draft') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerDraftQuestionIndex')); ?>">
                Draft
            </a>
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/questions/deactivated') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerDeactivatedQuestionIndex')); ?>">
                Deactivated
            </a>
        </div>
    </header>

    <main class="admin-content__body">
        <?php if($view=="live"): ?>
        <section class="admin-content__section">
            <h3 class="admin-content__section-headline">Stat Totals</h3>
            <p class="admin-content__section-desc">
                Total statistics for all live questions over the last 30 days
            </p>
            <div class="admin-content__stats u-background-white">
                <div class="admin-content__stat">
                    <h4 class="admin-content__stat-label">
                        Impressions
                    </h4>
                    <span class="admin-content__stat-number">
                        11,004
                    </span>
                </div><!-- /admin-content__stat-->
                <div class="admin-content__stat">
                    <h4 class="admin-content__stat-label">
                        Clicks
                    </h4>
                    <span class="admin-content__stat-number">
                        450
                    </span>
                </div><!-- /admin-content__stat-->
                <div class="admin-content__stat">
                    <h4 class="admin-content__stat-label">
                        User Engagement
                    </h4>
                    <span class="admin-content__stat-number">
                        6,003
                    </span>
                </div><!-- /admin-content__stat-->
                <div class="admin-content__stat">
                    <h4 class="admin-content__stat-label">
                        Ad Clicks
                    </h4>
                    <span class="admin-content__stat-number">
                        22
                    </span>
                </div><!-- /admin-content__stat-->
            </div>
        </section><!-- /section-->

        <section class="admin-content__section">
            <h3 class="admin-content__section-headline">Stat Totals</h3>
            <p class="admin-content__section-desc">
                Total statistics for all live questions over the last 30 days
            </p>
            <div class="admin-content__chart u-background-white">
                <question-chart :impressions="[300, 403, 112, 400, 480, 442, 108]" :clicks="[120, 123, 87, 43, 50, 23, 10]" :engagement="[45, 88, 44, 67, 54, 66, 15]" :ads="[41, 29, 15, 34, 12, 5, 88]"></question-chart>
            </div>
        </section><!-- /section-->
        <?php endif; ?>


    <?php
         $prev = "";
         $i=0;
    ?>
    <section class="admin-content__section">
        <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
            $curr = \Carbon\Carbon::parse($latest->publish_at)->format('l, M d, Y');
            ?>
            <?php if($curr != $prev): ?>
            <div class="table-main-scroll"><table class="admin-content__table sche-header-main">
                <div class="admin-content__section-header sche-header scheduled-head-sec">
                    <div><h3 class="admin-content__section-headline"> <?php echo e(\Carbon\Carbon::parse($latest->publish_at)->format('l, M d, Y')); ?></h3> </div>
                    <!-- <div>
                    <p class="admin-content__section-desc">

                        <button class="white-button">Export for Social</button>
                    </p>

                    </div> -->
                </div> 
                <thead><tr>
                    <th></th>
                    <th>TIME</th>
                    <th>QUESTIONS</th>
                    <th>AUTHOR</th>
                    <th>CATEGORY</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
            <?php endif; ?>
                <tr class="clickable-row">
                        <td><form method="POST" action="/partners/questions/update/<?php echo e($latest->id); ?>">
                            <input type="hidden" name="question_id" value="<?php echo e($latest->id); ?>">
                            <button type="submit" name="question_status" value="deactive"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                        </form></td>
                        <td><a href="/partners/questions/view/<?php echo e($latest->id); ?>" alt="view question"><strong><?php echo e(\Carbon\Carbon::parse($latest->publish_at)->format('h:i A')); ?></strong></a></td> 
                        <td><a href="/partners/questions/view/<?php echo e($latest->id); ?>" alt="view question"><?php echo e($latest->text); ?></a></td>
                        <td><a href="/partners/questions/view/<?php echo e($latest->id); ?>" alt="view question"><?php echo e(auth()->user()->name); ?></a></td>
                        <td><a href="/partners/questions/view/<?php echo e($latest->id); ?>" alt="view question"><?php echo e($questions[$i]->category->name); ?></a></td>
                        <td>
                            <form method="POST" action="/partners/questions/view/<?php echo e($latest->id); ?>">
                                <input type="hidden" name="question_id" value="<?php echo e($latest->id); ?>">
                                <button type="submit"><i class="fa fa-caret-right" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>





            <?php if(count($questions) == $i+1): ?>

                </tbody>
            </table>
  
            <?php endif; ?>

            <?php
            $i++;
            $prev = $curr;
            ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </section>
        
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>