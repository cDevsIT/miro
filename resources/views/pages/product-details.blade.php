@extends('layouts.app')

@section('content')
<main>
    <div id="product-details" data-model-number="{{ $modelNumber }}"></div>
</main>
@endsection

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@vite(['resources/js/app.jsx'])
@endpush 