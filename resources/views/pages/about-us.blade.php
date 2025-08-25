@extends('layouts.app')

@section('content')
    <main>
        <div id="about-us"></div>
    </main>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 