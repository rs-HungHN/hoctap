<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Category;
use App\Course;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data = Category::all()->toArray();
        for($i = 0; $i < count($data); $i++){
            $data[$i]['subCategory'] = Course::where('category_id', '=', $data[$i]['id'])->get()->toArray();
        }
        return view('template.frontend.home.index',['category' => $data]);
    }
}
