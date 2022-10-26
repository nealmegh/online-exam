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
    @if(Session::has('message'))
        <div class="alert alert-gradient mb-4" role="alert">
            <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  data-dismiss="alert" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif
    <div class="container">
        <div class="container">
            <div class="row layout-top-spacing">

                <div id="flActionButtons" class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h2><small>create</small> New Question </h2>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="" method="post" action="{{route('questions.store')}}">
                                @csrf
                                <div class="form-row mb-4" style="margin-bottom: 0px !important;">
                                    <div class="col-md-4">
                                        <label for="category_id">Category</label>
                                        <select id="category_id" class="form-control userDriver" name="category_id">
                                            <option value="">Select a Category</option>
                                            <option value="seru" selected>SERU</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="type_id">Type</label>
                                        <select id="type_id" class="form-control userDriver" name="type_id" onchange="cityChangedTrigger()">
                                            <option value="">Select a Type</option>

                                            <option value="mcq" {{request()->type_id == 'mcq'? 'selected':''}}>Multiple Choice</option>
                                            <option value="dnd" {{request()->type_id == 'dnd'? 'selected':''}}>Drag And Drop</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="mcq_type" class="mcq_type" style="{{request()->type_id != 'mcq'?'Display: None;':''}}">
                                        <div class="form-group mb-4">
                                            <label class="control-label">Question:</label>
                                            <textarea id="text" name="text" placeholder="Question" required="required" class="form-control" {!!  request()->type_id != 'mcq'?'Disabled="Disabled"':''!!}></textarea>
                                        </div>
                                </div>
                                <div id="mcq_type" class="mcq_type" style="{{request()->type_id != 'dnd'?'Display: None;':''}}">
                                    <table class="table" id="dynamicAddRemoveQuestion">
                                        <tr>
                                            <th>Question</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td>
{{--                                                <input type="text" name="addMoreQuestionFields[0][question]" placeholder="Enter Question" class="form-control" />--}}
                                                <textarea name="addMoreQuestionFields[0][question]" placeholder="Enter Question" class="form-control"></textarea>
                                            </td>
                                            <td><button type="button" name="add" id="dynamic-arq" class="btn btn-outline-primary">+</button></td>
                                        </tr>
                                    </table>
                                </div>
                                        <table class="table" id="dynamicAddRemove">
                                            <tr>
                                                <th>Answer</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <td><input type="text" name="addMoreInputFields[0][subject]" placeholder="Enter Answer" class="form-control" />
                                                </td>
                                                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">+</button></td>
                                            </tr>
                                        </table>

                                <div class="form-group mb-4">
                                    <label class="control-label">Correct Answer <span class="required">*</span></label>
                                    <input type="text" id="correct_answer" name="correct_answer" placeholder="Correct Answer" required="required" class="form-control" >

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
    <script>
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
                '][subject]" placeholder="Enter Answer" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });
    </script>
    <script>
        function cityChangedTrigger () {
            let queryString = window.location.search;  // get url parameters
            let params = new URLSearchParams(queryString);  // create url search params object
            params.delete('type_id');  // delete city parameter if it exists, in case you change the dropdown more then once
            params.append('type_id', document.getElementById("type_id").value); // add selected city
            document.location.href = "?" + params.toString(); // refresh the page with new url
        }
    </script>

    <script>
        var i = 0;
        // $("#dynamic-arq").click(function () {
        //     ++i;
        //     $("#dynamicAddRemoveQuestion").append('<tr><td><input type="text" name="addMoreQuestionFields[' + i +
        //         '][question]" placeholder="Enter Part Question" class="form-control" /></td><td><button type="button" class="btn btn-outline-danger remove-input-field-question">Delete</button></td></tr>'
        //     );
        // });
        $("#dynamic-arq").click(function () {
            ++i;
            $("#dynamicAddRemoveQuestion").append('<tr><td><textarea name="addMoreQuestionFields[' + i +
                '][question]" placeholder="Enter Part Question" class="form-control" ></textarea></td><td><button type="button" class="btn btn-outline-danger remove-input-field-question">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field-question', function () {
            $(this).parents('tr').remove();
        });
    </script>

@endsection
