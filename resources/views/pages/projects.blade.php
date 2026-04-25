@extends('layouts.app')

@section('content')
<main>
    <div id="projects-page"></div>
</main>
@endsection

@push('scripts')
    <script>
        window.projectsData = @json($projects);
    </script>
    @vite(['resources/js/app.jsx'])
@endpush 