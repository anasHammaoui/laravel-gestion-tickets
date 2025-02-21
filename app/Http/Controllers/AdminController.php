<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view("admin.admindashboard");
    }
    public function showUsers(){
        $users = User::all();
        return view("admin.adminUsers",["users"=>$users]);
    }
    public function updateRole($id, Request $request){
        $isExist = User::findOrFail($id);
        $validate  = $request -> validate([
            "roles" => 'required'
        ]);
        User::where("id",$id) -> update(["role_id" => $validate["roles"]]);
        return redirect() -> route("adminagents") -> with("success","Role updated with success");
    }
    public function deleteUser($id){
        $delete = User::findOrFail($id);
        $delete -> delete();
        return redirect()->route('adminagents')->with('success', 'User deleted successfully');
   }
}
