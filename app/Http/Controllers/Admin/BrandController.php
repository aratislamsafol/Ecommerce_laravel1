<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function Index(){
        $brands=Brand::latest()->paginate(5);
        $TrashCat=Brand::onlyTrashed()->latest()->paginate(3);
        return view('admin.brand.index',compact('brands','TrashCat'));
    }

    public function AddBrand(Request $request){
        $request->validate([
            'brand_name' => 'required|min:4',
            'brand_img' =>'required|mimes:png,jpg,jpeg',
        ],
        [
            'brand_name.required'=>'please Input brand Name',
            'brand_name.min'=>'Maximum 4 Chars brand Name',
            'brand_img.required'=>'Supported format png,jpg,jpeg only',
        ]);
        $brand_image=$request->file('brand_img');


        $name_gen=hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300,300)->save(public_path('img/brand/'.$name_gen));

        $img_add_all='img/brand/'.$name_gen;

        $brand_add=Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_img'=>$img_add_all,
            'created_at'=>Carbon::now(),
        ]);
        return Redirect()->back()->with('success','Brand Inserted Successfully');
    }

    public function Edit($id){
        $brand_id=Brand::find($id);

        return view('admin.brand.edit',compact('brand_id'));
    }

    public function Update(Request $request,$id){
        $request->validate([
            'brand_name' => 'required|min:4',
            'brand_img' =>'required|mimes:png,jpg,jpeg',
        ],
        [
            'brand_name.required'=>'please Input brand Name',
            'brand_name.min'=>'Maximum 4 Chars brand Name',
            'brand_img.required'=>'Attached only png,jpg,jpeg format',
        ]);

        $brand_image=$request->file('brand_img');
        $old_image=$request->old_image;

        if($brand_image){
            $name_gen=hexdec(uniqid());
            $ext=strtolower($brand_image->getClientOriginalExtension());
            $add_all=$name_gen.'.'.$ext;
            $img_loc='img/brand/';
            $img_add_all=$img_loc.$add_all;
            $brand_image->move($img_loc,$add_all);

            unlink($old_image);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_img' =>$img_add_all,
                'updated_at' =>Carbon::now(),
            ]);
            return Redirect()->route('admin.brand')->with('success','Brand Updated Successfully');
        }else{
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'updated_at' =>Carbon::now(),
            ]);
            return Redirect()->route('admin.brand')->with('success','Brand Updated Successfully');
        }
    }

    public function Delete($id){
        $item_del=Brand::find($id)->delete();

        return Redirect()->back()->with('success','Item go to Trash');
    }

    public function Restore($id){
        $restore=Brand::withTrashed()->find($id)->restore();

        return Redirect()->back()->with('success','Brand Item Restored');
    }

    public function PDelete($id){
        $del_id=Brand::find($id);
        $delete=Brand::onlyTrashed()->find($id)->forcedelete();

        return Redirect()->back()->with('success','Brand Item Delete Permanently');
    }

    public function Inactive($id){
        Brand::find($id)->Update([
            'status'=>0
        ]);
        return Redirect()->back()->with('status-Active','Category Item Inactived');
    }

    public function Active($id){
        Brand::find($id)->Update([
            'status'=>1
        ]);
        return Redirect()->back()->with('status-Inactive','Category Item Actived');
    }


}
