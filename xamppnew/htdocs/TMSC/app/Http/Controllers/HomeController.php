<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientOrder;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        //$standardOrder = ClientOrder::where('user_id',$user_id)->paginate(10);

         $standardOrigin = ClientOrder::where('user_id',$user_id)->get();
        return view('landing', ['standardOrigin'=>$standardOrigin]);
    }
}
