@extends('template.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <upload-image></upload-image>
@endsection
