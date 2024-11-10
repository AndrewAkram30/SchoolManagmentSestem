<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\student;
use App\Models\student_promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grades = grade::all();
        return view('promotions.student_promotions', compact('Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $promotions = student::all();
        return view('promotions.student_mangment', compact('promotions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',   $request->Classroom_id)->where('Section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();

            if($students->count() < 1){
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            // update in table student
            foreach ($students as $student){

                $ids = explode(',',$student->id);
                student::whereIn('id', $ids)->update([
                        'Grade_id'=>$request->Grade_id_new,
                        'Class_id'=>$request->Classroom_id_new,
                        'Section_id'=>$request->section_id_new,
                    ]);

                // insert in to promotions
                student_promotion::updateOrCreate([
                    'Student_id'=>$student->id,
                    'From_Grade_id'=>$request->Grade_id,
                    'From_Class_id'=>$request->Class_id,
                    'From_Section_id'=>$request->section_id,
                    'To_Grade_id'=>$request->Grade_id_new,
                    'To_Class_id'=>$request->Classroom_id_new,
                    'To_Section_id'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);

            }
            DB::commit();
            toastr()->success('done');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


    /**
     * Display the specified resource.
     */
    public function show(student_promotion $student_promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student_promotion $student_promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student_promotion $student_promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student_promotion $student_promotion)
    {
        //
    }
}
