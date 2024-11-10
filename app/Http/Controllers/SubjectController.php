<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\Subject;
use App\Models\Teatcher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Subject = Subject::all();
        return view('subject.index',compact('Subject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = grade::all();
        $Teatchers = Teatcher::all();
        return view('subject.create',compact('Grades','Teatchers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
      try {
          $request->validate([
            'name_subject'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',
            'Teatcher_id'=>'required',

        ]);

            $Subject = new Subject();
            $Subject->name_subject = $request->name_subject;
            $Subject->Grade_id = $request->Grade_id;
            $Subject->Class_id = $request->Class_id;
            $Subject->Teatcher_id = $request->Teatcher_id;
            $Subject->save();
            toastr()->success('تم الحفظ بنجاح');
            return back();
      } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        $subject = Subject::findOrFail($id);
        $Grades = grade::all();
        $Teatchers = Teatcher::all();
           return view('subject.edit',compact('subject','Grades','Teatchers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject,$id)
    {
        try {
          $request->validate([
            'name_subject'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',
            'Teatcher_id'=>'required',

        ]);

            $Subject = Subject::findOrFail($request->id);
            $Subject->name_subject = $request->name_subject;
            $Subject->Grade_id = $request->Grade_id;
            $Subject->Class_id = $request->Class_id;
            $Subject->Teatcher_id = $request->Teatcher_id;
            $Subject->save();
            toastr()->success('تم التعديل بنجاح');
            return back();
      } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,$id)
    {
      try {
            Subject::destroy($request->id);
          toastr()->success('تم الحذف بنجاح');
            return back();

       } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
    }
}
