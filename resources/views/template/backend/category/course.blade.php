@extends('template.backend.master')
@section('appname', 'E-learning')
@section('title', $category->title .' Course manager')
@section('css')
	@include('template.backend.css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/backend/question/index.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/preloading.min.css') }}">
@endsection
@section('wrapper')
	<div id="loading">
		<div class="cssload-thecube" >
			<div class="cssload-cube cssload-c1"></div>
			<div class="cssload-cube cssload-c2"></div>
			<div class="cssload-cube cssload-c4"></div>
			<div class="cssload-cube cssload-c3"></div>
		</div>
	</div>
	
	<div ng-controller = "CourseController" style="overflow-x: hidden;">
		<div class="row" style="background-color: #673AB7; padding-bottom: 100px">
			<div class="container">
				<div layout-padding class="col-sm-12 color-white">
				<input type="hidden" name="" value="{{ $category->id}}" class="category_id">
					<h2>{{ $category->title}} - Course manager</h2>
					<p>{{ $category->description }}</p>
				</div>
			</div>
			
		</div>
		<md-progress-linear md-mode="indeterminate" ng-show="toggleProgess"></md-progress-linear>
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<md-card md-theme="default" md-theme-watch>
				        <md-card-title>
				          <md-card-title-text>
				            <span class="md-headline">Danh sách đề tài</span>
				            <span class="md-subhead">Hiện có @{{courses.length}} đề tài</span>
				          </md-card-title-text>			         
				        </md-card-title>
				        <md-card-content>
				        	<ul class="list-group">
				        		<li class="list-group-item" ng-repeat="course in courses">@{{ course.title }} <span class="pull-right"><i class="fa fa-fw fa-trash"></i><i class="fa fa-fw fa-cog"></i></span></li>
				        	</ul>
				        </md-card-content>
				        <md-card-actions layout="row" layout-align="end center">
				          <md-button ng-click="changeToggleAdd()">Thêm chủ đề</md-button>
				        </md-card-actions>
				      </md-card>
					<p></p>
				</div>
				<div class="col-sm-8" ng-show="toggleAdd">					
					<h2 class="text-center">THÊM MỚI</h2>
					<hr class="line">
					<div class="step-one" ng-hide = "nextStep">
						<md-input-container class="md-block">
					        <label>Tên chủ đề</label>
					        <input type="text" required ng-model="newCourse.title">
					    </md-input-container>
					    <div layout="row" st>
							 <md-input-container flex>
						        <label>Số câu hỏi (câu)</label>
						        <md-select ng-model="newCourse.nums">
						          <md-option ng-repeat="num in config.nums" value="@{{num}}" >
						            @{{num}}
						          </md-option>
						        </md-select>
						    </md-input-container>
						    <md-input-container flex>
						        <label>Thời gian làm bài (phút)</label>
						         <md-select ng-model="newCourse.time">
						          <md-option ng-repeat="time in config.time" value="@{{time}}" >
						            @{{time / 60}}
						          </md-option>
						        </md-select>
						    </md-input-container>
						</div>
					    <md-input-container class="md-block">
					        <textarea required ng-model="newCourse.description"  aria-label="description"></textarea>
					    </md-input-container>
					    <hr>
					    <md-button class="md-raised md-warn pull-left" aria-label="cancel" md-ripple-size="full" ng-click="cancelToggleAdd()"><i class="fa fa-fw fa-close"></i> Hủy bỏ</md-button>
						<md-button class="md-raised md-primary pull-right" aria-label="next" md-ripple-size="full" ng-click="changeNextStep()">Next step <i class="fa fa-fw fa-arrow-right"></i></md-button>					    
					</div>
					<div class="step-two" ng-show="nextStep">
					    <hr>
					    <md-button class="md-raised md-warn pull-left" aria-label="cancel" md-ripple-size="full" ng-click="cancelToggleAdd()"><i class="fa fa-fw fa-close"></i> Hủy bỏ</md-button>
						<md-button class="md-raised md-primary pull-right" aria-label="next" md-ripple-size="full">Hoàn tất<i class="fa fa-fw fa-arrow-right"></i></md-button>					    
					</div>
				    
				</div>
				<div class="col-sm-7">
					
				</div>
			</div>
		</div>
		
	</div>
@endsection
@section('js')
	<script src="{{ asset('public/components/tinymce-dist/tinymce/tinymce.min.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('js/backend/courseController.js') }}"></script>
	<script>tinymce.init({ selector:'textarea' });</script>
	<script>
        $(window).load(function() {
            setTimeout(function(){
            	$("#loading").fadeOut(1000);
            }, 1000)
        });
    </script>
@stop