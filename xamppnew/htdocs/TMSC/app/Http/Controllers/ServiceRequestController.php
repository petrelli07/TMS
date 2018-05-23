<?php

namespace App\Http\Controllers;
use App\carrierResource;
use App\ClientInvoice;
use Auth;
use App\serviceRequest;
use Illuminate\Http\Request;
use DB;
use Validator;
use App\haulageResourceRequest;
use App\User;
use App\ClientOrder;

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

    public function checkOrigins(Request $request){
        $originToServer = $request->originToServer;
        $destination = ClientOrder::where('origin',$originToServer)->get();
        return response()->json(['success'=>$destination]);
    }


    public function viewOrderDetails($id)
    {
        $orderDetails = serviceRequest::where('serviceIDNo',$id)->get();
        if($orderDetails){
            return view('orders.orderDetails', ['orderDetails'=>$orderDetails]);
        }else{
            return redirect('/viewOrders')->with('message', 'Order Not Found');
        }
    }

    public function showAllForCustomer()
    {
        $createdByID = Auth::user()->id;
        $allRequests = serviceRequest::where('createdBy',$createdByID)->paginate(10);
        $countRequests = serviceRequest::where('createdBy',$createdByID)->count();
        return view('orders.allOrders',['allRequests'=>$allRequests,'countRequests'=>$countRequests]);
    }

    public function store(Request $request)
    {
        $createdByUser = Auth::user()->id;
        $createdContact = Auth::user()->email;

        $deliverFrom = $request->deliverFrom;
        $deliverTo = $request->deliverTo;
        $weight = $request->weight;
        $itemDescription = $request->itemDescription;
        //$packagingType = $request->packagingType;
        $haulageType = $request->haulageType;
        $contactPhone = $request->contactPhone;
        $contactName = $request->contactName;
        $value = $request->amount;
        $pickupDate = $request->pickupDate;
        $pickupTime = $request->pickupTime;
        $haulageVal = $request->haulageVal;
        $standardOrigin = $request->standardOrigin;
        $standardDestination = $request->standardDestination;
        $orderStatus = 0;

        $validator = Validator::make($request->all(), [
            'deliverFrom'=>'required',
            'deliverTo'=>'required',
            'resourceType'=>'required',
            'itemDescription'=>'required',
            'haulageType'=>'required',
        ]);



                $rand = $this->randomNumber();

                if($request->haulageType == 1){

                    if ($validator->passes()) {

                        $serviceReq = DB::table("service_requests")->insert([
                            'serviceIDNo' => $rand,
                            'deliverFrom' => $deliverFrom,
                            'deliverTo' => $deliverTo,
                            'orderStatus' => $orderStatus,
                            'itemDescription' => $itemDescription,/*
                            'requiredResourceType' => $resourceType,
                            'packagingType' => $packagingType,*/
                            'typeOfHaulage' => $haulageType,
                            'estimatedWgt' => $weight,
                            'valueOfHaulage' => $haulageVal,
                            'amountForHaulage' => $value,
                            'pickupDate' => $pickupDate,
                            'pickUpTime' => $pickupTime,
                            'createdBy' => $createdByUser,
                            'contactDetails' => $createdContact,
                            'contactName' => $contactName,
                            'contactPhone' => $contactPhone,
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

                }else{

                    $destinationValue = ClientOrder::where('id',$standardDestination)->value('destination');

                        $serviceReq = DB::table("service_requests")->insert([
                            'serviceIDNo' => $rand,
                            'deliverFrom' => $standardOrigin,
                            'deliverTo' => $destinationValue,
                            'orderStatus' => $orderStatus,
                            'clientOrderID' => $standardDestination,
                            'itemDescription' => $itemDescription,/*
                            'requiredResourceType' => $resourceType,
                            'packagingType' => $packagingType,*/
                            'typeOfHaulage' => $haulageType,
                            'estimatedWgt' => $weight,
                            'valueOfHaulage' => $haulageVal,
                            'pickupDate' => $pickupDate,
                            'pickUpTime' => $pickupTime,
                            'createdBy' => $createdByUser,
                            'contactDetails' => $createdContact,
                            'contactName' => $contactName,
                            'contactPhone' => $contactPhone,
                            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        ]);

                        if($serviceReq){
                            return response()->json(['success'=>'New Order Created Successfully']);
                        }else{
                            return response()->json(['error'=>'Something Went Wrong']);
                        }

                }
    }

    public function viewInvoice($id){

        $serviceId = serviceRequest::where('serviceIDNo',$id)->value('id');

        $serviceIdRequest = serviceRequest::where('serviceIDNo',$id)->get();

        $resID = ClientInvoice::where('service_id', $serviceId)->value('resource_id');

        $invoiceID = ClientInvoice::where('service_id', $serviceId)->value('invoice_id');
        $invoiceStat = ClientInvoice::where('service_id', $serviceId)->value('status');

        $carInvID = carrierResource::findOrFail($resID);

        return view('invoice.invoiceDetails',['carInvID'=>$carInvID,'serviceIdRequest'=>$serviceIdRequest,'invoiceID'=>$invoiceID, 'invoiceStat'=>$invoiceStat]);

    }


    public function approveInvoice($id){

        $serviceID = serviceRequest::where('serviceIDNo',$id)->value('id');

        $invoiceID = ClientInvoice::where('service_id', $serviceID)->value('id');

        $resource_id = ClientInvoice::where('service_id', $serviceID)->value('resource_id');


        $data = array(
            'status' => 1
        );

        ClientInvoice::where(
            'id',$invoiceID)
            ->update($data);

        $dataRes = array(
            'resourceStatus' => 1
        );

        carrierResource::where(
            'id',$resource_id)
            ->update($dataRes);

        $dataStatus = array(
            'orderStatus' => 5
        );

        serviceRequest::where(
            'id',$serviceID)
            ->update($dataStatus);

        return back()->with('message', 'Approval Confirmed');

    }

    public function finishTransaction($id)
    {
        $serviceID = serviceRequest::where('serviceIDNo', $id)->value('id');

        $resourceID = haulageResourceRequest::where('serviceIDNo', $id)->value('resource_id');

        $dataHC = array(
            'status' => 0
        );

        carrierResource::where(
            'id',$resourceID)
            ->update($dataHC);

        $dataStatus = array(
            'orderStatus' => 7
        );

        serviceRequest::where(
            'id',$serviceID)
            ->update($dataStatus);

        $dataRes = array(
            'resourceStatus' => 1
        );

        carrierResource::where(
            'id',$resourceID)
            ->update($dataRes);

        return back()->with('message', 'Transaction Confirmed');
    }

}
