<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*====================================
=            Authenticate            =
====================================*/
Route::auth();
/*=====  End of Authenticate  ======*/



/*================================
=            frondend            =
================================*/
Route::get('/', 'Frontend\HomeController@getIndex');
/*=====  End of frondend  ======*/
Route::group(['prefix' => 'test'], function(){
	Route::get('{slug}/{id}/info', 'Frontend\TestController@getIndex');
	Route::get('{token}/progress', ['middleware' => 'auth', 'uses' =>'Frontend\TestController@getTest']);
	Route::get('{token}/result', ['middleware' => 'auth', 'uses' =>'Frontend\TestController@getResult']);
});
Route::group(['prefix' => 'api'], function(){
	Route::group(['prefix' => 'test', 'middleware' => 'auth'], function(){
		Route::post('gen', 'Frontend\TestController@postGeneration');
		Route::post('start', 'Frontend\TestController@postStart');
		Route::post('next', 'Frontend\TestController@postNext');
	});
});


/*===============================
=            Backend            =
===============================*/
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
	Route::get('/', 'Backend\AdminController@getIndex');


	Route::group(['prefix' => 'question'], function() {
	    Route::get('{category}/{id}', 'Backend\QuestionController@getIndex')->where('id', '[0-9]+');
	    Route::get('{category}/{id}/{subcateory}/add', 'Backend\QuestionController@getAddQuestion')->where('id', '[0-9]+');
	});

	Route::group(['prefix' => 'category'], function() {
	    Route::get('/', 'Backend\CategoryController@getIndex');
	    Route::get('/{slug}-ca{id}/course', 'Backend\CourseController@getIndex')->where('id', '[0-9]+');
	});

	Route::group(['prefix' => 'api'], function() {
		
		Route::group(['prefix' => 'level'], function() {
		    Route::get('/', 'Backend\LevelController@getIndex');
		});
		Route::group(['prefix' => 'course'], function() {
		    Route::get('/{id}', 'Backend\CourseController@getListCourse')->where('id', '[0-9]+');
		    Route::post('/store', 'Backend\CourseController@postStore');
		    Route::post('/update', 'Backend\CourseController@postUpdate');
		});
		Route::group(['prefix' => 'question'], function() {
		    Route::get('/{id}', 'Backend\QuestionController@getQuestion')->where('id', '[0-9]+');
		    Route::post('store', 'Backend\QuestionController@postStore');
		    Route::post('update', 'Backend\QuestionController@postUpdate');
		    Route::post('delete', 'Backend\QuestionController@postDelete');
		    Route::get('show/{id}', 'Backend\QuestionController@getQuestionId')->where('id', '[0-9]+');
		});
	    Route::group(['prefix' => 'category'], function() {
		    Route::get('/', 'Backend\CategoryController@getCategoryList');
		    Route::post('store', 'Backend\CategoryController@postStore');
		    Route::post('update', 'Backend\CategoryController@postUpdate');
		    Route::post('delete', 'Backend\CategoryController@postDelete');
		});
	});    
});
/*=====  End of Backend  ======*/
