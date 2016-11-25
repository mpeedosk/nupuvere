<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 padding-vert-5 hidden-xs no-padding-left-lg">

                <!-- Logo -->
                <div class="logo">
                    <a href="/" title="">
                        <img src="@if (App::isLocal()) {{asset('img/logo.png')}} @else {{secure_asset('img/logo.png')}} @endif"
                             alt="Logo"/>
                    </a>
                </div>
            </div>

            <div class="col-sm-7 padding-vert-5">
                <!-- Login Box -->
                <div class="row">
                    <div class="col-md-12 no-padding-lg">
                        @if (Auth::guest() )
                            <form class="login-page" method="POST"
                                  action="@if (App::isLocal()) {{ url('/login') }} @else{{ secure_url('/login') }} @endif ">
                                {{ csrf_field() }}
                                <div class="row inputs">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-sm label-floating">
                                            <label for="username" class="control-label">Kasutajanimi</label>
                                            <input id="username" class="form-control" type="text" name="username"
                                                   value="{{ old('username') }}" required>
                                            @if($errors->has('username'))
                                                <span class="help-block">
                                                         <strong>{{ $errors->first('username') }}</strong>
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
                                                <label for="remember" class="visuallyhidden">Hoia mind
                                                    sisselogituna</label>
                                                <input tabindex="-1" id="remember" type="checkbox" name="remember" checked> Mäleta
                                                mind
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 margin-top-10 no-padding">
                                        <div class="col-md-6">
                                            <button class="btn btn-sm btn-primary pull-right" type="submit">Logi sisse</button>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-sm btn-primary pull-right" href="/register">Loo konto</a>
                                        </div>
                                    </div>

                                </div>

                            </form>

                        @elseif(Auth::user()->isAdmin())
                            <form style="padding-right: 29px" id="logout-form"
                                  action="@if (App::isLocal()) {{ url('/logout') }} @else{{ secure_url('/logout') }} @endif "
                                  method="POST">
                                {{ csrf_field() }}
                                <div class="row text-center">
                                    <div class="bottom-border user-bar pull-right"
                                         style="display:inline-block; width: 80%; padding-top: 10px;">

                                        <div class="pull-left">
                                            <span class="fa fa-trophy points-icon"
                                                  aria-hidden="true"></span>
                                            <span id="user-points" class="points">{{Auth::user() -> points }}</span>
                                            <span id="points-increase" class="fa fa-arrow-up points-icon points-increase" aria-hidden="true"></span>
                                        </div>
                                        <h2 style="display:inline-block;">{{Auth::user() -> username }}</h2>


                                        <button class="btn btn-sm btn-primary pull-right" type="submit">Logi välja
                                        </button>
                                        <a href="@if (App::isLocal()) {{ url('/admin') }} @else{{ secure_url('/admin') }}
                                        @endif " class="btn btn-sm btn-info pull-right">Admin
                                        </a>
                                        {{ csrf_field() }}
                                    </div>
                                </div>
                            </form>
                        @else
                            <form style="padding-right: 30px;padding-left: 30px" id="logout-form"
                                  action="@if (App::isLocal()) {{ url('/logout') }} @else{{ secure_url('/logout') }} @endif "
                                  method="POST">
                                {{ csrf_field() }}
                                <div class="row text-center">

                                    <div class="bottom-border user-bar pull-right">
                                        <div class="col-xs-4">
                                            <span class="fa fa-trophy points-icon"
                                                  aria-hidden="true"></span>
                                            <span id="user-points" class="points">{{Auth::user() -> points }}</span>
                                            <span id="points-increase" class="fa fa-arrow-up points-icon points-increase" aria-hidden="true"></span>

                                        </div>

                                        <div class="col-xs-4">
                                            <div class="user-bar-name">{{Auth::user() -> username }}</div>
                                        </div>

                                        <div class="col-xs-4">
                                            <button class="btn btn-sm btn-primary pull-right" type="submit">Logi välja
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                    <!-- End Login Box -->
                </div>
            </div>

            <!-- End Logo -->
        </div>
    </div>
</header>
