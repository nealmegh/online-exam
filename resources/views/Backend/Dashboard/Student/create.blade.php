@extends('theme.base')
@section('head-customization')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
{{--    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/datatables.css")}}>--}}
{{--    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/custom_dt_html5.css")}}>--}}
{{--    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/dt-global_style.css")}}>--}}
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/font-icons/fontawesome/css/regular.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/font-icons/fontawesome/css/fontawesome.css")}}>
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <link href={{asset("css/theme/scrollspyNav.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/animate/animate.css")}} rel="stylesheet" type="text/css" />
    <script src={{asset("css/theme/plugins/sweetalerts/promise-polyfill.js")}}></script>
    <link href={{asset("css/theme/plugins/sweetalerts/sweetalert2.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/sweetalerts/sweetalert.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/components/custom-sweetalert.css" )}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/forms/switches.css" )}} rel="stylesheet" type="text/css" />
    <style>
        .create-button{
            position: relative;
            width: fit-content;
        }
        .button-holder{
            padding-top: 1.5%;
            padding-bottom: 30px;
            margin-bottom: 2px;

        }
        .create-button-btn{
            position: absolute;
            right: 0% !important;
        }
    </style>

@endsection

@section('main-content')

<div class="container">
    <div class="container">
            <div class="row layout-top-spacing">
                @if(Session::has('message'))
                    <div class="alert alert-gradient mb-4" role="alert">
                        <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  data-dismiss="alert" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                        <strong>{{ Session::get('message') }}</strong>
                    </div>
                @endif
                <div id="flActionButtons" class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h2><small>create</small> Students </h2>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="" method="post" action="{{route('students.store')}}">
                                @csrf
                                <div class="form-group mb-4">
                                    <label class="control-label">Name:</label>
                                    <input id="name" name="name" placeholder="Name" required="required" type="text" class="form-control" >
                                </div>
                                <div class="form-group mb-4">
                                    <label class="control-label">Email <span class="required">*</span><span> (Default Pass: Exam123456)</span></label>
                                    <input type="email" id="email" name="email" placeholder="Email Address" data-validate-minmax="1,20" required="required" class="form-control" >

                                </div>

                                <input type="hidden" name="password" value="Exam123456">
                                <div class="form-group mb-4">
                                    <label class="control-label" for="phone_full">Phone<span class="required">*</span></label>
                                    <input type="text" id="phone_full" name="phone_full" placeholder="Phone Number" required="required" class="form-control" >
                                </div>
                                <div class="form-group mb-4">
                                    <label class="control-label">Address:</label>
                                    <input id="address" name="address" placeholder="Address" required="required" type="text" class="form-control" >
                                </div>
                                <div class="form-group mb-4">
                                    <label class="control-label">Post Code:</label>
                                    <input id="post_code" name="post_code" placeholder="Post Code" required="required" type="text" class="form-control" >
                                </div>
                                <div class="form-group mb-4">
                                    <label class="control-label">Passport Number:</label>
                                    <input id="passport_number" name="passport_number" placeholder="Passport Number" required="required" type="text" class="form-control" >
                                </div>
                                <div class="form-group mb-4">
                                    <label class="control-label">Date of Birth:</label>
                                    <input id="dob" name="dob" placeholder="Date of Birth" required="required" type="date" class="form-control" >
                                </div>
                                <div class="form-group mb-4">
                                    <label class="control-label" for="r_status">Active<span class="required">*</span></label> <br>
                                    <label class="switch s-icons s-outline s-outline-success mr-2">
                                        <input id="r_status" name="r_status" type="checkbox" value="1" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <input type="hidden" id="status" name="status" value="1">
                                <input type="hidden" id="role_id" name="role_id" value="2">
                                <div class="form-row mb-4" style="margin-bottom: 0px !important;">
                                    <label for="course_id">Course</label>
                                    <select id="course_id" class="form-control userDriver" name="course_id" required="required">
                                        <option value="" selected>Select a Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <a href="{{url()->previous()}}" class="btn btn-danger ml-3 mt-3">Cancel</a>
                                <button id="send" type="submit" class="btn btn-success ml-3 mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
@endsection

@section('js-customization')
    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
        <script src= {{ asset("js/theme/plugins/perfect-scrollbar/perfect-scrollbar.min.js") }}></script>
        <script src={{ asset("js/theme/plugins/table/datatable/datatables.js") }}></script>
        <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
        <script src={{asset("js/theme/plugins/table/datatable/button-ext/dataTables.buttons.min.js")}}></script>
        <script src={{asset("js/theme/plugins/table/datatable/button-ext/jszip.min.js")}}></script>
        <script src={{asset("js/theme/plugins/table/datatable/button-ext/buttons.html5.min.js")}}></script>
        <script src={{asset("js/theme/plugins/table/datatable/button-ext/buttons.print.min.js")}}></script>

        <!-- BEGIN THEME GLOBAL STYLE -->
        <script src={{asset("js/theme/js/scrollspyNav.js")}}></script>
        <script src={{asset("js/theme/plugins/sweetalerts/sweetalert2.min.js")}}></script>
        <script src={{asset("js/theme/plugins/sweetalerts/custom-sweetalert.js")}}></script>
        <!-- END THEME GLOBAL STYLE -->
        <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
    <script>
        $(document).on("click", "#r_status", function(){
            if(document.getElementById('status').value === '1')
            {
                document.getElementById('r_status').value= '0';
                document.getElementById('status').value= '0';
            }
            else {
                document.getElementById('r_status').value='1';
                document.getElementById('status').value='1';
            }

        });
    </script>

@endsection
