<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Agent extends Controller
{
   public function dashboard(){
    $tickets = Ticket::where("assigned_to",Auth::id() )-> get();
    return view("agent.agentdashboard",["tickets"=>$tickets]);
   }
   public function changeStatus($id, Request $request){
    $validate = $request -> validate([
        "changeStatus" => "required",
    ]);
    Ticket::where("id",$id) -> update([
        "status" => $validate["changeStatus"],
    ]);
    return redirect() -> route("agentdashboard");
   }
}
