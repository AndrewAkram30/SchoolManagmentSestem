<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\Teatcher;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Quizzes = Quiz::all();
        return view('quiz.index',compact('Quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['Grades'] = grade::all();
        $data['Subjects'] = Subject::all();
        $data['Teatchers'] = Teatcher::all();
        return view('quiz.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $quizzes = new Quiz();
            $quizzes->name = $request->name;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();
            toastr()->success(trans('messages.success'));
             return back();
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quizz = Quiz::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teatcher::all();
        return view('pages.Quizzes.edit', $data, compact('quizz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $quizz = Quiz::findorFail($request->id);
            $quizz->name = $request->name;
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->save();
            toastr()->success(trans('messages.Update'));
            return back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
        try {
            Quiz::destroy($request->id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    }

