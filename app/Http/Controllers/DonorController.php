<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donor::latest()->paginate(10);
        return view('donors.index', compact('donors'));
    }

    public function create()
    {
        return view('donors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:donors,email',
            'phone'         => 'required|string|max:20',
            'blood_type'    => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'date_of_birth' => 'required|date',
            'address'       => 'required|string|max:500',
            'status'        => 'required|in:active,inactive',
        ]);

        Donor::create($validated);

        return redirect()->route('donors.index')
            ->with('success', 'Donor added successfully!');
    }

    public function show(Donor $donor)
    {
        return view('donors.show', compact('donor'));
    }

    public function edit(Donor $donor)
    {
        return view('donors.edit', compact('donor'));
    }

    public function update(Request $request, Donor $donor)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:donors,email,' . $donor->id,
            'phone'         => 'required|string|max:20',
            'blood_type'    => 'required|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'date_of_birth' => 'required|date',
            'address'       => 'required|string|max:500',
            'status'        => 'required|in:active,inactive',
        ]);

        $donor->update($validated);

        return redirect()->route('donors.index')
            ->with('success', 'Donor updated successfully!');
    }

    public function destroy(Donor $donor)
    {
        $donor->delete();

        return redirect()->route('donors.index')
            ->with('success', 'Donor deleted successfully!');
    }
}