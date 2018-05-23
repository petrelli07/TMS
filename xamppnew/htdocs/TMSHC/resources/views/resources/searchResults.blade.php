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

            <form id="resourceSearch">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div style="color:black;">Resource Type</div>
                            <select class="form-first-name form-control" required name="resourceType" id="resourceType">
                                <option value="">[-Resource Type-]</option>
                                <option value="0">Truck</option>
                                <option value="1">Ship</option>
                                <option value="2">Cargo Plane</option>
                            </select>
                            <span class="input-group-addon"></span>
                            <div style="color:black;">Estimated Capacity(Tonnes)</div>
                            <input class="form-first-name form-control" required name="estimatedCapacity" id="form-first-name">

                            <span class="input-group-addon"></span>
                            <div style="color:black;">Resource Status</div>
                            <select class="form-first-name form-control" required name="resourceStatus"  id="form-first-name">
                                <option value="">[-Resource Status-]</option>
                                <option value="0">Available</option>
                                <option value="1">In Use</option>
                                <option value="2">Inactive</option>
                                <option value="2">Under Maintenance</option>
                            </select>

                            <span class="input-group-addon"></span>
                            <div style="color:black;">Type Of Route</div>
                            <select class="form-first-name form-control" required name="routeType"  id="form-first-name">
                                <option value="">[-Route Type-]</option>
                                <option value="0">Nationwide</option>
                                <option value="1">SW</option>
                                <option value="2">SE</option>
                                <option value="3">SS</option>
                                <option value="4">NE</option>
                                <option value="5">NW</option>
                                <option value="6">NC</option>
                                <option value="7">International</option>
                            </select>

                            <span class="input-group-addon"></span>
                            <div style="color:black;">GIT Insurance</div>
                            <select class="form-first-name form-control" required name="git"  id="form-first-name">
                                <option value="">[-GIT-]</option>
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                        </div>
                        <div style="margin-top: 5px; margin-bottom:5px;">
                            <button class="btn btn-small btn-success searchResources">Search</button>
                        </div>

                    </div>
                </div>
            </form>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="table-responsive">

                    <table class="table table-striped">

                        <thead>
                        <tr class="row-name" style="background-color: #34495e; color: #ffffff;">
                            <th>Resource ID</th>
                            <th>Action</th>
                            <th>{{$serviceIDNo}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($resourceQuery as $allRequest)
                        <tr class="row-content">
                            <td><h5>{{$allRequest->resource_id}}</h5></td>
                            <td>
                                <a class="label label-primary" href='{{ url("/viewResource/{$allRequest->resource_id}") }}' title="View Resource"  class="label label-primary">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @empty
                        No Resource Found
                        @endforelse
                        {{$resourceQuery->links()}}
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