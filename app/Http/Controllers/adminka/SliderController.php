<?php

namespace App\Http\Controllers\adminka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::orderBy('sort_id','ASC')->get();
        return view('admin.slider',compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'images' => 'required',
            'images,*' => 'image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        if ($valid->fails()){
            return redirect()->back()-withErrors($valid);
        }
        if ($request->hasFile('images')){
            $files = $request->file('images');
            foreach ($files as $file){
                $name = time().$file->getClientOriginalName();
                $file->move(public_path().'/images/',$name);

                $slider = new Slider();
                $slider->path = $name;

                if ($slider->save()){
                    $slider->sort_id = $slider->id;
                    $slider->save();
                }
            }

        }
        return redirect()->route('slider.index');
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
        $destroy = Slider::find($id);
        \File::delete(public_path().'/images/'.$destroy->path);
        $destroy->delete();
        return redirect()->route('slider.index');
    }

    public function change_image_order(Request $request){
        $position = 0;
        foreach ($request->ids as $id){
            $slider = Slider::where('id',$id)->update(['sort_id' => $position]);
            $position++;
        }
    }
}
