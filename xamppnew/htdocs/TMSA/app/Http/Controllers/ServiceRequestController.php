<?php

namespace App\Http\Controllers;
use App\CarrierInvoice;
use App\ClientInvoice;
use Auth;
use App\serviceRequest;
use App\carrierResource;
use App\CarrierDetail;
use App\User;
use App\HaulageResourceRequest;
use Illuminate\Http\Request;
use DB;
use Validator;

class ServiceRequestController extends Controller
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

            $checkAvailable = serviceRequest::where('serviceIDNo', $result);

            if( $checkAvailable->count() < 1 ){

                return $result;

                break;
            }
            $i++;

        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAllForCustomer()
    {
        $allRequests = serviceRequest::paginate(10);
        $countRequests = serviceRequest::count();
        return view('orders.allOrders',['allRequests'=>$allRequests,'countRequests'=>$countRequests]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $createdByUser = Auth::user()->id;
        $createdContact = Auth::user()->email;

        $deliverFrom = $request->deliverFrom;
        $deliverTo = $request->deliverTo;
        $resourceType = $request->resourceType;
        $itemDescription = $request->itemDescription;
        $numberOfResources = $request->numberOfResources;
        $haulageType = $request->haulageType;
        $estimatedWgt = $request->estimatedWgt;
        $dateRequired = $request->dateRequired;
        $dateReturned = $request->dateReturned;
        $git = $request->git;
        $orderStatus = 0;

        $validator = Validator::make($request->all(), [
            'deliverFrom'=>'required',
            'deliverTo'=>'required',
            'resourceType'=>'required',
            'itemDescription'=>'required',
            'numberOfResources'=>'required',
            'haulageType'=>'required',
            'estimatedWgt'=>'required',
            'dateRequired'=>'required|date',
            'dateReturned'=>'required|date',
            'git'=>'required',
        ]);

        if ($validator->passes()) {

            $rand = $this->randomNumber();

            $serviceReq = DB::table("service_requests")->insert([
                'serviceIDNo' => $rand,
                'deliverFrom' => $deliverFrom,
                'deliverTo' => $deliverTo,
                'estimatedWgt' => $estimatedWgt,
                'orderStatus' => $orderStatus,
                'itemDescription' => $itemDescription,
                'dateRequired' => $dateRequired,
                'dateReturned' => $dateReturned,
                'requiredResourceType' => $resourceType,
                'typeOfHaulage' => $haulageType,
                'numberOfResources' => $numberOfResources,
                'git' => $git,
                'createdBy' => $createdByUser,
                'contactDetails' => $createdContact,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ]);

            if($serviceReq){
                return response()->json(['success'=>'New Order Created Successfully']);
            }else{
                return response()->json(['error'=>'Something Went Wrong']);
            }

        }else{
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewOrderDetails($id)
    {
        $orderDetails = serviceRequest::where('serviceIDNo',$id)->get();
        if($orderDetails){
            return view('orders.orderDetails', ['orderDetails'=>$orderDetails]);
        }else{
            return redirect('/viewOrders')->with('message', 'Order Not Found');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchResources($serviceIDNo)
    {
        $origin = serviceRequest::where('serviceIDNo', $serviceIDNo)->value('deliverFrom');
        $destination = serviceRequest::where('serviceIDNo', $serviceIDNo)->value('deliverTo');
        $estimatedWgt = serviceRequest::where('serviceIDNo', $serviceIDNo)->value('estimatedWgt');
        $id_user = serviceRequest::where('serviceIDNo', $serviceIDNo)->value('createdBy');

        $resourceQuery = carrierResource::where('origin', '=', $origin)->where
            ('destination', '=', $destination)->get();

        return $resourceQuery;

        foreach($resourceQuery as $user){
            $user_id = $user->user_id;
        }

        $userOrder = DB::table('client_orders')
            ->select('resourceType')->where('user_id',$id_user)
            ->groupBy('resourceType')
            ->get();

        $carrRes = carrierResource::where('user_id', $user_id)->get();

        if($resourceQuery->count() > 0){
            return view('resources.searchResults', ['resourceQuery'=>$resourceQuery, 'serviceIDNo'=>$serviceIDNo, 'carrRes'=>$carrRes, 'userOrder'=>$userOrder, 'estimatedWgt'=>$estimatedWgt]);
        }else{
            return back()->with('message', 'Resource Not Found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewResource($id)
    {
        $resource = carrierResource::where('resource_id',$id)->get();
        $carrierDetailUserID = carrierResource::where('resource_id',$id)->value('user_id');
        $carrierDetail = carrierDetail::where('user_id',$carrierDetailUserID)->get();
        return view ('resources.resourceDetails', ['resource'=>$resource, 'carrierDetail'=>$carrierDetail]);
    }

    public function sendHaulageRequest(Request $request){

    $orderID = $request->orderID;

    $resource_id = $request->resource_id;
    $carrier_id = $request->carrier_id;
    $resourceType = $request->resourceType;
    $resourceNumber = $request->resourceNumber;

        foreach ($resourceType as $value) {
            $arrType[] = [
                'resourceType'=>$value
            ];
        }

        foreach ($resourceNumber as $value2) {
            $arrType[] = [
                'resourceNumber'=>$value2
            ];
        }

    $pendingRequests = HaulageResourceRequest::where('serviceIDNo', '=', $orderID)->where
        ('resource_id', '>=', $resource_id)->count();

        if($pendingRequests < 1){

            $order_id = serviceRequest::where('serviceIDNo',$orderID)->value('id');

            if($order_id){

                $sendHaulageRequest = DB::table("haulage_resource_requests")->insert([
                    'serviceIDNo' => $orderID,
                    'carrier_id' => $carrier_id,
                    'resource_id' => $resource_id,
                    'order_id' => $order_id,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                ]);

                if($sendHaulageRequest){
                    return response()->json(['success'=>'Request Sent Successfully']);
                }else{
                    return response()->json(['error'=>'Something Went Wrong']);
                }


            }else{
                return response()->json(['error'=>'Something Went Wrong']);
            }

        }else{
            return response()->json(['error'=>'Another Request Involving this order and this request is in progress']);
        }

    }

    public function createInvoiceForCarrier($id){

        $serviceID = serviceRequest::where('serviceIDNo',$id)->value('id');
        $invoiceCarrierResourceID = HaulageResourceRequest::where('serviceIDNo',$id)->value('resource_id');
        $user_id = carrierResource::where('id',$invoiceCarrierResourceID)->value('user_id');/*
        $invoiceCarrierID = carrierResource::where('id',$invoiceCarrierResourceID)->value('resource_id');*/

        $rand = $this->randomNumber();

        $serviceReq = DB::table("carrier_invoices")->insert([
            'invoice_id' => $rand,
            'service_id' => $serviceID,
            'resource_id' => $invoiceCarrierResourceID,
            'carrier_id' => $user_id,
            'status' => 0,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        $data = array(
            'orderStatus' => 2
        );

        $updateStatus = serviceRequest::where(
            'serviceIDNo',$id)
            ->update($data);

        $dataHC = array(
            'status' => 1
        );

        $updateHCStatus = HaulageResourceRequest::where(
            'serviceIDNo',$id)
            ->update($dataHC);

        if($serviceReq && $updateStatus){
            return back()->with('message', 'Invoice sent successfully');
        }else{
            return back()->with('message', 'Something went wrong');
        }

    }

    public function createInvoiceForClient($id){

        $serviceID = serviceRequest::where('serviceIDNo',$id)->value('id');
        $invoiceCarrierResourceID = HaulageResourceRequest::where('serviceIDNo',$id)->value('resource_id');
        $user_id = carrierResource::where('id',$invoiceCarrierResourceID)->value('user_id');/*
        $invoiceCarrierID = carrierResource::where('id',$invoiceCarrierResourceID)->value('resource_id');*/

        $rand = $this->randomNumber();

        $serviceReq = DB::table("client_invoices")->insert([
            'invoice_id' => $rand,
            'service_id' => $serviceID,
            'resource_id' => $invoiceCarrierResourceID,
            'client_id' => $user_id,
            'status' => 0,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);

        $data = array(
            'orderStatus' => 4
        );

        $updateStatus = serviceRequest::where(
            'serviceIDNo',$id)
            ->update($data);

        if($serviceReq && $updateStatus){
            return back()->with('message', 'Invoice sent successfully');
        }else{
            return back()->with('message', 'Something went wrong');
        }

    }


    public function carrierProceed($id){

        $dataHC = array(
            'status' => 2
        );

        $updateHCStatus = HaulageResourceRequest::where(
            'serviceIDNo',$id)
            ->update($dataHC);

        $servReq = array(
            'orderStatus' => 6
        );

        $updateServiceRequest = serviceRequest::where(
            'serviceIDNo',$id)
            ->update($servReq);

        if($updateHCStatus && $updateServiceRequest){
            return back()->with('message', 'Action Successful');
        }else{
            return back()->with('message', 'Something went wrong');
        }

    }

}
