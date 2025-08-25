@extends('layouts.app')

@section('content')
<main>
    <div id="product-blog"></div>
</main>

@push('scripts')
<script>
    window.productBlogData = @json($productBlog);
</script>
@endpush
 @vite(['resources/js/app.jsx'])
@endsection 