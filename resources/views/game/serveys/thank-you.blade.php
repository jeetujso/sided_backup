<div class="header2">
@extends('layouts.game')
</div>
@section('content')
<main class="game-wrapper">
	<div class="debate-preview u-background-white">
		<div class="dashboard-item">
	 		<div class="debate-preview__header text-center">
             <h2>Thank you for your answer.</h2>
	        </div>
			<a href="{{ url('feed') }}">Back to Feed</a>
	 	</div>
	</div>
</main>

@endsection