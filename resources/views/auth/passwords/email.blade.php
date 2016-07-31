@extends('auth.app')
@section('appname', 'GMOZ E-learning')
@section('title', 'Tạo tài khoản mới')
@section('css')
    @include('template.frontend.css')
@endsection
<!-- Main Content -->
@section('content')
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center"><h3>Thiết lập lại mật khẩu</h3></div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-sm-6 col-sm-offset-3">
                                <md-input-container class="md-block" >
                                <label>Email bạn dùng để đăng ký tài khoản</label>
                                <input type="email"  required name="email" value="" >
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                              </md-input-container>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 " layout="row"  layout-align="center center">
                                <md-button   type="submit" class="md-raised md-primary btn-padding"  aria-label="Submit"  md-ripple-size="full"><i class="fa fa-btn fa-envelope"></i> Xác nhận</md-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
