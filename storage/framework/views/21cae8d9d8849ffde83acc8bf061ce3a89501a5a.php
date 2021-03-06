<div class="header2">

</div>
<?php $__env->startSection('content'); ?>
<div class="marg-top seperate-page-voter challenge-debate-arg">
    <div id="accept-challenge-debate-arg" role="dialog">  
        <div class="modal-dialog">
            <form method="POST" action="<?php echo e(route('saveDebateChallengeWithArg')); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </div>
                
                    <div class="modal-body">
                        <h4 class="modal-title">Join Debate</h4>
                        <p>Question text : <?php echo e($debate->question->name); ?>.</p>
                        <input type="hidden" name="debate_id" value="<?php echo e($debate->id); ?>">
                        <textarea name="join_debate_argument" id="join-debate-argument" required placeholder="What do you think?"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="challenge-submit-btn">Join</button>
                        <a class="challenge-cancel" href="/debates/<?php echo e($debate->id); ?>">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="challenge-overlay"></div>



  

  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>