<?php

namespace App\Http\Controllers;

use App\Models\fundaccount;
use App\Models\payment_student;
use App\Models\student;
use App\Models\student_account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Payment_Studnets = payment_student::all();
        return view('payment_studnet.index',compact('Payment_Studnets'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function show(Request $request,$id)
    {
        $students = student::findOrFail($id);
        return view('payment_studnet.add',compact('students'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

                // تعديل البيانات في جدول سندات الصرف
            $Payment_Students = new payment_student();
            $Payment_Students->date = date('Y-m-d');
            $Payment_Students->Student_id = $request->studnet_id;
            $Payment_Students->amount = $request->Debit;
            $Payment_Students->description = $request->description;
            $Payment_Students->save();

                 // تعديل البيانات في جدول الصندوق
            $Fund_Account = new fundaccount();
            $Fund_Account->date = date('Y-m-d');
            $Fund_Account->payment_id = $Payment_Students->id;
            $Fund_Account->Debit = 0.00;
            $Fund_Account->credit = $request->Debit;
            $Fund_Account->description = $request->description;
            $Fund_Account->save();


               // تعديل البيانات في جدول حساب الطلاب
            $students_accounts = new student_account();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $Payment_Students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            toastr()->success("تم الحفظ بنجاح");
            return redirect()->back();



        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {

        $Payment_Students = payment_student::findOrFail($id);
        return view('payment_studnet.edit',compact('Payment_Students'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
          DB::beginTransaction();
        try {

                // حفظ البيانات في جدول سندات الصرف
            $Payment_Students =  payment_student::findOrFail($request->id);
            $Payment_Students->date = date('Y-m-d');
            $Payment_Students->Student_id = $request->studnet_id;
            $Payment_Students->amount = $request->Debit;
            $Payment_Students->description = $request->description;
            $Payment_Students->save();

                 // حفظ البيانات في جدول الصندوق
            $Fund_Account =  fundaccount::where('payment_id',$request->id)->first();
            $Fund_Account->date = date('Y-m-d');
            $Fund_Account->payment_id = $Payment_Students->id;
            $Fund_Account->Debit = 0.00;
            $Fund_Account->credit = $request->Debit;
            $Fund_Account->description = $request->description;
            $Fund_Account->save();


               // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = student_account::where('payment_id',$request->id)->first();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'payment';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->payment_id = $Payment_Students->id;
            $students_accounts->Debit = $request->Debit;
            $students_accounts->credit = 0.00;
            $students_accounts->description = $request->description;
            $students_accounts->save();

            DB::commit();
            toastr()->success("تم الحفظ بنجاح");
            return redirect()->back();



        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(payment_student $payment_student)
    {
        //
    }
}
