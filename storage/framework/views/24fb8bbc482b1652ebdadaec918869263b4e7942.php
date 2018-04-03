<?php $__env->startSection('content'); ?>

	<div class="admin-content__body u-background-light">
		<div class="admin-content__table-header">
			<h2 class="admin-content__table-title">
				Create a New Ad Unit
			</h2>
		</div>
        <div class="ques-info">
        <label for="text">Ad Creative</label>
        <p class="field-description">This is what users see when scrolling through the main feed</p>
        </div>
		<div class="admin-content__form">
			<form method="POST" action="/partners/ads/store" enctype="multipart/form-data" class="create-ad-btn"> 
				<div class="field field-err">
                <div class="field-inner">
					<input type="text" name="name" class="form-control ad-textbox" v-model="form.name" placeholder="Name Your Ad…">
					<input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
					<?php if($errors->has('name')): ?>
                        <span style="color: red;" class="validation_err"><?php echo e($errors->first('name')); ?></span>
                    <?php endif; ?>
				</div>
                </div>
                
                <div class="ranged"  style="border-bottom: 1px solid #ccc; margin-bottom: 20px;">
                
                <div class="field field__left field-err">
                

                	<div class="upload-sec">
                		<input type="file" name="avatar_url" id="avatar_url"/>
                
                		<img id="img-preview" src="<?php echo e(asset('img/upload-bg.jpg')); ?>" alt="" />
                	<span></span>			
				
                </div>
				<?php if($errors->has('avatar_url')): ?>
                        <span style="color: red;" class="validation_err"><?php echo e($errors->first('avatar_url')); ?></span>
                    <?php endif; ?>	
					<span style="color: red;" class="img-size-err"></span>

                <label for="text">DESTINATION WEBSITE</label>
					<p class="field-description">Where this advertisement should send users on click</p>
					<!-- <input class="hide-bg" type="text" name="weburl" placeholder="Enter url..." required="required"/> -->

					<input class="hide-bg" type="url" pattern="(http|https)?://.+" name="weburl" placeholder="Enter url..."/>


					<p class="field-description">eg. (http|https)://in.yahoo.com</p>
					<?php if($errors->has('weburl')): ?>
                        <span style="color: red;" class="validation_err"><?php echo e($errors->first('weburl')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="field field__right">
                <p class="field-description first-line"><strong>Uploading the Right Creative</strong></p>
                <p class="field-description">Sided uses IAB Standard Ad Units for display ads that appear in our question feed and details. </p>
                <p class="field-description">We currently support 320x50 Smartphone Banner in questions.</p>
                <p class="field-description">

                	<a href="" id="open_adportfolio">https://www.iab.com/newadportfolio/</a>
                </p>

                </div>
                </div>
                <div class="ranged">
                <div class="field field__left">
                 <label for="text">Placement Information</label>
					<p class="field-description">Choose any placement options for the ad unit.</p>
                </div>
                </div>
				<div class="ranged">               
				<!-- <div class="field field__left field-err">
					<label for="text">Choose a Category</label>
					<p class="field-description">Select all topics that apply.</p>
					<select name="category_id" class="form-control" v-model="form.category_id" disabled>
						<option value="">Pick one</option>
					<?php $__currentLoopData = $debate_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($categories->id); ?>"><?php echo e($categories->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
					<?php if($errors->has('category_id')): ?>
                        <span style="color: red;" class="validation_err"><?php echo e($errors->first('category_id')); ?></span>
                    <?php endif; ?>
				</div> -->
				<!-- <div class="field field__right">
					<label for="text">Choose a Pro Profile</label>
					<p class="field-description">Select the profile you’d like this advertisement to post to</p>
					<select class="form-control" disabled>
						<option value="">Pick one</option>
					</select>
				</div> -->
					<div class="field field__left field-err">
						<label for="text">Choose type of advertisement</label>
						<select name="advertisement_type" class="form-control">
							<option value="">Pick one</option>
							<option value="1">Individual questions</option>
							<option value="2">Question categories</option>
							<option value="3">Pro account</option>
						</select>
						<?php if($errors->has('advertisement_type')): ?>
							<span style="color: red;" class="validation_err"><?php echo e($errors->first('advertisement_type')); ?></span>
						<?php endif; ?>
					</div>

					<div class="field field__right">
						<label for="text">CPM</label>
						<input name="cpm" placeholder="CPM Value..." class="form-control hide-bg" type="text">
						<?php if($errors->has('cpm')): ?>
							<span style="color: red;" class="validation_err"><?php echo e($errors->first('cpm')); ?></span>
						<?php endif; ?>
					</div>
				</div>
				<div class="ranged">
					<div class="field field__left field-err">
						<label for="text">Publish Date</label>
						<p class="field-description">Select all topics that apply.</p>

						<input type="text" name="publish_at" class="form-control" data-calendar-start v-model="form.publish_at" placeholder="Choose a date to publish your ad">
						<?php if($errors->has('publish_at')): ?>
                        <span style="color: red;" class="validation_err"><?php echo e($errors->first('publish_at')); ?></span>
                    	<?php endif; ?>

					</div>
					<div class="field field__right field-err">
						<label for="text">Expiration Date</label>
						<p class="field-description">Select all topics that apply.</p>
						<input type="text" name="expire_at" class="form-control" data-calendar-end v-model="form.expire_at" placeholder="Choose a date to expire your ad">

						<?php if($errors->has('expire_at')): ?>
                        <span style="color: red;" class="validation_err"><?php echo e($errors->first('expire_at')); ?></span>
                    	<?php endif; ?>

					</div>
				</div>
				<div class="field-group">
					<button class="btn btn-green" type="submit" name="status" value="live">Create Ad</button>
				</div>
				
			</form>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>