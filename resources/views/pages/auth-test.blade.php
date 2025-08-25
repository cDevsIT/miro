@extends('layouts.app')

@section('content')
    <div id="auth-test"></div>
@endsection

@push('scripts')
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
@endpush 