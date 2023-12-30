<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    public function index(){
        // $categories = DB::table('categories')->get();
        return view('admin.category.categories');
    }

    public function create(){
        return view('admin.category.create-categories');
    }

    public function store(){

    }
    public function edit(){

    }
    public function update(){

    }
    public function destroy(){

    }  
}
