<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Choice;
use App\Http\Controllers\Controller;
use App\Question;
use App\Course;
use App\CourseQuestion;
use App\UserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller {
	/**
	 * Test page
	 * @param  string $slug slug của category
	 * @param  int 	$id   id của
	 * @return [type]       [description]
	 */
	public function getIndex($slug, $id) {
		// biến phục vụ cho hiển thị category
		$data            = Category::where('id', '<>', 0)->orderBy('title')->get()->toArray();
		$currentCourse = Course::where('id', '=', $id)->get()->first();
		$fatherCategory  = Category::where('id', '=', $currentCourse->category_id)->get()->first()->toArray();
		// nếu ko có gì
		if (count($currentCourse) == 0) {
			return $id;
		}

		return view('template.frontend.test.info', ['category' => $data, 'current' => $currentCourse->toArray(), 'fatherCategory' => $fatherCategory]);
	}
	/**
	 * Test page
	 * @param  string $value mã key của bài test
	 * @return view
	 */
	public function getTest($key = '') {
		$data     = UserTest::where('key', '=', $key)->first();
		$course = Course::where('id', '=', $data->course_id)->first();
		// nếu bài test đã được làm
		if ($data->active == "disable") {
			return view('template.frontend.test.progress', ['course' => $course, 'data' => $data]);
		}
		// bài test bình thường
		return view('template.frontend.test.end', ['course' => $course, 'data' => $data]);
	}
	/**
	 * Result basic page
	 * @param  string $key mã key của bài test
	 * @return view
	 */
	public function getResult($key) {
		$test = UserTest::where('key', '=', $key)->first();
		// nếu bài test đã chưa đc kích hoạt
		if ($test->active == "disable") {
			return redirect('test/' . ($test->key) . '/progress');
		}
		$course = Course::where('id', '=', $test->course_id)->first();
		$result   = json_decode($test->result);
		$score    = 0;
		$map      = "";
		// bản đồ trả lời
		foreach ($result as $key) {
			if ($key->answer != 0) {
				$choice = Choice::where('id', '=', $key->answer)->first();
				if ($choice->is_right == 1) {
					$score++;
					$map = $map . "<span>Đ</span>";
				} else {
					$map = $map . "<span class=\"error\">S</span>";
				}

			} else {
				$map = $map . "<span class=\"error\">Null</span>";
			}

		}
		return view('template.frontend.test.result', ['course' => $course, 'test' => $test, 'score' => $score, 'map' => $map]);
	}
	/**
	 * tạo mới một bộ test cho user với bộ đề tương ứng
	 * @param  Request $request
	 * @return json
	 */
	public function postGeneration(Request $request) {
		$course = Course::where('id', '=', $request->id ?: 0)->first();
		// Kiểm tra nếu đã tạo mà chưa kích hoạt thì lấy luôn cái cũ
		$oldUserTest = UserTest::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $course->id)->where('active', '=', 'disable')->orderBy('id', 'DESC')->first();
		if (count($oldUserTest) != 0)
		// trả về key cũ
		{
			return response()->json(['key' => $oldUserTest->key], 200);
		}

		// tạo mới
		// lấy câu hỏi random
		$question = CourseQuestion::where('course_id', '=', $course->id)->take($course->nums)->inRandomOrder()->get();
		$dataQ    = [];
		// lấy đáp án của câu hỏi random
		foreach ($question as $key) {
			$choices = Choice::where('question_id', '=', $key->id)->inRandomOrder()->get()->toArray();
			$answer  = [];
			foreach ($choices as $key2) {
				$value = $key2['id'];
				array_push($answer, $value);
			}

			$value = [
				'question' => $key['id'],
				'answer'   => $answer,
			];
			array_push($dataQ, $value);
		}
		// tạo mới
		$userTest              = new UserTest();
		$userTest->user_id    = Auth::user()->id;
		$userTest->course_id = $course->id;
		$userTest->generation  = json_encode($dataQ);
		$userTest->save();
		$userTest->key = md5($userTest->id);
		$userTest->update();
		// trả về cái mới
		return response()->json(['key' => $userTest->key], 200);
	}
	/**
	 * Bắt đầu ghi nhận làm bài test
	 * @param  Request $request
	 * @return json
	 */
	public function postStart(Request $request) {
		/**

		TODO:
		- Thiếu Cập nhật trạng thái

		 */

		$test         = UserTest::where('key', '=', $request->key)->first();
		$test->result = "[]";
		$test->active = 'enable';
		$test->update();
		$course = Course::where('id', '=', $test->course_id)->first();
		$data     = ['key' => $test->key, 'time' => $course->time, 'nums' => $course->nums];
		return response()->json($data, 200);
	}
	/**
	 * Lấy câu hỏi tiếp theo
	 * @param  Request $request
	 * @return json
	 */
	public function postNext(Request $request) {
		$test       = UserTest::where('key', '=', $request->key)->first();
		$course   = Course::where('id', '=', $test->course_id)->first();
		$generation = json_decode($test->generation);
		// cập nhật kết quả
		if ($test->current != 0) {
			$test->timeout = $request->timeOut;
			$result        = json_decode($test->result);
			array_push($result, ['question' => $generation[$test->current - 1]->question, 'answer' => $request->answer]);
			$test->result = json_encode($result);
			$test->update();
		}
		// nếu là câu cuối
		if ($test->current == $course->nums) {
			return response()->json(['status' => "success"], 202);
		}

		if ($request->timeOut == 0) {
			return response()->json(['status' => "success"], 202);
		}

		// lấy câu hoit tiếp theo
		$question = Question::where('id', '=', $generation[$test->current]->question)->first();
		$answer   = [];
		foreach ($generation[$test->current]->answer as $key) {
			$choice = Choice::where('id', '=', $key)->first();
			array_push($answer, ['id' => $choice->id, 'content' => $choice->content]);
		}
		$data = [
			'num'      => $test->current + 1,
			'question' => $question->content,
			'answer'   => $answer,
			'action'   => $test->current + 1 == $course->nums ? "submit" : "next",
		];
		if ($test->current < $course->nums) {
			$test->current++;
			$test->update();
		}
		return response()->json($data, 200);
	}

}
