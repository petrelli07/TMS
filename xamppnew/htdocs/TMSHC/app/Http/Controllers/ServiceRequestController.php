<?php

namespace App\Http\Controllers;

use App\carrierResource;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\serviceRequest;
use App\Invoice;
use App\TimeLog;
use App\CarrierInvoice;
use DB;
use Validator;
use App\HaulageResourceRequest;

class ServiceRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allServiceRequests(){
        $user_id = Auth::user()->id;
        $haulageRequests = HaulageResourceRequest::where('carrier_id', $user_id)->paginate(10);
        return view('resourceRequests.allRequests', ['haulageRequests'=>$haulageRequests]);
    }

    public function viewOrder($id){

        $orderDetails = serviceRequest::where('serviceIDNo',$id)->get();
        if($orderDetails){
            return view('orders.orderDetails', ['orderDetails'=>$orderDetails]);
        }else{
            return redirect('/viewOrders')->with('message', 'Order Not Found');
        }

    }

    public function checkInvoice($id){

        $invoiceCheck = CarrierInvoice::where('service_id',$id)->count();

        if($invoiceCheck > 0){

            $invoice = CarrierInvoice::where('service_id',$id)->value('invoice_id');
            $invoiceStatus = CarrierInvoice::where('service_id',$id)->value('status');
            $HaulageResourceRequestID = HaulageResourceRequest::where('order_id',$id)->value('resource_id');
            $carrRes = carrierResource::where('id',$HaulageResourceRequestID)->get();
            $servReq = serviceRequest::where('id',$id)->get();
            return view('invoice.invoiceDetails', ['invoice'=>$invoice, 'carrRes'=>$carrRes, 'servReq'=>$servReq, 'invoiceStatus'=>$invoiceStatus]);

        }else{
            return back()->with('message', 'Invoice Not Found');
        }

    }



    public function approveInvoice($id){

        $serviceID = serviceRequest::where('serviceIDNo',$id)->value('id');

        $invoiceID = CarrierInvoice::where('service_id', $serviceID)->value('id');

        $resource_id = CarrierInvoice::where('service_id', $serviceID)->value('resource_id');


        $data = array(
            'status' => 2
        );

        CarrierInvoice::where(
            'id',$invoiceID)
            ->update($data);

        $dataRes = array(
            'resourceStatus' => 1
        );

        carrierResource::where(
            'id',$resource_id)
            ->update($dataRes);

        $invStat = array(
            'status' => 1
        );

        CarrierInvoice::where(
            'service_id',$serviceID)
            ->update($invStat);

        $dataStatus = array(
            'orderStatus' => 3
        );

        serviceRequest::where(
            'id',$serviceID)
            ->update($dataStatus);
        return back()->with('message', 'Approval Confirmed');



    }

    public function confirmRequest($id){
        $data = array(
            'orderStatus' => 1
        );

        /*$dataRes = array(
            'resourceStatus' => 1
        );*/

        serviceRequest::where(
            'serviceIDNo',$id)
            ->update($data);

        /*serviceRequest::where(
            'serviceIDNo',$id)
            ->update($data);*/
        return back()->with('message', 'Order Confirmed');

    }

    public function timeIn(Request $request){

        $serviceIDNo = $request->serviceIDNo;
        $orderID = $request->orderID;
        $haulageReqID = $request->haulageRequestID;
        $carrierID = $request->carrierID;
        $clockIn = $request->timeIn;

        $client_id = serviceRequest::where('id', $orderID)->value('createdBy');

        $timeIn = new TimeLog;

        $timeIn->serviceIDNo = $serviceIDNo;
        $timeIn->order_id = $orderID;
        $timeIn->carrier_id = $carrierID;
        $timeIn->client_id = $client_id;
        $timeIn->haulageRequestID = $haulageReqID;
        $timeIn->clockIn = $clockIn;

        $timeInSave = $timeIn->save();

        $dataStatus = array(
            'status' => 3
        );

        $haulageStatus = HaulageResourceRequest::where(
            'id',$haulageReqID)
            ->update($dataStatus);

        if($timeInSave && $haulageStatus){
            return back()->with('message', 'Time In Confirmed');
        }else{
            return back()->with('message', 'Something went wrong');
        }


    }

    public function timeOut(Request $request){

        $orderID = $request->orderIDOut;
        $haulageReqID = $request->haulageRequestIDOut;
        $clockOut= $request->timeOut;


        $dataStatusClock = array(
            'clockOut' => $clockOut
        );

        $timeOutLog = TimeLog::where(
            'order_id',$orderID)
            ->update($dataStatusClock);


        $dataStatus = array(
            'status' => 4
        );

        $haulageStatus = HaulageResourceRequest::where(
            'id',$haulageReqID)
            ->update($dataStatus);

        if($timeOutLog && $haulageStatus){
            return back()->with('message', 'Time Out Confirmed');
        }else{
            return back()->with('message', 'Something went wrong');
        }


    }

}
