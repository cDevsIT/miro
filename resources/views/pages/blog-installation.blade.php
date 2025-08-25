@extends('layouts.app')

@section('content')
    <div id="blog-installation"></div>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 