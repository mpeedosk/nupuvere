@extends('admin.layouts.dashboard')
@section('title', 'Administraator')
@section('description', 'Uus administraator/moderaator')


@section('content')
    <section class="admin-page-content">
        <div class="se-pre-con"></div>
        <div class="container">
            @if(session('toast'))
                <script>
                    $(function () {
                        toastr.success('{{session('toast')}}');
                    });
                </script>
            @endif
            <div class="row">
                <div class="col-md-8 registration">
                    <form class="form-horizontal" role="form" method="POST"
                          @if(isset($admin)) action="/admin/admins/edit/{{$admin->id}}"
                          @else action="/admin/admins/create"
                          @endif>
                        {{ csrf_field() }}
                        @if(isset($admin))
                            {{ method_field('PATCH')}}
                        @endif
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-2 control-label">Kasutajanimi</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username"
                                       value="@if(isset($admin)){{$admin->username}}@else{{old('username')}}@endif"
                                       required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('first_name') ? 'has-error' : ''}}">
                            <label for="first_name" class="col-md-2 control-label">Eesnimi</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name"
                                       value="@if(isset($admin)){{$admin->first_name}}@else{{old('first_name')}}@endif"
                                       required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('last_name') ? 'has-error' : ''}}">
                            <label for="last_name" class="col-md-2 control-label">Perenimi</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name"
                                       value="@if(isset($admin)){{$admin->last_name}}@else{{old('last_name')}}@endif"
                                       required autofocus>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">E-posti aadress</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="@if(isset($admin)){{$admin->email}}@else{{old('email')}}@endif"
                                       required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-2 control-label">Salasõna</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-2 control-label">Kinnita Salasõna</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Roll</label>
                            <div class="col-md-10">
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" name="role" value="mod"
                                               @if(isset($admin)) @if($admin->role === 2) checked="" @endif @else checked="" @endif>
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
                                    Loo kasutaja
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection