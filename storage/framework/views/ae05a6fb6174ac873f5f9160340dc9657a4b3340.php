<div class="header2">

</div>
<?php $__env->startSection('content'); ?>
    <main class="game-wrapper otp-sec">
        <div class="game-main debate-single update-profile">
            <div class="game-header"><span>Please enter OTP</span></div>
            <form class="form-horizontal form login-form u-center-block" role="form" method="POST" action="<?php echo e(route('frontMobileOtpVerify')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="form-group<?php echo e($errors->has('otp') ? ' has-error' : ''); ?>">
                    <div class="col-md-6">
                        <input id="otp" type="text" placeholder="Enter OTP" class="form-control" name="otp" required>
                        <span class="help-block">
                            <?php if($errors->any()): ?>
                                <strong>Invalid OTP.</strong>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="edit-profile-resend-otp resend-otp">
                        <a href="<?php echo e(route('frontMobileOtpResend')); ?>">Resend OTP</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="debate-btn">
                            Verify Phone Number
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>