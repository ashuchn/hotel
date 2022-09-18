<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answers;
use App\Models\Question;
use Session;
use DB;

class QuizController extends Controller
{
   public function index()
   {
    $data = Quiz::all();
    return view('quiz.index', ['data' => $data]);
   }

   public function post_quiz(Request $request)
   {
        $length = 20;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $insert = new Quiz;
        $insert->quiz_title = $request->quiz_title;
        $insert->quiz_starts_on = $request->startTime;
        $insert->quiz_ends_on = $request->endTime;
        $insert->quizId = $randomString;
        $insert->save();

        if($insert){
            return redirect()->route('quiz-dashboard')->with('status', 'Quiz Added');
        } else {
            return redirect()->route('quiz-dashboard')->with('status', 'Some Error occured');
        }

   }


   public function add_quiz($quizId)
   {
        $quiz = Quiz::where('quizId', $quizId)->get();
        $questions = Question::where('quizId', $quizId)->get();
        return view('quiz.addQuestion', ['quiz'=>$quiz, 'questions' => $questions ]);

   }

   public function post_question(Request $request, $quizId)
   {
        // return $request;
        // exit;
        $questionAdd =  Question::create([
            "question_title" => $request->question,
            "quizId" => $quizId
        ]);
        $questionId = $questionAdd->id;
        // return $questionId;

        foreach($request->options as $opt) {
            DB::table('answer')->insert([
                "qid" => $questionId,
                "answer_text" => $opt 
            ]);
        }

        return redirect()->back()->with('status','Question Added');

   }

   public function publish_quiz($quizId)
   {
        $update = Quiz::where('quizId', $quizId)->update([
            "is_published" => 1
        ]);

        return redirect()->back()->with('status', 'Quiz Published');
   }


}
