<?php $__env->startSection('content'); ?>
	<div class="game-wrapper" style="display:flex; height:100vh; align-items:center;">
		<div class="404-error-content" style="border: 5px solid #60dd50;border-radius: 100%;display: table;height: 300px;margin: 0 auto;text-align: center;vertical-align: middle;
width: 300px; padding-top: 37px;">
			<h1 style="color: #60dd50; font-size: 77px; font-weight: 700; margin-bottom: 0;"><span>404</span></h1>
			<h2 style="color: #f44336;font-size: 30px;margin-top: 0;padding: 0;"><span>Not Found</span></h2>


			<a style="background:#333; color:#fff; padding:5px 10px;" href="<?php echo e(route('publicDashboardIndex')); ?>">Go back to Feed</a>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>