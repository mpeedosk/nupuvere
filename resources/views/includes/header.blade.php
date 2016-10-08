<div id="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 padding-vert-5 hidden-xs no-padding-left-lg">

                <!-- Logo -->
                <div class="logo">
                    <a href="/" title="">
                        <img src="{{asset('img/logo.png')}}" alt="Logo"/>
                    </a>
                </div>
            </div>

            <div class="col-sm-7 padding-vert-5 no-padding-lg">
                <!-- Login Box -->
                <div class="row">
                    <div class="col-md-12 no-padding-lg">
                        @if (Auth::guest() )
                            <form class="login-page" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}
                                <div class="row inputs">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-sm label-floating">
                                            <label for="username" class="control-label">Kasutajanimi</label>
                                            <input id="username" class="form-control" type="text" name="username"
                                                   {{ old('username') }} required>
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
                                           href="{{ url('/password/reset') }}" tabindex="-1">Unustasid parooli?</a>

                                    </div>

                                    <div class="form-group hidden">
                                        <div class="col-md-6 col-md-offset-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" checked> Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 margin-top-10 no-padding">
                                        <div class="col-md-6">
                                            <button class="btn btn-sm btn-primary pull-right" type="submit">Logi sisse
                                            </button>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-sm btn-primary pull-right" href="/register">Loo konto</a>
                                        </div>
                                    </div>

                                </div>

                            </form>

                        @elseif(Auth::user()->isSuperAdmin())
                            <H1>SuperAdmin</H1>
                            <form style="padding-right: 29px" id="logout-form" action="{{ url('/logout') }}"
                                  method="POST">
                                <div class="row text-center">
                                    <div class="bottom-border user-bar pull-right" style="padding-top: 10px;">


                                        <div class="col-xs-4" >
                                            <span class="points-icon fa fa-trophy" aria-hidden="true"></span>
                                            <span class="points">{{Auth::user() -> points }}</span>
                                        </div>

                                        <div class="col-xs-4">
                                            <h2>{{Auth::user() -> username }}</h2>
                                        </div>

                                        <div class="col-xs-4">
                                            <button class="btn btn-sm btn-primary pull-right" type="submit">Logi välja
                                            </button>
                                            {{ csrf_field() }}
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @elseif(Auth::user()->isAdmin())
                            <H1>Admin</H1>
                            <form style="padding-right: 29px" id="logout-form" action="{{ url('/logout') }}"
                                  method="POST">
                                <button class="btn btn-sm btn-primary pull-right" type="submit">Logi välja
                                            </button>
                                            {{ csrf_field() }}
                            </form>
                        @else


                            <form style="padding-right: 29px" id="logout-form" action="{{ url('/logout') }}"
                                  method="POST">
                                <div class="row text-center">
                                    <div class="bottom-border user-bar pull-right" style="width: 80%; padding-top: 10px;">


                                        <div class="col-xs-4" >
                                            <span class="points-icon fa fa-trophy" aria-hidden="true"></span>
                                            <span class="points">{{Auth::user() -> points }}</span>
                                        </div>

                                        <div class="col-xs-4">
                                            <h2>{{Auth::user() -> username }}</h2>
                                        </div>

                                        <div class="col-xs-4">
                                            <button class="btn btn-sm btn-primary pull-right" type="submit">Logi välja
                                            </button>
                                            {{ csrf_field() }}
                                        </div>
                                    </div>
                                </div>
                            </form>


                        @endif

                        <div class="search-bar col-md-6 col-md-offset-6 no-padding visible-lg">
                            <form class="search-form" role="search">
                                <div class="form-group form-group-sm">
                                    <div class="input-group">
                                        <input type="text" id="search" placeholder="Otsi..." class="form-control">
                                        <span class="input-group-btn">
                                    <button class="btn btn-aqua btn-xs" type="submit"><i
                                                class="glyphicon glyphicon-search"></i></button></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <!-- End Login Box -->
                </div>
            </div>

            <!-- End Logo -->
        </div>
    </div>
</div>
