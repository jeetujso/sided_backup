<div class="header2">
@extends('layouts.new')
</div>
@section('content')
<div class="marg-top seperate-page-voter challenge-debate-arg">
    <div id="accept-challenge-debate-arg" role="dialog">  
        <div class="modal-dialog">
            <form method="POST" action="{{ route('saveDebateChallengeWithArg') }}">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                    </div>
                
                    <div class="modal-body">
                        <h4 class="modal-title"></h4>
                        <p>You are about to join debate, please confirm.</p>
                        <input type="hidden" name="debate_id" value="{{ $debate->id }}">
                        <textarea name="join_debate_argument" id="join-debate-argument" required></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="challenge-submit-btn">Yes</button>
                        <p data-dismiss="modal">No</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="challenge-overlay"></div>



  

  
@endsection