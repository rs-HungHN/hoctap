@extends('template.frontend.master')
@section('appname', 'GMOZ E-learning')
@section('title', 'Home')
@section('css')
	@include('template.frontend.css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/frontend/home/index.css') }}">
@endsection
@section('wrapper')
	<div class="fixed-style">
			<div class="container">
				<div layout-padding layout-wrap class="color-white" layout="row" layout-xs="column">
					<div flex-gt-sm="40" flex="100">
						<img src="{{ asset('images/banner.png') }}" alt="" class="img-responsive center-block" width="200">
					</div>
					<div flex-gt-sm="60" flex="100">
						<h2>Test Programmers Online </h2>
						<h4>How it works:</h4>
						<ol>
							<li>Send your job candidate a link to the programming test</li>
							<li>Receive the report by email when an applicant finishes the test</li>
							<li>If the result is unsatisfactory, congratulations, you just saved your time!<br/> If the result is acceptable, go ahead, invite a potential employee to the interview!</li>
						</ol>
					</div>
					
				</div>
					
			</div>
			
		</div>
		<div class="container main">
			<div layout="row" layout-wrap layout-xs="column">					
						@forelse ($category as $cate)
							<div flex="100" flex-gt-sm="33" class="main-column">
								<h3 class="text-center">{{$cate['title']}}</h3>
									@if (count($cate['subCategory']) == 0)
										<p>Coming soon!</p>
									@endif
									@foreach ($cate['subCategory'] as $sub)
										<p class="text-center"><a href="{{url('/test/'.$sub['slug'].'/'.$sub['id'].'/info')}}">{{$sub['title']}}</a>
											<br><small>{{$sub['nums']}} câu hỏi/ {{$sub['time']/60}} phút</small>
										</p>
									@endforeach
							</div>
						@empty
							{{-- empty expr --}}
						@endforelse	
			</div>
		</div>

@endsection
@section('js')
	
@stop