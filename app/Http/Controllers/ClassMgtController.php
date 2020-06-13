<?php

namespace App\Http\Controllers;

use App\ClassName;
use Illuminate\Http\Request;

class ClassMgtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassName::all();
        return view('admin.settings.class.index', ['classes'=>$classes]);
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
            'class_name' => 'required|max:50',
        ]);

        $classinsert = new ClassName();

        $classinsert->class_name = $request->class_name;
        if(isset($request->status)){
            $classinsert->status = 1;
        }else{
            $classinsert->status = 0;
        }

        $classinsert->save();

        return redirect()->back()->with('message', 'Class Added successfully');
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'class_name' => 'required|max:50',
        ]);

        $classupdate = ClassName::findOrFail($request->class_id);

        $classupdate->class_name = $request->class_name;
        $classupdate->update();

        return redirect()->back()->with('message', 'Class Name updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classdestroy = ClassName::findOrFail($id);
        $classdestroy->delete();
        return redirect()->back();
    }
    public function StatusUpdate(Request $request, $id){
        $classmgt = ClassName::findOrFail($id);

        if($classmgt->status == 1){
            $classmgt->status = 0;
        }else{
            $classmgt->status = 1;
        }
        $classmgt->save();
        return redirect()->back()->with('message', 'Action Successfull');
    }
}
