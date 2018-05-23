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
    <script type="text/javascript" src="{{ url('js/newUser.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/newCarrier.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/newClient.js')}}"></script>
<!--    <script>

        $(document).ready(function() {
            $(".ShowMe").hide();
            $(".carrierDetails").hide();
            $('#userCategory').on('change', function() {
                if ( this.value == '2')
                //.....................^.......
                {


                }
                else
                {
                    $(".ShowMe").hide();
                    $(".userDetails").show();
                    $(".carrierDetails").hide();
                }
            });

            $('.carrierDetails').on('click', function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var userCategory = $('#userCategory').val();

                document.getElementById('emailModal').value = email;
                document.getElementById('nameModal').value = name;
                document.getElementById('categoryModal').value = userCategory;
            });
        });
    </script>-->


    <script>

        $(document).ready(function() {
            $(".ShowMeClient").hide();
            $(".clientDetails").hide();

            $(".ShowMe").hide();
            $(".carrierDetails").hide();

            $('#userCategory').on('change', function() {
                if ( this.value == '1')
                //.....................^.......
                {
                    $(".ShowMeClient").show();
                    $(".userDetails").hide();
                    $(".clientDetails").show();

                    $('.clientDetails').on('click', function() {
                        var clientName = $('#name').val();
                        var clientEmail = $('#email').val();
                        var userClientCategory = $('#userCategory').val();

                        document.getElementById('clientemailModal').value = clientName;
                        document.getElementById('clientnameModal').value = clientEmail;
                        document.getElementById('clientcategoryModal').value = userClientCategory;
                    });

                }
                else if ( this.value == '2'){

                        //alert("2");

                        $(".ShowMe").show();
                        $(".userDetails").hide();
                        $(".carrierDetails").show();

                        $('.carrierDetails').on('click', function() {
                            var name = $('#name').val();
                            var email = $('#email').val();
                            var userCategory = $('#userCategory').val();

                            document.getElementById('emailModal').value = email;
                            document.getElementById('nameModal').value = name;
                            document.getElementById('categoryModal').value = userCategory;
                        });



                }
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
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: #ffffff;">Manage Users<span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity fa fa-newspaper-o"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a href="{{url('/home')}}">Create Users</a></li>
                        <li><a href="{{url('/viewAllUsers')}}">View All Users</a></li>
                    </ul>
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
                        <li><a class="btn btn-success edit" href='{{ url("/viewAllResources") }}' title="View Details">
                                View All Resources
                            </a></li>
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
        <h1 class="title"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> CREATE A USER</h1>
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
            <form id="userDetails"  method="post">
                {{csrf_field()}}
                <div class="col-md-8">
                    <div class="postbody">

                        <div class="form-group">
                            <label for="usr"><h4>Name</h4></label>
                            <input type="text" name="name" class="form-control admin-form" id="name">

                        </div>

                        <div class="form-group">
                            <label for="usr"><h4>Email Address</h4></label>
                            <input type="text" name="email" class="form-control admin-form" id="email">

                        </div>

                        <div class="form-group">
                            <label for="usr"><h4>User Category</h4></label>
                            <select name="category" required class="form-control admin-form" id="userCategory">
                                <option value="">Choose a category</option>
                                <option value="0">[-ADMIN-]</option>
                                <option value="1">[-CLIENT-]</option>
                                <option value="2">[-HAULAGE COY-]</option>
                               </select>
                        </div>
                        <div class="ShowMe row">
                            <a href="#" data-toggle="modal" data-target="#myModal" class="carrierDetails">
                                <div class="col-sm-8 col-sm-offset-2" style="border:1px dashed; margin:10px;">
                                     <span class="fa fa-plus" style="margin-left:100px; font-size: 24px; color: red;"></span>
                                     <p style="margin-left:50px;"><b>Add Carrier Details (Required)</b></p>
                                </div>
                            </a>
                        </div>
                        <div class="ShowMeClient row">
                            <a href="#" data-toggle="modal" data-target="#myClientModal" class="clientDetails">
                                <div class="col-sm-8 col-sm-offset-2" style="border:1px dashed; margin:10px;">
                                     <span class="fa fa-plus" style="margin-left:100px; font-size: 24px; color: red;"></span>
                                     <p style="margin-left:50px;"><b>Add Client Details (Required)</b></p>
                                </div>
                            </a>
                        </div>
                        <button type="submit" class="btn btn-primary userDetails">Create User</button>
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

                        <!-- <div class="row sub-stickers">
                           <div class="col-md-5"><b> <i class="fa fa-sign-in" aria-hidden="true"></i> Last log in :</b></div>
                           <div class="col-md-7"> 3rd of May 2017 </div>
                         </div>
                         <div class="row sub-stickers">
                           <div class="col-md-5"><b> <i class="fa fa-pencil" aria-hidden="true"></i> Latest Post:</b></div>
                           <div class="col-md-7">How to make smoothies </div>
                         </div>-->

                    </div>
                </div>
            </form>
        </div>
    </div>


    <!--Cient Modal -->
    <div id="myClientModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Client Details</h4>
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

                        <form id="clientDetails"  class="newTestCase">
                            {{ csrf_field() }}
                            <div class="input-group" style="margin-bottom: 30px;">
                                <div style="color:black;">Registered Company Name</div>
                                <label class="sr-only" for="form-first-name">Registered Company Name</label>
                                <input placeholder="Registered Company Name..." class="form-first-name form-control" id="companyName" name="companyName" required="required">
                            </div>

                            <div class="form-group" style="margin-bottom: 30px;">
                                <div style="color:black;">RC Number</div>
                                <label class="sr-only" for="form-first-name">RC Number</label>
                                <input placeholder="RC Number..." class="form-first-name form-control" id="rcNumber" name="rcNumber" required="required">
                            </div><!--

                            <div class="form-group" style="margin-bottom: 30px;">
                                <div style="color:black;">Item Description</div>
                                <label class="sr-only" for="form-first-name">Item Description</label>
                                <input placeholder="Item Description..." class="form-first-name form-control" id="itemDescription" name="itemDescription" required="required">
                            </div>-->

                            <!--<div class="form-group" style="margin-bottom: 30px;">
                                <div style="color:black;">Packaging Type</div>
                                <label class="sr-only" for="form-first-name">Packaging Type</label>
                                <select class="form-first-name form-control col-md-3" required name="packagingType" id="packagingType">
                                    <option value="">[-Packaging Type-]</option>
                                    <option value="0">Pallets</option>
                                    <option value="1">Single</option>
                                    <option value="2">Others</option>
                                </select>
                            </div>


                            <!--<div class="stepresults_wrap" style="margin-bottom: 30px;">
                                <button class="stepresults_add_resource_button btn-md btn-success">Add More Resources</button>
                            </div>
                            <br/>-->
                            <div class="form-group" style="margin-bottom: 30px;">
                                <p>Upload Client Standard Form Here</p>
                                <input type="file" name="clientForm" required>
                            </div>

                            <br/>
                            <input type="hidden" name="clientemail" id="clientemailModal">
                            <input type="hidden" name="clientname" id="clientnameModal">
                            <input type="hidden" name="clientcategory" id="clientcategoryModal">

                            <button class="btn btn-success btn-submit newClientDets">Submit</button>

                        </form>
                        &nbsp;
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    <h4 class="modal-title">New Carrier Details</h4>
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

                        <form id="carrDetails"  class="newTestCase" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="input-group" style="margin-bottom: 30px;">
                                <div style="color:black;">Registered Company Name</div>
                                <label class="sr-only" for="form-first-name">Registered Company Name</label>
                                <input placeholder="Registered Company Name..." class="form-first-name form-control" id="companyName" name="companyName" required="required">
                            </div>

                            <div class="form-group" style="margin-bottom: 30px;">
                                <div style="color:black;">RC Number</div>
                                <label class="sr-only" for="form-first-name">RC Number</label>
                                <input placeholder="RC Number..." class="form-first-name form-control" id="rcNumber" name="rcNumber" required="required">
                            </div>

                            <div class="form-group" style="margin-bottom: 30px;">
                                <p>Upload Carrier Standard Route Map File</p>
                                <input type="file" name="carrierRoute" required>
                            </div>

                            <div class="form-group" style="margin-bottom: 30px;">
                                <p>Upload Carrier Standard Resource Data File</p>
                                <input type="file" name="carrierForm" required>
                            </div>
                            <br/>

                            <input type="hidden" name="email" id="emailModal">
                            <input type="hidden" name="name" id="nameModal">
                            <input type="hidden" name="category" id="categoryModal">

                            <button class="btn btn-success btn-submit newCarrDets">Submit</button>

                        </form>
                        &nbsp;
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>

</div>

<!-- Include external JS libs. -->
<script type="text/javascript">
    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".stepresults_wrap"); //Fields wrapper
        var add_button      = $(".stepresults_add_resource_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><div class="input-group"><div style="color:black;">Resource Type</div><select class="form-first-name form-control" name="resourceType[]" id="resourceType"><option value="0">Truck</option><option value="1">Ship</option><option value="2">Cargo Plane</option></select><span class="input-group-addon"></span><div style="color:black;">Estimated Capacity(Tonnes)</div><input class="form-first-name form-control" name="estimatedCapacity[]" id="form-first-name"><span class="input-group-addon"></span><div style="color:black;">Resource Status</div><select class="form-first-name form-control" name="resourceStatus[]"  id="form-first-name"><option value="0">Truck</option><option value="1">Ship</option><option value="2">Cargo Plane</option></select><span class="input-group-addon"></span><div style="color:black;">Type Of Route</div><select class="form-first-name form-control" name="routeType[]"  id="form-first-name"><option value="0">Nationwide</option><option value="1">SW</option><option value="2">SE</option><option value="3">SS</option><option value="4">NE</option><option value="5">NW</option><option value="6">NC</option><option value="7">International</option></select><span class="input-group-addon"></span><div style="color:black;">GIT Insurance</div><select class="form-first-name form-control" name="git[]"  id="form-first-name"><option value="0">NO</option><option value="1">YES</option></select></div><div class="input-group"><div style="color:black;">Origin</div><input class="form-first-name form-control" name="origin[]"  id="form-first-name"><span class="input-group-addon"></span><div style="color:black;">Destination</div><input class="form-first-name form-control" name="destination[]"  id="form-first-name"><span class="input-group-addon"></span><div style="color:black;">Price</div><input class="form-first-name form-control" name="price[]"  id="form-first-name"></div><br/><a href="#" class="remove_field_prerequsite">Remove</a></div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field_prerequsite", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
</script>
</body>
</html>