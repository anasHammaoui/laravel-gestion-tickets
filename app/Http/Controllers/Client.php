<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Client extends Controller
{
    public function index(){
        $categories = Category::all();
        $tickets = Ticket::where("user_id",Auth::id()) -> get();
        return view("/client/clientdashboard",["categories"=> $categories, "tickets" => $tickets]);
    }
    public function addTicket(Request $request){
        $validate = $request -> validate([
            "ticketName" => "required | unique:tickets,ticket_name",
            "ticketDescription" => "required | unique:tickets,ticket_name",
            "ticketCat" => "required"
        ]);
        
            Ticket::create([
                "ticket_name" =>$validate["ticketName"],
                "ticket_description" =>$validate["ticketDescription"],
                "category_id" =>$validate["ticketCat"],
                "user_id" => Auth::id(),
            ]);
            return redirect()-> route("client");
    }
    public function closeticket($id){
        $close = Ticket::where("id", $id) -> update([
            "status" => "resolved",
        ]);
        return redirect() -> back() -> with("success", "Ticket closed successully");
    }
}
