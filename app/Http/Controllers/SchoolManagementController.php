<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        return view('admin.settings.school.index', ['schools'=>$schools]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
        ]);

        $school = new School();

        $school->name = $request->name;
        if(isset($request->status)){
            $school->status = 1;
        }else{
            $school->status = 0;
        }
        $school->save();

        return redirect()->route('schoolmgt.index')->with('message', 'School added successfully');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
        ]);
        $school = School::findOrFail($request->school_id);
        $school->name = $request->name;
        $school->update();
        return redirect()->back()->with('message', 'Data Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::findOrFail($id);
        $school->delete();
        return redirect()->back()->with('message', 'Data deleted successfylly');
    }
    public function StatusUpdate(Request $request, $id){
        $school = School::findOrFail($id);

        if($school->status == 1){
            $school->status = 0;
        }else{
            $school->status = 1;
        }
        $school->save();
        return redirect()->back()->with('message', 'Action Successfull');
    }
}
