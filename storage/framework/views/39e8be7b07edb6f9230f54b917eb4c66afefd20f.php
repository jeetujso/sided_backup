<?php $__env->startSection('content'); ?>
<div class="create-account">
<form class="form category-form u-center-block u-container" role="form" method="POST" action="<?php echo e(route('onboardingCategoryCreate')); ?>">
    <?php echo e(csrf_field()); ?>


    <h2 class="login-form-title u-text-center">
    	Now Select Your Categories
    </h2>
    <p class="login-form-desc u-text-center">
    	Tell us what you're interested in
    </p>

    <section class="onboarding-categories u-container">
	    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	    	<div class="onboarding-category" style="background-image: url(<?php echo e(asset('img-dist/category/'.$category->image_url)); ?>);">
	    		<span class="onboarding-category__name">
	    			<?php echo e($category->name); ?>

	    		</span>
	    		<input name="category[]" type="checkbox" value="<?php echo e($category->id); ?>" class="onboarding-category__checkbox">
	    		<div class="onboading-category__screen"></div>
	    	</div>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</section>
    
    <div class="field">
        <button type="submit" class="btn btn-green btn-block">
            Create Your Account
        </button>
    </div>
</form>
</div>
<form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
    <?php echo e(csrf_field()); ?>

</form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>