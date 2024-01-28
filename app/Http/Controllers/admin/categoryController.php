<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class categoryController extends Controller
{
    public function index(){
        // $categories = DB::table('categories')->get();
        return view('admin.category.categories');
    }

    public function create(){
        return view('admin.category.create-categories');
    }

    public function store(Request $request){
        $validator = validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

        if($validator->passes()){
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            $request->session()->flash('success','Category Added Successfully');
            return response()->json([
                'status'=> true,
                'msg' => 'Category Added Successfully'
            ]);
        }else{
            return response()->json([
                'status'=> false,
                'errors' => $validator->errors()
            ]);
        }


    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }  
}
