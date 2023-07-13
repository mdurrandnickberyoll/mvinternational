<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash –  Laravel Bootstrap 5 Admin & Dashboard Template">
    <meta name="author" content="SPRUKO™">
    <meta name="keywords" content="admin, admin dashboard, admin dashboard template, bootstrap admin, bootstrap dashboard, dashboard laravel, dashboard template, laravel admin, laravel admin dashboard, laravel admin dashboard template, laravel admin panel, laravel admin template, laravel dashboard template, laravel template, laravel ui template">

    <!-- title -->
    <title>Sash –  Laravel Bootstrap 5 Admin & Dashboard Template</title>

    @include('layouts.components.styles')

</head>

<body class="app sidebar-mini ltr">

    <!-- Switcher-->
    @include('layouts.components.switcher')
    <!-- Switcher-->

        <!-- global-loader -->
        <div id="global-loader">
            <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
        </div>
        <!-- global-loader closed -->

        <!-- page -->
        <div class="page">
            <div class="page-main">

                @include('layouts.components.app-header')

                @include('layouts.components.app-sidebar')

                    <!--app-content open-->
                    <div class="main-content app-content mt-0">
                        <div class="side-app">

                            <!-- container -->
                            <div class="main-container container-fluid">

                                @yield('content')

                            </div>
                            <!-- container-closed -->
                        </div>
                    </div>
                    <!--app-content closed-->
                </div>
                <!-- page-main closed -->

            @include('layouts.components.sidebar-right')

            @include('layouts.components.modal')

            @yield('modal')

            @include('layouts.components.footer')

        </div>
        <!-- page -->

        @include('layouts.components.scripts')

    </body>

</html>
