<?php $side=""; ?>
            <div class="debate-preview u-background-white">

                <div class="debate-preview__header">
                    <div class="debate-haeder-top">
                        <h4 class="debate-preview__category"> Submitted In <strong class="u-text-black"><?php echo e($debate->question->category->name); ?></strong></h4>
						
                        <!-- <span><img src="img/dot.svg" alt=""></span> -->
						<h5 class="debate-preview__category">Submitted By <strong class="u-text-black"><a href="<?php echo e(route('publicPlayerShow', $debate->getDebatequestion->getquestionAuther->handle )); ?>"><?php echo e($debate->getDebatequestion->getquestionAuther->name); ?></a></strong></h5>
                    </div>
					
                    <p class="debate-preview__question-text"><?php echo e($debate->question->text); ?></p>

                    <small class="debate-preview__question-source <?=(empty($debate->question->source))?'source-hidden':''?>"><?php echo e($debate->question->medium); ?> from <strong class="u-text-black"><?php echo e($debate->question->source); ?></strong></small>
                </div>

                <!-- Players -->
                <div class="debate-preview__players u-flex">


                    <?php $__currentLoopData = $debate->users()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $side = strtolower((new \App\Helpers\Debates)->getDebateUserSide($debate->id, $user->id)->side); ?>

                        <div class="debate-preview__player u-flex-center">
                            <div class="debate-preview__player-img  <?php echo e($side); ?>">
                                    
                                    <a href="<?php echo e(route('publicPlayerShow', $user->handle)); ?>"><img class="debate-preview__player-avatar" src="<?php echo e(asset('images')); ?>/<?php echo e($user->avatar_url); ?>" alt="<?php echo e($user->name); ?>"></a>
                            </div>
                            <div class="debate-preview__player-info">
                                <h4 class="debate-preview__player-name">
                                    <a href="<?php echo e(route('publicPlayerShow', $user->handle)); ?>" class="u-link-black"> <?php echo e($user->handle); ?> </a>
                                </h4>
                                <small><?php echo e($user->rank); ?></small>
                            </div><!-- /player-info-->

                            <ul class="voter-sec">
                                <li><span></span><img src="<?php echo e(asset('/img/left-vote-btn-dark.svg')); ?>"></li>
                            </ul>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($side =='agree'): ?>
                        <?php $opponent_side = 'disagree'; ?>
                    <?php else: ?>
                        <?php $opponent_side = 'agree'; ?>
                    <?php endif; ?>

                    <div class="debate-preview__player u-flex-center">
                        <div class="debate-preview__player-img <?php echo e($opponent_side); ?>">
                            <a href="#"><img src="<?php echo e(asset('images/user.svg')); ?>" alt="" class="debate-preview__player-avatar"></a>
                        </div>
                        <div multilinks-noscroll="true" class="debate-preview__player-info">
                            <h4 multilinks-noscroll="true" class="debate-preview__player-name">
                                
                                <a onclick="return false" class="u-link-black non-active">Waiting for<br>Opponent</a>
                            </h4>
                            <small></small>
                        </div>

                        <ul class="voter-sec">
                            <li><span></span><img src="<?php echo e(asset('/img/right-vote-btn-dark.svg')); ?>"><span></span></li>
                        </ul>
                    </div>

                </div>
            </div>