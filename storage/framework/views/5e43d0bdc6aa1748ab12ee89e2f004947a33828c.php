<?php $__env->startSection('content'); ?>

	<div class="admin-content__body u-background-light">
		<div class="admin-content__table-header">
			<h2 class="admin-content__table-title">
				Edit a Question
			</h2>
		</div>
        <div class="ques-info">
        <label for="text">Question Information</label>
        <p class="field-description"></p>
        </div>
		<div class="admin-content__form">
			<form method="POST" action="/partners/questions/updatequestion">
				<div class="field field-err">
					<label for="text">QUESTION TEXT</label>
					<p class="field-description"></p>
					<input type="text" name="text" class="form-control" value="<?php echo e($questions->text); ?>">
					<input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
					<input type="hidden" name="question_id" value="<?php echo e($questions->id); ?>">
					<?php if($errors->has('text')): ?>
                        <span style="color: red;" class="validation_err"><?php echo e($errors->first('text')); ?></span>
                    <?php endif; ?>
				</div>
				<div class="ranged">
				<div class="field field__left field-err">
					<label for="text">Choose a Category</label>
					<p class="field-description">Select all topics that apply.</p>
					<select name="category_id" class="form-control">
					<?php $__currentLoopData = $debate_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option <?php if($questions->category_id==$categories->id): ?> selected <?php endif; ?> value="<?php echo e($categories->id); ?>"><?php echo e($categories->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
					<?php if($errors->has('category_id')): ?>
                        <span style="color: red;" class="validation_err"><?php echo e($errors->first('category_id')); ?></span>
                    <?php endif; ?>
				</div>
				<div class="field field__right">
					<label for="text">CHOOSE A PROFILE</label>
					<p class="field-description">Select the profile you’d like this question to post to</p>
					<select class="form-control" disabled>
						<option value="">Pick one</option>
					</select>
				</div>
				</div>
				<div class="ranged">
					<div class="field field__left field-err">
						<label for="text">Publish Date</label>
						<p class="field-description">Select all topics that apply.</p>
						<input type="text" name="publish_at" value="<?php echo e($questions->publish_at); ?>" class="form-control" <?php if($questions->publish_at > date('Y-m-d H:i:s')): ?> data-calendar-start <?php else: ?> disabled <?php endif; ?> required="required">
					</div>
					<div class="field field__right field-err">
						<label for="text">Expiration Date</label>
						<p class="field-description">Select all topics that apply.</p>
						<input type="text" name="expire_at" value="<?php echo e($questions->expire_at); ?>" class="form-control" data-calendar-end required="required">
						<?php if($errors->has('expire_at')): ?>
                            <span style="color: red;" class="validation_err"><?php echo e($errors->first('expire_at')); ?></span>
                        <?php endif; ?>
					</div>
				</div>
				<div class="field-group">
					<button class="btn btn-green" type="submit" name="status" value="publish">Update Question</button>
				</div>
				
				<div class="field-group">
					<button class="btn btn-green" type="submit" name="status" value="draft">Save as Draft</button>
				</div>
			</form>
		</div>        
	</div>
          
        </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>