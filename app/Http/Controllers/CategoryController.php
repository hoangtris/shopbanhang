<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $htmlSelect;

    public function __construct()
    {
        # code...
        $this->htmlSelect = '';
    }
    public function index()
    {
        $data = Category::all();
        $this->categoryRecursive(0);

        return view('category.index', compact('data'));
    }

    //de qui
    public function categoryRecursive($id, $text='')
    {
        # code...
        $data = Category::all();
        foreach ($data as $value) {
            if($value['parent_id']==$id){
                $this->htmlSelect .= "<option value='".$value['id']."'>".$text.$value['name']."</option>";

                $this->categoryRecursive($value['id'], $text.'&#9866;');
            }
        }
        return $this->htmlSelect;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = Category::all();
        $htmlOption = $this->categoryRecursive(0);

        return view('category.add', compact('htmlOption'));
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
        Category::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name, '-'),
            'parent_id'=>$request->parent_id
        ]);

        \Session::flash('flash_message', 'Add category successfully.');  // dòng thêm vào 
        
        //cũ : return redirect('articles');
        return redirect()->route('categories.index');
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
        $category = Category::findOrFail($id);
        $htmlOption = $this->categoryRecursive(0);
        return view('category.edit', compact('category','htmlOption'));
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
        $category = Category::findOrFail($id);
 
        $category->update($request->all());
        \Session::flash('flash_message', 'Update category successfully.');
        return redirect()->route('categories.index', [$category->id]);
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
        Category::where('id',$id)->delete();
        \Session::flash('flash_message', 'Deleted category successfully.');  // dòng thêm vào 
        return redirect()->route('categories.index');
    }
}
