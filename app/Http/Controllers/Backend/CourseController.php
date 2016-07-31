<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\Course;
use Cocur\Slugify\Slugify;
class CourseController extends Controller
{
	/**
	 * Quản lý course của một category
	 * @param  string  $slug [description]
	 * @param  integer $id   [description]
	 * @return view
	 */
    public function getIndex($slug='', $id = 0)
    {
    	$category = Category::where('id', '=', $id)->first();
    	return view('template.backend.category.course', ['category' => $category]);
    }
    /**
     * Lấy danh sách các course trong một category
     * @param  integer $id 
     * @return json
     */
    public function getListCourse($id = 0)
    {
    	$courses = Course::where('category_id', '=', $id)->get()->toArray();
    	return response()->json($courses, 200);
    }

    public function postStore(Request $request)
    {
    	$slug = new Slugify();
    	$course = new Course();
    	$course->category_id = $request->category_id;
    	$course->title = $request->title;
    	$course->slug        = $slug->slugify($course->title);
    	$course->description = $request->description;
    	$course->nums = $request->nums;
    	$course->time = $request->time;
    	$course->save();
    	return response()->json(['status' => $course->title], 200);
    }
    public function postUpdate(Request $request)
    {
    	$course = Course::where('id', '=', $request->id)->first();
    	$slug = new Slugify();
    	$course->title = $request->title;
    	$course->slug        = $slug->slugify($course->title);
    	$course->description = $request->description;
    	$course->nums = $request->nums;
    	$course->time = $request->time;
    	$course->update();
    	return response()->json(['status' => $course->title], 200);
    }
}
