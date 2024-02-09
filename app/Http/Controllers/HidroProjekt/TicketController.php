<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function tickets(){
        return view('hidro-projekt.ADM.tickets');
    }

    public function newTicket(Request $request){
        $validate = $request->validate([
            'ticketName' => 'required',
            'job_description' => 'required',
        ]);

    }
}
