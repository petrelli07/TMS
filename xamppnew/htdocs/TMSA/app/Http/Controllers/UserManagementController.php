<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use Excel;
use App\serviceRequest;
use App\CarrierDetail;
use App\CarrierResource;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function randomNumber(){

        $i = 1;

        for($j=0; $j < $i; $j++){
//            return random_int(1,10000);

            $result = '';

            $length = 7;

            for($x = 0; $x < $length; $x++) {
                $result .= mt_rand(0, 9);
            }

            $checkAvailable = CarrierResource::where('resource_id', $result);

            if( $checkAvailable->count() < 1 ){

                return $result;

                break;
            }
            $i++;

        }
    }

    public function createNewUser(Request $request){

        $createdByUser = Auth::user()->name;

        $name = $request->name;
        $email = $request->email;
        $category = $request->category;
        $defaultPassword = '$2y$10$a76F.mWAnjgTBqpUYeiO1OKwFRW1pc96VbShjxsuglKMCm4V/Xysm';

        $check = User::where('email', $email);

        if($check->count() <= 0){

            /*$validator = Validator::make($request->all(), [

                'email'=>'required|unique:users',
                'category'=>'required',
                'name'=>'required',

            ]);*/

            //if ($validator->passes()) {



                if($request->category != "0"){//if option is not admin

                    //if option is client
                    if($request->clientcategory == "1"){

                        $emailModal = $request->clientemail;
                        $nameModal = $request->clientname;
                        $categoryModal = $request->clientcategory;

                        //validate client
                        $validatorClient = Validator::make($request->all(), [
                            'companyName'=>'required',
                            'rcNumber'=>'required',
                            'clientForm'=>'required',
                            'clientemail'=>'required',
                            'clientname'=>'required',
                            'clientcategory'=>'required',

                        ]);

                        //if validate passes
                        if ($validatorClient->passes()) {

                        $client = DB::table("users")->insertGetId([
                            'name' => $emailModal,
                            'email' => $nameModal,
                            'password' => $defaultPassword,
                            'userAccessLevel' => $categoryModal,
                            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        ]);

                        }else{

                            return response()->json(['error'=>$validatorClient->errors()->all()]);

                        }

                        $clientID = $client;
                        $companyName = $request->companyName;
                        $rcNumber = $request->rcNumber;

                        if ($validatorClient->passes()) {

                            if($request->hasFile('clientForm')){

                                $path = $request->file('clientForm')->getRealPath();
                                $data = Excel::load($path)->get();

                                if($data->count()){
                                    foreach ($data as $value) {

                                            $arr[] = [
                                                'user_id' => $clientID,
                                                'companyName' => $companyName,
                                                'rcNumber' => $rcNumber,
                                                'resourceType' => $value->resource,
                                                'origin' => $value->origin,
                                                'destination' => $value->destination
                                            ];
                                    }
                                    if(!empty($arr)){

                                        DB::table('client_orders')->insert($arr);

                                        return response()->json(['success'=>'New Client Created Successfully']);
                                    }else{
                                        return response()->json(['error'=>'Something Went Wrong']);
                                    }
                                }

                            }else{
                                return response()->json(['error'=>'Something Went Wrong']);
                            }

                            /*$insertClientDetails = DB::table("client_orders")->insertGetId([
                                'user_id' => $clientID,
                                'rcNumber' => $rcNumber,
                                'companyName' => $companyName,
                                'resourceType' => $resourceType,
                                'itemDescription' => $itemDescription,
                                'packagingType' => $packagingType,
                                'origin' => $origin,
                                'destination' => $destination,
                                'amount' => $amount,
                                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            ]);

                            if($insertClientDetails){
                                return response()->json(['success'=>'New Client Created Successfully']);
                            }else{
                                return response()->json(['error'=>'Something Went Wrong']);
                            }*/

                        }else{
                            return response()->json(['error'=>$validatorClient->errors()->all()]);
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
                       // $resourceID = $rand = $this->randomNumber();
                        $resourceStatus = 0;

                            /*$logText = $createdByUser." created a new user: name = ".$name." email = ".$email;

                            $log = DB::table("logs")->insert([
                                'description' => $logText,
                                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            ]);*/

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


                        //resource type and number
                        if($request->hasFile('carrierForm')){

                            $path = $request->file('carrierForm')->getRealPath();
                            $data = Excel::load($path)->get();

                            if($data->count()){
                                foreach ($data as $value) {
                                    $arr[] = [
                                        'user_id' => $carrierID,/*
                                        'resourceStatus' => $resourceStatus,*/
                                        'resourceType' => $value->resourcetype,
                                        'numberOfResource' => $value->numberofresource
                                    ];
                                }
                               $resourceTypeNumber = DB::table('carrier_resources')->insert($arr);
                            }

                        }else{
                            return response()->json(['error'=>'Something Went Wrong']);
                        }

                        //resource type and number
                        if($request->hasFile('carrierRoute')){

                            $path = $request->file('carrierRoute')->getRealPath();
                            $data = Excel::load($path)->get();

                            if($data->count()){
                                foreach ($data as $value) {
                                    $arrNew[] = [
                                        'user_id' => $carrierID,/*
                                        'resourceStatus' => $resourceStatus,*/
                                        'origin' => $value->origin,
                                        'destination' => $value->destination
                                    ];
                                }

                                $routeMap =  DB::table('carrier_route_maps')->insert($arrNew);

                            }

                        }else{
                            return response()->json(['error'=>'Something Went Wrong']);
                        }

                        //endresources

                            if($haul && $resourceTypeNumber && $routeMap){
                                return response()->json(['success'=>'New Haulage Provider Created Successfully']);
                            }else{
                                return response()->json(['error'=>'Something Went Wrong']);
                            }

                    }else{
                        return response()->json(['error'=>"something went wrong"]);
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

                    /*$log = DB::table("logs")->insert([
                        'description' => $logText,
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ]);*/

                    if($admin){
                            return response()->json(['success'=>'New Admin Created Successfully']);
                    }else{
                        return response()->json(['error'=>'Something Went Wrong']);
                    }

                }


            /*}else{
                return response()->json(['error'=>$validator->errors()->all()]);
            }*/
        }else{
            return response()->json(['error'=>'This User Already Exists']);
        }

    }
}
