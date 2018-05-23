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
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <!-- <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">-->
    <link rel="stylesheet" href="{{ url('fontawesome/css/font-awesome.min.css') }}">
    <script type="text/javascript" src="{{ url('js/searchResources.js')}}"></script>
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
            <div> <h2 class="title"> <i class="fa fa-thumb-tack" aria-hidden="true"></i> Resource Details </h2>  </div>
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

            <div class="description">
                <div class="alert alert-danger print-error-msg" style="display:none">

                    <ul></ul>
                </div>

                <div class="alert alert-success print-success-msg" style="display:none">

                    <ul></ul>
                </div>
            </div>
            <br/>

        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="panel-body">
                    <p><b>Order Details</b></p>
                    <div class="well">
                        <div>

                            @foreach($resourceQuery as $orderDetail)
                            <p><b>Service ID No</b>: {{$serviceIDNo }}</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Origin:</b> {{ $orderDetail->origin }}
                                </div>
                                <div class="col-md-4">
                                    <b>Destination:</b> {{ $orderDetail->destination }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <b>Estimated Weight:</b> {{ $estimatedWgt }}
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <form id="haulReq" name="haulageRequest">
                        {{ csrf_field() }}
                        @foreach($resourceQuery as $orderDetail)
                        <input type="hidden" name="carrier_id" value="{{$orderDetail->user_id}}">
                        <input type="hidden" name="resource_id" value="{{$orderDetail->id}}">
                        @endforeach
                        <table class="table-bordered table-responsive table">
                            <thead>
                                <tr>
                                    <th>Resource Type</th>
                                    <th>Number Required</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userOrder as $user)
                                    <tr>
                                        <td>{{$user->resourceType}}&nbsp; <input value="{{$user->resourceType}}" type="checkbox" name="resourceType[]"></td>
                                        <td><input type="text" name="resourceNumber[]"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <input type="hidden" name="orderID" value="{{$serviceIDNo}}">
                        <div class="form-group">
                            <button class="btn btn-success btn-sm haulageRequest">Send Resource Request</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel-body">
                    <p><b>Carrier Resource Details</b></p>
                    <div class="well">
                        <h4>Resource Type(Number)</h4>
                        @foreach($carrRes as $carrDetail)
                    <p>{{$carrDetail->resourceType}}({{$carrDetail->numberOfResource}})</p>
                    @endforeach
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<!-- Include external JS libs. -->

</body>
</html>