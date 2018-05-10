<div class="header2">

</div>
<?php $__env->startSection('content'); ?>

 <?php if(Session::has('message')): ?>
    <div class="flash-msg"><?php echo e(Session::get('message')); ?></div>
  <?php endif; ?>
   	<main class="game-wrapper voter-img">

   		<?php if(!Session::has('sharebox')): ?>

   		<div class="marginb game-wrapper new-share-main">
			<div class="new-share-sec">
	   			<div class="share-head">
	   				<h4 class="u-white-text">Welcome to Sided</h4>
		   			<a href="#" class="share-close"><i class="fa fa-times" aria-hidden="true"></i></a>
		   		</div>
		   		<p class="debate-preview__question-text">
		   			Every Story has two sides.<br>
			   		Pick a question, take a side, and win stuff.
			   </p>
		   		<span>Learn more about points and status.</span>
			</div>
		</div>
		<?php endif; ?>

		<!-- prousers list -->
		<div class="dashboard-item">
			<?php echo $__env->make('game.dashboard.include.prousers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<!-- prousers list end-->
   
	    <div class="game-main debate-single">
			<?php $num_debates = $debates->count(); ?>
			<?php if($debates->count() > 0): ?>
		
				<?php $i=0; 

				?>
				<?php if(!empty($debates)): ?>
				<?php $__currentLoopData = $debates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					<?php if($debate->status == 'needs_opponent' || $debate->status == 'active'): ?>
				    <div class="dashboard-item user-detial-bottom" data-debate="<?php echo e($debate->id); ?>">
				    	<?php echo $__env->make('game.debates.partials._debate-'.$debate->status, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				    </div>
				    <?php endif; ?>
				    
				    <?php if($i == 2): ?>
			        	<?php echo $__env->make('game.dashboard.include.invite', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php if(count($ads) != 0): ?>
			        	<div class="upper-ad-box">
			        		<?php echo $__env->make('game.dashboard.include.ads-slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			        	</div>
						<?php endif; ?>
				    <?php endif; ?>


				    <?php if($i == 6): ?>
				    	<?php echo $__env->make('game.dashboard.include.category-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

				    	<div class="lower-ad-box">
					    	<?php echo $__env->make('game.dashboard.include.ads-slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					    </div>

				    <?php endif; ?>

				    <?php $i++; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
			<?php endif; ?>
		</div>

		<!-- suggested questions -->
	    <?php if($questions->count() > 0 ): ?>
	    	<?php echo $__env->make('game.dashboard.include.suggested_ques', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	    <?php endif; ?>
	    <!-- / suggested questions -->
		

		<?php if($num_debates < 3): ?>
			<?php echo $__env->make('game.dashboard.include.invite', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php if(count($ads) != 0): ?>
			<div class="upper-ad-box">
				<?php echo $__env->make('game.dashboard.include.ads-slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
			<?php endif; ?>
	    <?php endif; ?>



	    <?php if($num_debates < 7): ?>
			<?php echo $__env->make('game.dashboard.include.category-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php if(count($ads) != 0): ?>
		    <div class="lower-ad-box">
		    	<?php echo $__env->make('game.dashboard.include.ads-slider', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		    </div>
			<?php endif; ?>
	    <?php endif; ?>



		<div class="dashboard-item">
		      <div class="debate-preview u-background-white debate-preview_follow">
		      	<?php echo $__env->make('game.dashboard.include.follow-suggestion-box', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		    </div>
      	</div>
		
	</main>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>