@if(session('role') == 'admin')
    @include('layouts.admin-header')
@else
    @include('layouts.header')
@endif

@yield('main')
@include('layouts.footer')