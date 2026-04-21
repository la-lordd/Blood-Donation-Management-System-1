@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h2>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-red-500">
        <p class="text-gray-500 text-sm mb-1">Total Donors</p>
        <p class="text-4xl font-bold text-red-600">{{ \App\Models\Donor::count() }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
        <p class="text-gray-500 text-sm mb-1">Active Donors</p>
        <p class="text-4xl font-bold text-green-600">{{ \App\Models\Donor::where('status','active')->count() }}</p>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-gray-400">
        <p class="text-gray-500 text-sm mb-1">Inactive Donors</p>
        <p class="text-4xl font-bold text-gray-600">{{ \App\Models\Donor::where('status','inactive')->count() }}</p>
    </div>
</div>

<!-- Welcome Card -->
<div class="bg-white rounded-xl shadow p-6">
    <p class="text-lg text-gray-700 mb-1">
        Welcome back, <strong>{{ auth()->user()->name }}</strong>!
    </p>
    <p class="text-gray-500 text-sm mb-4">
        Your role:
        <span class="bg-red-100 text-red-700 font-semibold px-2 py-0.5 rounded capitalize">
            {{ auth()->user()->role }}
        </span>
    </p>
    <a href="{{ route('donors.index') }}"
       class="inline-block bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
        View All Donors →
    </a>
</div>
@endsection