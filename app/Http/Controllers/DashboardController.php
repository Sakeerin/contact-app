<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */

    
    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }
    public function __invoke(Request $request)
    {
        $user = $request->user()->loadCount(['companies','contacts']);
        return view('dashboard',compact('user'));
    }
}