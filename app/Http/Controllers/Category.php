<?php

namespace App\Http\Controllers;

use App\Models\Category as ModelsCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class Category extends Controller
{
   public function addCategory (Request $request){
    // Validate the incoming request
    $validated = $request->validate([
        'categoryName' => 'required|max:255|unique:categories,category_name',
    ]);
        ModelsCategory::create([
           "category_name" => $validated["categoryName"],
        ]);
    return redirect()->route("admin");
   }
   public function deleteCategory($id){
        $delete = ModelsCategory::findOrFail($id);
        $delete -> delete();
        return redirect()->route('admin')->with('success', 'Item deleted successfully');
   }
   public function updateCategory($id, Request $request){
    $checkifExist = ModelsCategory::findOrFail($id);
    $validate = $request -> validate([
        "categoryUpdate" => "required"
    ]);
    ModelsCategory::where("id",$id) -> update(["category_name" => $validate["categoryUpdate"]]);
    return redirect()->route("admin");
   }
   public function showCategories(){
   $categories =  ModelsCategory::all();
    return view("admin.adminCategory",["categories"=>$categories]);
   }
}
