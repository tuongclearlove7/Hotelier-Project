<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- https://getbootstrap.com/docs/5.2/getting-started/introduction/ --}}
<link href="img/favicon.ico" rel="icon">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">  

<!-- Icon Font Stylesheet -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


<link rel="stylesheet" href="{{asset('customer/js/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('customer/js/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('customer/js/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

<!-- Libraries Stylesheet -->
<link href="{{ asset('customer/lib/animate/animate.min.css') }}" rel="stylesheet">

<!-- {{ asset('customer/img/about-1.jpg') }} -->

<link href="{{ asset('customer/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('customer/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet"/>

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('customer/css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Template Stylesheet -->
{{-- common --}}
<link href="{{ asset('customer/css/style.css') }}" rel="stylesheet">

{{-- declare other file css --}}
@stack('css')



















