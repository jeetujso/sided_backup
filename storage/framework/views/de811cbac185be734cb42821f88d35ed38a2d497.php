<?php $__env->startSection('content'); ?>
<main class="game-wrapper">
    <h2 class="title-head">Pick a Question</h2>
    <p class="title-caption">Select one question youʼd like to debate and then hit next.</p>
    
    <form name="select_question" method="get" action="<?php echo e(route('pickaside')); ?>">

    <div class="tab-section">
      <ul class="nav nav-tabs" id="nav-tabs">
          <li class="active"><a data-toggle="tab" href="#recent_container" onclick="window.location.hash = ''">Most Recent</a></li>
          <li><a data-toggle="tab" href="#category_container" id="cat-tab">By Category</a></li>
      </ul>

      <div class="tab-content">
          <input type="hidden" name="question_id" id="question_id">

          <!-- tab 1 (Recent questions)-->
          <div id="recent_container" class="tab-pane fade in active">

            <!-- one row -->
            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php if($question->category->status == 'live'): ?>
            <div class="dashboard-item questions">
              <div class="question_id" ques-id="<?php echo e($question->id); ?>"></div>
              <div class="debate-preview u-background-white">
                <div class="debate-preview__header">

                  <div class="debate-haeder-top">
                    <h4 class="debate-preview__category"> Submitted In <strong class="u-text-black"><?php echo e($question->category->name); ?></strong></h4>
					<h5 class="debate-preview__category"> Submitted By <strong class="u-text-black"><a href="<?php echo e(route('publicPlayerShow', $question->getquestionAuther->handle)); ?>"><?php echo e($question->getquestionAuther->name); ?></a></strong></h5>
                  </div>

                  <p class="debate-preview__question-text">
                    <?php echo e($question->text); ?>

                  </p>
                  <small class="debate-preview__question-source <?=(empty($question->source))?'source-hidden':''?>">
                    Source from <strong class="u-text-black"><a href="<?php echo e($question->source_url); ?>" target="_blank"><?php echo e($question->source); ?></a></strong>
                  </small>
                </div>

                <div class="debate-btn-box"></div>
                
              </div>
            </div>
            <!-- one row -->
			<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </div>

          <!-- tab 2 (By Category)-->
          <div id="category_container" class="tab-pane fade">
            <section class="onboarding-categories u-container" id="category-listing">
              
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div style="background-image: url(&quot;<?php echo e(asset('img-dist/category/'.$category->image_url)); ?>&quot;);" class="onboarding-category">
                  <span class="onboarding-category__name" data-cat-id="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></span>
                  <!-- <input type="hidden"  value="<?php echo e($category->id); ?>" name="category_name"  class="category_name"> -->
                  <div class="onboading-category__screen"></div>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </section>
            <div id="category-ads">

            </div>
            <section id="category-wise-questions">
            </section>
          </div>

          <!-- <div class="nxt-btn"><input class="debate-btn disabled" type="submit" Value ="Next" disabled="disabled"></div> -->
          
        </div>
      </div>
    </form>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.debate', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>