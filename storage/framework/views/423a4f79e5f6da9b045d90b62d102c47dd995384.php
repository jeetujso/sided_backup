<?php $__env->startSection('content'); ?>

<form class="form login-form u-center-block" role="form" method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo e(csrf_field()); ?>


    <div class="field">
        <input id="email" type="email" class="form-control" name="email" placeholder="Enter Your Email" value="<?php echo e(old('email')); ?>" required autofocus>
        <?php if($errors->has('email')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('email')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class="field">
        <input id="password" type="password" class="form-control" placeholder="Enter Your Password"  name="password" required>
        <?php if($errors->has('password')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('password')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <input type="hidden" name="remember" checked>

    <div class="field">
        <button type="submit" class="btn btn-green btn-block">
            Login
        </button>
        <p class="field-description">
            Forgot your login details?
            <a href="<?php echo e(route('password.request')); ?>">
                Get help signing in
            </a>
        </p>
    </div>


    <a href="/facebook/redirect" class="btn btn-facebook btn-social btn-block">
        Login with Facebook
    </a>
    <!-- <a href="/twitter/redirect" class="btn btn-twitter btn-social btn-block">
        Login with Twitter
    </a>
    <a href="/google/redirect" class="btn btn-google btn-social btn-block">
        Login with Google
    </a> -->

</form>

<p class="field-description">
    Don’t have an account? 
    <a href="<?php echo e(route('register')); ?>">
        Sign up.
    </a>
</p>






<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>