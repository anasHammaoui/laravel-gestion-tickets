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
    public function addTicket(){
        if (isset($_GET["addTicket"])){
            Ticket::create([
                "ticket_name" => $_GET["ticketName"],
                "ticket_description" => $_GET["ticketDescription"],
                "category_id" => $_GET["ticketCat"],
            ]);
            return redirect("/clientdashboard");
        }
    }
}
