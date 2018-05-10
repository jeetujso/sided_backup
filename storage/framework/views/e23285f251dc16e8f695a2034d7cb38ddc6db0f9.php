<div class="header2">

</div>
<?php $__env->startSection('content'); ?>
<main class="game-wrapper">
	<div class="debate-preview u-background-white thx-content">
		<div class="dashboard-item">
	 		<div class="debate-preview__header text-center">
             <h2>Thank you for submitting  your choice.</h2>
	        </div>
			<div class="border-head thx-link">
			<a href="<?php echo e(url('feed')); ?>">Back to Feed</a>
			</div>
	 	</div>
	</div>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>