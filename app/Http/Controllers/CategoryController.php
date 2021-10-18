<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct(){
    //     $this->middleware('isadmin');
    // }
    
    public function index()
    {
        $data['categories'] = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.createcategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'status' => 'required'

        ]);
       
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $categoryObj = new Category();

        $categoryObj->name = $request->name;
        $categoryObj->slug = strtolower(str_replace(' ', '-', $request->name));
        $categoryObj->category_id = $request->category_id;
        $categoryObj->status = $request->status;
        $categoryObj->save();

        return redirect()->route('category.index')->with('success', "Category added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['category'] = Category::find($id);
        $category_id = $data['category']['category_id'];
        $data['categoryName'] = Category::select('name')->where('id', $category_id)->first();
        if($data['categoryName'] == null){
            $data['aa'] = 1;
        }else{
            $data['aa'] = 0;
        }
        return view('admin.category.categorydetails', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = Category::find($id);
        return view('admin.category.editcategory', $data);
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
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'status' => 'required'

        ]);
       
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $categoryObj = Category::find($id);

        $categoryObj->name = $request->name;
        $categoryObj->slug = strtolower(str_replace(' ', '-', $request->name));
        $categoryObj->category_id = $request->category_id;
        $categoryObj->status = $request->status;
        $categoryObj->save();

        return redirect()->route('category.index')->with('success', "Category Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryObj = Category::find($id);
        $categoryObj->delete();
        return redirect()->route('category.index')->with('success', 'Category Deleted Successfully');
    }
}
