<?php
// الفصول الدراسيه
namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\grade;
use Faker\Provider\Image;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Classrooms = classroom::all();
        $Grades = grade::all();
        return view('classrooms.classroom', compact('Classrooms', 'Grades'));

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
            'Grade_id' => 'required',
            'Name_Class' => 'required',
        ]);
        classroom::create([
            'Grade_id' => $request->Grade_id,
            'Name_Class' => $request->Name_Class,
        ]);

        toastr()->success('تم بنجاح');
        return redirect()->route('classroom.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // return dd($request->all());

        $id = $request->id;
        $request->validate([
            'Name_Class' => 'required|unique:classrooms,Name_Class,' . $id,
            'Grade_id' => 'required',

        ]);
        classroom::findOrFail($id)->update([
            'Name_Class' => $request->Name_Class,
            'Grade_id' => $request->Grade_id,

        ]);
        toastr()->success('تم حفظ البيانات بنجاح');
        return redirect()->route('classroom.index');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request)
    {
        $id = $request->id;
        classroom::findOrFail($id)->delete();
        toastr()->error('تم الحذف بنجاح');
        return redirect()->route('classroom.index');
    }

    public function delete_all(Request $request)
    {
        // return dd($request->all());
        $delete_all_id = explode(",", $request->delete_all_id);
        classroom::whereIn('id',  $delete_all_id)->delete();
          toastr()->error('تم الحذف بنجاح');
        return redirect()->route('classroom.index');

    }

    public function Filter_Classes(Request $request)
    {

        $Grades = grade::all();
        $search = classroom::select('*')->where('Grade_id', $request->Garde_id)->get();
        return view('classrooms.classroom', compact('Grades'))->with($search);

    }


}
