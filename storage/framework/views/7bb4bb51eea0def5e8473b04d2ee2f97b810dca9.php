<div class="header2">

</div>
<?php $__env->startSection('content'); ?>
<div class="reset-bg">
<div class="game-wrapper reset-sec">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="login-form-title"> Change Password</div>

                <div class="panel-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('playerChangePassword')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('current-password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Current Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current-password" required>

                                <?php if(session('error_current')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e(session('error_current')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('new-password') ? ' has-error' : ''); ?>">
                            <label for="password-confirm" class="col-md-4 control-label">New Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="new-password" required>

                                <?php if(session('error_new_password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e(session('error_new_password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <?php if($errors->has('new-password')): ?>
                                    <span class="help-block">
                                        <strong>The password must be at least 6 characters.</strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('confirm-password') ? ' has-error' : ''); ?>">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="confirm-password" type="password" class="form-control" name="confirm-password" required>

                                <?php if(session('error_confirm_password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e(session('error_confirm_password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12" style="text-align:center;">
                                <button type="submit" class="btn btn-green btn-block">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		</div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>