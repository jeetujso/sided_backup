<?php $__env->startSection('content'); ?>
  <header class="admin-content__header u-bg-white">
        <div class="admin-content__header-mast u-flex-center">
            <h2 class="admin-content__header-title">
                <?php echo e($title); ?>

            </h2>
        </div>
        <div class="admin-content__header-nav">
           <div class="admin-content__header-nav">
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('partners/categories') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerCategoryIndex')); ?>">
                Live
            </a>
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('*partners/categories/deactivate*') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerCategoryDeactivate')); ?>">
                Deactivated
            </a>
            <a class="admin-nav__header-nav-link <?php echo e(Request::is('*partners/categories/draft*') ? 'admin-nav__header-nav--active' : ''); ?>" href="<?php echo e(route('partnerCategoryDraft')); ?>">
                Draft
            </a>
        </div>
        </div>
    </header>
	<div class="admin-content__body u-background-light">      
        <div class="ques-info">
        <label for="text">Category Information</label>
        <p class="field-description">Create unique categories for the questions you publish.</p>
        </div>
		<div class="admin-content__form">
			<form method="POST" enctype="multipart/form-data" action="/partners/categories/store">
				<div class="field field-err">
					<label for="text">CATEGORY NAME</label>
					<p class="field-description">Create a unique name for your category</p>
					<input type="text" name="cat_name" class="form-control" v-model="form.cat_name" placeholder="Enter your category here…">
					<input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
					<?php if($errors->has('cat_name')): ?>
                        <span style="color: red;" class="validation_err"><?php echo e($errors->first('cat_name')); ?></span>
                    <?php endif; ?>
				</div>
				<div class="ranged">
				<div class="field field__left">
					<label for="text">ADD TAGS</label>
					<p class="field-description">Help people find your category by adding tags</p>
					<input disabled type="text" name="tags" class="form-control" v-model="form.tags" placeholder="Tag 1, Tag 2, Tag 3">
					<span class="validation is-danger" v-if="form.errors.has('tags')" v-text="form.errors.get('tags')"></span>
				</div>
				<div class="field field__right">
					<label for="text">CHOOSE A PARENT CATEGORY</label>
					<p class="field-description">Unlike tags, categories can have hierarchy. This is optional.</p>
					<select class="form-control" disabled>
						<option value="">Pick one</option>
					</select>
				</div>
				</div>
                <div class="field field-err">
                    <label for="text">Select Image</label>
                    
                     <input id="avatar_url" type="file" class="upload-image-field" name="avatar_url" value="<?php echo e(old('avatar_url')); ?>" >

                        <img id="img-preview" />

                    <?php if($errors->has('avatar_url')): ?>
                            <span style="color: red;" class="validation_err"><?php echo e($errors->first('avatar_url')); ?></span>
                        <?php endif; ?>
						<span style="color: red;" class="img-size-err"></span>
                </div>
				<div class="field-group">
					<button class="btn btn-green" type="submit" name="status" value="live">Create Category</button>
				</div>
				
				<div class="field-group">
					<button class="btn btn-green" type="submit" name="status" value="draft">Save as Draft</button>
				</div>
			</form>
		</div>
		


        <section class="admin-content__section">
            <div class="admin-content__section-header">
                <div>
                    <h3 class="admin-content__section-headline">Explore data of all Live Categories</h3>
                    <p class="admin-content__section-desc">
                        
                    </p>
                </div>
            </div>
            <div class="table-main-scroll"><table class="admin-content__table rect-table" id="category-table">
                <thead>
                    <tr>
                    	<th class=""></th>
                        <th class="">NAME</th>
                        <th class="">AUTHOR</th>
                        <th class="">Parent</th>
                        <th class="">QUESTIONS ATTACHED</th>
                        <th class="">STATUS</th>
                        <th class=""></th>
                    </tr>
                </thead>



             <tbody>
            <?php $__currentLoopData = $debate_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <tr class="clickable-row">
            	<td>
            		<form method="POST" action="/partners/categories/updatestatus/<?php echo e($categories->id); ?>">
            			<input type="hidden" name="category_id" value="<?php echo e($categories->id); ?>">
            			<button type="submit" name="status" value="deactive"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
            		</form>
                </td>
                <td>
                    <img src="<?php echo e(asset('img-dist/category')); ?>/<?php echo e($categories->icon_url); ?>" class="category-listing-icon">
                    <?php echo e($categories->name); ?> 
            </td> <td>
                <?php echo e(Auth::user()->name); ?>

            </td> <td class="admin-table__large-cell">
                N/A
            </td>  <td class="admin-table__large-cell">
                <?php echo e($categories->questions()->count()); ?>

            </td> <td>
               <?php echo e($categories->status); ?>

                </td>
                <td>
                	<form method="POST" action="/partners/categories/edit/<?php echo e($categories->id); ?>">
            			<input type="hidden" name="category_id" value="<?php echo e($categories->id); ?>">
            			<button type="submit"><i class="fa fa-caret-right" aria-hidden="true"></i></button>
            		</form>
                </td>
            </tr>
           
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 <?php if($debate_category->count() == 0): ?>
                <tr><td colspan="8">No record found.</td></tr>

                <?php endif; ?>
            </table></div></section>
			
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>