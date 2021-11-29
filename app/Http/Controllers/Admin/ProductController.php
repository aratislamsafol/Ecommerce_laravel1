<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AddProduct(){
        $categories=Category::latest()->get();
        $Brands=Brand::latest()->get();
        return view('admin.product.add',compact('categories','Brands'));
    }

    public function StoreProduct(Request $request){
        $request->validate([
            'product_name' => 'required|max:100',
            'product_code' => 'required|max:100',
            'price' => 'required|max:100',
            'product_quantity' => 'required|max:100',
            'category_id' => 'required|max:100',
            'brand_id' => 'required|max:100',

            'image_one' =>'required|mimes:png,jpg,jpeg',
            'image_two' =>'required|mimes:png,jpg,jpeg',
            'image_three' =>'required|mimes:png,jpg,jpeg',

            'short_description' => 'required|max:5000',
            'long_description' => 'required|max:10000',

        ],
        [
            'category_id.required'=>'Select Category Name Please',
            'category_id.max'=>'Maximum 100 Chars Category Name',
            'brand_id.required'=>'Select Category Name Please',
            'brand_id.max'=>'Maximum 100 Chars Category Name',
            'image_one.required'=>'Attached only png,jpg,jpeg format',
            'image_two.required'=>'Attached only png,jpg,jpeg format',
            'image_three.required'=>'Attached only png,jpg,jpeg format',
        ]);

        $image_one=$request->file('image_one');
        $name_gen=hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
        Image::make($image_one)->resize(270,270)->save(public_path('fontend/img/product/upload/'.$name_gen));

        $img_add_all1='fontend/img/product/upload/'.$name_gen;

        $image_two=$request->file('image_two');
        $name_gen=hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
        Image::make($image_two)->resize(270,270)->save(public_path('fontend/img/product/upload/'.$name_gen));

        $img_add_all2='fontend/img/product/upload/'.$name_gen;

        $image_three=$request->file('image_three');
        $name_gen=hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
        Image::make($image_three)->resize(270,270)->save(public_path('fontend/img/product/upload/'.$name_gen));

        $img_add_all3='fontend/img/product/upload/'.$name_gen;

        $brand_add=Product::insert([
            'product_name'=>$request->product_name,
            'product_slug'=>strtolower(str_replace(' ','-',$request->product_name)),
            'product_code'=>$request->product_code,
            'price'=>$request->price,
            'product_quantity'=>$request->product_quantity,
            'category_id'=>$request->category_id,
            'brand_id'=>$request->brand_id,
            'image_one'=>$img_add_all1,
            'image_two'=>$img_add_all2,
            'image_three'=>$img_add_all3,
            'short_description'=>$request->short_description,
            'long_description'=>$request->long_description,

            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','product Inserted Successfully');
    }

    // =====================Manage Product===========================

    public function ShowProduct(){
        $show_pro=Product::latest()->paginate(10);
        return view('admin.product.manage',compact('show_pro'));
    }

    public function Edit($id){
        $product_id= Product::find($id);
        $categories=Category::latest()->get();
        $Brands=Brand::latest()->get();

        return view('admin.product.edit',compact('product_id','categories','Brands'));
    }

    public function Update(Request $request,$id){

        $request->validate([
            'product_name' => 'required|max:100',
            'product_code' => 'required|max:100',
            'price' => 'required|max:100',
            'product_quantity' => 'required|max:100',
            'category_id' => 'required|max:100',
            'brand_id' => 'required|max:100',

            'image_one' =>'required|mimes:png,jpg,jpeg',
            'image_two' =>'required|mimes:png,jpg,jpeg',
            'image_three' =>'required|mimes:png,jpg,jpeg',

            'short_description' => 'required|max:5000',
            'long_description' => 'required|max:10000',

        ],
        [
            'category_id.required'=>'Select Category Name Please',
            'category_id.max'=>'Maximum 100 Chars Category Name',
            'brand_id.required'=>'Select Category Name Please',
            'brand_id.max'=>'Maximum 100 Chars Category Name',
            'image_one.required'=>'Attached only png,jpg,jpeg format',
            'image_two.required'=>'Attached only png,jpg,jpeg format',
            'image_three.required'=>'Attached only png,jpg,jpeg format',
        ]);

            $old_img1=$request->old_image1;
            $old_img2=$request->old_image2;
            $old_img3=$request->old_image3;

            $image_one=$request->file('image_one');
            $name_gen=hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(270,270)->save(public_path('fontend/img/product/upload/'.$name_gen));

            $img_add_all1='fontend/img/product/upload/'.$name_gen;

            $image_two=$request->file('image_two');
            $name_gen=hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(270,270)->save(public_path('fontend/img/product/upload/'.$name_gen));

            $img_add_all2='fontend/img/product/upload/'.$name_gen;


            $image_three=$request->file('image_three');
            $name_gen=hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(270,270)->save(public_path('fontend/img/product/upload/'.$name_gen));

            $img_add_all3='fontend/img/product/upload/'.$name_gen;

            unlink($old_img1);
            unlink($old_img2);
            unlink($old_img3);


            Product::findOrfail($id)->Update([

                'product_name'=>$request->product_name,
                'product_slug'=>strtolower(str_replace(' ','-',$request->product_name)),
                'product_code'=>$request->product_code,
                'price'=>$request->price,
                'product_quantity'=>$request->product_quantity,
                'category_id'=>$request->category_id,
                'brand_id'=>$request->brand_id,
                'image_one'=>$img_add_all1,
                'image_two'=>$img_add_all2,
                'image_three'=>$img_add_all3,
                'short_description'=>$request->short_description,
                'long_description'=>$request->long_description,
                'created_at'=>Carbon::now(),
            ]);

        return Redirect()->route('manage.product')->with('success','Product Updated Successfully');

    }

    public function Delete($id){
        $pro_img=Product::findOrfail($id);
        $img1=$pro_img->image_one;
        $img2=$pro_img->image_two;
        $img3=$pro_img->image_three;

        unlink($img1);
        unlink($img2);
        unlink($img3);

        Product::findOrfail($id)->delete();

        return Redirect()->back()->with('success','Product Deleted Successfully');
    }

    public function Inactive($id){
        Product::find($id)->Update([
            'status'=>0
        ]);
        return Redirect()->back()->with('status-Active','Product Item Inactived');
    }

    public function Active($id){
        Product::find($id)->Update([
            'status'=>1
        ]);
        return Redirect()->back()->with('status-Inactive','Product Item Actived');
    }
}
