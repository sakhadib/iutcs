@if(session('user_id'))
    @include('layouts.admin-header')
@else
    @include('layouts.header')
@endif

@yield('main')
@include('layouts.footer')