<?php

namespace App\Http\Controllers;

use App\Models\classroom;
use App\Models\Gender;
use App\Models\image;
use App\Models\nationalites;
use App\Models\section;
use App\Models\student;
use App\Models\Type_Blood;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // protected $Students;

    // public function __construct(StudentRepositoryInterface $Students){
    //     $this->Students = $Students;
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Students = student::all();
        return view('Students.index',compact('Students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Data['Classrooms'] = classroom::all();
        $Data['Sections'] = section::all();
        $Data['Gender'] = Gender::all();
        $Data['type_blood'] = Type_Blood::all();
        $Data['Nationalists'] = nationalites::all();
        return view('Students.create', $Data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // هعمل validate
        // else .... studebt ::ceate هنشا عادى بالركويست
        // attachment


            // insert img

        DB::beginTransaction();

        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            // insert img
            if($request->hasfile('photos'))
            {
                foreach($request->file('photos') as $file)
                {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$students->name, $file->getClientOriginalName(),'upload_attachments');

                    // insert in image_table
                    $images= new Image();
                    $images->filename=$name;
                    $images->imageable_id= $students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }
            DB::commit(); // insert data
            toastr()->success('done');
            return redirect()->route('students.create');

        }

        catch (\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }




    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        //الغرض: تستخدم لعرض البيانات الحالية لسجل أو كائن معين دون إجراء أي تعديل عليه.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        //   تعديل البيانات (UI)

        $Students = student::findOrFail($id);
         $Data ['Classrooms'] = classroom::all();
        $Data['Sections'] = section::all();
        $Data['Gender'] = Gender::all();
        $Data['type_blood'] = Type_Blood::all();
        $Data['Nationalists'] = nationalites::all();
        return view('Students.index', $Data,compact('Students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        // تعديل البيانات


        // ف الاول بعمل validate
        try {
            student::findOrFail($id)->update([
                'Email' => $request->email,
                'Passworrd' => Hash::make($request->password),
                'Gender' => $request->gender_id,
                // ونكمل انا بعمل بس علشان فاهم
            ]);
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student ,Request $request)
    {
        $id = $request->id;
        student::findOrFail($id)->delete();
        toastr()->error('deleted done');
        return redirect()->back();
    }
    public function Get_Classrooms($id)
    {
        $List_Class = classroom::where('Grade_id', $id)->pluck('Name_Class', $id);
        return $List_Class;
    }
    public function Get_Section($id)
    {
        $List_Section = section::where('Grade_id', $id)->pluck('Name_Section', $id);
        return $List_Section;
    }
}
