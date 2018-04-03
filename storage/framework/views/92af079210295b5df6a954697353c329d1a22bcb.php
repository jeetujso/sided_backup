<?php $__env->startSection('content'); ?>
    <header class="admin-content__header u-bg-white">
      <div class="admin-content__header-mast u-flex-center">
        <h2 class="admin-content__header-title">Update an Advertiser</h2>
        <div class="admin-content__header-actions">
          <div class="admin-content__date-group"></div>
        </div>
      </div>
    </header>
    <div class="admin-content__body u-background-light">
      <div class="ques-info">
        <label for="text">Advertiser Information</label>
      </div>
      <div class="admin-content__form">
        <form method="POST" action="<?php echo e(route('partnerAdvertiserUpdate')); ?>">
          <div class="field field-err col-md-6">
            <label for="text">Company Name</label>
            <input type="text" value="<?php echo e($advertiser->company_name); ?>" name="company_name" placeholder="Company Name" class="form-control">
            <?php if($errors->has('company_name')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('company_name')); ?></span>
		    		<?php endif; ?>
          </div>
          <div class="field field-err col-md-6">
            <label for="text">Contact Name</label>
            <input type="text" value="<?php echo e($advertiser->contact_name); ?>" name="contact_name" placeholder="Contact Name" class="form-control">
            <?php if($errors->has('contact_name')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('contact_name')); ?></span>
		    		<?php endif; ?>
          </div>
          <div class="field field-err col-md-6">
            <label for="text">Contact Phone</label>
            <input type="text" value="<?php echo e($advertiser->phone); ?>" name="phone" placeholder="Contact Phone" class="form-control">
            <?php if($errors->has('phone')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('phone')); ?></span>
		    		<?php endif; ?>
          </div>
          <div class="field field-err col-md-6">
            <label for="text">Contact Email</label>
            <input type="email" value="<?php echo e($advertiser->email); ?>" name="email" placeholder="Contact Email" class="form-control">
            <?php if($errors->has('email')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('email')); ?></span>
		    		<?php endif; ?>
          </div>
          <input type="hidden" value="<?php echo e($advertiser->id); ?>" name="advertiser_id">
          <div class="field field-err col-md-12">
            <label for="text">Confirmation of agreement to place ads</label>
           <input type="checkbox" name="agreement" value="1" checked="checked">
           <?php if($errors->has('agreement')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('agreement')); ?></span>
		    		<?php endif; ?>
          </div>
          <div class="field-group">
            <button type="submit" name="status" value="publish" class="btn btn-green">Update an advertiser</button>
          </div>
          <div class="field-group"></div>
        </form>
      </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>