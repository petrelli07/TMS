<!DOCTYPE html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="{{ url('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/media_query.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/admin_dashboard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/bank_deposits.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('fontawesome/css/font-awesome.min.css') }}">
    <script type="text/javascript" src="{{ url('js/jquery-3.2.1.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/admin_dashboard.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/newOrder.js')}}"></script>
    <link rel="stylesheet" href="{{url('//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css')}}">

    <script>
    $(document).ready(function() {

    $(".newOrder").hide();
    $(".newNonStandardOrder").hide();

    $(".ShowMeStandard").hide();

    $('#userCategory').on('change', function() {
            if ( this.value == '1'){

            $(".ShowMeStandard").show();
            $(".dateReqStandard").hide();
            $(".newOrder").hide();
            $(".newNonStandardOrder").show();
            }else if ( this.value == '0'){

                $(".ShowMeStandard").hide();
                $(".dateReqStandard").show();
                $(".newOrder").show();
                $(".newNonStandardOrder").hide();

            }

        });
    });
    </script>

    <script>
        $(document).ready(function() {

        $(".general").hide();

        $('#haulageType').on('change', function() {
                if ( this.value == '0'){

                $(".general").show();

                }else if ( this.value >= '0'){

                    alert("This Request cannot be processed at the moment. Please contact Systems Administrator");
                    $(".general").hide();
                }

            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('.newOrderConfirm').click(function(e){

                var haulageType = document.getElementById('haulageType').value;
                if(haulageType == "0"){
                    document.getElementById('haulageTypeConfirm').innerText = "Land Freight";/*
                    document.getElementById('confirmHaulageType').value = haulageType;*/
                }else if(haulageType == "1"){
                    document.getElementById('haulageTypeConfirm').innerText = "N/A";
                }else if(haulageType == "2"){
                    document.getElementById('haulageTypeConfirm').innerText = "N/A";
                }

                var reqType = document.getElementById('requestType').value;
                if(haulageType == "0"){
                    document.getElementById('requestTypeConfirm').innerText = "Standard Order";
                    alert(document.getElementById('requestTypeConfirm').innerText);
                    document.getElementById('confirmRequestType').value = reqType;
                }else if(haulageType == "1"){
                    document.getElementById('requestTypeConfirm').innerText = "Non Standard Order";
                    document.getElementById('confirmRequestType').innerText = reqType;
                }

                document.getElementById('pickupTimeConfirm').innerText = document.getElementById('pickupTime').value;
                document.getElementById('confirmPickUpTime').value = document.getElementById('pickupTime').value;
                alert(document.getElementById('confirmPickUpTime').value);

                document.getElementById('pickupDateConfirm').innerText = document.getElementById('pickupDate').value;
                document.getElementById('confirmPickUpDate').value = document.getElementById('pickupDate').value;

                //document.getElementById('destinationConfirm').innerText = document.getElementById('standardDestination').value;
                document.getElementById('confirmDestination').value = document.getElementById('standardDestination').value;

                //document.getElementById('originConfirm').innerText = document.getElementById('standardOrigin').value;
                document.getElementById('confirmOrigin').value = document.getElementById('standardOrigin').value;

                document.getElementById('haulageValConfirm').innerText = document.getElementById('haulageVal').value;
                document.getElementById('confirmHaulageValue').value = document.getElementById('haulageVal').value;

                document.getElementById('weightConfirm').innerText = document.getElementById('weight').value;
                document.getElementById('confirmWeight').value = document.getElementById('weight').value;

                document.getElementById('itemDescriptionConfirm').innerText = document.getElementById('itemDescription').value;
                document.getElementById('confirmItemDescription').value = document.getElementById('itemDescription').value;

                document.getElementById('contactNameConfirm').innerText = document.getElementById('contactName').value;
                document.getElementById('confirmContactName').value = document.getElementById('contactName').value;

                document.getElementById('contactPhoneConfirm').innerText = document.getElementById('contactPhone').value;
                document.getElementById('confirmContactPhone').value = document.getElementById('contactPhone').value;

            })
        });
    </script>

    <script>
        $(document).ready(function() {

            $("#standardDestination").hide();
            $("#originDestinationAddon").hide();
            $("#destinationLabel").hide();

            $('#standardOrigin').on('change', function() {
                var val = this.value;
                var _token = $("input[name='_token']").val();

                document.getElementById('origin2').value = val;
                var original = document.getElementById('origin2').value;

                $.ajax({

                    url: "http://localhost/TMSC/public/checkOrigins",

                    type:'POST',

                    data: {_token:_token, originToServer:original},

                    success: function(data) {

                        if($.isEmptyObject(data.error)){

                            var length = data.success;
                            var trueLength = length.length;

                            if(trueLength > 0){
                                var catOptions = "";
                                for(var i = 0; i < trueLength; i++) {

                                    var company = data.success[i].destination;
                                    catOptions += "<option width='50%' value="+ data.success[i].id +">" + company + "</option>";
                                }
                                document.getElementById("standardDestination").innerHTML = catOptions;
                                $("#standardDestination").show();
                                $("#originDestinationAddon").show();
                                $("#destinationLabel").show();
                            }else{
                                alert("nothing");
                            }



                        }else if(trueLength == 0){

                            alert('error');

                        }

                    }

                });
            })
        });
        </script>
        <script src="{{url('//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js')}}"></script>

        <script>
            $(document).ready(function(){
                $('input.timepicker').timepicker({
                    timeFormat: 'h:mm p'
                });
            });
        </script>



    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />

    <!--  <script type="text/javascript" src="{{ url('js/jquery-3.2.1.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/admin_dashboard.js')}}"></script> -->

</head>
<style type="text/css">
    .image_file_uploader{
        display: none;
    }
    .copy_clipboard{
        top:40%;
        left: 30%;
        background: #000000ad;
        position: absolute;
        color: white;
        padding:10px 15px;
        font-size: 15px;
    }
    .image-remover{
        position: absolute;
        left: 0px;
        top:0px;
        font-size: 15px;
        width: 50px;
        color: red;
        z-index: 4;
    }
    .mce-notification-warning{
        display: none !important;
    }
    #image_uploader{
        display: none;
    }
    .admin-form{
        height: 40px;
        border-radius: 0px;
    }
    .stickers{
        width: 100%;
        margin-top: 13%;
        min-height: 40px;
        background: white;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
        box-shadow: -1px 3px 5px #0000004a;
    }
    .title{
        letter-spacing: 1px;
    }
    .sub-stickers{
        padding-top: 5px !important;
        padding-bottom: 5px !important;
        border-bottom: 2px solid #20070757;

    }
    .sub-stickers b{
    }
    .sticker-container>li{
        list-style: none;
        margin-left: 0px;
        padding-left: 5px;
        padding-top: 10px;
        margin-bottom: 5px;
        border-bottom: 3px solid black;
    }
    .main{
        padding-bottom: 20px;
    }
    .upload-thumbnail{
        width: 90%;
        margin-top:5%;
    }
    .empty_image{
        vertical-align: middle;
        display: block;
        margin:auto;
    }
    .empty_image_desc{
        border: 1px dashed grey;
        text-align: center;
        padding-top: 5px;
        padding-bottom: 5px;
    }
</style>

<nav class="navbar navbar-inverse sidebar" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="color: #ffffff;">TRUCKA</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"
                       class="dropdown-toggle" data-toggle="dropdown"
                       style="color: #ffffff;">Logout<span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-user"></span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">My Orders<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-newspaper-o"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="{{url('/home')}}">Create New Order</a></li>
                        <li><a href="{{ url('/viewOrders') }}">View My Orders</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- BODY OF PAGE -->
<body>
<div class="main" style="background-color: #0c0b0b08;">
    <div class="container-fluid">
        <h1 class="title"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> CREATE AN ORDER</h1>
        <!session message starts-->

        @if(session('message'))
        <p>
            {{ session('message') }}
        </p>
        @endif

        <!session message ends-->
        <div class="alert alert-danger print-error-msg" style="display:none">

            <ul></ul>
        </div>

        <div class="alert alert-success print-success-msg" style="display:none">

            <ul></ul>
        </div>
        <div class="row">
            <form>
                <div class="col-md-8">
                    <div class="postbody">
                        {{csrf_field()}}



                        <div class="form-group">
                            <label for="usr"><h4>Haulage Type</h4></label>
                            <select class="form-first-name form-control" name="resourceType" class="haulageType" id="haulageType">
                                <option value="">[-Haulage Type-]</option>
                                <option value="0">Land Freight</option>
                                <option value="1">Sea Freight</option>
                                <option value="2">Air Freight</option>
                            </select>

                        </div>

                        <div class="input-group">
                            <!--<label for="usr">Haulage Value</label>-->
                            <div style="color:black;">Pick Up Time</div>
                            <input type="text" width="50%" class="form-first-name timepicker form-control" id="pickupTime" name="pickupTime">
                            <span class="input-group-addon"></span>
                            <div style="color:black;">Pick Up Date</div>
                            <input width="50%" type="date" class="form-first-name form-control" name="pickupDate" id="pickupDate">
                        </div>
                        <br/>

                        <div class="general">
                            <div class="form-group">
                                <label for="usr"><h4>Request Type</h4></label>
                                <select name="haulageType" class="form-first-name form-control" name="haulageType" id="requestType">
                                    <option value="">[-REQUEST TYPE-]</option>
                                    <option value="0">Standard</option>
                                    <option value="1">Non Standard</option>
                                </select>
                            </div>
<br/>

                            <div class="input-group">
                                <div style="color:black;">Origin</div>
                                <select name="standardOrigin" class="form-first-name form-control" id="standardOrigin">
                                    <option value="">[-SELECT ORIGIN-]</option>
                                    @foreach($standardOrigin as $standardOrigins)
                                    <option value="{{$standardOrigins->origin}}">{{$standardOrigins->origin}}</option>
                                    @endforeach
                                </select>
                                <span id="originDestinationAddon" class="input-group-addon"></span>
                                <div style="color:black;" id="destinationLabel"><b>Destination</b></div>
                                <select name="standardDestination" class="form-form-first-name form-control" id="standardDestination">

                                </select>


                            </div>
                            <br/>

                            <div class="input-group">
                                <!--<label for="usr">Haulage Value</label>-->
                                <div style="color:black;">Haulage Value</div>
                                <input type="text" class="form-first-name form-control" name="haulageVal" id="haulageVal">
                                <span class="input-group-addon"></span>
                                <div style="color:black;">Approximate Weight (Tonnes)</div>
                                <input type="text" class="form-first-name form-control" name="weight" id="weight">
                            </div>
                            <br/>




                            <div style="color:black;">DESCRIBE THE ITEM(S) TO BE MOVED</div>
                                <textarea required class="form-control admin-form" name="itemDescription" id="itemDescription"></textarea>
                            </div>
                            <br/>

                            <div class="input-group">
                                <div style="color:black;">Contact Name</div>
                                <input type="text" class="form-first-name form-control" name="contactName" id="contactName">

                                <span class="input-group-addon"></span>
                                <div style="color:black;">Contact Phone</div>
                                <input type="text" class="form-first-name form-control" name="contactPhone" id="contactPhone">
                            </div>
                        <br/>
                        </div>


                    <div class="ShowMeStandard">

                        <div class="input-group">
                            <div style="color:black;">Destination</div>
                            <input type="text" class="form-first-name form-control" name="deliverTo" id="deliverTo">

                            <span class="input-group-addon"></span>
                            <div style="color:black;">Origin</div>
                            <input type="text" class="form-first-name form-control" name="deliverFrom" id="deliverFrom">
                        </div>


                        <div class="form-group">
                            <label for="usr"><h4>Offering Amount</h4></label>
                            <input type="text" class="form-first-name form-control" name="amount" id="amount">
                        </div>
                        <br/>

                    </div>

                    <div class="form-group">
                        <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary newOrderConfirm">Create New Standard Order</button>
                        <button type="submit" class="btn btn-primary newNonStandardOrder">Create New Non Standard Order</button>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="stickers">
                        <div class="row sub-stickers">
                            <div class="col-md-4"><b> <i class="fa fa-envelope" aria-hidden="true"></i> Email :</b></div>
                            <div class="col-md-8"> {{auth::user()->email}} </div>
                        </div>
                        <div class="row sub-stickers">
                            <div class="col-md-5">  <b> <i class="fa fa-user" aria-hidden="true"></i> Name :</b></div>
                            <div class="col-md-7"> {{auth::user()->name}} </div>
                        </div>

                    </div>
                </div>
            </form>
<form id="originForm" style="display:none;">
    <input type="hidden" id="origin2" name="originToServer">
</form>
        </div>
    </div>

</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirm Order Details</h4>
            </div>
            <div class="modal-body">
                <div class="description">
                    <div class="alert alert-danger print-error-msg" style="display:none">

                        <ul></ul>
                    </div>

                    <div class="alert alert-success print-success-msg" style="display:none">

                        <ul></ul>
                    </div>
                </div>
                <div class="form-bottom">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Haulage Type</h4>
                            <div id="haulageTypeConfirm"></div>
                        </div>
                        <div class="col-md-6">
                            <h4>Request Type</h4>
                            <div id="requestTypeConfirm"></div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Pick Up Time</h4>
                            <div id="pickupTimeConfirm"></div>
                        </div>
                        <div class="col-md-6">
                            <h4>Pick Up Date</h4>
                            <div id="pickupDateConfirm"></div>
                        </div>
                    </div>

                    <!--<div class="row">
                        <div class="col-md-6">
                            <h4>Origin</h4>
                            <div id="originConfirm"></div>
                        </div>
                        <div class="col-md-6">
                            <h4>Destination</h4>
                            <div id="destinationConfirm"></div>
                        </div>
                    </div>-->

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Haulage Value</h4>
                            <div id="haulageValConfirm"></div>
                        </div>
                        <div class="col-md-6">
                            <h4>Weight</h4>
                            <div id="weightConfirm"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>Contact Name</h4>
                            <div id="contactNameConfirm"></div>
                        </div>
                        <div class="col-md-6">
                            <h4>Contact Phone</h4>
                            <div id="contactPhoneConfirm"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Item Description</h4>
                            <div id="itemDescriptionConfirm"></div>
                        </div>
                    </div>


                    <form  id="newOrder">
                        {{ csrf_field() }}

                        <!--<input type="hidden" name="haulageType0" id="confirmHaulageTypex">-->
                        <input type="hidden" name="haulageType" id="confirmRequestType">
                        <input type="hidden" name="standardOrigin" id="confirmOrigin">
                        <input type="hidden" name="standardDestination" id="confirmDestination">
                        <input type="hidden" name="pickupDate" id="confirmPickUpDate">
                        <input type="hidden" name="pickupTime" id="confirmPickUpTime">
                        <input type="hidden" name="haulageVal" id="confirmHaulageValue">
                        <input type="hidden" name="itemDescription" id="confirmItemDescription">
                        <input type="hidden" name="weight" id="confirmWeight">
                        <input type="hidden" name="contactName" id="confirmContactName">
                        <input type="hidden" name="contactPhone" id="confirmContactPhone">

                        <button data-dismiss="modal" class="btn btn-success btn-submit newStanOrder">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                    </form>
                    &nbsp;
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>

</div>

</body>
</html>