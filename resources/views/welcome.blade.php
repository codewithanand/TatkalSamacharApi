@extends('layouts.app')

@section('title', 'Admin - Tatkal Samachar')

@section('content')
    <div style="height: 100vh; width: 100vw;"
        class="bg-gradient-danger d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="text-light text-center">
                <h1>Welcome to तत्काल समाचार</h1>
                <p>Your journey to knowledge starts here.</p>
                <div>
                    <a href="{{ route('login') }}" class="btn btn-dark border btn-lg">Get Started</a>
                </div>
            </div>
        </div>
    </div>
@endsection
