<div class="header2">

</div>
<?php $__env->startSection('content'); ?>

    <main class="game-wrapper">
        <aside class="game-sidebar game-sidebar__right profile-content">
            <div class="game-header"><span>Your Profile</span></div>
            <div class="profile-image">
                <img src="<?php echo e(asset('images')); ?>/<?php echo e(Auth::user()->avatar_url); ?>">
            </div>
            <div class="profile-content-inner">
                <p class="profile-name"><?php echo e(Auth::user()->name); ?></p>
                <p class="profile-email"><?php echo e(Auth::user()->email); ?></p>
                <!-- <p class="profile-id"><span><?php echo e(Auth::user()->id); ?></span></p> -->
                  <div class="wrapper">
<p>Receive Notifications</p>
  <label class="switch2">
  <?php if(Auth::user()->notification_settings == 'false'): ?>
    <input type="checkbox" value="false">
<?php else: ?>
<input type="checkbox" value="true" checked>
<?php endif; ?>
  <span class="slider round"></span>
</label>
</div>
            </div>
    </aside>
    

    
        <?php if( Session::has( 'success' )): ?>
             <div class="flash-msg"> <?php echo e(Session::get( 'success' )); ?></div>
        <?php elseif( Session::has( 'warning' )): ?>
             <div class="flash-msg"><?php echo e(Session::get( 'warning' )); ?> </div><!-- here to 'withWarning()' -->
        <?php endif; ?>
    
    

    <div class="game-main debate-single update-profile">
        <div class="game-header"><span>Update Your Profile Information</span></div>

            <form class="form-horizontal form login-form u-center-block" role="form" method="POST" action="<?php echo e(route('profile.update', Auth::user()->id)); ?>" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <?php echo e(method_field('PUT')); ?>


                <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="<?php echo e(Auth::user()->name); ?>" required autofocus>

                        <?php if($errors->has('name')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('name')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="<?php echo e(Auth::user()->email); ?>" required>

                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('phone_number') ? ' has-error' : ''); ?>">
                    <label for="phone_number" class="col-md-4 control-label">Mobile Phone</label>

                    <div class="col-md-6">
                        <input id="phone_number" type="tel" class="form-control" name="phone_number" value="<?php if( Auth::user()->otp == 1): ?> <?php echo e(Auth::user()->phone_number); ?> <?php endif; ?>" placeholder="Ex. +17256267914">

                        <?php if($errors->has('phone_number')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('phone_number')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group<?php echo e($errors->has('handle') ? ' has-error' : ''); ?>">
                    <label for="handle" class="col-md-4 control-label">Handle</label>

                    <div class="col-md-6">
                        <input id="handle" type="text" class="form-control" name="handle" value="<?php echo e(Auth::user()->handle); ?>">

                        <?php if($errors->has('handle')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('handle')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-group<?php echo e($errors->has('avatar_url') ? ' has-error' : ''); ?>">
                    <label for="avatar_url" class="col-md-4 control-label">Image Upload</label>

                    <div class="col-md-6 upload-btn">
                        <input id="avatar_url" type="file" class="form-control" name="avatar_url" value="<?php echo e(old('avatar_url')); ?>" accept='image/*' />

                        <img id="img-preview" src="<?php echo e(asset('images')); ?>/<?php echo e(Auth::user()->avatar_url); ?>" />
                        
                        <?php if($errors->has('avatar_url')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('avatar_url')); ?></strong>
                            </span>
                        <?php endif; ?>
                        <span style="color: red;" class="img-size-err"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="debate-btn">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!--aside class="game-sidebar game-sidebar__right">
            <div class="game-header">Activity Feed</div>
            <div class="u-background-white">
                
            </div>
        </aside-->

    </main>

    <!-- Modal -->
  <button style="display:none;" id="otpPopup" type="button" data-toggle="modal" data-target="#mibileOtpModal"></button>
  <div id="mibileOtpModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="#">
      <div class="modal-content">
        <div class="modal-header"><button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button></div>
        <div class="modal-body">
          <p>Please Enter Otp.</p>
          <input type="text" name="otp">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="green-btn" value="Submit">
        </div>
      </div>
    </form>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.game', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>