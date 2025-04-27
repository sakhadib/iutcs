@if(session('is_admin') == true)
    @include('layouts.admin_header')
@else
    @include('layouts.header')
@endif

@yield('main')
@include('layouts.footer')