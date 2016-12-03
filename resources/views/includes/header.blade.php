<header>
    <div class="container">
        <div class="row">
            <div class="col-md-5 padding-vert-5 hidden-xs hidden-sm no-padding-left-lg">
                <a href="/" title="">
                    <img src="@if (App::isLocal()) {{asset('img/logo.png')}} @else {{secure_asset('img/logo.png')}} @endif" alt="Logo"/>
                </a>
            </div>
            <div class="col-md-7">
                @if (Auth::guest() )
                    <form class="no-padding" method="POST" onsubmit="startLoader(this)"
                          action="@if(App::isLocal()){{ url('/login')}}@else{{secure_url('/login') }}@endif">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-group-sm label-floating">
                                    <label for="login" class="control-label">Kasutajanimi või email</label>
                                    <input id="login" class="form-control" type="text" name="login"
                                           value="{{ old('login') }}" required>
                                    @if($errors->has('login'))
                                        <span class="help-block help-error">
                                            <strong>{{ $errors->first('login') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">

                                <div class="form-group form-group-sm label-floating ">
                                    <label for="password" class="control-label">Parool</label>
                                    <input id="password" type="password" class="form-control" name="password"
                                           required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <a id="forgot-password" class="small pull-right"
                                   href="/password/reset" tabindex="-1">Unustasid parooli?</a>
                            </div>

                            <div class="form-group hidden">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label for="remember" class="visuallyhidden">Hoia mind sisselogituna</label>
                                        <input tabindex="-1" id="remember" type="checkbox" name="remember" checked> Mäleta mind
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 text-center margin-top-10 no-padding">
                                <button class="btn btn-sm btn-primary spinner-button" type="submit">
                                    <span class="spinner"><span class="md-spinner md-spinner-blue"></span></span>
                                    <span class="md-spinner-text">Logi sisse</span>
                                </button>
                                <a class="btn btn-sm btn-primary " href="/register">Loo konto</a>
                            </div>
                        </div>
                    </form>
                @elseif(Auth::user()->isAdmin())
                    <form id="logout-form" method="POST" onsubmit="startLoader(this)" action='/logout'>
                        {{ csrf_field() }}
                        <div class="row text-center">
                            <div class="bottom-border user-bar no-padding-lg">
                                <div class="col-xs-3 user-bar-item">
                                    <span class="fa fa-trophy points-icon" aria-hidden="true"></span>
                                    <span id="user-points">{{Auth::user() -> points }}</span>
                                    <span id="points-increase" class="fa fa-arrow-up points-icon" aria-hidden="true"></span>
                                </div>
                                <div class="col-xs-5 user-bar-item">
                                    <div class="user-bar-name">{{Auth::user() -> username }}</div>
                                </div>
                                <div class="col-xs-4">
                                    <a href='/admin' class="btn btn-sm btn-info">Admin</a>
                                    <button class="btn btn-sm btn-primary pull-right spinner-button" type="submit">
                                        <span class="spinner"><span class="md-spinner md-spinner-blue"></span></span>
                                        <span class="md-spinner-text">Logi välja</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <form id="logout-form" method="POST" onsubmit="startLoader(this)" action="/logout">
                        {{ csrf_field() }}
                        <div class="row text-center">
                            <div class="bottom-border user-bar no-padding-lg">
                                <div class="col-xs-3 user-bar-item">
                                    <span id="points-increase" class="fa fa-fw points-icon" aria-hidden="true">
                                        <span class="fa-trophy"></span>
                                        <span class="fa-arrow-up"></span>
                                    </span>
                                    <span id="user-points">{{Auth::user() -> points }}</span>
                                </div>
                                <div class="col-xs-6 user-bar-item">
                                    <div class="user-bar-name">{{Auth::user() -> username }}</div>
                                </div>
                                <div class="col-xs-3">
                                    <button class="btn btn-sm btn-primary pull-right spinner-button" type="submit">
                                        <span class="spinner"><span class="md-spinner md-spinner-blue"></span></span>
                                        <span class="md-spinner-text">Logi välja</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</header>
