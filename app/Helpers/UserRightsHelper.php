<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserRightsHelper{

    public function hasRight($resource){
        if(Auth::user()->type == User::USER_TYPE_SUPER_ADMIN){
            return TRUE;
        }
        return in_array($resource, Session::get('user_rights'));
    }
}