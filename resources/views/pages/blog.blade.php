@extends('layouts.app')

@section('content')
<main>
    <div id="blog-page"></div>
</main>
@endsection

@push('scripts')
    <script>
        window.blogsData = @json($blogs);
    </script>
    @vite(['resources/js/app.jsx'])
@endpush 