<div class="header2">
@extends('layouts.game')
</div>
@section('content')

    <main class="game-wrapper">
        <aside class="game-sidebar game-sidebar__right profile-content">
            <div class="game-header"><span>Your Profile</span></div>
            <div class="profile-image">
                <img src="{{ asset('images') }}/{{ Auth::user()->avatar_url }}">
            </div>
            <div class="profile-content-inner">
                <p class="profile-name">{{ Auth::user()->name }}</p>
                <p class="profile-email">{{ Auth::user()->email }}</p>
                <!-- <p class="profile-id"><span>{{ Auth::user()->id }}</span></p> -->
                  <div class="wrapper">
<p>Receive Notifications</p>
  <label class="switch2">
  @if(Auth::user()->notification_settings == 'false')
    <input type="checkbox" value="false">
@else
<input type="checkbox" value="true" checked>
@endif
  <span class="slider round"></span>
</label>
</div>
            </div>
    </aside>
    

    
        @if( Session::has( 'success' ))
             <div class="flash-msg"> {{ Session::get( 'success' ) }}</div>
        @elseif( Session::has( 'warning' ))
             <div class="flash-msg">{{ Session::get( 'warning' ) }} </div><!-- here to 'withWarning()' -->
        @endif
    
    

    <div class="game-main debate-single update-profile">
        <div class="game-header"><span>Update Your Profile Information</span></div>

            <form class="form-horizontal form login-form u-center-block" role="form" method="POST" action="{{ route('profile.update', Auth::user()->id) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                    <label for="phone_number" class="col-md-4 control-label">Mobile Phone</label>

                    <div class="col-md-6">
                        <input id="phone_number" type="tel" class="form-control" name="phone_number" value="@if( Auth::user()->otp == 1) {{ Auth::user()->phone_number }} @endif" placeholder="Ex. +17256267914">

                        @if ($errors->has('phone_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('handle') ? ' has-error' : '' }}">
                    <label for="handle" class="col-md-4 control-label">Handle</label>

                    <div class="col-md-6">
                        <input id="handle" type="text" class="form-control" name="handle" value="{{ Auth::user()->handle }}">

                        @if ($errors->has('handle'))
                            <span class="help-block">
                                <strong>{{ $errors->first('handle') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('avatar_url') ? ' has-error' : '' }}">
                    <label for="avatar_url" class="col-md-4 control-label">Image Upload</label>

                    <div class="col-md-6 upload-btn">
                        <input id="avatar_url" type="file" class="form-control" name="avatar_url" value="{{ old('avatar_url') }}" accept='image/*' />

                        <img id="img-preview" src="{{ asset('images') }}/{{ Auth::user()->avatar_url }}" />
                        
                        @if ($errors->has('avatar_url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('avatar_url') }}</strong>
                            </span>
                        @endif
                        <span style="color: red;" class="img-size-err"></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <button type="submit" class="debate-btn">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!--aside class="game-sidebar game-sidebar__right">
            <div class="game-header">Activity Feed</div>
            <div class="u-background-white">
                
            </div>
        </aside-->

    </main>

    <!-- Modal -->
  <button style="display:none;" id="otpPopup" type="button" data-toggle="modal" data-target="#mibileOtpModal"></button>
  <div id="mibileOtpModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <form method="post" action="#">
      <div class="modal-content">
        <div class="modal-header"><button type="button" data-dismiss="modal" class="btn-default"><i aria-hidden="true" class="fa fa-times"></i></button></div>
        <div class="modal-body">
          <p>Please Enter Otp.</p>
          <input type="text" name="otp">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="green-btn" value="Submit">
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
