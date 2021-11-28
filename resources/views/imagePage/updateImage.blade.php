@extends('template.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <update-image-tags image-endpoint="{{ $image_id }}"></update-image-tags>
@endsection
