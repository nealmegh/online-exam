<style>
    .droptarget {
        display: inline-block;
        /*padding: 12px 44px;*/
        padding: 0.8rem 2rem;
        border: 1px solid #000;
        position: relative;
        overflow: hidden;
    }
    .droptargetEnd {
        padding: 0.1rem 0.6rem !important;
    }
    p {
        margin-bottom: 0 !important;
    }
    .bg-danger-custom{
        background-color: #fc827f;
    }
</style>

@php
    $dQuestions = json_decode($question->text);
    $dAnswers = json_decode($question->answers->text);
@endphp
<div class="row mt-3">
    <div class="col-8 mt-5">
        <p style="font-size: x-large !important; color: black !important;">

            @foreach($dQuestions as $dKey => $q)
                {{--                        <div style="">--}}
                {!!$q!!}

                @if ($dKey !== array_key_last($dQuestions))

                    <span   class="droptarget" ondrop="drop(event)" data-id="100{{$key}}{{$dKey}}" ondragover="allowDrop(event)" style="background-color: #ececec"></span>
                    <input type="hidden" value="" name="question{{$question->id}}[]" id="100{{$key}}{{$dKey}}">
                    {{--                                <input type="text" class="inline question-input"  draggable="true"/>--}}

                @endif
                {{--                        </div>--}}
            @endforeach
        </p>
        <div class=" mt-5">
            <h3 style="color: black"> Incorrect Answers</h3><br>
            <span   class="droptarget bg-danger-custom" ondrop="drop(event)" data-id="100inCorrect" ondragover="allowDrop(event)" style="height: 200px;width: 300px; border-radius: 42px!important; "></span>

        </div>
    </div>
    <div class="col-4 mt-5">
        @foreach($dAnswers as $key1 => $a)
            <span class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)" style="background-color: #ececec !important;">
                <p ondragstart="dragStart(event)" draggable="true" id="dragtarget_{{$question->id}}{{$key1}}" style="font-size: large !important; color: black">{{$a}}</p>
            </span>
            <br>
        @endforeach</div>
</div>



