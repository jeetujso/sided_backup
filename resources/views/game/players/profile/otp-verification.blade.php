<div class="header2">
@extends('layouts.game')
</div>
@section('content')
    <main class="game-wrapper otp-sec">
        <div class="game-main debate-single update-profile">
            <div class="game-header"><span>Please enter OTP</span></div>
            <form class="form-horizontal form login-form u-center-block" role="form" method="POST" action="{{ route('frontMobileOtpVerify') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('otp') ? ' has-error' : '' }}">
                    <div class="col-md-6">
                        <input id="otp" type="text" placeholder="Enter OTP" class="form-control" name="otp" required>
                        <span class="help-block">
                            @if($errors->any())
                                <strong>Invalid OTP.</strong>
                            @endif
                        </span>
                    </div>
                    <div class="edit-profile-resend-otp resend-otp">
                        <a href="{{ route('frontMobileOtpResend') }}">Resend OTP</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="debate-btn">
                            Verify Phone Number
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
   
@endsection
