@extends('layouts.app')

@section('content')
<main>
    <div id="mymiro-login-page">
        <form method="POST" action="{{ route('mymiro.login.submit') }}" class="login-form">
            @csrf
            <!-- form fields -->
        </form>
    </div>
</main>
@endsection

@push('scripts')
    @vite(['resources/js/app.jsx'])
@endpush 