@extends('auth.app')
@section('appname', 'GMOZ E-learning')
@section('title', 'Tạo tài khoản mới')
@section('css')
    @include('template.frontend.css')
@endsection
@section('content')
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h3>Đăng nhập</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">                           
                            <div class="col-sm-8 col-sm-offset-2">
                            <md-input-container class="md-block no-margin-bottom">
                                <label>Email đăng nhập</label>
                                <input type="email"  required name="email" value="{{ old('email') }}" >
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                              </md-input-container>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            
                            <div class="col-sm-8 col-sm-offset-2">
                                <md-input-container  class="md-block no-margin">
                                <label>Mật khẩu</label>
                                <input type="password"  required name="password" value="{{ old('email') }}" >
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                              </md-input-container>

                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12"  layout="column"  layout-align="center center">
                                <label><input type="checkbox" name="remember" class=""> Remember me</label>  
                                <br>
                                <md-button type="submit" class="md-raised md-primary btn-padding" aria-label="Submit"  md-ripple-size="full"><i class="fa fa-btn fa-sign-in"></i> Đăng nhập</md-button>
                                <br>
                                <p class="text-center"><a class="btn btn-link" href="{{ url('/password/reset') }}">Quên mật khẩu?</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
