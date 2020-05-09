<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\FeaturedProduct;
use App\ProductImage;
use App\Category;
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
        $data['products'] = Product::with('category')->orderBy('id', 'desc')->get();

        return view('admin.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::select('id', 'name')->where('status', 1)->get();
        return view('admin.product.createproduct', $data);
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
            'regular_price' => 'required',
            'category_id' => 'required',
            'status' => 'required'

        ]);
       
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $productObj = new Product();
        
        $productObj->name = $request->name;
        $productObj->regular_price = $request->regular_price;
        $productObj->sale_price = $request->sale_price;
        $productObj->category_id = $request->category_id;
        $productObj->status = $request->status;
        $productObj->save();

        if($request->hasFile('thumbnail_image')){
            $productImageObj = new ProductImage();
            $image = $request->file('thumbnail_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('upload/product/image');
            $image->move($path, $name);
            $productImageObj->image = $name;
            $productImageObj->thumbnail_image = 1;
            $productImageObj->product_id = 1;
            $productImageObj->save();
        } 

        if($request->hasFile('image')){
            $images = $request->file('image');
            foreach($images as $image){
                $productImageObj = new ProductImage();
                $name = time().rand(100, 999).'.'.$image->getClientOriginalExtension();
                $path = public_path('upload/product/image');
                $image->move($path, $name);
                $productImageObj->image = $name;
                $productImageObj->thumbnail_image = 0;
                $productImageObj->product_id = 1;
                $productImageObj->save();
            }
           
        } 

        return redirect()->route('product.index')->with('success', 'Product added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['product'] = Product::find($id);

        return view('admin.product.productdetails', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['product'] = Product::find($id);
        $category_id = $data['product']['category_id'];
        $data['category'] = Category::select('name')->where('id', $category_id)->first();
        return view('admin.product.editproduct', $data);
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
            'regular_price' => 'required',
            'category_id' => 'required',
            'status' => 'required'

        ]);
       
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $productObj = Product::find($id);
        
        $productObj->name = $request->name;
        $productObj->regular_price = $request->regular_price;
        $productObj->sale_price = $request->sale_price;
        $productObj->category_id = $request->category_id;
        $productObj->status = $request->status;
        $productObj->save();

        if($request->hasFile('thumbnail_image')){
            $productImageObj = ProductImage::where('product_id', '$id');
            $image = $request->file('thumbnail_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('upload/product/image');
            $image->move($path, $name);
            $productImageObj->image = $name;
            $productImageObj->thumbnail_image = 1;
            $productImageObj->product_id = 1;
            $productImageObj->save();
        } 

        if($request->hasFile('image')){
            $images = $request->file('image');
            foreach($images as $image){
                $productImageObj = ProductImage::where('product_id', '$id');
                $name = time().rand(100, 999).'.'.$image->getClientOriginalExtension();
                $path = public_path('upload/product/image');
                $image->move($path, $name);
                $productImageObj->image = $name;
                $productImageObj->thumbnail_image = 0;
                $productImageObj->product_id = 1;
                $productImageObj->save();
            }
           
        } 

        return redirect()->route('product.index')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productObj = Product::find($id);
        $productObj->delete();
        return redirect()->route('product.index')->with('success', 'Product Deleted Successfully');
    }

    // Featured Product

    public function featuredproduct(){
        $data['featuredproducts'] = FeaturedProduct::with('product')->select('id', 'product_id')->get();
// dd($data);
        return view('admin.product.featuredproduct', $data);
    }
}
