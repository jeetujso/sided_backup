<?php
if (Auth::check()) {
    $login_user_id  = auth()->user()->id;
} else {
    $login_user_id = "0";
}

$users_array = array();
$users          = $debate->users()->get();
if(count($users) >= 2){
    $users_array    = [$users[0]->id , $users[1]->id ];
    $total_votes    = ($users[0]->pivot->votes + $users[1]->pivot->votes);
}

$my_debate      = false;
$votes          = $debate->votes()->select('voter_id','user_id')->where('voter_id', $login_user_id)->first();
?>

<?php if(in_array($login_user_id, $users_array)): ?>
    <?php $my_debate = true; ?>
<?php endif; ?>


<div class="debate-preview u-background-white user-detial-bottom">
    <div class="debate-preview__header">
        <h4 class="debate-preview__category">
            Submitted In <strong class="u-text-black"><?php echo e($debate->question->category->name); ?></strong> 

            <span>
                <?php
                    $days = $debate->starts_at->diffInDays();
                    if($days < 1){
                        echo $debate->starts_at->diffForHumans();
                    }else{
                        echo $days." days ago";
                    }
                ?>

                <?php if($my_debate): ?>
                    <!-- <a data-toggle="modal" data-target="#inviteFriends" class="align-right" id="openPopUpClick"><img  src="<?php echo e(asset('img')); ?>/dot.svg" class="align-right"></a> -->
                <?php endif; ?>

            </span>
        </h4>
		<h5 class="debate-preview__category">Submitted By <strong class="u-text-black"><a href="<?php echo e(route('publicPlayerShow', $debate->getDebatequestion->getquestionAuther->handle )); ?>"><?php echo e($debate->getDebatequestion->getquestionAuther->name); ?></a></strong></h5>
        <p class="debate-preview__question-text">
            <?php echo e($debate->question->text); ?>

        </p>
        <small class="debate-preview__question-source <?=(empty($debate->question->source))?'source-hidden':''?>">
            <?php echo e($debate->question->medium); ?> from 
            <strong class="u-text-black">
                <a href="<?php echo e($debate->question->source_url); ?>" target="_blank" onclick="return false;"> <?php echo e($debate->question->source); ?>

                </a>
            </strong>
        </small>

    </div>
    <div class="debate-preview__players u-flex">
        <?php $i=1; ?>

        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php $side = strtolower($user->pivot->side); ?>

            <div class="debate-preview__player u-flex-center">
                <div class="debate-preview__player-img <?php echo e($side); ?>" >
                    <a href="<?php echo e(route('publicPlayerShow', $user->handle)); ?>">
                        <img class="debate-preview__player-avatar" src="<?php echo e(asset('images')); ?>/<?php echo e($user->avatar_url); ?>" alt="<?php echo e($user->name); ?>">
                    </a>
                </div>
                <div class="debate-preview__player-info">
                    <h4 class="debate-preview__player-name">
                        <a class="u-link-black" href="<?php echo e(route('publicPlayerShow', $user->handle)); ?>">
                            <?php echo e($user->handle); ?></a>
                    </h4>
                    <small>
                        <?php echo e($user->rank); ?>

                    </small>
                </div><!-- /player-info-->

                <ul class="voter-sec full-dark">
                    <!-- <li><span>22</span><img src="img/green-vote-btn.svg"></li> -->

                    <li>
                        <?php if($my_debate): ?>
                            <?php if($i==1): ?>
                                <?php if($total_votes > 0): ?>
                                    <span class="<?php echo e($side); ?>-<?php echo e($i); ?>"><?php echo e($user->pivot->votes); ?></span>
                                    <img src="/img/<?php echo e($side); ?>-<?php echo e($i); ?>-vote-btn.svg">
                                <?php else: ?>
                                    <img src="/img/left-vote-btn-dark.svg">
                                <?php endif; ?>
                                
                            <?php else: ?>
                                <?php if($total_votes > 0): ?>
                                    <img src="/img/<?php echo e($side); ?>-<?php echo e($i); ?>-vote-btn.svg">
                                    <span class="<?php echo e($side); ?>-<?php echo e($i); ?>"><?php echo e($user->pivot->votes); ?></span>
                                <?php else: ?>
                                    <img src="/img/right-vote-btn-dark.svg">
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>

                            <?php if($i==1): ?>
                                <?php if(count($votes)>0): ?>
                                    <?php if($votes->user_id == $user->id): ?>
                                        <span  class="<?php echo e($side); ?>-<?php echo e($i); ?>"><?php echo e($user->pivot->votes); ?></span>
                                        <img src="/img/<?php echo e($side); ?>-<?php echo e($i); ?>-vote-btn.svg">
                                    <?php else: ?>
                                        <span class="<?php echo e($side); ?>-<?php echo e($i); ?>-dark"><?php echo e($user->pivot->votes); ?></span>
                                        <img src="/img/left-vote-btn-dark.svg">
                                    <?php endif; ?> 
                                <?php else: ?>
                                    <!-- <span><?php echo e($user->pivot->votes); ?></span> -->
                                   <!--  <img src="/img/left-vote-btn.svg"> -->
                                    <img src="/img/<?php echo e($side); ?>-<?php echo e($i); ?>-vote-btn.svg">
                                <?php endif; ?> 

                                
                            <?php else: ?>
                                <!-- <img src="/img/right-vote-btn.svg">
                                <span><?php echo e($user->pivot->votes); ?></span> -->

                                <?php if(count($votes)>0): ?>
                                    <?php if($votes->user_id == $user->id): ?>
                                        <img src="/img/<?php echo e($side); ?>-<?php echo e($i); ?>-vote-btn.svg">
                                        <span class="<?php echo e($side); ?>-<?php echo e($i); ?>"><?php echo e($user->pivot->votes); ?></span>
                                    <?php else: ?>
                                        
                                        <img src="/img/right-vote-btn-dark.svg">
                                        <span class="<?php echo e($side); ?>-<?php echo e($i); ?>-dark"><?php echo e($user->pivot->votes); ?></span>
                                    <?php endif; ?> 
                                <?php else: ?>
                                    <img src="/img/<?php echo e($side); ?>-<?php echo e($i); ?>-vote-btn.svg">
                                    <!-- <img src="/img/right-vote-btn.svg"> -->
                                    <!-- <span><?php echo e($user->pivot->votes); ?></span> -->
                                <?php endif; ?> 


                            <?php endif; ?>

                        <?php endif; ?>
                    </li>
                </ul>

            </div>
            <?php $i++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="">
        <div>
            <h3>Start your own debate with this question.<a href="<?php echo e(url('debates/pickaside')); ?>?question_id=<?php echo e($debate->question->id); ?>"> Click here.</a>
            <a href="<?php echo e(url('debates/create')); ?>?cid=<?php echo e($debate->question->category->id); ?>#category_container">All questions</a>
            </h3>
        </div>
    </div>
</div>
