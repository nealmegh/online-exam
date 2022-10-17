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

        .droptarget {
            /*!*float: left;*!*/
            /*width: 100px;*/
            /*height: 35px;*/
            /*!*margin: 15px;*!*/
            /*!*padding: 10px;*!*/
            /*border: 1px solid #aaaaaa;*/
        }
        .droptarget {
            display: inline-block;
            padding: 12px 44px;
            border: 1px solid #000;
            position: relative;
            overflow: hidden;
        }
    </style>
    <style>
        .hide{
            display:none !important;
        }
        .show{
            display:block !important;
        }
        .card-footer:last-child {
            border-radius: 0 0 2px 2px;
            display: inline-block;
            width: 100%;
            margin-bottom: -7px;
        }
        /*#question5 .next {*/
        /*display:none;*/
        /*}*/
        /*.single_question_wrapper{*/
        /*display:none;*/
        /*}*/
        .question_wrapper #questionForm .single_question_wrapper{
            display:none;
        }
        .question_wrapper #questionForm .single_question_wrapper:first-child {
            display:block;
        }

        .countdown span{
            font-size: 35px;
        }

        .btn-radio {
            cursor: pointer;
            display: block;
            -webkit-user-select: none;
            user-select: none;
        }
        .btn-radio:not(:first-child) {
            margin-left: 0px;
        }
        @media screen and (max-width: 480px) {
            .btn-radio {
                display: block;
                float: none;
            }
            .btn-radio:not(:first-child) {
                margin-left: 0;
                margin-top: 15px;
            }
        }
        .btn-radio svg {
            fill: none;
            vertical-align: middle;
        }
        .btn-radio svg circle {
            stroke-width: 2;
            stroke: #C8CCD4;
        }
        .btn-radio svg path {
            stroke: #008FFF;
        }
        .btn-radio svg path.inner {
            stroke-width: 6;
            stroke-dasharray: 19;
            stroke-dashoffset: 19;
        }
        .btn-radio svg path.outer {
            stroke-width: 2;
            stroke-dasharray: 57;
            stroke-dashoffset: 57;
        }
        .btn-radio input {
            display: none;
        }
        .btn-radio input:disabled + svg path {
            stroke: #5b656d !important;
        }
        .btn-radio input:checked + svg path {
            transition: all 0.4s ease;
        }
        .btn-radio input:checked + svg path.inner {
            stroke-dashoffset: 38;
            transition-delay: 0.3s;
        }
        .btn-radio input:checked + svg path.outer {
            stroke-dashoffset: 0;
        }
        .btn-radio span {
            display: inline-block;
            vertical-align: middle;
        }
        .inline {
            display: inline;
            width: auto;
            max-width: 5rem;
        }
        .question-input {
            /*display: block;*/
            width: 100%;
            margin-bottom: .5rem;
        }
        .question-p {
            display: inline;
            line-height: 2;
        }
        p {
            margin-bottom: 0 !important;
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
    @php
    $dQuestions = json_decode($question->text);
    $dAnswers = json_decode($question->answers->text);
    @endphp
    <div class="container">
        <div class="container">
            <div class="row layout-top-spacing">
                <form id="questionForm" action="store_answers" method="post" >
                    @csrf
                    <input type="hidden" name="mock_test_id" value="{{$mockTest->id}}">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="col-md-9">
                    <p>

                @foreach($dQuestions as $key => $q)
{{--                        <div style="">--}}
                           {{$q}}



                    @if ($key !== array_key_last($dQuestions))

                            <span   class="droptarget" ondrop="drop(event)" data-id="100{{$key}}" ondragover="allowDrop(event)"></span>
                        <input type="hidden" value="" name="userAnswer[]" id="100{{$key}}">
{{--                                <input type="text" class="inline question-input"  draggable="true"/>--}}

                    @endif
{{--                        </div>--}}
                @endforeach
                    </p>

                </div>
                    <div class="col-md-6">
                            @foreach($dAnswers as $key1 => $a)
                                <br>
                            <span class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <p ondragstart="dragStart(event)" draggable="true" id="dragtarget_{{$key1}}">{{$a}}</p>
                            </span>
                                <br>

                            @endforeach
                    </div>
                    <input id="sendansbutton" class="btn questionsend btn-success float-right" type="submit">


                </form>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script>

            function dragStart(event) {

            event.dataTransfer.setData("Text", event.target.id);
                var tid = $('#'+event.target.id).data('value');

            // var test = $(this).closest('.droptarget').attr('data-id');
            // console.log(test);


            // let tid = event.target.id;
            $("#"+tid).val(' ');

            // document.getElementById("demo").innerHTML = "Started to drag the p element";
        }

            function allowDrop(event) {
            event.preventDefault();
        }

            function drop(event, ui) {
            event.preventDefault();
            var data = event.dataTransfer.getData("Text");
            event.target.appendChild(document.getElementById(data));

            // console.log(document.getElementById(data).innerText)
            let hid = event.target.dataset.id;
            $('#'+data).attr('data-value', hid);
            if(hid > 999)
            {
                $("#"+hid).val(document.getElementById(data).innerText);
            }
            else
            {
                $("#"+hid).val('');
            }



            // document.getElementById("demo").innerHTML = "The p element was dropped";
        }

    </script>

    <script>
        {{--var count = {{$questions[0]->id}};--}}
        {{--jQuery(".next").click(function(){--}}
        {{--    var myclass = jQuery(this).parent().parent().attr('id');--}}
        {{--    console.log(myclass);--}}
        {{--    jQuery("#"+myclass).addClass( "hide" );--}}
        {{--    var quesidname = 'question';--}}
        {{--    count = count + 1;--}}
        {{--    count1 = count - 1;--}}
        {{--    jQuery("#"+quesidname+count1).removeClass("show").addClass( "hide" );--}}
        {{--    jQuery("#"+quesidname+count).addClass( "show" );--}}

        {{--    //$(myclass).addClass('id');--}}
        {{--    console.log(myclass);--}}
        {{--});--}}

    </script>



@endsection
