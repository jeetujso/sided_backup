<?php $__env->startSection('content'); ?>
    <header class="admin-content__header u-bg-white">
      <div class="admin-content__header-mast u-flex-center">
        <h2 class="admin-content__header-title"> Advertiser </h2>
        <div class="admin-content__header-actions">
          <div class="admin-content__date-group sch-group">
            <select id="filter_days" name="filter_days" class="dropdown-button">
              <option value="" selected="selected">All</option>
              <option value="7">Last 7 Days</option>
              <option value="30">Last 30 Days</option>
              <option value="180">Last 180 Days</option>
            </select>
            <a href="<?php echo e(route('partnerAdvertiserCreate')); ?>" class="btn btn-green">Add Advertiser</a>
            </div>
        </div>
      </div>
      <div class="admin-content__header-nav">
      <a href="<?php echo e(route('partnerAdvertiserIndex')); ?>" class="admin-nav__header-nav-link <?php echo e(Request::is('partners/advertiser') ? 'admin-nav__header-nav--active' : ''); ?>">Active</a> 
      
      <a href="<?php echo e(route('partnerAdvertiserInactive')); ?>" class="admin-nav__header-nav-link <?php echo e(Request::is('partners/advertiser/inactive') ? 'admin-nav__header-nav--active' : ''); ?>">Inactive</a>
    </header>
    <main class="admin-content__body">
      <section class="admin-content__section">
        <div class="admin-content__section-header">
          <div class="ques-info">
            <h3 class="admin-content__section-headline">Explore data of all Inactive Advertisers</h3>
          </div>
        </div>
        
          <div class="table-main-scroll"><table class="admin-content__table ad-table3 ad-table2 no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
            <thead>
              <tr role="row">
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=": activate to sort column ascending"></th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Company Name : activate to sort column ascending"> Company</th>
                <th class="sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Contact Name : activate to sort column ascending" aria-sort="descending"> Contact</th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Contact Phone : activate to sort column ascending"> Phone </th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=" Contact Email : activate to sort column ascending"> Email </th>
                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=": activate to sort column ascending"></th></tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $advertisers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advertiser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="clickable-row odd" role="row">
                <td>
                <form method="POST" action="<?php echo e(route('partnerAdvertiserActivate', $advertiser->id)); ?>">
                    <input type="hidden" name="advertiser_id" value="<?php echo e($advertiser->id); ?>">
                    <button type="submit" name="status" value="activate"><i aria-hidden="true" class="fa fa-times-circle"></i></button>
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
        
      </section>
    </main>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>