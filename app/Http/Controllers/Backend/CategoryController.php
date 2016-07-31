<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Course;
use App\Http\Controllers\Controller;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;

class CategoryController extends Controller {

	public function getIndex() {
		return view("template.backend.category.index");
	}
	/**
	 *
	 * dành cho gọi api
	 *
	 */
	public function getCategoryList(Request $request) {
		$category = Category::all()->toArray();
		for ($i = 0; $i < count($category); $i++) {
			$category[$i]['sub'] = Course::where('category_id', '=', $category[$i]['id'])->get(['id', 'title', 'category_id', 'active', 'nums', 'time', 'description'])->toArray();
		}
		return response()->json($category, 200);
	}

	public function postStore(Request $request) {
		$category              = new Category();
		$slug                  = new Slugify();
		$category->title       = $request->title ?: '';
		$category->slug        = $slug->slugify($category->title);
		$category->description = $request->description?:'';
		$category->save();
		return response()->json($category, 200);
	}

	public function postUpdate(Request $request) {
		$category = Category::find($request->id ?: 0);
		if (count($category) != 0) {
			if ($category->title != $request->title) {
				$category->title = $request->title;
				$slug            = new Slugify();
				$category->slug  = $slug->slugify($request->title);
			}
			if ($category->description != $request->description) {
				$category->description = $request->description;
			}
			$category->update();
			return response()->json(['status' => $request->title], 200);
		} else {
			return response()->json(['status' => "Not found"], 400);
		}

	}

	public function postDelete(Request $request) {
		$category = Category::find($request->id ?: 0);
		if (count($category) != 0) {			
			$category->delete();
			return response()->json(['status' => 'Deleted ' . $request->title], 200);
		} else {
			return response()->json(['status' => "Not found"], 400);
		}

	}
}
