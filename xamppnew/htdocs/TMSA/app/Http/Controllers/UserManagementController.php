<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\CarrierDetail;
use App\CarrierResource;

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

                'email'=>'required|unique:users',
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

                        $rcNumber = $request->rcNumber;
                        $emailModal = $request->email;
                        $nameModal = $request->name;
                        $categoryModal = $request->category;
                        $companyName = $request->companyName;

                            $haul = DB::table("users")->insertGetId([
                                'name' => $nameModal,
                                'email' => $emailModal,
                                'password' => $defaultPassword,
                                'userAccessLevel' => $categoryModal,
                                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            ]);

                            $carrierID = $haul;

                            $logText = $createdByUser." created a new user: name = ".$name." email = ".$email;

                            $log = DB::table("logs")->insert([
                                'description' => $logText,
                                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            ]);

                        //carrierDetails
                        $validator3 = Validator::make($request->all(), [

                            'companyName'=>'required',
                            'rcNumber'=>'required',

                        ]);

                        if ($validator3->passes()) {
                            $insertCarrierDetails = DB::table("carrier_details")->insertGetId([
                                'user_id' => $carrierID,
                                'rcNumber' => $rcNumber,
                                'companyName' => $companyName,
                                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            ]);
                        }
                        //endCarrierDetails

                        //resources
                            $validator2 = Validator::make($request->all(), [

                                'resourceType.*'=>'required',
                                'capacity.*'=>'required',
                                'resourceStatus.*'=>'required',
                                'routeType.*'=>'required',
                                'git.*'=>'required',

                            ]);

                            if ($validator2->passes()) {
                                for ($i=0; $i < count($request->get('resourceType')); ++$i)
                                {
                                    $resources = new CarrierResource;
                                    $resources->user_id = $carrierID;
                                    $resources->resourceType= $request->get('resourceType')[$i];
                                    $resources->capacity= $request->get('estimatedCapacity')[$i];
                                    $resources->resourceStatus= $request->get('resourceStatus')[$i];
                                    $resources->routeType= $request->get('routeType')[$i];
                                    $resources->git= $request->get('git')[$i];
                                    $resources->created_at = \Carbon\Carbon::now()->toDateTimeString();
                                    $resources->updated_at = \Carbon\Carbon::now()->toDateTimeString();
                                    $res = $resources->save();
                                }
                            }
                        //endresources

                            if($haul && $log && $res){
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
