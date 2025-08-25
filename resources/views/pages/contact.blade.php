@extends('layouts.app')

@section('content')
<main>
    <div id="contact-root"></div>
</main>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 