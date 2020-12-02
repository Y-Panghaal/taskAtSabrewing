<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'email'     => 'required|email:filter|exists:users,email',
            'password'  => 'required'
        ]);

        if (Auth::attempt($request->only(['email', 'password']))) {
            return redirect('/dashboard');
        } else {
            return redirect()->back()->withInput()->with('authentication', 'Invalid credentials.');
        }
    }
}
