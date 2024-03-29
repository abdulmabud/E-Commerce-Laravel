<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\FeaturedProduct;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        $insert_id = $productObj->id;

        if($request->hasFile('thumbnail_image')){
            $productImageObj = new ProductImage();
            $image = $request->file('thumbnail_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('upload/product/image');
            $image->move($path, $name);
            $productImageObj->image = $name;
            $productImageObj->thumbnail_image = 1;
            $productImageObj->product_id = $insert_id;
            $productImageObj->save();
        }else{
            $productImageObj = new ProductImage();
            $productImageObj->image = 'noImage.png';
            $productImageObj->thumbnail_image = 1;
            $productImageObj->product_id = $insert_id;
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
                $productImageObj->product_id = $insert_id;
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
        // dd($productObj);
        $productObj->name = $request->name;
        $productObj->regular_price = $request->regular_price;
        $productObj->sale_price = $request->sale_price;
        $productObj->category_id = $request->category_id;
        $productObj->status = $request->status;
        $productObj->save();

        if($request->hasFile('thumbnail_image')){
            $productImageObj = ProductImage::where(['product_id' => $id, 'thumbnail_image' => 1])->first();
            if($productImageObj == null){
                $id = $productObj->id;
                $productImageObj = new ProductImage();
                $productImageObj->product_id = $id;
            }
            $image = $request->file('thumbnail_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $path = public_path('upload/product/image');
            $image->move($path, $name);
            $productImageObj->image = $name;
            $productImageObj->save();
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
        // dd($count);
        return view('admin.product.featuredproduct', $data);
    }

    public function addfproduct(Request $request){
        $count = FeaturedProduct::count();
        
        if($count< 8){
            $key = $request->productName;
            $data['products'] = Product::where('name', 'like', '%'.$key.'%')->get();
            return view('admin.product.addfeaturedproduct', $data);
        }else{
            return redirect()->route('featuredproduct.index')->with('warning', 'You can add maximum 8 Featured Product');

        }
      
        
    }

    public function savefproduct($productId){
        $isAdded = FeaturedProduct::select('id')->where('product_id', $productId)->first();
        if($isAdded){
            return redirect()->route('featuredproduct.index')->with('warning', 'Product already added as Featured Product');
        }else{
            $fproduct = new FeaturedProduct();
            $fproduct->product_id = $productId;
            $fproduct->save();
            return redirect()->route('featuredproduct.index')->with('success', 'Featured Product added Successfully');
        }
    }

    public function fproductdelete($productId){
        $productObj = FeaturedProduct::find($productId);
        $productObj->delete();

        return redirect()->route('featuredproduct.index')->with('success', 'Featured Product Deleted Successfully');
    }
}
