@extends('theme.base')
@section('head-customization')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/datatables.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/custom_dt_html5.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/dt-global_style.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/font-icons/fontawesome/css/regular.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/font-icons/fontawesome/css/fontawesome.css")}}>
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <link href={{asset("css/theme/scrollspyNav.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/animate/animate.css")}} rel="stylesheet" type="text/css" />
    <script src={{asset("css/theme/plugins/sweetalerts/promise-polyfill.js")}}></script>
    <link href={{asset("css/theme/plugins/sweetalerts/sweetalert2.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/sweetalerts/sweetalert.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/components/custom-sweetalert.css" )}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/apex/apexcharts.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/dashboard/dash_1.css" )}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/dashboard/dash_2.css" )}} rel="stylesheet" type="text/css" />
    <style>
        /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection

@section('main-content')
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div id="flActionButtons" class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header mb-2">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h2 class="text-center pt-3"> Subscribe </h2>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area" style="background-color: #d8ffec">
                        <form action="{{route('subscribe.post')}}" method="post" id="payment-form" data-secret="{{ $intent->client_secret }}">
                            @csrf
                            <div class="form-group mb-4 w-50 ml-4 mt-2">
                                <label class="control-label" for="cardholder-name">Card Holder's Name:</label>
                                <input id="cardholder-name" name="name" placeholder="Name" required="required" type="text" class="form-control" >
                            </div>
                            <div class="form-group mb-4 w-50 ml-4 mt-2">
                                <label class="" for="card-element">
                                    Subscribe SERU
                                </label>
                                @foreach($courses as $course)
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-primary" style="font-size: medium">
                                            <input type="radio" class="new-control-input" name="plan" value="{{$course->stripe_plan}}" required="required">
                                            <span class="new-control-indicator"></span>Premium Plan({{$course->title}}) for £{{$course->amount}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group mb-4 w-50 ml-4">
                                <label class="" for="card-element">
                                    Credit or debit card
                                </label>
                                <div  id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>

                            <button class="btn btn-success ml-5 mt-2 mb-2">Submit Payment</button>
                        </form>
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
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src={{asset("js/theme/plugins/apex/apexcharts.min.js")}}></script>
    <script src={{asset("js/theme/js/dashboard/dash_1.js")}}></script>
    <script src={{asset("js/theme/js/dashboard/dash_2.js")}}></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51LkrSjC7DhbbV76TSLAZKi273WGlHlAhA1OASa49YaxnKrU5miXB44lJhFtc1V9C6v7HN5DitfpxKLt7TRCNM1HZ004SuNFVaC');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        var cardHolderName = document.getElementById('cardholder-name');
        var clientSecret = form.dataset.secret;
        form.addEventListener('submit', async function(event) {
            event.preventDefault();

            // stripe.createToken(card).then(function(result) {
            //     if (result.error) {
            //         // Inform the user if there was an error.
            //         var errorElement = document.getElementById('card-errors');
            //         errorElement.textContent = result.error.message;
            //     } else {
            //         // Send the token to your server.
            //         stripeTokenHandler(result.token);
            //     }
            // });
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                // Display "error.message" to the user...
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                // The card has been verified successfully...
                stripeTokenHandler(setupIntent);
            }
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(setupIntent) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'paymentMethod');
            hiddenInput.setAttribute('value', setupIntent.payment_method);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
@endsection


