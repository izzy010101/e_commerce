<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        // Get the logged-in user
        $user = Auth::user();

        return view('profile.account', compact('user'));
    }
}
