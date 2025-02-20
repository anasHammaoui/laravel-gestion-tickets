<?php

namespace App\Http\Controllers;

use App\Models\Category as ModelsCategory;
use Illuminate\Http\Request;

class Category extends Controller
{
   public function addCategory (){
    if (isset($_GET["addCat"])){
        ModelsCategory::create([
            "category_name" => $_GET["categoryName"]
        ]);
    }
    return redirect("/admindashboard");
   }
   public function showCategories(){
   $categories =  ModelsCategory::all();
    return view("admin.adminCategory",["categories"=>$categories]);
   }
}
