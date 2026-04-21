@extends('layouts.app')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Donor Records</h2>
    @if(auth()->user()->isAdmin())
        <a href="{{ url('/donors/create') }}"
           class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
            + Add New Donor
        </a>
    @endif
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-red-600 text-white">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Blood Type</th>
                <th class="px-4 py-3 text-left">Phone</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donors as $donor)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="px-4 py-3 text-gray-400">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 font-semibold text-gray-800">{{ $donor->name }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $donor->email }}</td>
                    <td class="px-4 py-3">
                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-bold">
                            {{ $donor->blood_type }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $donor->phone }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            {{ $donor->status === 'active'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-gray-100 text-gray-500' }}">
                            {{ ucfirst($donor->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">

                            <a href="{{ route('donors.show', $donor) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600 transition">
                                View
                            </a>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('donors.edit', $donor) }}"
                                   class="bg-yellow-400 text-white px-3 py-1 rounded text-xs hover:bg-yellow-500 transition">
                                    Edit
                                </a>

                                <form action="{{ route('donors.destroy', $donor) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this donor?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                </form>
                            @endif

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-400 py-10">
                        No donors found.
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('donors.create') }}" class="text-red-500 hover:underline ml-1">Add one now.</a>
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="px-4 py-3 border-t">
        {{ $donors->links() }}
    </div>
</div>

@endsection