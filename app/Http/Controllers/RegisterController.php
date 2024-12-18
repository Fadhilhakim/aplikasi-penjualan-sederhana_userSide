<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view("register.index");
    }

    public function store(Request $request) {
       $validated_data =  $request->validate([
            'name' => 'required|max:225',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:225',
        ]);

        User::create($validated_data);

        $x_error = 'flash'; 

        return redirect('/login')->with('success', 'Registrasi Berhasil! Silahkan Log In');
    }
}
