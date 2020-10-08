<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Category;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Product::all();
        return view('products.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $listCategory = Category::all();

        return view('products.add', compact('listCategory'));
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
        /*
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'slug' => 'max:255',
        ],[
            'name.required' => 'A name is required',
        ])->validate();
        */
        $file = $request->file('url_image');
        Product::create([
            'name'=>$request->name,
            'category_id'=>$request->parent_id,
            'price'=>$request->price,
            'description'=>$request->description,
            'url_image'=>$file->move('upload', $file->getClientOriginalName())
        ]);

        \Session::flash('flash_message', 'Add product successfully.');  
        
        //cũ : return redirect('articles');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $listCategory = Category::all();

        $dataProduct = Product::findOrFail($id);



        return view('products.edit', compact('dataProduct','listCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);
 
        $product->update($request->all());
        
        $file = $request->file('url_image')->move('upload', $request->file('url_image')->getClientOriginalName());

        Product::where('id',$id)->update(['url_image'=>$file]);
        
        \Session::flash('flash_message', 'Edit product successfully.');  
        
        //cũ : return redirect('articles');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Product::where('id',$id)->delete();
        \Session::flash('flash_message', 'Deleted product successfully.');  // dòng thêm vào 
        return redirect()->route('products.index');
    }
}
