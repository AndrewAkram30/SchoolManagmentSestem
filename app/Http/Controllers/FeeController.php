<?php

namespace App\Http\Controllers;

use App\Models\fee;
use App\Models\grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $Fees=fee::all();
        $Grades = grade::all();
        return view('fees.index', compact('Fees', 'Grades'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
             $Grades = grade::all();
        return view('fees.create', compact('Grades'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try {

            $fees = new fee();
            $fees->title = $request->title;
            $fees->amount  =$request->amount;
            $fees->Grade_id  =$request->Grade_id;
            $fees->Class_id =$request->Classroom_id;
            $fees->description =$request->description;
            $fees->year  =$request->year;
            $fees->free_type  =$request->free_type;
            $fees->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees.create');

        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request ,$id)
    {
        $Fee=fee::findOrFail($id);
        $Grades = grade::all();
        return view('fees.edit', compact('Fee','Grades'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        DB::beginTransaction();
        try {
             fee::findOrFail($request->id)->update([
                'title'=>$request->title,
                'amount'=>$request->amount,
                'Grade_id'=>$request->Grade_id,
                'Class_id'=>$request->Class_id,
                'description'=>$request->description,
                'year'=>$request->year,
            ]);
            DB::commit();
            toastr()->success('تم التعديل بنجاح');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            //throw $th;
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,$id)
    {
        fee::findOrFail($request->id)->delete();
        toastr()->error('تم الحذف بنجاح');
        return back();
    }
}
