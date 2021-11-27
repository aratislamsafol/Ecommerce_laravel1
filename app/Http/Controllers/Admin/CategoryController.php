<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Index(){
        $categories=Category::latest()->paginate(6);
        return view('admin.category.index',compact('categories'));
    }

    public function Store(Request $request){
        $Category_validation = $request->validate([
            'category_name' => 'required|max:255',
        ],
        [
            'category_name.required'=>'please Valid Input category Name',
            'category_name.max'=>'Maximum 255 Chars category Name',
        ]
    );

    Category::insert([
        'category_name'=>$request->category_name,
        'user_id'=>Auth::user()->id,
        'created_at'=>Carbon::now()
    ]);
    return Redirect()->back()->with('success','Category Inserted Successfully');
    }

    public function Edit($id){
        $category_id=Category::find($id);

        return view('admin.category.edit',compact('category_id'));
    }

    public function Update(Request $request,$id){
        $category_id=Category::find($id)->Update([
            'category_name'=>$request->category_name,
            'user_id'=>Auth::user()->id,
            'updated_at'=>Carbon::now(),
        ]);
        return Redirect()->route('admin.category')->with('success','Category Updated Successfully');
    }

    public function Delete($id){
        $cat_id_del=Category::find($id)->delete();

        return Redirect()->back()->with('delete','Category Item Deleted Successfully');
    }

    public function Inactive($id){
        Category::find($id)->Update([
            'status'=>0
        ]);
        return Redirect()->back()->with('status-Active','Category Item Inactived');
    }

    public function Active($id){
        Category::find($id)->Update([
            'status'=>1
        ]);
        return Redirect()->back()->with('status-Inactive','Category Item Actived');
    }



}
