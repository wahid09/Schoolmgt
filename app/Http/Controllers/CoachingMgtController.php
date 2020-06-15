<?php

namespace App\Http\Controllers;

use App\ClassName;
use App\CoachingType;
use DB;
use Illuminate\Http\Request;

class CoachingMgtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coachingtypes = $this->getCoachingType();
        $classes = ClassName::all();
        //dd($classnames);
        return view('admin.settings.coaching.index', [
            'coachingtypes' => $coachingtypes,
            'classes'  => $classes,
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
        if($request->ajax()){
            $data = new CoachingType();

            $data->class_name_id = $request->class_name_id;
            $data->coaching_type = $request->coaching_type;
            if(isset($request->status)){
                $data->status = 1;
            }else{
                $data->status = 0;
            }
            $data->save();
        }
    }
    public function CoachingTypeList(){
        $coachingtypes = $this->getCoachingType();
        $classes = ClassName::all();
        //dd($classnames);
        return view('admin.settings.coaching.coaching_list', [
            'coachingtypes' => $coachingtypes,
            'classes'  => $classes,
        ]);
    }
    public function CoachingDeleteByAjax(Request $request){
        $caochingtype = CoachingType::find($request->caochingId);
        //dd($caochingtype);
        $caochingtype->delete();

        $coachingtypes = $this->getCoachingType();

            return view('admin.settings.coaching.coaching_list', [
            'coachingtypes' => $coachingtypes,
            ])->with('message', 'Action Successfull');
    }
    public function CoachingUnpublishByAjax(Request $request){
        $caochingtypes = CoachingType::find($request->caochingId);
        //dd($caochingtypes);
        $caochingtypes->status = 0;
        $caochingtypes->save();

        $coachingtypes = $this->getCoachingType();

        //dd($batches);
        return view('admin.settings.coaching.coaching_list', [
            'coachingtypes' => $coachingtypes,
        ])->with('message', 'Action Successfull');
    }
    public function CoachingpublishByAjax(Request $request){
        $caochingtypes = CoachingType::find($request->caochingId);
        //dd($caochingtypes);
        $caochingtypes->status = 1;
        $caochingtypes->save();

        $coachingtypes = $this->getCoachingType();

        //dd($batches);
        return view('admin.settings.coaching.coaching_list', [
            'coachingtypes' => $coachingtypes,
        ])->with('message', 'Action Successfull');
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
        //
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
    protected function getCoachingType(){
        $coachingtypes = DB::table('coaching_types')
                        ->join('class_names', 'coaching_types.class_name_id', '=', 'class_names.id')
                        ->select('coaching_types.*', 'class_names.class_name')
                        ->get();
        return $coachingtypes;
    }
}
