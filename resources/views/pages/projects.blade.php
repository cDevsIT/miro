@extends('layouts.app')

@section('content')
<main>
    <div id="projects-page"></div>
</main>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 