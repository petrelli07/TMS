<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\carrierResource;
use App\User;

class ReportController extends Controller
{
    public function viewAllResources(){
        $resource = carrierResource::paginate(10);
        return view('resources.allResources', ['resource'=>$resource]);
    }

    public function allUsers(){
        $resource = User::paginate(10);
        return view('allUsers', ['resource'=>$resource]);
    }
}
