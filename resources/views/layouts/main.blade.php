<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="{{ asset('images/icon-logo.png') }}">
    <title>@yield('title', 'বাংলাবিদ')</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="msapplication-tap-highlight" content="no">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script language="JavaScript" type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{asset('js/select2.full.min.js')}}"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    @yield('css')
</head>

<body>
    <div class="se-pre-con"></div>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        
        @include('layouts.Components.navbar')

        <div class="app-main">
                {{-- SIDEBAR --}}

                @include('layouts.Components.sidebar')
           
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @yield('modal')
    
    <script src="{{asset('js/main.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        if (!localStorage.getItem('sidebar-preference')) {
            localStorage.setItem('sidebar-preference', '');
        } else {
            $('.fixed-header').addClass(localStorage.getItem('sidebar-preference'));

        }

        $(document).ready(function () {


            $('#side-hamburger').on('click', function () {
                if (localStorage.getItem('sidebar-preference') == 'closed-sidebar') {
                    localStorage.setItem('sidebar-preference', '');
                } else if (localStorage.getItem('sidebar-preference') == '') {
                    localStorage.setItem('sidebar-preference', 'closed-sidebar');
                }

            });

            $('input[name="from_date"]').daterangepicker({
                autoUpdateInput: false,
                opens: 'left',
                autoApply: true,
                singleDatePicker: true,
                minYear: '2022'

            });
            $('input[name="to_date"]').daterangepicker({
                autoUpdateInput: false,
                opens: 'left',
                autoApply: true,
                singleDatePicker: true,
                minYear: '2022'

            });


            $('input[name="from_date"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            $('input[name="to_date"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
        });
        
    </script>
    @stack('script')
</body>

</html>