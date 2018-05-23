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
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>

    $(document).ready(function(){
        $('input.timepicker').timepicker({
            timeFormat: 'h:mm p',
            interval: 60,
            minTime: '10',
            maxTime: '6:00pm',
            defaultTime: '11',
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>


<script>
    $(document).ready(function() {
        $("#clockIn").hide();

        $('.timein').on('click', function() {
            $("#clockIn").show();
            $(".timein").hide();

        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#clockOut").hide();

        $('.timeOut').on('click', function() {
            $("#clockOut").show();
            $(".timeOut").hide();

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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

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
            <div> <h2 class="title"> <i class="fa fa-thumb-tack" aria-hidden="true"></i> All Orders </h2>  </div>
        </div>
        <div class="post_details">
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
            <div class="sorting_bar">
                 <form>
                     <label>Search By</label>
                     <div class="row">
                         <select class="col-md-2">
                             <option value="">Search By</option>
                             <option value="">By Date Created</option>
                             <option value="">By Order ID</option>
                         </select>
                     </div>
                 </form>
            </div>
            <br/>
        </div>

        <div class="row">
            <div class="col-md-11 ">
                <div class="table-responsive">

                    <table class="table table-striped">

                        <thead>
                        <tr class="row-name" style="background-color: #34495e; color: #ffffff;">
                            <th>Resource ID</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($haulageRequests as $allRequest)
                        <tr class="row-content">
                            <td><h5>{{$allRequest->serviceIDNo}}</h5></td>
                            <td>
                            @if($allRequest->status == 0)
                                <a class="btn btn-success edit" href='{{ url("/confirm/{$allRequest->serviceIDNo}") }}' title="Approve">
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                </a>|

                                <a class="btn btn-success edit" href='{{ url("/view_order/{$allRequest->serviceIDNo}") }}' title="View Details">
                                 View Order Details <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            @elseif($allRequest->status == 1)
                                <a class="btn btn-success edit" href='{{ url("/checkInvoice/{$allRequest->order_id}") }}' title="Check Invoice">
                                    Check Invoice
                                </a>
                            @elseif($allRequest->status == 2)
                                <a class="btn btn-success edit" href='{{ url("/view_order/{$allRequest->serviceIDNo}") }}' title="View Details">
                                 View Order Details   <i class="fa fa-eye" aria-hidden="true"></i>
                                </a> |
                                <a class="btn btn-success edit timein"  title="Clock In">
                                    <i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Clock In
                                </a>&nbsp;
                                <form id="clockIn" method="post" action="{{ url('/timeIn') }}">
                                    {{ csrf_field() }}
                                    <div class="input-group">
                                    <input type="text" class="timepicker" name="timeIn">
                                        <input type="hidden" name="serviceIDNo" value="{{ $allRequest->serviceIDNo }}">
                                        <input type="hidden" name="orderID" value="{{ $allRequest->order_id }}">
                                        <input type="hidden" name="haulageRequestID" value="{{ $allRequest->id }}">
                                        <input type="hidden" name="carrierID" value="{{ $allRequest->carrier_id }}">
                                        &nbsp;
                                    <button type="submit" class="btn-success btn">Time In</button>
                                </form>
                            @elseif($allRequest->status == 3)
                                <a class="btn btn-success edit timeOut"  title="Clock In">
                                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Clock Out
                                </a>|
                                <a class="btn btn-success edit" href='{{ url("/view_order/{$allRequest->serviceIDNo}") }}' title="View Details">
                                    View Order Details   <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>|
                                &nbsp;
                                <form id="clockOut" method="post" action="{{ url('/timeOut') }}">
                                    {{ csrf_field() }}
                                    <div class="input-group">
                                        <input type="text" class="timepicker" name="timeOut">
                                        <input type="hidden" name="serviceIDNoOut" value="{{ $allRequest->serviceIDNo }}">
                                        <input type="hidden" name="orderIDOut" value="{{ $allRequest->order_id }}">
                                        <input type="hidden" name="haulageRequestIDOut" value="{{ $allRequest->id }}">
                                        <input type="hidden" name="carrierIDOut" value="{{ $allRequest->carrier_id }}">
                                        &nbsp;
                                        <button type="submit" class="btn-success btn">Time Out</button>
                                </form>
                                @elseif($allRequest->status == 4)
                                Order In Progress
                                @elseif($allRequest->status == 5)
                                Order Completed
                            @endif
                            </td>
                        </tr>
                        @empty
                        No Request Exist Yet
                        @endforelse
                        {{$haulageRequests->links()}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Include external JS libs. -->

</body>
</html>