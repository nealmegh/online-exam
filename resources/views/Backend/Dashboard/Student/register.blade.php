<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Exam</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> --}}
    <link href={{ asset("css/theme/plugins.css") }} rel="stylesheet" type="text/css" />
    <link href={{ asset("css/theme/authentication/form-2.css") }} rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href={{ asset("css/theme/forms/theme-checkbox-radio.css") }}>
    <link rel="stylesheet" type="text/css" href={{ asset("css/theme/forms/switches.css") }}>
</head>
<body class="form">


<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">Register</h1>
                    <p class="signup-link register">Already have an account? <a href="/login">Log in</a></p>
                    <form class="text-left" method="POST" action="{{route('students.register.store')}}">
                        @csrf
                        <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <label for="name">NAME</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="name" name="name" type="text" class="form-control" placeholder="name ">
                            </div>

                            <div id="email-field" class="field-wrapper input">
                                <label for="email">EMAIL</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign register"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                <input id="email" name="email" type="text" value="" class="form-control" placeholder="Email">
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password">PASSWORD</label>
{{--                                    <a href="{{ route('password.request') }}" class="forgot-pass-link">Forgot Password?</a>--}}
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </div>
                            <div id="username-field" class="field-wrapper input">
                                <label for="phone_full">PHONE</label>
                                <input id="phone_full" name="phone_full" type="text" class="form-control" placeholder="Phone ">
                            </div>
                            <div class="field-wrapper input">
                                <label class="control-label">Address:</label>
                                <input id="address" name="address" placeholder="Address" required="required" type="text" class="form-control" >
                            </div>
                            <div class="field-wrapper input">
                                <label class="control-label">Post Code:</label>
                                <input id="post_code" name="post_code" placeholder="Post Code" required="required" type="text" class="form-control" >
                            </div>
                            <div class="field-wrapper input">
                                <label class="control-label">Passport Number:</label>
                                <input id="passport_number" name="passport_number" placeholder="Passport Number" required="required" type="text" class="form-control" >
                            </div>
                            <div class="field-wrapper input">
                                <label class="control-label">Date of Birth:</label>
                                <input id="dob" name="dob" placeholder="Date of Birth" required="required" type="date" class="form-control" >
                            </div>
                            <input type="hidden" id="status" name="status" value="1">
                            <input type="hidden" id="role_id" name="role_id" value="2">
                            <div class="field-wrapper input" style="margin-bottom: 0px !important;">
                                <label for="course_id">Course</label>
                                <select id="course_id" class="form-control userDriver" name="course_id" required="required">
                                    <option value="" selected>Select a Course</option>
                                    @foreach($courses as $course)
                                        <option value="{{$course->id}}">{{$course->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="field-wrapper terms_condition">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox checkbox-primary">
                                        <input type="checkbox" id="policy" name="policy" class="new-control-input">
                                        <span class="new-control-indicator"></span><span>I agree to the <a href="{{route('terms')}}" target="_blank">  terms and conditions </a></span>
                                    </label>
                                </div>
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button id="register_save" type="submit" class="btn btn-primary" value="" disabled>Get Started!</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src= {{ asset("js/theme/js/libs/jquery-3.1.1.min.js") }}></script>
<script src= {{ asset("js/app.js") }}></script>
<script src= {{ asset("js/theme/js/app.js") }}></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src={{ asset("js/theme/js/authentication/form-2.js") }}></script>
<script>
    $('#policy').on('click', function() {
        console.log('hello');
        if(document.getElementById('register_save').disabled){

            $("#register_save").prop('disabled', false);

        }
        else {
            $("#register_save").prop('disabled', true);

        }
    });
</script>

</body>
</html>

