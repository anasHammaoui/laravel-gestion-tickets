<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;

class Client extends Controller
{
    public function index(){
        $categories = Category::all();
        $tickets = Ticket::all();
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
            ]);
            return redirect()-> route("addTicket");
    }
}
