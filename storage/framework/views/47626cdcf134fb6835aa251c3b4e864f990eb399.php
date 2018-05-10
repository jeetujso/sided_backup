<?php $__currentLoopData = $serveyQuestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($question->category->status=="live"): ?>
    <div class="dashboard-item">
	    <div class="debate-preview u-background-white">
	    	<div class="debate-preview__header">
	        	<div class="debate-haeder-top">
	          		<h4 class="debate-preview__category"> Submitted In <strong class="u-text-black">
	          		<?php echo e($question->category->name); ?>

	          		</strong></h4>
	          		<h5 class="debate-preview__category"> Submitted By <strong class="u-text-black">
	          		<a href="<?php echo e(route('publicPlayerShow', $question->getquestionAuther->handle)); ?>"><?php echo e($question->getquestionAuther->name); ?></a>
	          		</strong></h5>

	          	</div>
				<p class="debate-preview__question-text"><?php echo e($question->text); ?></p>

	          	<small class="debate-preview__question-source <?=(empty($question->source))?'source-hidden':''?>">
	          		<i class="fa fa-circle" aria-hidden="true"></i> 
	          		<?php echo e($question->medium); ?> from 
	          		<strong class="u-text-black"><?php echo e($question->source); ?></strong>
				  </small>
                  <div class="debate-btn-box">
						<a class="debate-btn" href="<?php echo e(route('pickServeyAnswer').'?question_id='.$question->id); ?>">Submit Answer</a>
					</div>
				<!-- <?php if($question->question_type == 1): ?>
					<div class="debate-btn-box">
						<a class="debate-btn" href="<?php echo e(route('pickServeyAnswer').'?question_id='.$question->id); ?>">Start Servey</a>
					</div>
				<?php else: ?>
					<div class="debate-btn-box">
						<a class="debate-btn" href="<?php echo e(url('debates/pickaside')); ?>?question_id=<?php echo e($question->id); ?>">Start Debate</a>
					</div>
				<?php endif; ?>      -->
	        </div>
	    </div>
	</div>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>