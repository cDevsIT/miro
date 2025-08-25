@extends('layouts.app')

@section('content')
<main>
    <div id="products-page" data-type="{{ $type }}"></div>
</main>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 