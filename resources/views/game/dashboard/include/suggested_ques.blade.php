@foreach($questions as $question)
@if($question->category->status=="live")
    <div class="dashboard-item">
	    <div class="debate-preview u-background-white">
	    	<div class="debate-preview__header">
	        	<div class="debate-haeder-top">
	          		<h4 class="debate-preview__category"> Submitted In <strong class="u-text-black">
	          		{{ $question->category->name }}
	          		</strong></h4>
	          	</div>
				<p class="debate-preview__question-text">{{ $question->text }}</p>

	          	<small class="debate-preview__question-source <?=(empty($question->source))?'source-hidden':''?>">
	          		<i class="fa fa-circle" aria-hidden="true"></i> 
	          		{{ $question->medium }} from 
	          		<strong class="u-text-black">{{ $question->source }}</strong>
	          	</small>

	          	<div class="debate-btn-box">
	          		<a class="debate-btn" href="{{ url('debates/pickaside') }}?question_id={{$question->id}}">Start Debate</a>
	          	</div>     
	        </div>
	    </div>
	</div>
	@endif
@endforeach