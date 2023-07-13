<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MV International</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets_front/img/favicon.png" rel="icon">
  <link href="assets_front/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets_front/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets_front/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets_front/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets_front/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets_front/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets_front/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets_front/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Logis
  * Updated: May 30 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- Navbar Start -->
    @include('front.components.header')
    <!-- Navbar End -->

    <!-- Body Start -->
    @yield('content')
    <!-- Body End -->
    

    <!-- Footer Start -->
    @include('front.components.footer')
    <!-- Footer End -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>
  
    <!-- Vendor JS Files -->
    <script src="assets_front/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets_front/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets_front/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets_front/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets_front/vendor/aos/aos.js"></script>
    <script src="assets_front/vendor/php-email-form/validate.js"></script>
  
    <!-- Template Main JS File -->
    <script src="assets_front/js/main.js"></script>
  
  </body>
  
  </html>