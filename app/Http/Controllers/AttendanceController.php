<?php

namespace App\Http\Controllers;

use App\Models\attendance;
use App\Models\grade;
use App\Models\Teatcher;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Grade = grade::with(['section'])->get();
        $List_Grade=grade::all();
        $Teatcher = Teatcher::all();
        return view('attendance.attendance_section',compact('Grade','List_Grade','Teatcher'));
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
        try {
            $attendadate = date('Y-m-d');
            foreach ($request->attendances as $studentid =>$attendance){
               if ($attendance=='presence') {
                    $attendance_status == true;
               }elseif ($attendance=='absent') {
                    $attendance_status == false;
               }
                attendance::create([
                    'student_id'=> $studentid,
                    'grade_id'=> $request->grade_id,
                    'classroom_id'=> $request->classroom_id,
                    'section_id'=> $request->section_id,
                    'teacher_id'=> 1,
                    'attendence_date'=> date('Y-m-d'),
                    'attendence_status'=> $attendence_status,
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(attendance $attendance)
    {
        //
    }
}
