@extends('layouts.blank')

@section('page')
    <section class="container margin-top-30">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center bottom-border">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="logo">
                                    <a href="/">
                                        <img src="/img/logo.png " alt="Logo">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xs-4 panel-title">
                                <span>Registreerimine</span>
                            </div>
                            <div class="col-xs-4 panel-title-back">
                                <a href="/"><span class="hidden-xs">Tagasi &nbsp;</span><span
                                            class="glyphicon glyphicon-arrow-left"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal registration" role="form" method="POST"
                              onsubmit="startLoader(this)"
                              action="{{ url('/register') }}">
                            {{ csrf_field() }}
                            <div id="username-form"
                                 class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-md-4 control-label">Kasutajanimi</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username"
                                           value="{{old('username')}}" onBlur="checkAvailabilityUser()"
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

                            <div id="first-name-form"
                                 class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
                                <label for="first-name" class="col-md-4 control-label">Eesnimi</label>
                                <div class="col-md-6">
                                    <input id="first-name" type="text" class="form-control" name="first_name"
                                           value="{{old('first_name')}}" onBlur="validateField('first-name')"
                                           required autofocus>
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

                            <div id="last-name-form"
                                 class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
                                <label for="last-name" class="col-md-4 control-label">Perenimi</label>
                                <div class="col-md-6">
                                    <input id="last-name" type="text" class="form-control" name="last_name"
                                           value="{{old('last_name')}}" onBlur="validateField('last-name')"
                                           required autofocus>
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
                                <label for="email" class="col-md-4 control-label">Meiliaadress</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{old('email')}}" onblur="checkAvailabilityEmail()"
                                           required>
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
                                <label for="password" class="col-md-4 control-label">Salasõna</label>

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

                            <div id="password-confirm-form" class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirm" class="col-md-4 control-label">Kinnita Salasõna</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                    onblur="validatePasswordMatching()">
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

                            <div class="form-group text-center">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary btn-raised spinner-button">
                                        <span class="spinner"><span class="md-spinner md-spinner-blue"></span></span>
                                        <span class="md-spinner-text">Loo konto</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
