@extends('template.frontend.master')
@section('appname', 'GMOZ E-learning')
@section('title', 'Are you ready?')
@section('css')
	@include('template.frontend.css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend/test/progress.css') }}">
@endsection
@section('wrapper')
	<noscript>
	    <style type="text/css">
	        .fixed-style {display:none;}
	        .noscript{padding-top: 250px;padding-bottom: 150px;}
	    </style>
	    <div class="container noscript">
	    	<h1 class="text-center"><i class="fa fa-fw fa-refresh fa-spin"></i>OOPS</h1>
	    	<hr>
	    	<h3 class="text-center">Javascript hiện đang TẮT, vui lòng kích hoạt javascript cho trình duyệt sau đó refresh lại trang.</h3>
	    </div>
	    
	</noscript>
	<div class="fixed-style" ng-controller="ProgressController">
		<div class="ready color-white" ng-show="preTest">
			<h1 class="text-center">{{ $course->title }}</h1>
			<h3 class="text-center">Test Programming Skills & Knowledge</h3>
			<p class="text-center"><small>{{ 	$course->nums }} câu hỏi/ {{ round($course->time / 60) }} phút</small></p>
			<hr>
			<h4 class="text-center waring-heading">Những lưu ý khi làm bài</h4>
			<ul class="warning">
				<li>Bạn chỉ được làm bài MỘT lần duy nhất, thời gian sẽ được tính kể từ lúc bạn BẮT ĐẦU</li>
				<li>Không ấn bất cứ phím nào khi đang làm bài, bạn chỉ được sử dụng chuột để chọn đáp án.</li>
			</ul>
			<div layout="row" layout-xs="column"   layout-align="center center">
				<md-button class="md-raised btn-play md-warn" aria-label="description"  md-ripple-size="full" ng-click="testStart()">Bắt đầu <i class="fa fa-fw fa-play"></i></md-button>

			</div>
		</div>
		<div class="testing" ng-hide="preTest">
			<div class="container">
				<input type="hidden" class="key" value="{{ $data->key }}">
				<div class="col-sm-8 col-sm-offset-2">
					<h2>Question #@{{question.num}} <small>/{{ 	$course->nums }}</small> <span class="pull-right"><i class="fa fa-fw fa-clock-o"></i>@{{ formatNumber(config.time / 60) }} mins @{{ config.time % 60 }} s</span></h2>
					<hr>
					<p>@{{question.question}}</p>
					<hr>
					@{{result.q}}
					<md-radio-group ng-model="result.answer">
				      <md-radio-button ng-repeat="answer in question.answer" value="@{{ answer.id }}">@{{ answer.content }}</md-radio-button>
				    </md-radio-group>
				    <hr>
				    <md-button class="md-raised pull-right md-warn" aria-label="next" md-ripple-size="full" ng-click="nextQuestion()">@{{ question.action}}</md-button>
				</div>
				
			</div>
		</div>
		<div class="success" ng-show="success">
		<h1 class="text-center">SUCCESS</h1>
		<h2 class="text-center">Bạn đã hoàn thành bài test</h2>	
		<div class="col-sm-4 col-sm-offset-4">
		<hr>
			<md-button class="md-raised pull-left btn-success" aria-label="home" md-ripple-size="full" href="{{ url('/') }}"><i class="fa fa-fw fa-arrow-circle-o-left"></i>Trang chủ</md-button>
			<md-button class="md-raised pull-right md-warn btn-success" aria-label="result" md-ripple-size="full" href="{{ url('test/'.($data->key).'/result') }}">Kết quả<i class="fa fa-fw fa-arrow-circle-o-right"></i></md-button>
		</div>

	</div>
	</div>
	
@endsection
@section('js')
	<script src="{{ asset('public/js/frontend/progressController.js') }}" type="text/javascript" charset="utf-8" ></script>
@stop