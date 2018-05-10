<?php
if (Auth::check()) {
    $login_user_id  = auth()->user()->id;
} else {
    $login_user_id = "0";
}

$users          = $debate->users()->get();
$users_array    = [$users[0]->id , $users[1]->id ];
$total_votes    = ($users[0]->pivot->votes + $users[1]->pivot->votes);

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
			
            <span class="debate-closed"> Closed </span>
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
    <div class="debate-preview__players u-flex debate-preview-closed">
        <?php $i=1; ?>

        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php $side = strtolower($user->pivot->side); ?>

            <div class="debate-preview__player u-flex-center">                
                <div class="debate-preview__player-info">
                    <h4 class="debate-preview__player-name">
                        <a class="u-link-black" href="<?php echo e(route('publicPlayerShow', $user->handle)); ?>">
                            <?php echo e($user->handle); ?></a>
                    </h4>
                    <small>
                        <?php echo e($user->pivot->votes); ?> votes
                    </small>
                </div><!-- /player-info-->
				<div class="debate-preview__player-img <?php echo e($side); ?>" >
                    <a href="<?php echo e(route('publicPlayerShow', $user->handle)); ?>">
                        <img class="debate-preview__player-avatar" src="<?php echo e(asset('images')); ?>/<?php echo e($user->avatar_url); ?>" alt="<?php echo e($user->name); ?>">
                    </a>
                </div>

            </div>
            <?php $i++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
