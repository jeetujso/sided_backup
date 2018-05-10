
<div class="debate-preview u-background-white">
	<div class="debate-preview__header">
			<h4 class="debate-preview__category">Active Now <strong class="u-text-black">(<?php echo e(count($active_users_online)); ?>)</strong></h4>
			<div class="active-main">
			<ul class="active-list ">
	  			<?php $__currentLoopData = $active_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $active): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	          	<li <?php if($active->go_online=="true"): ?> class="pro_online" <?php else: ?> class="pro_offline" <?php endif; ?>>
	          		<a href="<?php echo e(route('publicPlayerShow', $active->handle )); ?>">
	          			<img src="<?php echo e(asset('images')); ?>/<?php echo e($active->avatar_url); ?>" alt="">
	          			<p><?php echo e($active->name); ?></p>
	            		<span></span>
	            	</a>
	            </li>
	    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	    		<?php if(count($active_users) < 6 ): ?>
	    			<?php for($i=count($active_users); $i < 6; $i++): ?>
	    				<li class="deactivate_proprofile">
		              		<img src="<?php echo e(asset('images')); ?>/demo_pro.jpg" alt="">
		                	<span></span>
		                </li>
		            <?php endfor; ?>
	    		<?php endif; ?>
			</ul>
			</div>
	</div>
</div>
