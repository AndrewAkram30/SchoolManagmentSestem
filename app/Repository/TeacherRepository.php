<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teatcher;
use Exception;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface{

  public function GetAllTeatchers(){
      return Teatcher::all();
  }


  public function GetSpecializations(){
        return Specialization::all();
  }
  public function GetGender(){
      return Gender::all();
  }


 public function StoreTeatcher($request){

    try {
            $Teachers = new Teatcher();
            $Teachers->Email = $request->Email;
            $Teachers->Password =  Hash::make($request->Password);
            $Teachers->Name = $request->Name;
            $Teachers->Specialization_id = $request->Specialization_id;
            $Teachers->Gender_id = $request->Gender_id;
            $Teachers->Phone_number = $request->Phone_number;
            $Teachers->Address = $request->Address;
            $Teachers->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('teatchers.create');

        }
        catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
