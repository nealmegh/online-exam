<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\MockTest;
use App\Models\MockTestItems;
use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view('Backend.Question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Question.create');
    }

    public function testExam()
    {
        $questions = Question::all();
//        dd($question);
        return view('Backend.Question.test', compact('questions'));
    }
    public function testExamDemo()
    {

        $user = Auth::user();
        $mockTestData = ['user_id' => $user->id];
        $mockTest = MockTest::create($mockTestData);


        $mcqQuestions = Question::where('type', 'mcq')->get();
        if(count($mcqQuestions) >= 21)
        {
            $FinalmcqQuestions = $mcqQuestions->random(21);
        }
        else
        {
            $FinalmcqQuestions = $mcqQuestions;
        }

        $dndQuestions = Question::where('type', 'dnd')->get();
        if(count($dndQuestions) >= 15)
        {
            $FinaldndQuestions = $dndQuestions->random(15);
        }
        else
        {
            $FinaldndQuestions = $dndQuestions;
        }
        // dd($FinaldndQuestions,$FinalmcqQuestions );
        $questions = $FinalmcqQuestions->merge($FinaldndQuestions);
        // dd($questions);

        foreach ($questions as $question)
        {
            $questionData =
                [
                    'text' => $question->text,
                    'type' => $question->type,
                    'text_url'=> $question->text_url,
                    'number_answers'=> $question->nummber_answers,
                    'mark_distribution'=> $question->mark_distribution,
                    'question_id'=> $question->id,
                    'mock_test_id'=> $mockTest->id,
                    'answer_text'=> $question->answers->text,
                    'correct_answer'=> $question->answers->correct_answer,
                    'category_id'=> $question->category_id,
                    'isPro'=> $question->isPro,
                    'explanation'=> $question->explanation,
                ];
            MockTestItems::create($questionData);
        }
//        dd($questions);
//        $question = $questions[0];
        return view('Backend.Question.demotest', compact('questions', 'user', 'mockTest'));
//        return view('Backend.Question.test', compact('question', 'user', 'mockTest'));
    }
    public function testExamStore(Request $request)
    {
//        dd($request->all());
        $mockTest = MockTest::where('id', $request->mock_test_id)->first();
        $user = User::where('id', $request->user_id)->first();
        $request->request->remove('_token');
        $request->request->remove('user_id');
        $request->request->remove('mock_test_id');
        $user_answers = $request->all();
        $total_obtained_number = 0;
        $total_number = 0;

        foreach ($user_answers as $key => $user_answer)
        {
            $obtained_number = 0;
            $question_id = ltrim($key, 'question');
            $mockTestItem = MockTestItems::where('mock_test_id', $mockTest->id)->where('question_id', $question_id)->first();
            if(!is_array($user_answer))
            {
                if($mockTestItem->correct_answer == $user_answer){
                    $obtained_number = $mockTestItem->mark_distribution;
                }
                $total_number += $mockTestItem->mark_distribution;
                $total_obtained_number += $obtained_number;
                $mockTestItem->user_answer = $user_answer;
                $mockTestItem->number = $obtained_number;
                $mockTestItem->save();
            }
            else{
                $dndCheck = 0;
                $mTCorrectAnswers = json_decode( $mockTestItem->correct_answer);

                foreach ($user_answer as $keyDND => $answer)
                {
                    if($answer == $mTCorrectAnswers[$keyDND])
                    {
                        $dndCheck += 1;
                    }
                }
                if($dndCheck == count($mTCorrectAnswers))
                {
                    $obtained_number = $mockTestItem->mark_distribution;
                }
                $total_number += $mockTestItem->mark_distribution;
                $total_obtained_number += $obtained_number;
                $mockTestItem->user_answer = json_encode($user_answer);
                $mockTestItem->number = $obtained_number;
                $mockTestItem->save();

            }

        }
        $mockTest->total_number = $total_number;
        $mockTest->obtained_number = $total_obtained_number;
        $mockTest->status = true;
        $mockTest->save();
        return view('Backend.Question.testEnd', compact('total_obtained_number', 'total_number'));
//        return route();
    }
    public function practiceDnd()
    {
        $questions = Question::where('type', 'dnd')->get();
//        if(count($dndQuestions) >= 21)
//        {
//            $FinalDndQuestions = $dndQuestions->random(21);
//        }
//        else
//        {
//            $FinalDndQuestions = $dndQuestions;
//        }

//        $questions = $FinalDndQuestions;

        return view('Backend.Question.practiceDnd', compact('questions'));
    }
    public function practiceMcq()
    {
        $questions = Question::where('type', 'mcq')->get();
//        if(count($mcqQuestions) >= 21)
//        {
//            $FinalmcqQuestions = $mcqQuestions->random(21);
//        }
//        else
//        {
//            $FinalmcqQuestions = $mcqQuestions;
//        }
//
//        $questions = $FinalmcqQuestions;

        return view('Backend.Question.practiceMcq', compact('questions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        $question = [];
        $answers = [];
        $questions = [];
        $answersArray = $request->addMoreInputFields;
        foreach ($answersArray as $answerArray)
        {
            $answers[] = $this->xtrim($answerArray['subject']);
        }
        if($request->type_id == 'mcq')
        {
            $data = [
                'text' => $request->text,
                'category_id' => $request->category_id,
                'type' => $request->type_id,
                'number_answers' => 1,
                'mark_distribution' => 1,
            ];
            $question = Question::create($data);
            $correct_answer = $request->correct_answer;
            $answerData = [
                'text' => json_encode($answers),
                'correct_answer' => $this->xtrim($correct_answer),
                'question_id' => $question->id
            ];
            Answer::create($answerData);
        }
        if($request->type_id == 'dnd')
        {
            $questionsArray = $request->addMoreQuestionFields;
            foreach ($questionsArray as $questionArray)
            {
                $questions[] = $this->xtrim($questionArray['question']);
            }
//            dd($questions, $answers);
//            dd(count($questions) >= count($answers));
            if (count($questions) > count($answers))
            {
                return redirect()->back()->withInput()->with('message', 'Number of Answers are not Correct');
            }
            $data = [
                'text' => json_encode($questions),
                'category_id' => $request->category_id,
                'type' => $request->type_id,
                'number_answers' => count($questions)-1,
                'mark_distribution' => 1,
            ];
            $question = Question::create($data);
            $c = $request->correct_answer;
            $c = explode(' ', $c);
            $correct_answer = json_encode($c);
            $answerData = [
                'text' => json_encode($answers),
                'correct_answer' => $this->xtrim($correct_answer),
                'question_id' => $question->id
            ];
            Answer::create($answerData);
        }

        return redirect()->back()->with('message', 'Question Added');
    }
    function xtrim ( $str )
    {
        return trim(preg_replace('/\\s+/',' ',$str));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('Backend.Question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {

//        $question = [];
        $answers = [];
        $questions = [];
        $answersArray = $request->addMoreInputFields;
        foreach ($answersArray as $answerArray)
        {
            if($answerArray['subject'] != null)
            {
                $answers[] = $this->xtrim($answerArray['subject']);
            }
        }
        if($request->type_id == 'mcq')
        {
            $data = [
                'text' => $request->text,
                'category_id' => $request->category_id,
                'type' => $request->type_id,
                'number_answers' => 1,
                'mark_distribution' => 1,
            ];
            $question->update($data);
            $correct_answer = $request->correct_answer;
            $answerData = [
                'text' => json_encode($answers),
                'correct_answer' => $this->xtrim($correct_answer),
                'question_id' => $question->id
            ];
            $question->answers->update($answerData);
        }
        if($request->type_id == 'dnd')
        {
            $questionsArray = $request->addMoreQuestionFields;
            foreach ($questionsArray as $questionArray)
            {
                $questions[] = $this->xtrim($questionArray['question']);
            }
//            dd(count($questions)-count($answers) != 1);
            if (count($questions) >= count($answers))
            {
                return redirect()->back()->withInput()->with('message', 'Number of Answers are not Correct');
            }
            $data = [
                'text' => json_encode($questions),
                'category_id' => $request->category_id,
                'type' => $request->type_id,
                'number_answers' => count($questions),
                'mark_distribution' => 1,
            ];
            $question->update($data);
            $c = $request->correct_answer;
            $c = explode(' ', $c);
            $correct_answer = json_encode($c);
            $answerData = [
                'text' => json_encode($answers),
                'correct_answer' => $this->xtrim($correct_answer),
                'question_id' => $question->id
            ];
            $question->answers->update($answerData);
        }

        return redirect()->route('questions.index')->with('message', 'Question Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
    public function delete(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('message', 'Question Deleted');
    }
}
