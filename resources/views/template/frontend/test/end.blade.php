@extends('template.frontend.master')
@section('appname', 'GMOZ E-learning')
@section('title', 'Gameover')
@section('css')
	@include('template.frontend.css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend/test/end.css') }}">
@endsection
@section('wrapper')
	<div class="fixed-style success" >
		<div class="container">
			<h1 class="text-center">Gameover</h1>
			<h3 class="text-center">Hệ thống đã phát hiện bài test này đã được sử dụng hoặc đã được hoàn thành</h3>	
			<div class="col-sm-6 col-sm-offset-3">
			<hr>
			<p class="text-center">Hãy tiếp tục thử sức với các bài test khác hoặc xem kết quả của bạn với bài test này</p>
			<hr>
				<md-button class="md-raised pull-left btn-success" aria-label="home" md-ripple-size="full" href="{{ url('/') }}"><i class="fa fa-fw fa-arrow-circle-o-left"></i>Trang chủ</md-button>
				<md-button class="md-raised pull-right md-warn btn-success" aria-label="result" md-ripple-size="full" href="{{ url('test/'.($data->key).'/result') }}">Kết quả<i class="fa fa-fw fa-arrow-circle-o-right"></i></md-button>
			</div>
		</div>	
	</div>
@endsection
@section('js')
@stop