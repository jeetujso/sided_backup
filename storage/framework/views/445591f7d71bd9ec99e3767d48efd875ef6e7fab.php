<div class="header2">

</div>
<?php $__env->startSection('content'); ?>
<main class="game-wrapper">
	<div class="debate-preview u-background-white">
		<h2 class="title-head"></h2>
		<div class="dashboard-item">
			<div class="pick-sec">
				<img src="<?php echo e(asset('img-dist/category')); ?>/<?php echo e($question->category->image_url); ?>" class="pick-image" alt=""> 
			</div>
	 		<div class="debate-preview__header text-center">
	        	<div class="debate-haeder-top">
	          		<h4 class="debate-preview__category text-center"> Submitted In <strong class="u-text-black"> <?php echo e($question->category->name); ?></strong></h4>
	          		<h5 class="debate-preview__category text-center"> Submitted By <strong class="u-text-black"> <a href="<?php echo e(route('publicPlayerShow', $question->getquestionAuther->handle )); ?>"><?php echo e($question->getquestionAuther->name); ?></a></strong></h5>
	          	</div>
				
				<div class="multi-question-ads">
				
					<?php if($ads->ads_id >= 1): ?>
						<?php if(isset($ads->ads)): ?>
						<a href="<?php echo e($ads->ads->website_url); ?>"  target="_blank">
							<img src="<?php echo e(asset('/img-dist/ads/'.$ads->ads->image_url)); ?>">
						</a>
						<?php endif; ?>
					<?php else: ?>
					
						<?php if(isset($ads->category->ads)): ?>
							<a href="<?php echo e($ads->category->ads->website_url); ?>"  target="_blank">
								<img src="<?php echo e(asset('/img-dist/ads/'.$ads->category->ads->image_url)); ?>">
							</a>
						<?php endif; ?>
						
					<?php endif; ?>
				</div>
				 
	          	<div>       
					<p class="debate-preview__question-text text-center"><?php echo e($question->text); ?></p>
				</div>
	          	<small class="debate-preview__question-source text-center <?=(empty($question->source))?'source-hidden':''?>"><i aria-hidden="true" class="fa fa-circle"></i> <?php echo e($question->medium); ?> from <strong class="u-text-black"><?php echo e($question->source); ?></strong></small>
	        </div>
	 	</div>
	 	<form onsubmit="return checkServeyValidation()" name="pickaside" method="post" action="<?php if($question->answer_type == 1) {?> <?php echo e(route('multipleServeyAnswers')); ?> <?php }else{?> <?php echo e(route('singleServeyAnswers')); ?> <?php } ?>">
	 		<input type="hidden" name="question_id" value="<?php echo e($question->id); ?>">
			<input type="hidden" name="servey_id" value="<?php echo e($userServey->id); ?>">
			<input type="hidden" name="fingerprint_string" id="fingerprint_string" value="">
			 
		 	<div class="dashboard-item">
		 		<div class="agree-btn-content text-center">
					<?php if($question->answer_type == 1): ?>
						<ul class="select-agree-btn survey-select-sec">
							<?php $__currentLoopData = $question->answer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<input type="checkbox" id="t-option-<?php echo e($answer->id); ?>" class="servey-answers" name="answer_id[]" value="<?php echo e($answer->id); ?>">
									<label for="t-option-<?php echo e($answer->id); ?>"><?php echo e($answer->answer); ?></label>    
									<div class="check"><div class="inside"></div></div>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php if($question->allowed_other_answer == 1): ?>
								<li>
									<input type="checkbox" id="option-other" name="other_answer" value="1">
									<label for="option-other">Other Answer</label>    
									<div class="check"><div class="inside"></div></div>
								</li>
								<input type="hidden" class="other-answer-text" name="other_answer_text">
							<?php endif; ?>
							<span style="color:red;" class="servey-form-error"></span>
						</ul>
					<?php else: ?>
						<ul class="select-agree-btn survey-select-sec2">
							<?php $__currentLoopData = $question->answer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<input type="radio" id="t-option-<?php echo e($answer->id); ?>" class="servey-answers" name="answer_id" value="<?php echo e($answer->id); ?>">
									<label for="t-option-<?php echo e($answer->id); ?>"><?php echo e($answer->answer); ?></label>    
									<div class="check"><div class="inside"></div></div>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php if($question->allowed_other_answer == 1): ?>
								<li>
									<input type="radio" id="option-other" name="other_answer" value="1">
									<label for="option-other">Other Answer</label>    
									<div class="check"><div class="inside"></div></div>
								</li>
								<input type="hidden" class="other-answer-text" name="other_answer_text">
							<?php endif; ?>
							<span style="color:red;" class="servey-form-error"></span>
						</ul>
					<?php endif; ?>
					<div class="select-agree-box">
						<input type="submit" class="agree-green" name="submit" value="Submit">
					</div>
		 		</div>
		 	</div>
		 </form>
	</div>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>