<?php

namespace App\Http\Controllers;

use App\Models\fee;
use App\Models\fees_invoice;
use App\Models\grade;
use App\Models\student;
use App\Models\student_account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeesInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Fee_invoices = fees_invoice::all();
        $Grades = grade::all();
        return view('fees_invoice.fees_invoices_index',compact('Fee_invoices','Grades'));
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
            $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new fees_invoice();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->Grade_id = $request->Grade_id;
                $Fees->Classroom_id = $request->Classroom_id;;
                $Fees->free_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new student_account();
                $StudentAccount->student_id = $List_Fee['student_id'];
                $StudentAccount->Grade_id = $request->Grade_id;
                $StudentAccount->Classroom_id = $request->Classroom_id;
                $StudentAccount->Debit = $List_Fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }

            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(fees_invoice $fees_invoice,$id)
    {
        $student = student::findorfail($id);
        $fees = fee::where('Classroom_id',$student->Classroom_id)->get();
        return view('fees_invoice.fees_invoices_add',compact('student','fees'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fees_invoice $fees_invoice)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fees_invoice $fees_invoice)
    {
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $Fees = fees_invoice::findorfail($request->id);
            $Fees->fee_id = $request->fee_id;
            $Fees->amount = $request->amount;
            $Fees->description = $request->description;
            $Fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = student_account::where('fees_invoice_id', $request->id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fees_invoice $fees_invoice)
    {
        //
    }
}
