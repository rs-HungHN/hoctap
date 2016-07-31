@extends('template.backend.master')
@section('appname', 'E-learning')
@section('title', 'Admin control panel')
@section('css')
	@include('template.backend.css')
@endsection
@section('wrapper')
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="well">
					<div class="jumbotron">
						<h2>Hướng dẫn thêm câu hỏi</h2>
						<button class="btn btn-primary">Xem thêm</button>
					</div>
				</div>
			</div>
			<div class="col-sm-12" data-masonry='{ "itemSelector": ".col-sm-4"}' style="padding: 0px;">
				@foreach ($data as $element)
					<div class="col-sm-4" >
						<div class="panel panel-primary">
							<div class="panel-heading">								
								<h3 class="panel-title"><a href="{{ $element['slug'] }}">{{ $element['title'] }}</a></h3>
							</div>
							<div class="panel-body">
								<p>{{ $element['description'] }}</p>
								<div class="list-group">
									@foreach ($element['sub'] as $key)
										<a href="#" class="list-group-item">{{ $key['title'] }}</a>
									@endforeach
								</div>
								<a href="" title="">Xem thêm</a>							
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script type="text/javascript" src="{{ asset('components/masonry/dist/masonry.pkgd.min.js') }}"></script>
@stop