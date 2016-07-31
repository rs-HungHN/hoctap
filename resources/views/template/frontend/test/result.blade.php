@extends('template.frontend.master')
@section('appname', 'GMOZ E-learning')
@section('title', 'Are you ready?')
@section('css')
	@include('template.frontend.css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend/test/result.css') }}">
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
	<div class="fixed-style bg-white">
		<div class="container	">
			<hr class="line">
			<h1 class="text-center">KẾT QUẢ TEST</h1>
			<hr class="line">
			<h1 class="text-center">{{$course->title}}</h1>
			<hr>
			<h4 class="text-center"> Thời gian hoàn thành: {{round(($course->time - $test->time) / 60) }} phút {{($course->time - $test->time) % 60 }} s</h4>
			<h4 class="text-center">Số câu đúng: {{ $score }} / {{ $course->nums }}</h4>
			<p class="text-center map">{!! $map !!}</p>
			<hr class="line">
			<h2 class="text-center">Số điểm: {{ 100 / $course->nums *  $score}} </h2>
			<hr class="line">
	</div>
	
@endsection
@section('js')
	
@stop