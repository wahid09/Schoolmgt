<?php

namespace App\Http\Controllers;

use App\FooterSetup;
use Illuminate\Http\Request;

class FooterSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $footer = FooterSetup::find($id);
        return view('admin.pages.footersetup', ['footer'=>$footer]);
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
            'copyright' => 'required|max:20',
            'facebook_url' => 'required',
            'linkedin_url' => 'required',
            'youtube_url' => 'required',
        ]);

        $footer=FooterSetup::find($id);
        
        $footer->copyright = $request->copyright;
        $footer->facebook_url = $request->facebook_url;
        $footer->linkedin_url = $request->linkedin_url;
        $footer->youtube_url = $request->youtube_url;
        $footer->save();

        return redirect()->back()->with('message', 'Data Updated Successfully');
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
}
