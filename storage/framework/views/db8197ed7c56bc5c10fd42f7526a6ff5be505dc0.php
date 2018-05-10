<?php $__env->startSection('content'); ?>

<form class="form login-form u-center-block" role="form" method="POST" action="<?php echo e(route('onboardingOtpStore')); ?>">
    <?php echo e(csrf_field()); ?>


    <h2 class="login-form-title u-text-center">
    	Finish Creating Your Account
    </h2>
    <div class="field resend-otp-sec">
        <input type="text" class="form-control" name="otp" placeholder="Enter OTP" required>
        <span class="help-block">
            <?php if($errors->any()): ?>
                <strong>Invalid OTP.</strong>
            <?php endif; ?>
        </span>
    </div>
    <div class="field resend-otp">
        <a href="<?php echo e(route('onboardingResendOtp')); ?>">Resend OTP</a>
    </div>
    <div class="field">
        <button type="submit" class="btn btn-green btn-block">
            Activate Your Account
        </button>

        <p class="field-description">
            <a href="<?php echo e(route('login')); ?>">
                Already have an account? Try signing in again.
            </a>
        </p>
      
    </div>
</form>

<form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
    <?php echo e(csrf_field()); ?>

</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>