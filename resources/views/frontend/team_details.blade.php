@extends('layouts.main')

@section('main')

{{ json_encode($team->toArray()) }}

@endsection
