@extends('layouts.login')

@section('content')

<form class="form login-form u-center-block" role="form" method="POST" action="{{ route('onboardingOtpStore') }}">
    {{ csrf_field() }}

    <h2 class="login-form-title u-text-center">
    	Finish Creating Your Account
    </h2>
    <div class="field resend-otp-sec">
        <input type="text" class="form-control" name="otp" placeholder="Enter OTP" required>
        <span class="help-block">
            @if($errors->any())
                <strong>Invalid OTP.</strong>
            @endif
        </span>
    </div>
    <div class="field resend-otp">
        <a href="{{ route('onboardingResendOtp') }}">Resend OTP</a>
    </div>
    <div class="field">
        <button type="submit" class="btn btn-green btn-block">
            Activate Your Account
        </button>

        <p class="field-description">
            <a href="{{ route('login') }}">
                Already have an account? Try signing in again.
            </a>
        </p>
      
    </div>
</form>

<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

@endsection
