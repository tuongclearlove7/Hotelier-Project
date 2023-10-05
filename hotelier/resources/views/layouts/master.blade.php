<!DOCTYPE html>
<html>
<head>
<title>@yield('title', 'Home page')</title>
<!-- file css -->
@include('layouts.css')
</head>
<body >
    <div class="container">
        @include('layouts.header')

        <main >
        
                @yield('content')
            
        </main>
        @include('layouts.footer')
        @include('layouts.js')
    </div>
</body>
</html>
















