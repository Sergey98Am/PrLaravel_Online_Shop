<?php

namespace App\Http\Controllers\adminka;

use App\Category;
use App\Brand;
use App\Color;
use App\Year;
use App\Http\Controllers\Controller;
use Faker\Provider\File;
use Illuminate\Http\Request;
use App\Product;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $years = Year::all();
        return view('admin.product-add',compact('categories','brands','colors','years'));
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
            'images' => 'required',
            'title' => 'required',
            'price' => 'required|numeric',
            'year' => 'required|numeric|min:2013',
            'quantity' => 'required|numeric|max:200',
            'web_id' => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('images')){
            $files = $request->file('images');
            $image = [];
            foreach ($files as $file){
                $file_name = time().$file->getClientOriginalName();
                array_push($image,$file_name);
                $file->move(public_path().'/images/',$file_name);
            }
            $input['images'] = json_encode($image);
        }else{
            return redirect()->route('product.create');
        }
        $product = new Product;
        $product->fill($input);
        $product->save();
        return redirect()->route('product.index');
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
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();
        $years = Year::all();
        return view('admin.product-edit',compact('product','categories','brands','colors','years'));
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
            'title' => 'required',
            'price' => 'required|numeric',
            'year' => 'required|numeric|min:2013',
            'quantity' => 'required|numeric|max:200',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('images')){
            $files = $request->file('images');
            $image = [];
            foreach ($files as $file){
                $file_name = time().$file->getClientOriginalName();
                array_push($image,$file_name);
                $file->move(public_path().'/images/',$file_name);

            }
            $input['images'] = json_encode($image);
        }
        $product = Product::find($id);
        $product->fill($input);
        $product->update();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Product::find($id);
        foreach (json_decode($destroy->images) as $img){
            \File::delete(public_path().'/images/'.$img);
        }
        $destroy->delete();
        return redirect()->route('product.index');
    }
}
