<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function passwordChangeForm(){
        return view('hidro-projekt.BDE.passwordChangeForm');
    }

    public function passwordChange(Request $request){
        $validate = $request->validate([
            'password' => ['required', 'string', 'confirmed']
        ]);

        $user = User::where('id', Auth::user()->id);
        $user->update([
            'password' => Hash::make($request['password'])
        ]);

        return redirect()->route('home');
    }
}
