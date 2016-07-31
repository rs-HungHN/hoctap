<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Level;
class LevelController extends Controller
{
    /**
     * Trả về danh sách các level hiện có
     * @return json
     */
    public function getIndex()
    {
    	$levels = Level::all()->toArray();
    	return response()->json($levels, 200);
    }
}
