<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Choice;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Level;
class QuestionController extends Controller {

	public function getIndex($category, $id) {
		$category = Category::find($id);
		$level = Level::all();
		return view("template.backend.question.index", ['category' => $category, 'level' => $level]);
	}

	public function getAddQuestion($category, $id, $subcategory) {
		$category = Category::find($id);
		return view("template.backend.question.add", ['category' => $category]);
	}

	public function getQuestion($category_id = 0) {
		$category = Category::where('id', '=', $category_id)->first();
		if (count($category) == 0) {
			return response()->json(['status' => 'Not found'], 400);
		}
		$questions = Question::where('category_id', '=', $category->id)->orderBy('id', "DESC")->get(['id', 'content', 'level_id']);
		return response()->json($questions, 200);
	}

	public function getQuestionId($question_id = 0) {
		$question = Question::where('id', '=', $question_id)->get(['id', 'category_id', 'content as question', 'level_id', 'created_at'])->first()->toArray();
		if (count($question) == 0) {
			return response()->json(['status' => 'Not found'], 400);
		}
		$question['answer'] = Choice::where('question_id', '=', $question['id'])->get(['id', 'content', 'is_right as isRight'])->toArray();
		return response()->json($question, 200);
	}

	public function postUpdate(Request $request) {
		$question = Question::where('id', '=', $request->id)->first();

		if (count($question) == 0) {
			return response()->json(['status' => 'Not found'], 400);
		}

		$question->content = $request->question ?: $question->content;
		$question->level_id   = $request->level_id ?: $question->level_id;
		$question->update();

		$newChoice = $request->answer;
		for ($i = 0; $i < count($newChoice); $i++) {
			if (!isset($newChoice[$i]['id'])) {
				$c               = new Choice();
				$c->question_id = $question->id;
				$c->content      = $newChoice[$i]['content'];
				$c->is_right     = $newChoice[$i]['isRight'];
				$c->save();
				$newChoice[$i]['id'] = $c->id;
			}
		}

		$oldChoice = Choice::where('question_id', '=', $question->id)->get();
		foreach ($oldChoice as $keyOld) {
			$flag = 0;
			foreach ($newChoice as $keyNew) {
				if ($keyOld->id == $keyNew['id']) {
					$keyOld->content  = $keyNew['content'];
					$keyOld->is_right = $keyNew['isRight'];
					$keyOld->update();
					$flag = 1;
				}

			}
			if ($flag == 0) {
				$keyOld->delete();
			}

		}
		return response()->json(['status' => 'success'], 200);
	}
	public function postStore(Request $request) {
		$category = Category::find($request->category_id ?: 0);
		if (count($category) == 0) {
			return response()->json(['status' => 'Bad request'], 400);
		}

		$question              = new Question();
		$question->content     = $request->question ?: '';
		$question->level_id     = $request->level_id ?: 1;
		$question->category_id = $category->id;
		$question->user_id    = Auth::user()->id;
		$question->save();

		foreach ($request->answer as $key) {
			$choice               = new Choice();
			$choice->question_id = $question->id;
			$choice->content      = $key['content'];
			$choice->is_right     = $key['isRight'];
			$choice->save();
		}
		return response()->json(['status' => 'success'], 200);
	}

	public function postDelete(Request $request) {
		$question = Question::find($request->id ?: 0);
		if (count($question) == 0) {
			return response()->json(['status' => 'Not found'], 404);
		}

		$question->delete();
		return response()->json(['status' => 'success '+$question->id], 200);
	}
}
