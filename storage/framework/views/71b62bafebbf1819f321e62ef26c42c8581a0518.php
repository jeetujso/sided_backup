<?php $__env->startSection('content'); ?>
<header class="admin-content__header u-bg-white"><div class="admin-content__header-mast u-flex-center"><h2 class="admin-content__header-title"><?php echo e($questionDetails->name); ?></h2> <div class="admin-content__header-actions"></div></div></header>
<div class="game-wrapper graph-wrapper <?php if($hasServeyAns == 0): ?> answer-show <?php endif; ?>">
    <!--game-wrapper--->
    <div class="row">
        <div class="col-lg-12">
            <!--custom chart start-->
            <?php if($hasServeyAns == 0): ?>
                <div class="border-head">
                    <h3>There is no activity for this question yet.</h3>
                </div>
            <?php else: ?>
<?php if(isset($serveyResults)){
				if($overFlowCount >= 13){
					$newClass="overflow-bar";
				}else{
					$newClass="";
				}
			}?>
            <div class="custom-bar-chart <?php echo e($newClass); ?>">
			<table class="custom-inner <?php echo e($newClass); ?>">
			<tr>
			<td>
                <ul class="y-axis">
                    <?php
                        $interval = 5;
                        $range = 25;
						$heightMultipliyer = 3.6;
                        if($answered > 25){
                            $rangeMultiply = floor($answered/25);
                            $newRange = $range*$rangeMultiply;
                            $range = $range+$newRange;
                            $interval = $range/$interval;
							$heightMultipliyer = $heightMultipliyer/($rangeMultiply+1);
                        }
                        $barHeight = $range;
                        $newBarArray = array();
                        for($h = 0; $h<=$barHeight; $h+=$interval){
                            array_push($newBarArray, $h);
                        }
                        $size = sizeof($newBarArray);

                        for($hb=$size-1; $hb>=0; $hb--){
                        
                    ?>
                        <li>
                        <span><?php echo e($newBarArray[$hb]); ?></span>
                        </li>
                    <?php } ?>
                </ul>
                <?php $i = 0; ?>
                <?php $__currentLoopData = $serveyResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($result->serveyAnswers) >=1 ): ?>
                        <div class="bar">
                            <div class="value tooltips" data-original-title="<?php echo e(count($result->serveyAnswers)); ?>%" data-toggle="tooltip" data-placement="top" style="height: <?php echo e(count($result->serveyAnswers)*$heightMultipliyer); ?>%; background-color:<?php echo e($colorArrays[$i]); ?>;" onclick='resultDetail("<?php echo e($result->answer); ?>", <?php echo e(count($result->serveyAnswers)); ?>, <?php echo e(round((count($result->serveyAnswers) / $answered)*100, 2)); ?>)'></div>
                        </div>
                    <?php endif; ?>
                     <?php 
                        $i++;
                        if($i % 12 == 0){
                            $i = 0;
                        }
                        
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if($questionDetails->allowed_other_answer == 1): ?>
                    <div class="bar">
                        <div class="value tooltips" data-original-title="<?php echo e($otherAnswersCount*$heightMultipliyer); ?>%; background-color:#ff00bf;" onclick='resultDetail("Other Answer", <?php echo e($otherAnswersCount); ?>, <?php echo e(round(($otherAnswersCount / $answered)*100, 2)); ?>)'></div>
                    </div>
                <?php endif; ?>
            </td>
			</tr>
			</table>
			</div>
            <!--custom chart end-->
            <div class="view-notify">
                <div class="col-md-6">
                    <label class="pull-right">
                        <span>Answered:</span>
                        <span></span>
                        <span><?php echo e($answered); ?></span>
                    </label>
                </div>
                <div class="col-md-6">
                    <label class="pull-left">
                        <span>Skipped:</span>
                        <span></span>
                        <span><?php echo e($skipped); ?></span>
                    </label>
                </div>
            </div>
            <table class="table">
                <?php $j = 0; ?>
                <?php $__currentLoopData = $serveyResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><span style="background-color:<?php echo e($colorArrays[$j]); ?>;"></span></td>
                        <td><?php echo e($result->answer); ?></td>
                        <td><?php echo e(round((count($result->serveyAnswers) / $answered)*100, 2)); ?>%</td>
                        <td><?php echo e(count($result->serveyAnswers)); ?></td>
                    </tr>
                    <?php
                        $j++;
                        if($j % 12 == 0){
                            $j = 0;
                        }
                       
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               
                <?php if($questionDetails->allowed_other_answer == 1): ?>
                    <tr>
                        <td><span style="background-color:#ff00bf;"></span></td>
                        <td>Other Answer</td>
                        <td><?php echo e(round(($otherAnswersCount / $answered)*100, 2)); ?>%</td>
                        <td><?php echo e($otherAnswersCount); ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td></td>
                    <td>Total <?php if($answered == 1): ?> Respondent <?php else: ?> Respondents <?php endif; ?></td>
                    <td></td>
                    <td><?php echo e($answered); ?></td>
                </tr>
            </table>
            <?php endif; ?>
        </div>
    </div>
</div>


 <!-- Modal -->
 <button style="display:none;" id="answer-details-servey-modal" type="button" data-toggle="modal" data-target="#serveyResultDetailPopup"></button>
  <div id="serveyResultDetailPopup" class="modal modal-box fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
            <h2 id="ans-name-servey"></h2>
            <p id="total-answered-servey"></p><br />
            <p id="total-percentage-servey"></p>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>