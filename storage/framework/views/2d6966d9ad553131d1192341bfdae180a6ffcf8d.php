<?php $__env->startSection('content'); ?>
  <header class="admin-content__header u-bg-white">
    <div class="admin-content__header-mast u-flex-center">
      <h2 class="admin-content__header-title"> Answers </h2>
      <div class="admin-content__header-actions">
        <div class="admin-content__date-group sch-group">
          <a href="javascript:void(0)" data-toggle="modal" data-target="#addAnswerModal" class="btn btn-green">Add Answer</a>
        </div>
      </div>
    </div>
  </header>
  <main class="admin-content__body">
    <section class="admin-content__section">
      <div class="table-main-scroll"><table class="admin-content__table ad-table3 ad-table2 no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
        <thead>
          <tr role="row">
          <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"  aria-label=" Company Name : activate to sort column ascending">Answer</th>
				  <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"  aria-label=" Company Name : activate to sort column ascending">Action</th>
        </thead>
        <tbody>
          <?php if(count($answers) >=1): ?>
            <?php $__currentLoopData = $answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="clickable-row odd ans-box" role="row">                
                <td><?php echo e($answer->answer); ?></td>
                <td>
                  <button class="edit-ans-btn" onclick='editAns(<?php echo e($answer->id); ?>, "<?php echo e($answer->answer); ?>")'>Edit</button>
                  <button class="remove-ans-btn" onclick='deleteAns(<?php echo e($answer->id); ?>, <?php echo e($answer->question_id); ?>)'>Remove</button>                    
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <tr class="clickable-row odd ans-box" role="row">                
              <td>No Record Found.</td>
              <td></td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 1 of 1 entries</div>
    </section>
  </main>



<!-- Add Modal -->
<div id="addAnswerModal" class="modal modal-box fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="<?php echo e(route('manageAnswersStore')); ?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button>
          <h4 class="modal-title">Add New Answer</h4>
        </div>
        <div class="modal-body">
        <input type="hidden" name="question_id" value="<?php echo e(Request::segment(4)); ?>" />
        <div class="form-group">
          <label for="answer">Answer:</label>
          <textarea rows="4" class="form-control" name="answer" id="answer" required></textarea>
        </div>
		<div class="ans-bottom-btn">
        <button type="submit" class="btn btn-green">Submit</button>
		</div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<button style="display:none;" id="edit-answer-modal" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editAnswerModal">Open Modal</button>
<div id="editAnswerModal" class="modal modal-box fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="<?php echo e(route('manageAnswersUpdate')); ?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button>
          <h4 class="modal-title">Edit Answer</h4>
        </div>
        <div class="modal-body">
        <input id="answer-id" type="hidden" name="ans_id" />
        <div class="form-group">
          <label for="answer">Answer:</label>
          <textarea id="answer-text" rows="4" class="form-control" name="answer" id="answer" required></textarea>
        </div>
		<div class="ans-bottom-btn">
        <button type="submit" class="btn btn-green">Submit</button>
		</div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Delete Modal -->
<button style="display:none;" id="delete-answer-modal" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#deleteAnswerModal">Open Modal</button>
<div id="deleteAnswerModal" class="modal modal-box fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="<?php echo e(route('manageAnswersDelete')); ?>">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button>
          <h4 class="modal-title">Delete Answer</h4>
        </div>
        <div class="modal-body">
        <p>Do you want to delete the selected answer?</p>
        <input id="answer-id-delete" type="hidden" name="ans_id" />
        <input id="question-id-delete" type="hidden" name="question_id" />
        
		<div class="bottom-pop-btn">
        <button type="submit" name="submit" value="yes" class="btn btn-green">Yes</button>
        <button type="submit" name="submit" value="no" class="btn btn-green">No</button>
        </div>
		</div>
      </div>
    </form>
  </div>
</div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>