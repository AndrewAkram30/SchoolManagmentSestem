<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
    {
        $Library = Library::all();
        return view('librarys.index', compact('Library'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Grades = grade::all();
        return view('librarys.create', compact('Grades'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
             $request->validate([
            'title'=>'required',
            'file_name'=>'required|mimes:png,jpg,pdf',
            'Teatcher_id'=>'required',
            'Grade_id'=>'required',
            'Class_id'=>'required',
            'Section_id'=>'required',

        ]);
            $Library = new Library();
            $Library->title=$request->title;
            $Library->file_name=$request->file('file_name')->getClientOriginalName();
            $Library->Teatcher_id=$request->Teatcher_id;
            $Library->Grade_id=$request->Grade_id;
            $Library->Class_id=$request->Class_id;
            $Library->Section_id=$request->Section_id;

        if ($request->file('file_name')) {
            $file = $request->file('file_name');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            }


        } catch (\Exception $e) {
         return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Library $library)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Library $library)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Library $library)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Library $library)
    {
        //
    }
    public function download(Request $request,$id)
    {
        //
    }
}
