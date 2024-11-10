<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = grade::all();
        return view('Grades.grade', compact('Grades'));
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
            'Names' => 'required|unique:grades,Names',
        ]);
        grade::create([
            'Names' => $request->Names,
            'Notes' => $request->Notes,

        ]);
       toastr()->success('تم اضافه بنجاح');
        return redirect()->route('grade.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'Names' => 'required|unique:grades,Names,' . $id,
        ]);
        grade::findOrFail($id)->updated([
            'Names' => $request->Names,
        ]);
        toastr()->success('تم التعديل بنجاح');
        return redirect()->route('grade.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $classrooms = classroom::where('Grade_id', $request->id)->pluck('Grade_id');
        // لو الجريدايدى بتاع المراحل الدراسيه بيساوى ايدى بتاع الصفوف الدراسيه هات القيم بتاع الجريدايدى

if ($classrooms->count()==0) {
    $id = $request->id;
        grade::findOrFail($id)->delete();
          toastr()->error('تم الحذف بنجاح');
        return redirect()->route('grade.index');
}
else{
        toastr()->error(' لا يمكن الحذف بسبب وجود  صفوف دراسيه تابعه لها');
        return redirect()->route('grade.index');
}

    }

}
