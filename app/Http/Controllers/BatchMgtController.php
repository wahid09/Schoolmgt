<?php

namespace App\Http\Controllers;

use App\Batch;
use App\ClassName;
use Illuminate\Http\Request;

class BatchMgtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = ClassName::all();
        return view('admin.settings.batch.index', [
            'classes' => $classes,
        ]);
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
        //return $request->all();
        $this->validate($request, [
            'class_name_id' => 'required',
            'name'          => 'required|max:20',
        ]);

        $batch = new Batch();

        $batch->class_name_id = $request->class_name_id;
        /*if (Batch::where('name', $request->name)->exists()) {
           return redirect()->back()->with('error', 'Batch name already exists');
        }*/
        $batch->name = $request->name;
        $batch->student_capacity = $request->student_capacity;
        if(isset($request->status)){
            $batch->status = 1;
        }else{
            $batch->status = 0;
        }
        $batch->save();

        return redirect()->back()->with('message', 'Batch added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    public function BatchByAjax(Request $request){
        //return $tt = $request->id;
        $batches = Batch::where([
            'class_name_id' => $request->id
        ])->get();

        //dd($batches);
        
        if(count($batches)){
            return view('admin.settings.batch.batch_list', [
            'batches' => $batches,
        ]);
        }else{
            return view('admin.settings.batch.batch_list_empty_error', [
            'batches' => $batches,
            ]);
        }
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
            'name' => 'required|max:20',
            'student_capacity' => 'required',
        ]);

        $batch = Batch::findOrFail($request->batch_id);
        //dd($batch);
        $batch->class_name_id = $request->class_name_id;
        $batch->name = $request->name;
        $batch->student_capacity = $request->student_capacity;
        $batch->update();
        return redirect()->back()->with('message', 'Batch updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*public function StatusUpdate(Request $request, $id){
        $batch = Batch::findOrFail($id);
        if($batch->status == 1){
            $batch->status = 0;
        }else{
            $batch->status = 1;
        }
        $batch->save();
        return redirect()->back()->with('message', 'Action Successfull');
    }*/
    public function BatchUnpublishByAjax(Request $request){
        $batch = Batch::find($request->batchId);
        $batch->status = 0;
        $batch->save();

        $batches = Batch::where([
            'class_name_id' => $request->ClassId
        ])->get();

        //dd($batches);
        return view('admin.settings.batch.batch_list', [
            'batches' => $batches,
        ])->with('message', 'Action Successfull');
    }
    public function BatchpublishByAjax(Request $request){
        $batch = Batch::find($request->batchId);
        $batch->status = 1;
        $batch->save();

        $batches = Batch::where([
            'class_name_id' => $request->ClassId
        ])->get();

        //dd($batches);
        return view('admin.settings.batch.batch_list', [
            'batches' => $batches,
        ])->with('message', 'Action Successfull');
    }

    public function BatchDeleteByAjax(Request $request){
        $batch = Batch::find($request->batchId);
        $batch->delete();

        $batches = Batch::where([
            'class_name_id' => $request->ClassId
        ])->get();

        if(count($batches) > 0){
            return view('admin.settings.batch.batch_list', [
            'batches' => $batches,
            ])->with('message', 'Action Successfull');

        }else{
            return view('admin.settings.batch.batch_list_empty_error', [
            'batches' => $batches,
            ])->with('message', 'Action Successfull');
        }
    }
}
