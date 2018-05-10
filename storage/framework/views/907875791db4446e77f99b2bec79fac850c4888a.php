<?php $__env->startSection('content'); ?>
 <header class="admin-content__header u-bg-white">
        <div class="admin-content__header-mast u-flex-center">
            <h2 class="admin-content__header-title">
                <?php echo e($title); ?>

            </h2>
        </div>
        <div class="admin-content__header-nav">
           <div class="admin-content__header-nav">
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/categories') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerCategoryIndex')); ?>">
                Live
            </a>
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('*partners/categories/deactivate*') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerCategoryDeactivate')); ?>">
                Deactivated
            </a>
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('*partners/categories/draft*') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerCategoryDraft')); ?>">
                Draft
            </a>
        </div>
        </div>
    </header>
	<div class="admin-content__body u-background-light">
		<section class="admin-content__section"><div class="admin-content__section-header"><div><h3 class="admin-content__section-headline">Explore data of all Deactivated Categories</h3> <p class="admin-content__section-desc">
                        
                    </p></div></div> <div class="table-main-scroll"><table class="admin-content__table cat-table"><thead><tr>
                    	<th class="">
                    
            </th><th class="">
                    NAME
            </th><th class="">
                    AUTHOR
            </th><th class="">
                    Parent
            </th><th class="">
                    QUESTIONS ATTACHED
            </th><th class="">
                    STATUS
            </th><th class="">
            </th></tr></thead> <tbody>
            <?php $__currentLoopData = $debate_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <tr class="clickable-row">
            	<td>
            		<form method="POST" action="/partners/categories/updatestatus/<?php echo e($categories->id); ?>">
            			<input type="hidden" name="category_id" value="<?php echo e($categories->id); ?>">
            			<button type="submit" name="status" value="deactive"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
            		</form>
                </td><td>
                 <img src="<?php echo e(asset('img-dist/category')); ?>/<?php echo e($categories->icon_url); ?>" class="category-listing-icon">
                    <?php echo e($categories->name); ?> 
            </td> <td>
                <?php echo e(Auth::user()->name); ?>

            </td> <td class="admin-table__large-cell">
                NBA
            </td> <td class="admin-table__large-cell">
                <?php echo e($categories->questions()->count()); ?>

            </td> <td>
               <?php echo e($categories->status); ?>

                </td>
                <td>
                	<form method="POST" action="/partners/categories/edit/<?php echo e($categories->id); ?>">
            			<input type="hidden" name="category_id" value="<?php echo e($categories->id); ?>">
            			<button type="submit"><i class="fa fa-caret-right" aria-hidden="true"></i></button>
            		</form>
                </td>
            </tr>
           
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($debate_category->count() == 0): ?>
                <tr><td colspan="8">No record found.</td></tr>

                <?php endif; ?>
            </table></div></section>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>