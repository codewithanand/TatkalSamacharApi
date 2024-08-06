@extends('layouts.app')

@section('title', 'Unauthorized')

@section('content')
    <div style="height: 100vh; width: 100vw;"
        class="bg-gradient-danger d-flex flex-column justify-content-center align-items-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="text-light text-center">
                <h1>401</h1>
                <h1 class="display-1">Unauthorized</h1>
                <div class="d-flex justify-content-center">
                    <a class="text-white" href="{{ url('/') }}">Home</a>
                    @if (auth()->user())
                        <a class="text-white ml-3" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
