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
        .disable-select {
            user-select: none; /* supported by Chrome and Opera */
            -webkit-user-select: none; /* Safari */
            -khtml-user-select: none; /* Konqueror HTML */
            -moz-user-select: none; /* Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
        }
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
                        <h1 class="text-center"> SERU Drag & Drop Practice </h1>
                        <div></div>

{{--                        <div id="countdowntimer"><span id="hm_timer"> </span> </div>--}}
                    </div>

                </div>
                <div>

                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 bg-white disable-select" >
                    <form id="questionForm" action="#" method="post" onsubmit="makeNull()">
                        @csrf

                        <nav>
                            {{--                            <div class="nav nav-tabs mx-lg-5" id="nav-tab" role="tablist">--}}
                            <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                                @foreach($questions as $key => $question)
                                    <li class="nav-item ">
                                        <a class="nav-link {{($key == 0)?'active':''}}" id="navtab-Q{{$key+1}}" data-toggle="pill" role="tab" href="#nav-Q{{$key+1}}" data-toggle="tab">{{$key+1}}</a>
                                    </li>
                                    {{--                                    <button class="nav-link" href="#nav-Q{{$key+1}}" {{($key == 0)?'active':''}}" style="background-color: green" id="navtab-Q{{$key+1}}" data-toggle="tab" data-target="#nav-Q{{$key+1}}" type="button" role="tab" aria-controls="nav-Q{{$key+1}}" aria-selected="false">{{$key+1}}</button>--}}
                                @endforeach
                            </ul>
                            {{--                            </div>--}}
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            @foreach($questions as $key => $question)
                                <div class="tab-pane fade bg-white {{($key == 0)?'active show':''}}" id="nav-Q{{$key+1}}" role="tabpanel" aria-labelledby="navtab-Q{{$key+1}}">

                                        @include('Backend.Question.dnd')

{{--                                    @if(count($questions) == ($key+1))--}}
{{--                                        <input id="sendansbutton" class="btn questionsend btn-success float-right" type="submit">--}}
{{--                                    @endif--}}
                                    @php
                                        $dQuestions = json_decode($question->text);
                                        $dAnswers = json_decode($question->user_answer);
                                        $dCAnswers = json_decode($question->answers->correct_answer);
                                    @endphp
                                    <div class="mx-lg-6 mx-5  mt-5 mb-5" id="correctAnswer{{$question->id}}" style="display:none;">
                                        <p>Correct Answer</p>
{{--                                        <span style="font-size: x-large !important; color: green !important;">{{$question->answers->correct_answer}}</span>--}}
{{--                                        <span> Correct Answer</span>--}}
                                        <p style="font-size: x-large !important; ">
                                            @foreach($dQuestions as $keyDND => $dQuestion)

                                                @if ($keyDND !== array_key_last($dQuestions))
                                                    {{$dQuestion}}<span style="color:green;">{{' '.$dCAnswers[$keyDND]}}</span>
                                                @else
                                                    {{$dQuestion}}
                                                @endif
                                            @endforeach
                                        </p>

                                    </div>
                                    {{--                                    {{dd(count($questions), $key)}}--}}
                                    <a type="button" class="btn btn-success float-right" href="{{route('student.dashboard')}}">Dashboard</a>
                                    <a type="button" class="btn btn-success float-right" onclick="showAnswer('correctAnswer'+{{$question->id}})">Show Correct Ans</a>


                                </div>

                            @endforeach



                        </div>

                    </form>
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


    {{--    <script>--}}

    {{--            function dragStart(event) {--}}

    {{--            event.dataTransfer.setData("Text", event.target.id);--}}
    {{--                var tid = $('#'+event.target.id).data('value');--}}

    {{--            // var test = $(this).closest('.droptarget').attr('data-id');--}}
    {{--            // console.log(test);--}}


    {{--            // let tid = event.target.id;--}}
    {{--            $("#"+tid).val(' ');--}}

    {{--            // document.getElementById("demo").innerHTML = "Started to drag the p element";--}}
    {{--        }--}}

    {{--            function allowDrop(event) {--}}
    {{--            event.preventDefault();--}}
    {{--        }--}}

    {{--            function drop(event, ui) {--}}
    {{--            event.preventDefault();--}}
    {{--            var data = event.dataTransfer.getData("Text");--}}
    {{--            event.target.appendChild(document.getElementById(data));--}}

    {{--            // console.log(document.getElementById(data).innerText)--}}
    {{--            let hid = event.target.dataset.id;--}}
    {{--            $('#'+data).attr('data-value', hid);--}}
    {{--            if(hid > 999)--}}
    {{--            {--}}
    {{--                $("#"+hid).val(document.getElementById(data).innerText);--}}
    {{--            }--}}
    {{--            else--}}
    {{--            {--}}
    {{--                $("#"+hid).val('');--}}
    {{--            }--}}



    {{--            // document.getElementById("demo").innerHTML = "The p element was dropped";--}}
    {{--        }--}}

    {{--    </script>--}}

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
    <script>
        $(function(){
            $("#hm_timer").countdowntimer({
                minutes : 45,
                size : "lg",
                timeSeparator : ":",
                timeUp : timeisUp
            })

            function timeisUp() {
                //Code to be executed when timer expires.
                document.getElementById("questionForm").submit();
            }
        });
    </script>
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
        function checkNull(d)
        {
            let Qid = d.getAttribute("data-id");
            $("#hiddenQ"+Qid).attr('disabled', true);
        }

    </script>

    <script>
        function showAnswer(id) {
            var x = document.getElementById(id);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

@endsection
