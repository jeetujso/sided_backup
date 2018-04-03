<div class="dashboard-item">
    <div class="debate-preview u-background-white">
        <div class="debate-preview__header">
        	<div class="debate-haeder-top">
          		<h4 class="debate-preview__category">Featured Categories</h4>
          	</div>
			<div class="category-list">
				<ul>
				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li>
						<a href="<?php echo e(url('debates/create')); ?>?cid=<?php echo e($category->id); ?>#category_container">
							<img src="<?php echo e(asset('img-dist/category')); ?>/<?php echo e($category->icon_url); ?>" alt="" height="100px">
							<p><?php echo e($category->name); ?></p>
						</a>
					</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>     
        </div>
        <div class="show-more-category">
         	<a href="<?php echo e(route('publicDebateCreate')); ?>#category_container" class="show-more-text"><span>Show more categories</span><span class="show-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a>
    	</div>
    </div>
</div>