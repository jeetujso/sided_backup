<?php $__env->startSection('content'); ?>
	<input type="hidden" id="event_type" name="event_type" value="debate_view">
	<input type="hidden" id="event_id" name="event_id" value="<?php echo e($debate->id); ?>">

    <!-- debate component loading -->
    <debate :debate="<?php echo e($debate); ?>"></debate>
  	<!-- /.game-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.debate_tracking', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>