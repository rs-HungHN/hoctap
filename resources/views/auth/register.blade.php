@extends('auth.app')
@section('appname', 'GMOZ E-learning')
@section('title', 'Tạo tài khoản mới')
@section('css')
    @include('template.frontend.css')
@endsection
@section('content')
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h3>Đăng ký tài khoản mới</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <div class="col-sm-8 col-sm-offset-2">
                                <md-input-container class="md-block" style="margin-bottom: 0px">
                                <label>Họ và tên</label>
                                <input type="text"  required name="name" value="{{ old('name') }}" >
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                              </md-input-container>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-sm-8 col-sm-offset-2">
                                <md-input-container  class="md-block no-margin">
                                <label>Email</label>
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
                                <input type="password"  required name="password" value="" >
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                              </md-input-container>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <div class="col-sm-8 col-sm-offset-2">
                                <md-input-container class="md-block no-margin">
                                <label>Xác nhận mật khẩu</label>
                                <input type="password"  required name="password_confirmation" value="" >
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                              </md-input-container>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 " layout="row"  layout-align="center center">
                                <md-button   type="submit" class="md-raised md-primary btn-padding" aria-label="Submit"  md-ripple-size="full"><i class="fa fa-btn fa-sign-in"></i> Đăng ký</md-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
