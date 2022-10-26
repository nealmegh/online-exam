@extends('theme.base')
@section('head-customization')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    {{--    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/datatables.css")}}>--}}
    {{--    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/custom_dt_html5.css")}}>--}}
    {{--    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/dt-global_style.css")}}>--}}
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/font-icons/fontawesome/css/regular.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/font-icons/fontawesome/css/fontawesome.css")}}>
{{--    <link href="{{asset('css/2Frontend/vendor/telephone/intlTelInput.css')}}" rel="stylesheet">--}}
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <link href={{asset("css/theme/scrollspyNav.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/animate/animate.css")}} rel="stylesheet" type="text/css" />
    <script src={{asset("css/theme/plugins/sweetalerts/promise-polyfill.js")}}></script>
    <link href={{asset("css/theme/plugins/sweetalerts/sweetalert2.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/sweetalerts/sweetalert.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/components/custom-sweetalert.css" )}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/forms/switches.css" )}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/select2/select2.min.css" )}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/flatpickr/custom-flatpickr.css" )}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/flatpickr/flatpickr.css" )}} rel="stylesheet" type="text/css" />


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
        .custom-bipon-container{
            max-width: 80% !important;
            margin-left: 5% !important;
        }
        @media (max-width: 50px) {
            .sidenav {
                display: none !important;
            }
        }
    </style>

@endsection

@section('main-content')
    @if(Session::has('message'))
        <div class="alert alert-gradient mb-4" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
            <strong>{{ Session::get('message') }}</strong>
        </div>
    @endif
    <div class="custom-bipon-container container " style="max-width: 80% !important;">
        <div class="container">
            <div class="row layout-top-spacing">
                <div id="flActionButtons" class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h2><small>edit</small> Question </h2>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <form class="" method="POST" action="{{route('questions.update', $question->id)}}">
                                @csrf
                                {{ method_field('PUT') }}
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

                                            <option value="mcq" {{$question->type == 'mcq'? 'selected':''}}>Multiple Choice</option>
                                            <option value="dnd" {{$question->type == 'dnd'? 'selected':''}}>Drag And Drop</option>
                                        </select>
                                    </div>
                                </div>
                                @if(request()->type_id == 'mcq')

                                <div id="mcq_type" class="mcq_type" style="{{request()->type_id != 'mcq'?'Display: None;':''}}">
                                    <div class="form-group mb-4">
                                        <label class="control-label">Question:</label>
                                        <textarea id="text" name="text" placeholder="Question" required="required" class="form-control" >{{$question->text}}</textarea>
                                    </div>
                                </div>
                                @endif
                                @if(request()->type_id == 'dnd')
                                <div id="mcq_type" class="mcq_type" style="{{request()->type_id != 'dnd'?'Display: None;':''}}">
                                    <table class="table" id="dynamicAddRemoveQuestion">
                                        <tr>
                                            <th>Question</th>
                                            <th></th>
                                        </tr>
                                        @php
                                            $questions = json_decode($question->text);
                                        @endphp
                                        @foreach($questions as $qkey => $dQuestion)
                                            <tr>
                                                <td>
{{--                                                    <input type="text" name="addMoreQuestionFields[{{$qkey}}][question]" value="{{$dQuestion}}" placeholder="Enter Question" class="form-control" />--}}
                                                    <textarea name="addMoreQuestionFields[{{$qkey}}][question]" placeholder="Enter Question" class="form-control">{{$dQuestion}}</textarea>
                                                </td>
                                                @if(array_key_first($questions) == $qkey)
                                                    <td>
                                                    <button type="button" name="add" id="dynamic-arq" class="btn btn-outline-primary">+</button>
                                                    </td>
                                                @else
                                                    <td><button type="button" class="btn btn-outline-danger remove-input-field-question">Delete</button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
{{--                                        <tr>--}}
{{--                                            <td><input type="text" name="addMoreQuestionFields[{{$qkey+1}}][question]" placeholder="Enter Question" class="form-control" />--}}
{{--                                            </td>--}}
{{--                                            <td><button type="button" name="add" id="dynamic-arq" class="btn btn-outline-primary">+</button></td>--}}
{{--                                        </tr>--}}
                                    </table>
                                </div>
                                @endif
                                <table class="table" id="dynamicAddRemove">
                                    <tr>
                                        <th>Answer</th>
                                        <th></th>
                                    </tr>
                                    @php
                                    $answers = json_decode($question->answers->text);
                                    @endphp
                                    @foreach($answers as $anskey => $answer)
                                        <tr>
                                            <td>
                                                <input type="text" name="addMoreInputFields[{{$anskey}}][subject]" value="{{$answer}}" placeholder="Enter Answer" class="form-control" />
                                            </td>
                                            @if(array_key_first($answers) == $anskey)
                                                <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">+</button></td>
                                            @else
                                                <td><button type="button" class="btn btn-outline-danger remove-input-field-question">Delete</button>
                                                </td>
                                            @endif
{{--                                            <td><button type="button" class="btn btn-outline-danger remove-input-field-question">Delete</button></td>--}}
                                        </tr>
                                    @endforeach

                                </table>

                                <div class="form-group mb-4">
                                    <label class="control-label">Correct Answer <span class="required">*</span></label>
                                    @if(request()->type_id == 'mcq')
                                    <input type="text" id="correct_answer" name="correct_answer" value="{{$question->answers->correct_answer}}" placeholder="Correct Answer" required="required" class="form-control" >
                                    @endif
                                    @if(request()->type_id == 'dnd')
                                        @php
                                        $dCorrectAnswers = json_decode($question->answers->correct_answer);
                                        $answers = implode(" ", $dCorrectAnswers)
                                        @endphp

                                        <input type="text" id="correct_answer" name="correct_answer" value="{{$answers}}" placeholder="Correct Answer" required="required" class="form-control" >

                                    @endif
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
    <script src={{asset("js/theme/plugins/select2/select2.min.js")}}></script>
    <script src={{asset("js/theme/plugins/flatpickr/flatpickr.js")}}></script>
    {{--    <script src={{asset("js/theme/plugins/flatpickr/custom-flatpickr.js")}}></script>--}}
{{--    <script src="{{asset('js/2Frontend/vendor/telephone/intlTelInput.min.js')}}"></script>--}}
    {{--    <script src={{asset("js/theme/plugins/select2/custom-select2.js")}}></script>--}}


    <!-- BEGIN THEME GLOBAL STYLE -->
    <script src={{asset("js/theme/js/scrollspyNav.js")}}></script>
    <script src={{asset("js/theme/plugins/sweetalerts/sweetalert2.min.js")}}></script>
    <script src={{asset("js/theme/plugins/sweetalerts/custom-sweetalert.js")}}></script>
    <!-- END THEME GLOBAL STYLE -->
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->

    <script>
        var i = @json($anskey)
        // var i = 0;
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
        var i = @json($qkey)
        // var i = 0;
        $("#dynamic-arq").click(function () {
            ++i;
            // $("#dynamicAddRemoveQuestion").append('<tr><td>' +
            //     '<input type="text" name="addMoreQuestionFields[' + i +
            //     '][question]" placeholder="Enter Part Question" class="form-control" />' +
            //     '</td><td><button type="button" class="btn btn-outline-danger remove-input-field-question">Delete</button></td></tr>'
            // );
            $("#dynamicAddRemoveQuestion").append('<tr><td>' +
                '<textarea type="text" name="addMoreQuestionFields[' + i +
                '][question]" placeholder="Enter Part Question" class="form-control" ></textarea>' +
                '</td><td><button type="button" class="btn btn-outline-danger remove-input-field-question">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field-question', function () {
            $(this).parents('tr').remove();
        });
    </script>

@endsection

