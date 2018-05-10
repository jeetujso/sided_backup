<?php if(count($ads) > 0): ?>
		<div class="flexslider">
		  <ul class="slides">

		    <?php $__currentLoopData = $ads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ad): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		    <?php if($ad->status=='live'): ?>            
		    <li>
		      <!-- <a href="<?php echo e(route('publicAdsClick', $ad->id)); ?>" target="_blank"><img class="lazy" data-original="<?php echo e(route('publicAdsImpression', $ad->id)); ?>" /></a> -->
		       <a href="<?php echo e(route('publicAdsClick', $ad->id)); ?>" target="_blank"><img src="<?php echo e(asset('img-dist/ads')); ?>/<?php echo e($ad->image_url); ?>" /></a>
		    </li>
		    <?php endif; ?>
		    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  </ul>
		</div>
<?php endif; ?>