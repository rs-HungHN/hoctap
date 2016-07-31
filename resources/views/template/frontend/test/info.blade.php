@extends('template.frontend.master')
@section('appname', 'GMOZ E-learning')
@section('title', $current['title'])
@section('css')
	@include('template.frontend.css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend/test/index.css') }}">
@endsection
@section('wrapper')
	<div class="fixed-style" >
			<div class="container">
				<div layout-padding layout-wrap class="color-white" layout="row" layout-xs="column">
					<div flex-gt-sm="40" flex="100">
						<img src="{{ asset('images/banner.png') }}" alt="" class="img-responsive center-block" width="200">
					</div>
					<div flex-gt-sm="60" flex="100">
						<h1 class="text-right">{{ $fatherCategory['title']}} - {{ $current['title'] }}</h1>
						<h2 class="text-right">Test Programming Skills & Knowledge</h2>
						<hr>
						<p style="font-size: 20px;"><i class="fa fa-fw fa-clock-o"></i><span style="line-height: 50px;">{{ round($current['time'] / 3600) }} hours {{ $current['time'] / 60 %60 }} mins</span></p>
						<p style="font-size: 20px;"><i class="fa fa-fw fa-question-circle-o"></i> {{ $current['nums'] }} câu</p>
					</div>

				</div>

			</div>

		</div>
		<div class="container main"  style="margin-top: -90px;" ng-controller="TestController">
			<div layout="row" layout-wrap layout-xs="column">
				<div flex-gt-sm="30" flex="100">
					<md-card>
						<md-card-title style="border-bottom: 1px solid #A9B0B0; margin-bottom: 50px">
							<md-card-title-text class="text-center"><h4>Language</h4></md-card-title-text>
							<hr>
						</md-card-title>
						<md-card-content>
							<div class="list-group">
								@foreach ($category as $key)
									<a href="#" class="list-group-item">{{ $key['title'] }}</a>
								@endforeach
							</div>
						</md-card-content>
					</md-card>
				</div>
				<div flex="100" flex-gt-sm="70" style="padding: 150px 20px 20px 20px;">
					<h2 class="text-center">{{ $current['title'] }}</h2>
					<h4 class="text-center"><small>{{ $current['nums'] }} câu / {{ $current['time'] / 60 %60 }} mins</small></h4>
					<hr>
					<p class="text-left">{!! $current['description'] !!}</p>
					<hr>
					<div layout="row" layout-xs="column"   layout-align="center center">
						<md-button class="md-raised md-warn btn-play"  aria-label="description"  md-ripple-size="full" ng-click="testStart({{ $current['id'] }})">Bắt đầu test <i class="fa fa-fw fa-play"></i></md-button>
						@if (Auth::check())
							<md-button class="md-raised md-primary btn-play"  aria-label="description"  md-ripple-size="full">Gửi bài test <i class="fa fa-share-alt fa-fw"></i></md-button>
						@endif

					</div>

				</div>
			</div>
		</div>

@endsection
@section('js')
	<script src="{{ asset('public/js/frontend/testController.js') }}" type="text/javascript" charset="utf-8" ></script>
@stop