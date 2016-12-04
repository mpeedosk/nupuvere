@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Uus administraator/moderaator')
@section('content')
    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <form class="form-horizontal registration" method="POST" onsubmit="startLoader(this)"
                          @if(isset($admin)) action="/admin/admins/edit/{{$admin->id}}"
                          @else action="/admin/admins/create"
                            @endif>
                        {{ csrf_field() }}
                        @if(isset($admin))
                            {{ method_field('PATCH')}}
                        @endif
                        <div id="username-form" class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-2 control-label">Kasutajanimi</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username"
                                       @if(isset($admin)) value="{{$admin->username}}" onBlur="checkAvailabilityUser({{$admin->id}})"
                                       @else value="{{old('username')}}" onBlur="checkAvailabilityUser(-1)"
                                       @endif
                                       required autofocus>
                                <span id="username-error">
                                    @if ($errors->has('username'))
                                        <span class="help-block help-error">
                                        <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <span class="visible-lg" id="user-status" data-toggle='tooltip'></span>
                        </div>
                        <div id="first-name-form" class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
                            <label for="first-name" class="col-md-2 control-label">Eesnimi</label>
                            <div class="col-md-6">
                                <input id="first-name" type="text" class="form-control" name="first_name"
                                       value="@if(isset($admin)){{$admin->first_name}}@else{{old('first_name')}}@endif"
                                       required onBlur="validateField('first-name')">
                                <span id="first-name-error">
                                    @if ($errors->has('first_name'))
                                        <span class="help-block help-error">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <span class="visible-lg" id="first-name-status" data-toggle='tooltip'></span>
                        </div>
                        <div id="last-name-form" class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
                            <label for="last-name" class="col-md-2 control-label">Perenimi</label>
                            <div class="col-md-6">
                                <input id="last-name" type="text" class="form-control" name="last_name"
                                       value="@if(isset($admin)){{$admin->last_name}}@else{{old('last_name')}}@endif"
                                       required onBlur="validateField('last-name')">
                                <span id="last-name-error">
                                    @if ($errors->has('last_name'))
                                        <span class="help-block help-error">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <span class="visible-lg visible-md" id="last-name-status" data-toggle='tooltip'></span>
                        </div>
                        <div id="email-form" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">Meiliaadress</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       @if(isset($admin)) value="{{$admin->email}}" onBlur="checkAvailabilityEmail({{$admin->id}})"
                                       @else value="{{old('email')}}" onBlur="checkAvailabilityEmail(-1)"
                                       @endif>
                                <span id="email-error">
                                    @if ($errors->has('email'))
                                        <span class="help-block help-error">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <span class="visible-lg visible-md" id="email-status" data-toggle='tooltip'></span>
                        </div>
                        <div id="password-form" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-2 control-label">Salasõna</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required onblur="validateField('password')">
                                <span id="password-error">
                                    @if ($errors->has('password'))
                                        <span class="help-block help-error">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <span class="visible-lg visible-md" id="password-status" data-toggle='tooltip'></span>
                        </div>
                        <div  id="password-confirm-form" class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-2 control-label">Kinnita Salasõna</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required onblur="validatePasswordMatching()">
                                <span id="password-confirm-error">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block help-error">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </span>
                            </div>
                            <span class="visible-lg visible-md" id="password-confirm-status" data-toggle='tooltip'></span>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Roll</label>
                            <div class="col-md-10">
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" name="role" value="admin"
                                               @if(isset($admin)) @if($admin->role === 1) checked="" @endif @else checked="" @endif>
                                        Tavakasutaja
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" name="role" value="mod"
                                               @if(isset($admin) && $admin->role === 2)checked="" @endif>
                                        Moderaator
                                    </label>
                                </div>
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" name="role" value="admin"
                                               @if(isset($admin) && $admin->role === 3)checked="" @endif>
                                        Administraator
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-raised">
                                    <span class="spinner"><span class="md-spinner md-spinner-white"></span></span>
                                    <span class="md-spinner-text">@if(isset($admin)) Muuda @else Loo kasutaja @endif</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    @if(session('toast'))
        <script>
            $(function () {
                toastr.success('{{session('toast')}}');
            });
        </script>
    @endif
@endsection