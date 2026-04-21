@extends('layouts.app')

@section('content')
<div class="text-center py-20">
    <div class="text-6xl mb-4">🩸</div>
    <h1 class="text-4xl font-bold text-red-700 mb-3">Blood Donation Management System</h1>
    <p class="text-gray-500 text-lg mb-8">Saving lives, one donor at a time.</p>

    @guest
        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}"
               class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition font-semibold text-lg">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="bg-white border-2 border-red-600 text-red-600 px-8 py-3 rounded-lg hover:bg-red-50 transition font-semibold text-lg">
                Register
            </a>
        </div>
    @else
        <a href="{{ route('dashboard') }}"
           class="bg-red-600 text-white px-8 py-3 rounded-lg hover:bg-red-700 transition font-semibold text-lg">
            Go to Dashboard →
        </a>
    @endguest
</div>
@endsection