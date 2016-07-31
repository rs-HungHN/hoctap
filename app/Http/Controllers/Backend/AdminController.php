<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class AdminController extends Controller
{
	/**
	 * [getIndex description]
	 * @return [type] [description]
	 */
    public function getIndex()
    {
    	$category = Category::where('category_id', '=', 0)->get()->toArray();
    	for($i = 0; $i < count($category); $i++){
    		$category[$i]['sub'] = Category::where('category_id', '=', $category[$i]['id'])->get()->toArray();
    	}
    	return view('template.backend.analyst.index', ['data' => $category]);
    }
}
