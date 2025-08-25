@extends('layouts.app')

@section('content')
<main>
    <div id="category-details" data-id="{{ $category->id }}"></div>
</main>

@push('scripts')
<script>
    console.log('Category data from blade:', @json($category));
    window.categoryData = @json($category);
</script>
@endpush
@vite(['resources/js/app.jsx'])
@endsection 