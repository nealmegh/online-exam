@extends('theme.base')
@section('head-customization')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/datatables.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/custom_dt_html5.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/dt-global_style.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/font-icons/fontawesome/css/regular.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/font-icons/fontawesome/css/fontawesome.css")}}>
    <link rel="stylesheet" type="text/css" href={{asset("css/theme/plugins/table/datatable/custom_dt_custom.css")}}>

    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <link href={{asset("css/theme/scrollspyNav.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/animate/animate.css")}} rel="stylesheet" type="text/css" />
    <script src={{asset("css/theme/plugins/sweetalerts/promise-polyfill.js")}}></script>
    <link href={{asset("css/theme/plugins/sweetalerts/sweetalert2.min.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/plugins/sweetalerts/sweetalert.css")}} rel="stylesheet" type="text/css" />
    <link href={{asset("css/theme/components/custom-sweetalert.css" )}} rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="{{asset("css/theme/tables/table-basic.css" )}}">

    <style>
        .btn-light { border-color: transparent; }
        .badge-success {
            color: #fff !important;
            background-color: #1abc9c !important;
        }
        .badge {
            font-weight: 600 !important;
            line-height: 1.4 !important;
            padding: 3px 6px !important;
            font-size: 12px !important;

            transition: all 0.3s ease-out !important;
            -webkit-transition: all 0.3s ease-out !important;
        }
    </style>
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
        td {
            white-space: nowrap;
        }

        td.wrapok {
            white-space:normal
        }
    </style>
    @can('Customer')
        <style>
            .main-content{
                margin-left: 5px !important;
            }
        </style>
    @endcan

@endsection

@section('main-content')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="modal-text" id="modal_booking_number"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="layout-px-spacing">
        @if(Session::has('message'))
            <div class="alert alert-gradient mb-4" role="alert">
                <button  type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  data-dismiss="alert" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <strong>{{ Session::get('message') }}</strong>
            </div>
        @endif
        <div class="row layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-6">

                    <div class="col 12 button-holder" style="display: flex">
                        <div class="col-7">
                            <h3>Questions</h3>
                        </div>
                        <div class="create-button col-3">
                            <a href="{{route('questions.create', ['type_id' => 'dnd'])}}" class="create-button-btn btn btn-success mb-6 mr-4 btn-lg"> New  Drag & Drop Question</a>
                        </div>
                        <div class="create-button col-2">
                            <a href="{{route('questions.create', ['type_id' => 'mcq'])}}" class="create-button-btn btn btn-success mb-6 mr-4 btn-lg"> New MCQ Question</a>
                        </div>
                    </div>
                    @cannot('Customer')
                    <table id="html5-extension" class="table table-hover table-striped dataTable">
                        <thead>
                        <tr>
                            <th class="text-center">Question ID</th>
                            <th class="text-center">Question</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Number of Answers</th>
                            <th class="text-center">Pro</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td class="text-center"><a class="badge outline-badge-success shadow-none showBooking" data-toggle="modal" data-value="{{$question->id}}"  data-target="#exampleModal">{{$question->id}}</a></td>
                                <td>{!!$question->text!!} </td>
                                <td>{{$question->category_id}}</td>
                                <td>{{$question->type}}</td>
                                <td>{{$question->number_answers}}</td>
                                <td>{{$question->status}}</td>
                                <td>{{$question->isPro}}</td>

                                <td>
                                    <a  href="{{route('questions.edit', $question->id). '?' . http_build_query(['type_id' => $question->type])}}" class="btn btn-primary" title="Edit Booking" >
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a id="{{$question->id}}" class="btn btn-danger delete-booking" data-value="{{$question->id}}" onClick="destroy_question(this.id)" >
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    @endcannot
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js-customization')
    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    @cannot('Customer')
    <script src= {{ asset("js/theme/plugins/perfect-scrollbar/perfect-scrollbar.min.js") }}></script>
    @endcannot
    <script src={{ asset("js/theme/plugins/table/datatable/datatables.js") }}></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src={{asset("js/theme/plugins/table/datatable/button-ext/dataTables.buttons.min.js")}}></script>
    <script src={{asset("js/theme/plugins/table/datatable/button-ext/jszip.min.js")}}></script>
    <script src={{asset("js/theme/plugins/table/datatable/button-ext/buttons.html5.min.js")}}></script>
    <script src={{asset("js/theme/plugins/table/datatable/button-ext/buttons.print.min.js")}}></script>
    <script>
        $('#html5-extension').DataTable( {
            "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            buttons: {
                buttons: [
                    // { extend: 'copy', className: 'btn btn-sm' },
                    // { extend: 'csv', className: 'btn btn-sm' },
                    // { extend: 'excel', className: 'btn btn-sm' },
                    // { extend: 'print', className: 'btn btn-sm' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
                    },
                    targets: 1
                }
            ],
            "order": [[0, 'desc']],
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10,
        } );
    </script>
    <!-- BEGIN THEME GLOBAL STYLE -->
    <script src={{asset("js/theme/js/scrollspyNav.js")}}></script>
    <script src={{asset("js/theme/plugins/sweetalerts/sweetalert2.min.js")}}></script>
    <script src={{asset("js/theme/plugins/sweetalerts/custom-sweetalert.js")}}></script>
    <!-- END THEME GLOBAL STYLE -->
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
    <script>
        // $('.delete-car').on('click', function () {
        function destroy_question(question_id) {
            const questionName = $('#'+question_id).attr("data-value");
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success btn-rounded',
                cancelButtonClass: 'btn btn-danger btn-rounded mr-3',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Are you sure you want to delete Question Number' +questionName+'?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true,
                padding: '2em',
                showLoaderOnConfirm: true,
                preConfirm: ()=>{
                    $.ajax({
                        url: '/admin/questions/del/'+question_id,
                        method: 'POST',
                        data:{"_token": "{{ csrf_token() }}"},
                        success: function(resp)
                        {
                            console.log(resp)

                        }
                    })
                }
            }).then(function(result) {
                if (result.value) {
                    swalWithBootstrapButtons(
                        {
                            title: 'Deleted!',
                            text: 'The Question has been deleted.',
                            type: 'success'
                        }
                    ).then(function (result){
                        location.reload();
                    })
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelled',
                        'The data is safe :)',
                        'error'
                    )
                }
            })

            // })
        }
    </script>
@endsection
