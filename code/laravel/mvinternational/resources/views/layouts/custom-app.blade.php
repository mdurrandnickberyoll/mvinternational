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
        <title>MV International</title>

        @include('layouts.components.custom-styles')

    </head>

    <body class="">

        @yield('class')

            <!-- global-loader -->
            <div id="global-loader">
                <img src="{{asset('assets/images/loader.svg')}}" class="loader-img" alt="Loader">
            </div>
            <!-- global-loader closed -->

                <!-- PAGE -->
                <div class="page">
                    <div class="">

                        @yield('content')

                    </div>
                </div>
                <!-- End PAGE -->

        </div>
        <!-- BACKGROUND-IMAGE CLOSED -->

        @include('layouts.components.custom-scripts')

    </body>

</html>
