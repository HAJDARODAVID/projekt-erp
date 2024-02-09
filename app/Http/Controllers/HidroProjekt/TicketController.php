<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use App\Services\HidroProjekt\ADM\TicketService;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $ticketService;

    public function __construct()
    {   
        $this->ticketService = new TicketService;
    }
    public function tickets(){
        return view('hidro-projekt.ADM.tickets');
    }

    public function newTicket(Request $request){
        $validate = $request->validate([
            'ticketName' => 'required',
            'job_description' => 'required',
        ]);
        $newTicket = $this->ticketService->createNewTicket($request->all());
        return redirect()->back()->with('success', 'Ticket #'.$newTicket->id.'  uspješno kreiran!');
    }

    public function showTicket($id){
        return view('hidro-projekt.ADM.showTicket',[
            'ticketInfo' => $this->ticketService->getTicketInfo($id)
        ]);
    }
}
