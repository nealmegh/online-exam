@extends('theme.testbase')
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
    <link href={{asset("css/jquery.countdownTimer.css" )}} rel="stylesheet" type="text/css" />


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
            float: left;
            width: 100px;
            height: 35px;
            margin: 15px;
            padding: 10px;
            border: 1px solid #aaaaaa;
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
        @media only screen and (min-width: 900px) {
            .mx-lg-6 {
                margin-left: 9rem !important;
                margin-right: 9rem !important;
            }
            .bipon-h{
                min-height: 20rem!important;
            }
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
        //$dQuestions = json_decode($question->text);
        //$dAnswers = json_decode($question->answers->text);
    @endphp

    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
                <div class="widget widget-content-area br-4">
                    <div class="d-flex justify-content-between">
                        <span></span>
                        <h1 class="text-center"> SERU TEST</h1>

                        <div id="countdowntimer"><span id="hm_timer"> </span> </div>
                    </div>

                </div>
                <div>

                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 bg-white" >
{{--                    <form id="questionForm" action="store_answers" method="post" >--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="mock_test_id" value="{{$mockTest->id}}">--}}
{{--                        <input type="hidden" name="user_id" value="{{$user->id}}">--}}
                        <nav>
                            {{--                            <div class="nav nav-tabs mx-lg-5" id="nav-tab" role="tablist">--}}
                            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                                @foreach($mockTest->mockTestItems as $key => $question)
                                    <li class="nav-item ">
                                        <a class="nav-link {{($key == 0)?'active':''}}" id="navtab-Q{{$key+1}}" data-toggle="pill" role="tab" href="#nav-Q{{$key+1}}" data-toggle="tab">{{$key+1}}</a>
                                    </li>
                                    {{--                                    <button class="nav-link" href="#nav-Q{{$key+1}}" {{($key == 0)?'active':''}}" style="background-color: green" id="navtab-Q{{$key+1}}" data-toggle="tab" data-target="#nav-Q{{$key+1}}" type="button" role="tab" aria-controls="nav-Q{{$key+1}}" aria-selected="false">{{$key+1}}</button>--}}
                                @endforeach
                            </ul>
                            {{--                            </div>--}}
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            @foreach($mockTest->mockTestItems as $key => $question)
                                @if($question->type == 'mcq')
                                <div class="bipon-h tab-pane fade bg-white {{($key == 0)?'active show':''}}" id="nav-Q{{$key+1}}" role="tabpanel" aria-labelledby="navtab-Q{{$key+1}}">
                                    <div class="mx-lg-6 mx-5  mt-5">
                                        <p class="pt-3" style="color: black; font-size: xx-large"> {{$question->text}}</p>
                                    </div>
                                    @php
                                        $answers = json_decode($question->answer_text)

                                    @endphp

                                    <div class="pb-3">
                                        @foreach($answers as $key1 => $answer)

                                            @if($answer == $question->user_answer)
                                            <div class="form-group mx-lg-6 mx-5">
                                                <label for="rdo-{{$key1}}{{$question->id}}" class="btn-radio">
                                                    <input class="timeConstrain" value="{{$answer}}" type="radio" id="rdo-{{$key1}}{{$question->id}}" name="question{{$question->id}}" checked disabled>
                                                    <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                        <circle cx="10" cy="10" r="9"></circle>
                                                        <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                                                        <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                    </svg>
                                                    <span style="font-size: x-large">{{$answer}}</span>
                                                    @if($question->user_answer == $question->correct_answer)
                                                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path fill="#c8e6c9" d="M36,42H12c-3.314,0-6-2.686-6-6V12c0-3.314,2.686-6,6-6h24c3.314,0,6,2.686,6,6v24C42,39.314,39.314,42,36,42z"/><path fill="#4caf50" d="M34.585 14.586L21.014 28.172 15.413 22.584 12.587 25.416 21.019 33.828 37.415 17.414z"/></svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>
                                                    @endif
                                                </label>
                                            </div>
                                            @else
                                                <div class="form-group mx-lg-6 mx-5">
                                                    <label for="rdo-{{$key1}}{{$question->id}}" class="btn-radio">
                                                        <input class="timeConstrain" value="{{$answer}}" type="radio" id="rdo-{{$key1}}{{$question->id}}" name="question{{$question->id}}" disabled>
                                                        <svg width="20px" height="20px" viewBox="0 0 20 20">
                                                            <circle cx="10" cy="10" r="9"></circle>
                                                            <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                                                            <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                                        </svg>
                                                        <span style="font-size: x-large">{{$answer}}</span>
                                                        @if($answer == $question->correct_answer)
                                                            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path fill="#c8e6c9" d="M36,42H12c-3.314,0-6-2.686-6-6V12c0-3.314,2.686-6,6-6h24c3.314,0,6,2.686,6,6v24C42,39.314,39.314,42,36,42z"/><path fill="#4caf50" d="M34.585 14.586L21.014 28.172 15.413 22.584 12.587 25.416 21.019 33.828 37.415 17.414z"/></svg>
                                                        @endif
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    {{--                                    {{dd(count($questions), $key)}}--}}
{{--                                    @if(count($questions) == ($key+1))--}}

{{--                                    @endif--}}
                                </div>
                            @elseif($question->type == 'dnd')
                                    @php
                                        $dQuestions = json_decode($question->text);
                                        $dAnswers = json_decode($question->user_answer);
                                        $dCAnswers = json_decode($question->correct_answer);
                                    @endphp
                                    <div class="bipon-h tab-pane fade bg-white {{($key == 0)?'active show':''}}" id="nav-Q{{$key+1}}" role="tabpanel" aria-labelledby="navtab-Q{{$key+1}}">
                                        <span style="font-size: x-large!important;"> Your Answer</span>
                                        <p style="font-size: xx-large!important;">
                                           @foreach($dQuestions as $keyDND => $dQuestion)
{{--                                               {{dd($dAnswers[$keyDND])}}--}}
                                               @if ($keyDND !== array_key_last($dQuestions))
                                                    @if($dAnswers[$keyDND] == $dCAnswers[$keyDND])
                                                         {!! $dQuestion !!}<span style="color: green">{!! ' '.$dAnswers[$keyDND] !!}</span>
                                                       <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" width="48px" height="48px"><path fill="#c8e6c9" d="M36,42H12c-3.314,0-6-2.686-6-6V12c0-3.314,2.686-6,6-6h24c3.314,0,6,2.686,6,6v24C42,39.314,39.314,42,36,42z"/><path fill="#4caf50" d="M34.585 14.586L21.014 28.172 15.413 22.584 12.587 25.416 21.019 33.828 37.415 17.414z"/></svg>
                                                   @else
                                                        {!! $dQuestion !!}<span style="color: red">{!!' '.$dAnswers[$keyDND] !!}</span>
                                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/></svg>
                                                   @endif
                                               @else
                                                   {!! $dQuestion !!}
                                               @endif
                                           @endforeach
                                       </p>
                                        <span style="font-size: x-large!important;"> Correct Answer</span>
                                        <p style="font-size: xx-large!important;">
                                            @foreach($dQuestions as $keyDND => $dQuestion)

                                                @if ($keyDND !== array_key_last($dQuestions))
                                                    {{$dQuestion}}{{' '.$dCAnswers[$keyDND]}}
                                                @else
                                                    {{$dQuestion}}
                                                @endif
                                            @endforeach
                                        </p>

                                    </div>
                            @endif
                            @endforeach



                                <a href="{{route('student.dashboard')}}" class="btn  btn-primary float-right" > Dashboard</a>
                        </div>

{{--                    </form>--}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src={{asset("js/jquery.countdownTimer.js")}}></script>


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
{{--    <script>--}}
{{--        var timeleft = 10;--}}
{{--        var downloadTimer = setInterval(function(){--}}
{{--            if(timeleft <= 0){--}}
{{--                clearInterval(downloadTimer);--}}
{{--            }--}}
{{--            document.getElementById("progressBar").value = 10 - timeleft;--}}
{{--            timeleft -= 1;--}}
{{--        }, 1000);--}}
{{--    </script>--}}

    <script>
        // $('.btnNext').click(function(){
        //     $('.nav-tabs > .active').next('li').find('a').trigger('click');
        // });
        //
        // $('.btnPrevious').click(function(){
        //     $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        // });
        $('.btnNext').click(function() {
            $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
        });

        $('.btnPrevious').click(function() {
            $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
        });
    </script>
{{--    <script>--}}
{{--        $(function(){--}}
{{--            $("#hm_timer").countdowntimer({--}}
{{--                minutes : 45,--}}
{{--                size : "lg",--}}
{{--                timeSeparator : ":",--}}
{{--                timeUp : timeisUp--}}
{{--            })--}}

{{--            function timeisUp() {--}}
{{--                //Code to be executed when timer expires.--}}
{{--                document.getElementById("questionForm").submit();--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}


@endsection
