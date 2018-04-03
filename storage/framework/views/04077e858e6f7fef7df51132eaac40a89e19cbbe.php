<?php $__env->startSection('content'); ?>
    <header class="admin-content__header u-bg-white">
      <div class="admin-content__header-mast u-flex-center">
        <h2 class="admin-content__header-title">Create an Advertiser</h2>
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
        <form method="POST" action="<?php echo e(route('partnerAdvertiserStore')); ?>">
          <div class="field field-err col-md-6">
            <label for="text">Company Name</label>
            <input type="text" name="company_name" placeholder="Company Name" class="form-control">
            <?php if($errors->has('company_name')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('company_name')); ?></span>
		    		<?php endif; ?>
          </div>
          <div class="field field-err col-md-6">
            <label for="text">Contact Name</label>
            <input type="text" name="contact_name" placeholder="Contact Name" class="form-control">
            <?php if($errors->has('contact_name')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('contact_name')); ?></span>
		    		<?php endif; ?>
          </div>
          <div class="field field-err col-md-6">
            <label for="text">Contact Phone</label>
            <input type="text" name="phone" placeholder="Contact Phone" class="form-control">
            <?php if($errors->has('phone')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('phone')); ?></span>
		    		<?php endif; ?>
          </div>
          <div class="field field-err col-md-6">
            <label for="text">Contact Email</label>
            <input type="email" name="email" placeholder="Contact Email" class="form-control">
            <?php if($errors->has('email')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('email')); ?></span>
		    		<?php endif; ?>
          </div>
          <div class="field field-err col-md-12">
            <label for="text">Confirmation of agreement to place ads</label>
           <input type="checkbox" name="agreement" value="1">
           <?php if($errors->has('agreement')): ?>
		        		<span style="color: red;" class="validation_err"><?php echo e($errors->first('agreement')); ?></span>
		    		<?php endif; ?>
          </div>
          <div class="field-group">
            <button type="submit" name="status" value="publish" class="btn btn-green">Create an advertiser</button>
          </div>
          <div class="field-group"></div>
        </form>
      </div>
      <section class="admin-content__section">
        <div class="admin-content__section-header">
          <div>
            <h3 class="admin-content__section-headline">Recently Added Advertisers</h3>
            <p class="admin-content__section-desc"> Explore data of all Active Advertisers </p>
          </div>
        </div>
        <div class="tab-main">
          <section id="first-tab-group" class="tabgroup">
            <!-- <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"> -->
              <div class="table-main-scroll">
                <table class="admin-content__table ad-table3 ad-table2 dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                  <thead>
                    <tr role="row"><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=": activate to sort column ascending"></th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Company Name : activate to sort column ascending"> Company</th><th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Contact Name : activate to sort column ascending" aria-sort="descending"> Contact</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Contact Phone : activate to sort column ascending"> Phone </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Contact Email : activate to sort column ascending"> Email </th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=": activate to sort column ascending"></th></tr>
                  </thead>
                  <tbody>
                    <?php $__currentLoopData = $advertisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertiser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr class="clickable-row odd" role="row">
                        <td>
                          <form method="POST" action="<?php echo e(route('partnerAdvertiserDeactivate', $advertiser->id)); ?>">
                            <input type="hidden" name="advertiser_id" value="<?php echo e($advertiser->id); ?>">
                            <button type="submit" name="status" value="deactive"><i aria-hidden="true" class="fa fa-times-circle"></i></button>
                          </form>
                        </td>
                        <td><?php echo e($advertiser->company_name); ?></td>
                        <td class="sorting_1"><?php echo e($advertiser->contact_name); ?></td>
                        <td class=""><?php echo e($advertiser->phone); ?></td>
                        <td class=""><?php echo e($advertiser->email); ?></td>
                        <td>
                          <form method="POST" action="<?php echo e(route('partnerAdvertiserEdit', $advertiser->id)); ?>">
                            <input type="hidden" name="advertiser_id" value="<?php echo e($advertiser->id); ?>">
                            <button type="submit"><i aria-hidden="true" class="fa fa-caret-right"></i></button>
                          </form>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
            </div>
          </section>
        </div>
      </section>
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>