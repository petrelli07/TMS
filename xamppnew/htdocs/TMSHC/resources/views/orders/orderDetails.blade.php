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
    <script type="text/javascript" src="{{ url('js/searchResources.js')}}"></script>
    <script>
        $(document).ready(function() {
            $("tbody").on("click", "button.getResourceID", function(e){
//                $(".getResourceID").click(function(e){
                e.preventDefault();

                $.ajax({

                    async:false,

                    processData: false,

                    contentType: false,

                    url: "http://localhost/TMSA/public/createNewUser",

                    type:'POST',

                    data: new FormData($("#carrDetails")[0]),

                    success: function(data) {

                        if($.isEmptyObject(data.error)){

                            printSuccessMsg(data.success);

                            $("#userDetails")[0].reset();

                        }else{

                            printErrorMsg(data.success);

                        }

                    }

                });
                $('.hideMe').hide()
                var value = document.getElementById("res").value;

            });
        });
    </script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="{{ url('fontawesome/css/font-awesome.min.css') }}">
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <!-- Include Editor style. -->


    <!--  <script type="text/javascript" src="{{ url('js/jquery-3.2.1.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/admin_dashboard.js')}}"></script> -->

</head>

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
                        <li><a href="{{url('/viewOrders')}}">View All Orders</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">All Resources<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-newspaper-o"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="#">View All Resources</a></li>
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
        <div class="page_header">
            <div> <h2 class="title"> <i class="fa fa-thumb-tack" aria-hidden="true"></i> Order Details </h2>  </div>
        </div>
        <div class="post_details container">
            <div class="overview_text" >
                <div><h6></h6></div>
                <!session message starts-->

                @if(session('message'))
                <p>
                    {{ session('message') }}
                </p>
                @endif

                <!session message ends-->
            </div>



        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="panel-body">
                    <div class="well">
                        @foreach($orderDetails as $orderDetail)
                        <p><b>Service ID No</b>: {{ $orderDetail->serviceIDNo }}</p>
                        <div>
                            <p>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Capacity Required:</b> {{ $orderDetail->estimatedWgt }}
                                </div>
                                <div class="col-md-4">
                                    <b>Value Of Haulage:</b> {{ $orderDetail->valueOfHaulage }}
                                </div>
                                <div class="col-md-4">
                                    <b>Cost Of Haulage:</b> {{ $orderDetail->amountForHaulage }}
                                </div>
                            </div>
                            </p>


                        <p><b>Deliver From</b>: {{ $orderDetail->deliverFrom }} | <b>Deliver To</b>: {{ $orderDetail->deliverTo }}</p>
                        <p><b>Item Description</b>: {{ $orderDetail->itemDescription }}</p>
                        <p>
                            <b>Required Resource Type</b>:
                            @if($orderDetail->requiredResourceType==0)
                            20 Tonne Truck
                            @elseif($orderDetail->requiredResourceType==1)
                            10 Tonne Truck
                            @elseif($orderDetail->requiredResourceType==2)
                            5 Tonne Truck
                            @endif
                        </p>
                    </div>
                    </div>
                </div>
                @if($orderDetail->orderStatus == 0)
                <a class="btn btn-success edit" href='{{ url("/confirm/{$orderDetail->serviceIDNo}") }}' title="Approve">
                   Approve <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                </a>
                @endif
            </div>

            @endforeach
        </div>
    </div>
</div>

<!-- Include external JS libs. -->

</body>
</html>