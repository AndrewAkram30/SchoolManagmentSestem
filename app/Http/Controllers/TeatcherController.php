<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teatcher;

use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeatcherController extends Controller
{
    protected $Teatchers;
    public function __construct( TeacherRepositoryInterface $Teatchers) {
        $this->Teatchers = $Teatchers;
    }


    public function index()
    {


        $Teatchers = $this->Teatchers->GetAllTeatchers();
         return view('teatchers.teatchers', compact('Teatchers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Specialization = $this->Teatchers->GetSpecializations();
        $Genders = $this->Teatchers->GetGender();
        return view('teatchers.create', compact('Specialization', 'Genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // return $this->Teatchers->StoreTeatcher($request);
        // dd($request->all());
            $request->validate([
                'Email' =>'required|unique:teatchers,Email',
                'Password' =>'required',
                'Name' =>'required',
                'Gender_id' =>'required',
                'Specialization_id' =>'required',
                'Address' =>'required',
                'Phone_number' =>'required',
            ]);
            Teatcher::create([
                'Email' => $request->Email,
                'Password' => Hash::make($request->Password),
                'Name' => $request->Name,
                'Gender_id' => $request->Gender_id,
                'Specialization_id' => $request->Specialization_id,
                'Address' => $request->Address,
                'Phone_number' => $request->Phone_number,
            ]);
             toastr()->success('add is success');
        return redirect()->route('teatchers.create');

    }




    /**
     * Display the specified resource.
     */
    public function show(Teatcher $teatcher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Request $request, $id)
    {
        // لعرض البيانات الحاليه

        $Teatchers=Teatcher::findOrFail($id);
        $Genders = Gender::all();
        $Specialization = Specialization::all();
        return view('teatchers.edit', compact('Teatchers','Genders','Specialization'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //  لتحديث البيانات

        // dd($request->all());
                $id = $request->id;
         $request->validate([
                'Email' =>'required|unique:teatchers,Email',
                'Password' =>'required',
                'Name' =>'required,'.$id,
                'Gender_id' =>'required',
                'Specialization_id' =>'required',
                'Address' =>'required',
                'Phone_number' =>'required',
            ]);
        Teatcher::findOrFail($id)->update([
                'Email' => $request->Email,
                'Password' => Hash::make($request->Password),
                'Name' => $request->Name,
                'Gender_id' => $request->Gender_id,
                'Specialization_id' => $request->Specialization_id,
                'Address' => $request->Address,
                'Phone_number' => $request->Phone_number,

        ]);
        toastr()->success('edit is success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        Teatcher::findOrFail($id)->delete();
        toastr()->success('delete is success');
        return back();
    }
}

