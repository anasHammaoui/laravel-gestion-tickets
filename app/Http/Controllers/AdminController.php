<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $totalTickets = Ticket::count();
        $resolved = Ticket::where("status","resolved")-> count();
        $pending = Ticket::where("status","pending")-> count();
        return view("admin.admindashboard",["tickets" => $totalTickets, "pending" => $pending, "resolved"=>$resolved]);
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
   public function showTickets (){
    $tickets = Ticket::all();
    $users = User::all();
    return view("admin.adminTickets",["tickets"=>$tickets,"users"=>$users]);
}
    public function assignTo(Request $request){
        $validate = $request -> validate([
            "assignTicket" => "required | numeric",
            "ticketId" => "required | numeric"
        ]);
        Ticket::where("id", $validate["ticketId"]) -> update([
            "assigned_to" => $validate["assignTicket"]
        ]);
        return redirect() -> route("adminTickets");
    }
}
