@extends('template.backend.master')
@section('appname', 'E-learning')
@section('title', 'Category manage')
@section('css')
	@include('template.backend.css')
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/backend/question/index.css') }}">
	
@endsection
@section('wrapper')

	<div ng-controller = "QuestionController" style="overflow-x: hidden;">
		<div class="row" style="background-color: #673AB7; padding-bottom: 100px">
			<div class="container">
				<div layout-padding class="col-sm-12 color-white">
				<input type="hidden" name="" value="{{ $category->id}}" class="category_id">
					<h2>{{ $category->title}}</h2>
					<p>{{ $category->description }}</p>
					@if (!Auth::guest())
						<p>{{ Auth::user()->role }}</p>
					@endif
				</div>
			</div>
			
		</div>
		<md-progress-linear md-mode="indeterminate" ng-show="toggleError"></md-progress-linear>
		<div class="row" ng-show="toggle">
			<div class="col-sm-1 col-sm-offset-9" >
				
			</div>
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2" style="margin-top: -109px;">
					<md-card md-theme="default" md-theme-watch>
					        <md-card-title>
					          <md-card-title-text>

					            <span class="md-headline text-center">Ngân hàng câu hỏi <md-button class="md-fab add-button fa fa-plus pull-right" aria-label="description"  md-ripple-size="auto" ng-click="toggleClick(null, 'ADD')">
					<md-tooltip md-direction="top" md-visible="tooltipVisible" >Thêm câu hỏi mới</md-tooltip>
				</md-button></span>
					            <span class="md-subhead">Hiện có @{{data.length || 0}} câu hỏi
      						</span>
					          </md-card-title-text>
					        </md-card-title>
					        <md-card-content>
					        	<md-list>
								  <md-list-item ng-repeat="q in data">
								    <p>@{{ q.content }}</p>
								    <span class="badge pull-right">@{{ checkLevel(q) }}</span>				    
								    <md-button aria-label="delete" class="md-fab md-raised md-mini fa fa-trash" ng-click="deleteQuestion(q)"></md-button>
								    <md-button aria-label="edit" class="md-fab md-raised md-mini fa fa-cog" ng-click="toggleClick(q,'EDIT')"></md-button>					
								  </md-list-item>						  
								</md-list>	
					        </md-card-content>
				     	 </md-card>
					</div>
					{{-- <div class="col-sm-5">
						 <md-card md-theme="default" md-theme-watch>
					        <md-card-title>
					          <md-card-title-text>
					            <span class="md-headline">Các tập đề hiện có</span>
					            <span class="md-subhead">hiện có 0 tập đề 
      						</span>
					          </md-card-title-text>
					        </md-card-title>
					        <md-card-content>
					        	<md-list>
								  <md-list-item ng-repeat="q in data" class="md-whiteframe-2dp">
								    <p>@{{ q.content }}</p>
								    <span class="badge pull-right">disable</span>				    
								    <md-button aria-label="delete" class="md-fab md-raised md-mini fa fa-trash" ng-click="deleteQuestion(q)"></md-button>
								    <md-button aria-label="edit" class="md-fab md-raised md-mini fa fa-cog" ng-click="toggleClick(q,'EDIT')"></md-button>					
								  </md-list-item>						  
								</md-list>	
					        </md-card-content>
					        <md-card-actions layout="row" layout-align="end center">
					          <md-button>Thêm bằng tay</md-button>
					          <md-button>Thêm thông minh</md-button>
					        </md-card-actions>
				     	 </md-card>
					</div> --}}
				</div>
			</div>			
		</div>
		<div class="row" ng-hide="toggle">
			<div class="col-sm-6 col-sm-offset-3" style="margin-top: -109px;">
				<md-card md-theme="default" md-theme-watch>
					<md-card-title class="question-title">
				          <md-card-title-text>
				          	<h3 class="text-center">@{{ action }} QUESTION</h3>
				          </md-card-title-text>			          
			        </md-card-title>
			        <md-card-title>
			          <md-card-title-text>
			          	<md-input-container>
					        <label>Level</label>
					        <md-select ng-model="question.levels_id">
					       {{--  @foreach ($level as $key)
					        	<md-option value="{{ $key->id }}">
					            {{ $key->title }}
					          	</md-option> --}}
					          	 <md-option ng-repeat="level in levels" value="@{{level.id}}">
						            @{{level.title}}
						          </md-option>
					       {{--  @endforeach --}}
					          
					        </md-select>
					      </md-input-container>
			            <md-input-container class="md-block">
				          <label>Nội dung câu hỏi</label>
				          <textarea ng-model="question.question" md-select-on-focus></textarea>
				        </md-input-container>
			          </md-card-title-text>			          
			        </md-card-title>
			        <md-card-content class="answer">
				        <md-content ng-repeat="answer in question.answer" class="md-block">
					        <md-input-container md-no-float class="margin-5px">	
						        <md-checkbox ng-checked="answer.isRight" ng-click="isRight(answer)" aria-label="Finished?"></md-checkbox>	
							</md-input-container>
						    <md-input-container md-no-float style="width: 80%" class="margin-5px">
								<textarea ng-model="answer.content" md-select-on-focus placeholder="Tùy chọn @{{$index + 1}}"></textarea>
							</md-input-container>
							<md-button class="md-icon-button fa fa-remove fa-2x color-gray" ng-click="removeAnswer(answer)" aria-label="remove"></md-button>
				        </md-content>

				        <md-content layout-wrap>
				        	<md-input-container style="margin: 5px">
				        			<md-checkbox md-indeterminate ng-click="addAnswer()" aria-label="add">Thêm tùy chọn	
						          </md-checkbox>
					        </md-input-container>			            
				        </md-content> 
			        </md-card-content>
			        <md-card-actions layout="row" layout-align="end center">
			          <md-button ng-click="toggleClick(null, null)">Hủy</md-button>
			          <md-button ng-click="saveQuestion()">Lưu</md-button>
			        </md-card-actions>
			      </md-card>
			</div>
		</div>
	</div>
@endsection
@section('js')
	<script type="text/javascript" src="{{ asset('js/backend/questionController.js') }}"></script>
@stop