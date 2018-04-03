<?php $__env->startSection('content'); ?>

<form class="form login-form u-center-block" role="form" method="POST" action="<?php echo e(route('onboardingAccountStore')); ?>">
    <?php echo e(csrf_field()); ?>


    <h2 class="login-form-title u-text-center">
    	Finish Creating Your Account
    </h2>

    <div class="field">
		<input type="text" class="form-control" name="handle" placeholder="Choose a Handle" value="<?php echo e(old('handle', $user->handle)); ?>" required autofocus>
        <?php if($errors->has('handle')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('handle')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class="field">
        <input type="email" class="form-control" name="email" placeholder="Enter your email address" value="<?php echo e(old('email', $user->email)); ?>" required>
        <?php if($errors->has('email')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('email')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class="field">
		<input type="tel" class="form-control" name="pn" placeholder="Add your mobile phone (Optional)" value="<?php echo e(old('pn', $user->phone_number)); ?>" data-format="phone">
        <?php if($errors->has('pn')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('pn')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class="field">
        <button type="submit" class="btn btn-green btn-block">
            Create Your Account
        </button>

        <p class="field-description">
            <a href="<?php echo e(route('login')); ?>">
                Already have an account? Try signing in again.
            </a>
        </p>
       <!-- 
        <p class="field-description">
            <a href="<?php echo e(route('login')); ?>" onclick="event.preventDefault();
            	document.getElementById('logout-form').submit();">
                Already have an account? Try signing in again.
            </a>
        </p> -->
    </div>
</form>

<form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
    <?php echo e(csrf_field()); ?>

</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>