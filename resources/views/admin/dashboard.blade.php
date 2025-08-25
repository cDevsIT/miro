
@extends('layouts.admin')

@section('content')
    <div id="dashboard-root"></div>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 