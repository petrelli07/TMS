<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createNewUser(Request $request){

        $createdByUser = Auth::user()->name;

        $name = $request->name;
        $email = $request->email;
        $category = $request->category;
        $defaultPassword = '$2y$10$a76F.mWAnjgTBqpUYeiO1OKwFRW1pc96VbShjxsuglKMCm4V/Xysm';

        $check = User::where('email', $email);

        if($check->count() <= 0){

            $validator = Validator::make($request->all(), [

                'email'=>'required',
                'category'=>'required',
                'name'=>'required',

            ]);

            if ($validator->passes()) {

                if($request->category != "0"){

                    if($request->category == "1"){

                        $client = DB::table("users")->insert([
                            'name' => $name,
                            'email' => $email,
                            'password' => $defaultPassword,
                            'userAccessLevel' => $category,
                            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        ]);

                        $logText = $createdByUser." created a new user: name = ".$name." email = ".$email;

                        $log = DB::table("logs")->insert([
                            'description' => $logText,
                            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        ]);

                        if($client && $log){
                            return response()->json(['success'=>'New Client Created Successfully']);
                        }else{
                            return response()->json(['error'=>'Something Went Wrong']);
                        }

                    }elseif($request->category == "2"){

                        $haul = DB::table("users")->insert([
                            'name' => $name,
                            'email' => $email,
                            'password' => $defaultPassword,
                            'userAccessLevel' => $category,
                            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        ]);

                        $logText = $createdByUser." created a new user: name = ".$name." email = ".$email;

                        $log = DB::table("logs")->insert([
                            'description' => $logText,
                            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        ]);

                        if($haul && $log){
                            return response()->json(['success'=>'New Haulage Provider Created Successfully']);
                        }else{
                            return response()->json(['error'=>'Something Went Wrong']);
                        }

                    }
                }else{

                    $admin = DB::table("users")->insert([
                        'name' => $name,
                        'email' => $email,
                        'password' => $defaultPassword,
                        'userAccessLevel' => $category,
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]);

                    $logText = $createdByUser." created a new user: name = ".$name." email = ".$email;

                    $log = DB::table("logs")->insert([
                        'description' => $logText,
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]);

                    if($admin && $log){
                            return response()->json(['success'=>'New Admin Created Successfully']);
                    }else{
                        return response()->json(['error'=>'Something Went Wrong']);
                    }

                }


            }else{
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }else{
            return response()->json(['error'=>'This User Already Exists']);
        }

    }
}
