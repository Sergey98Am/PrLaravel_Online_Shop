<?php

namespace App\Http\Controllers\adminka;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Year;
use Validator;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::orderBy('id','DESC')->get();
        return view('admin.years',compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.year-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $validator = Validator::make($input,[
            'title' => 'required|numeric',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        $year = new Year();
        $year->fill($input);
        $year->save();
        return redirect()->route('year.index');
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
        $year = Year::find($id);
        return view('admin.year-edit',compact('year'));
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
        $input = $request->except('_token','_method');
        $validator = Validator::make($input,[
            'title' => 'required|numeric',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        $year = Year::find($id);
        $year->fill($input);
        $year->update();
        return redirect()->route('year.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Year::find($id);
        $destroy->delete();
        return redirect()->route('year.index');
    }
}

