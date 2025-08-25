@extends('layouts.app')

@section('content')
<main>
    <div id="mymiro-signup-page">
        <form method="POST" action="{{ route('mymiro.signup.submit') }}" class="signup-form">
            @csrf
            <!-- form fields -->
        </form>
    </div>
</main>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 