<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\grade;
use App\Models\section;
use App\Models\Teatcher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = grade::with(['Sections'])->get();
        $List_Grades = grade::all();
        $Sections = section::all();
        $Teatchers = Teatcher::all();
        return view('sections.section' , compact('Sections','Grades','List_Grades','Teatchers'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([

            'Name_Section'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',

        ]);
        $Sections=new section();
        section::create([
'Name_Section'=>$request->Name_Section,
'Grade_id'=>$request->Grade_id,
'Class_id'=>$request->Class_id,
'Status'=>1,
$Sections->Teatchers()->attach($request->teatcher_id),

        ]);
        toastr()->success('تمه الاضافه بنجاح');
        return redirect()->route('section.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, section $section)
    {
        $id = $request->id;
        $request->validate([
            'Name_Section' => 'required',



        ]);
        section::findOrFail($id)->updated([
            'Name_Section' => $request->Name_Section,

        ]);

          toastr()->success('تمه التعديل بنجاح');
        return redirect()->route('section.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $section = section::findOrFail($request->id);
        $section->delete();

        toastr()->success('تم حذف القسم بنجاح');
        return back();
    }
    public function getclasses($id)
    {
       $Classrooms=classroom::where("Grade_id",$id)->pluck("Name_Class","id");
        return $Classrooms;
    }

}
