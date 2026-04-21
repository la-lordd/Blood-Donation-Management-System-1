@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Donor Details</h2>
       <a href="{{ url('/donors') }}" class="text-red-600 hover:underline text-sm">← Back to List</a>

    <div class="bg-white rounded-xl shadow p-6">

        <!-- Avatar + Name -->
        <div class="flex items-center gap-4 mb-6">
            <div class="bg-red-100 text-red-700 text-2xl font-bold w-16 h-16 rounded-full flex items-center justify-center uppercase">
                {{ substr($donor->name, 0, 1) }}
            </div>
            <div>
                <p class="text-xl font-bold text-gray-800">{{ $donor->name }}</p>
                <p class="text-gray-500 text-sm">{{ $donor->email }}</p>
            </div>
        </div>

        <hr class="mb-6">

        <!-- Details Grid -->
        <div class="grid grid-cols-2 gap-5 text-sm">

            <div>
                <p class="text-gray-400 text-xs uppercase mb-1">Blood Type</p>
                <span class="bg-red-100 text-red-700 px-3 py-1 rounded font-bold text-base">
                    {{ $donor->blood_type }}
                </span>
            </div>

            <div>
                <p class="text-gray-400 text-xs uppercase mb-1">Phone</p>
                <p class="font-semibold text-gray-800">{{ $donor->phone }}</p>
            </div>

            <div>
                <p class="text-gray-400 text-xs uppercase mb-1">Date of Birth</p>
                <p class="font-semibold text-gray-800">
                    {{ \Carbon\Carbon::parse($donor->date_of_birth)->format('F d, Y') }}
                </p>
            </div>

            <div>
                <p class="text-gray-400 text-xs uppercase mb-1">Status</p>
                <span class="px-2 py-1 rounded text-xs font-semibold
                    {{ $donor->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ ucfirst($donor->status) }}
                </span>
            </div>

            <div class="col-span-2">
                <p class="text-gray-400 text-xs uppercase mb-1">Address</p>
                <p class="font-semibold text-gray-800">{{ $donor->address }}</p>
            </div>

            <div>
                <p class="text-gray-400 text-xs uppercase mb-1">Registered On</p>
                <p class="font-semibold text-gray-800">{{ $donor->created_at->format('F d, Y') }}</p>
            </div>

        </div>

        <!-- Admin Action Buttons -->
        @if(auth()->user()->isAdmin())
            <div class="flex gap-3 mt-6 pt-4 border-t">
                <a href="{{ route('donors.edit', $donor) }}"
                   class="bg-yellow-400 text-white px-5 py-2 rounded-lg hover:bg-yellow-500 transition font-semibold text-sm">
                    Edit Donor
                </a>
                <form action="{{ route('donors.destroy', $donor) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this donor?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 text-white px-5 py-2 rounded-lg hover:bg-red-600 transition font-semibold text-sm">
                        Delete Donor
                    </button>
                </form>
            </div>
        @endif

    </div>
</div>
@endsection