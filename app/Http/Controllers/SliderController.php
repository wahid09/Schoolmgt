<?php

namespace App\Http\Controllers;

use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', ['sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
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
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|max:30',
            'description' => 'required|max:120',
        ]);

        $slider = new Slider();
        
        $image = $request->file('photo');
        $slug = str_slug($request->title);
        if(isset($image))
        {
            //make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            //$imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $imageName  = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('slider'))
            {
                Storage::disk('public')->makeDirectory('slider');
            }
            $sliderImage = Image::make($image)->resize(1400,600)->stream();
            Storage::disk('public')->put('slider/'.$imageName,$sliderImage);
        } else {
            $imageName = "avatar.jpeg";
        }
        $slider->photo = $imageName;
        $slider->title = $request->title;
        $slider->description = $request->description;
        if(isset($request->status)){
            $slider->status = 1;
        }else{
            $slider->status = 0;
        }
        $slider->save();

        return redirect()->route('slidersetup.index')->with('message', 'Slider have been added successfully');
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
        $slider = Slider::find($id);
        return view('admin.slider.edit', ['slider' =>$slider ]);
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
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|max:30',
            'description' => 'required|max:120',
        ]);

        $slider = Slider::find($id);
        
        $image = $request->file('photo');
        $slug = str_slug($request->title);
        if(isset($image))
        {
            //make unipue name for image
            $currentDate = Carbon::now()->toDateString();
            //$imageName  = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            $imageName  = $slug.'-'.$currentDate.'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('slider'))
            {
                Storage::disk('public')->makeDirectory('slider');
            }
            $sliderImage = Image::make($image)->resize(1400,600)->stream();
            Storage::disk('public')->put('slider/'.$imageName,$sliderImage);
        } else {
            $imageName = "avatar.jpeg";
        }
        $slider->photo = $imageName;
        $slider->title = $request->title;
        $slider->description = $request->description;
        if(isset($request->status)){
            $slider->status = 1;
        }else{
            $slider->status = 0;
        }
        $slider->save();

        return redirect()->route('slidersetup.index')->with('message', 'Slider have been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $filename = $slider->photo;
        if(unlink(storage_path('app/public/slider/'.$filename))){
            $slider->delete();
            return redirect()->back()->with('message', 'Item have been deleted successfully');
        }
        return redirect()->back()->with('error', 'Somthing went wrong. Pleasy try again..');
    }
    public function ChangeStatus(Request $request, $id){
        $slider = Slider::findOrFail($id);

        if($slider->status == 1){
            $slider->status = 0;
        }else{
            $slider->status = 1;
        }
        $slider->save();
        return redirect()->back();
    }
}
