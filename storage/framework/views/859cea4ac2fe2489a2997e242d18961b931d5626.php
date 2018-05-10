<div class="header2">

</div>
<?php $__env->startSection('content'); ?>

<main class="game-wrapper">

	<div class="debate-preview u-background-white">
		<h2 class="title-head">Pick a Side</h2>
		<div class="dashboard-item">
			<div class="pick-sec">
				<img src="<?php echo e(asset('img-dist/category')); ?>/<?php echo e($question->category->image_url); ?>" class="pick-image" alt=""> 
			</div>
	 		<div class="debate-preview__header text-center">
	        	<div class="debate-haeder-top">
	          		<h4 class="debate-preview__category text-center"> Submitted In <strong class="u-text-black"> <?php echo e($question->category->name); ?></strong></h4>
	          		<h5 class="debate-preview__category text-center"> Submitted By <strong class="u-text-black"> <a href="<?php echo e(route('publicPlayerShow', $question->getquestionAuther->handle )); ?>"><?php echo e($question->getquestionAuther->name); ?></a></strong></h5>
	          	</div>
	          	<div>       
					<p class="debate-preview__question-text text-center"><?php echo e($question->text); ?></p>
				</div>
	          	<small class="debate-preview__question-source text-center <?=(empty($question->source))?'source-hidden':''?>"><i aria-hidden="true" class="fa fa-circle"></i> <?php echo e($question->medium); ?> from <strong class="u-text-black"><?php echo e($question->source); ?></strong></small>
	        </div>
	 	</div>
	 	<form name="pickaside" method="post" action="<?php echo e(route('publicDebateStore')); ?>">
	 		<input type="hidden" name="question_id" value="<?php echo e($question->id); ?>">
		 	<div class="dashboard-item">
		 		<div class="agree-btn-content text-center">
		 			<!--<input type="submit" class="agree-green" name="submit" value="Agree">
		  			<input type="submit" class="agree-blue" name="submit" value="Disagree">-->
                    <ul class="select-agree-btn">
					  <li>
					    <input type="radio" id="f-option" name="side" value="Agree">
					    <label for="f-option">Agree</label>    
					    <div class="check"></div>
					    <input type="hidden" name="fingerprint_string" id="fingerprint_string" value="">
					  </li>  
					  <li>
					    <input type="radio" id="t-option" name="side" value="Disagree">
					    <label for="t-option">Disagree</label>    
					    <div class="check"><div class="inside"></div></div>
					  </li>
					</ul>
					<div class="form-group<?php echo e($errors->has('side') ? ' has-error' : ''); ?>">
						<?php if($errors->has('side')): ?>
	                    <span class="help-block">
	                        <strong><?php echo e($errors->first('side')); ?></strong>
	                    </span>
	                	<?php endif; ?>
	                </div>


					<div class="select-agree-box">
						<div class="form-group<?php echo e($errors->has('argument') ? ' has-error' : ''); ?>">

							
							<textarea id="debate-arg-textbox" name="argument" rows="8" wrap="hard" placeholder="What do you think?"><?php echo e(old('argument')); ?></textarea>
							
							<?php if($errors->has('argument')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('argument')); ?></strong>
                            </span>
                        	<?php endif; ?>

						</div>
						<input type="submit" class="agree-green" name="submit" value="Publish">
					</div>

		  			<!-- <p>Youʼll be able to explain why next.</p> -->
		 		</div>
		 	</div>
		 </form>
	</div>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>