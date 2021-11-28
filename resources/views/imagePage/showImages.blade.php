@extends('template.app')
@section('content')
    <show-images images-endpoint="{{ route("getImagesApi") }}"></show-images>
@endsection
