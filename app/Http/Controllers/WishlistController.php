<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display the wishlist page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('wishlist.index');
    }

}


