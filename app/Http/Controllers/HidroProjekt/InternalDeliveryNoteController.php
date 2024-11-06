<?php

namespace App\Http\Controllers\HidroProjekt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InternalDeliveryNoteController extends Controller
{
    public function index(){
        return view('hidro-projekt.WP.internalDeliveryNote');
    }

    public function internalOrder(){
        return view('hidro-projekt.WP.internalOrder');
    }
}
