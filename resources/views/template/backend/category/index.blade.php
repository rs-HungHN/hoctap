@extends('template.backend.master')
@section('appname', 'E-learning')
@section('title', 'Category manage')
@section('css')
	@include('template.backend.css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/preloading.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/backend/category/index.css') }}">
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
	<div style="background-color: #673AB7; padding: 100px">
			<div class="container">
				<div layout-padding class="col-sm-12 color-white">
					<h3>Quản lý chuyên mục</h3>
				</div>
			</div>
			
		</div>
	<div class="container" ng-controller="CategoryController">
		<md-button class="md-fab add-button fa fa-plus pull-right" aria-label="description"  md-ripple-size="auto" ng-click="addCategory()">
					<md-tooltip md-direction="top" md-visible="tooltipVisible" >Thêm chủ đề mới</md-tooltip>
				</md-button>
		<div class="row">			
			<div class="col-sm-12">
					<div class="row">						
						<md-input-container class="md-block" flex-xs flex="40" flex-offset="55">
				            <label>Tìm kiếm chủ đề bạn muốn</label>
				            <input ng-model="strFilter">
				        </md-input-container>
					</div>
					<div layout="row" layout-wrap layout-xs="column" class="md-padding" ng-hide="toggleCourse">
						<div flex="33" flex-xs="100" ng-repeat="category in categoryList | filter : strFilter" style="padding: 0px">
							<md-card md-theme="default" md-theme-watch>
						        <md-card-title>
						          <md-card-title-text>
						            <span class="md-headline"  {{-- ng-click="focusCategory(category)" --}} ng-click="addCourse(category)">
								    @{{ category.title }} </span>
						            <span class="md-subhead">Hiện có @{{ category.sub.length }} tập đề<span class="pull-right">					            
										<i class="fa fa-fw fa-trash fa-2x" ng-click="deleteCategory(category)"  title="Xóa chủ đề"></i>
										<i class="fa fa-fw fa-wrench fa-2x" ng-click="editCategory(category)"  title="Chỉnh sửa chủ đề"></i>
										<i class="fa fa-fw fa-plus fa-2x" ng-click="redirect(category)"  title="Thêm tập câu hỏi mới vào chủ đề"></i>
									</span></span>
						            <hr>
						          </md-card-title-text>
						        </md-card-title>
						        <md-card-content>
						        	<ul class="list-group">
						        		<li class="list-group-item" ng-repeat="course in category.sub" ng-click="editCourse(course)">
						        		@{{ course.title}}
						        		<span class="badge pull-right">@{{ course.active}}</span>
						        		</li>
						        	</ul>
						        </md-card-content>
						      </md-card>
						    </div>
					</div>

					<div class="col-sm-8 col-sm-offset-2" ng-show="toggleCourse" style="padding-bottom: 50px">
						<div class="col-sm-12" ng-show="toggleCourseAdd">
							<h2 class="text-center">NEW COURSE</h2>							
								<hr class="line">
								<h4 class="text-center">@{{focusData.title}}</h4>
								<div ng-hide = "nextStep">
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
								        <textarea required data-ui-tinymce id="tinymce2" ng-model="newCourse.description"  aria-label="description"></textarea>
								    </md-input-container>
								    <hr>
								    <md-button class="md-raised md-warn pull-left" aria-label="cancel" md-ripple-size="full" ng-click="cancelToggle()"><i class="fa fa-fw fa-close"></i> CANCEL</md-button>
									<md-button class="md-raised md-primary pull-right" aria-label="next" md-ripple-size="full" ng-click="saveCourse()">SUCCESS <i class="fa fa-fw fa-arrow-right"></i></md-button>					    
								</div>
						</div>
						<div class="col-sm-12" ng-show="toggleCourseEdit">
							<h2 class="text-center">EDIT COURSE</h2>							
								<hr class="line">
								<h4 class="text-center">@{{focusData.title}}</h4>
								<div ng-hide = "nextStep">
									<md-input-container class="md-block">
								        <label>Tên chủ đề</label>
								        <input type="text" required ng-model="focusData.title">
								    </md-input-container>
								    <div layout="row" st>
										 <md-input-container flex>
									        <label>Số câu hỏi (câu)</label>
									        <md-select ng-model="focusData.nums">
									          <md-option ng-repeat="num in config.nums" value="@{{num}}" >
									            @{{num}}
									          </md-option>
									        </md-select>
									    </md-input-container>
									    <md-input-container flex>
									        <label>Thời gian làm bài (phút)</label>
									         <md-select ng-model="focusData.time">
									          <md-option ng-repeat="time in config.time" value="@{{time}}" >
									            @{{time / 60}}
									          </md-option>
									        </md-select>
									    </md-input-container>
									</div>
								    <md-input-container class="md-block">
								        <textarea required data-ui-tinymce id="tinymce3" ng-model="focusData.description"  aria-label="description"></textarea>
								    </md-input-container>
								    <hr>
								    <md-button class="md-raised md-warn pull-left" aria-label="cancel" md-ripple-size="full" ng-click="cancelToggle()"><i class="fa fa-fw fa-close"></i> CANCEL</md-button>

									<md-button class="md-raised md-primary pull-right" aria-label="next" md-ripple-size="full" ng-click="updateCourse()">UPDATE <i class="fa fa-fw fa-arrow-right"></i></md-button>					    
									<md-button class="md-raised md-warn pull-right" aria-label="cancel" md-ripple-size="full" ng-click="deleteCourse()"><i class="fa fa-fw fa-close"></i> DELETE</md-button>
								</div>

						</div>
					</div>	
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script src="{{ asset('public/components/tinymce-dist/tinymce/tinymce.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/tinymce.angular.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/backend/categoryController.js') }}"></script>
	<script>
        $(window).load(function() {
            setTimeout(function(){
            	$("#loading").fadeOut(1000);
            }, 1000)
        });
    </script>
@stop