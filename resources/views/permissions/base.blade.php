@extends('layouts.app')

@section('content')
    <script src="{{asset('plugins/jquery/jquery-3.5.0.min.js')}}"></script>

    @yield('permission_content')
    @yield('permission_scripts')
@endsection
