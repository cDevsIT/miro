@extends('layouts.app')

@section('content')
    <div id="blog-details" data-blog-id="{{ $id }}"></div>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 