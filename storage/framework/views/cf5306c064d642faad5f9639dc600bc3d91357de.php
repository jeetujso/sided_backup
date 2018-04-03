<div class="header2">

</div>
<?php $__env->startSection('content'); ?>
<main class="game-wrapper">
<form class="form category-form u-center-block u-container" role="form" method="POST" action="<?php echo e(route('update-my-category')); ?>">
    <?php echo e(csrf_field()); ?>

    <h2 class="login-form-title u-text-center">Select Your Categories</h2>
    <section class="onboarding-categories u-container">

	    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	    	<div class="onboarding-category <?php if(!in_array($category->id, $catId)) { echo "is-selected"; }?>" style="background-image: url(<?php echo e(asset('img-dist/category/'.$category->image_url)); ?>);">
	    		<span class="onboarding-category__name">
	    			<?php echo e($category->name); ?>

	    		</span>
	    		<input name="category[]" type="checkbox" <?php if(in_array($category->id, $catId)) { echo 'checked'; }?>   value="<?php echo e($category->id); ?>" class="onboarding-category__checkbox">
	    		<div class="onboading-category__screen"></div>
	    	</div>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</section>
    <div class="field text-center">
        <button type="submit" class="btn btn-green btn-block">
            Update
        </button>
    </div>
</form>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>