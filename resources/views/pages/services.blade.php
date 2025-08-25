@extends('layouts.app')

@section('content')
<main>
    <div id="services-page"></div>
</main>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 