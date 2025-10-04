<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_donors' => Donor::count(),
            'available_donors' => Donor::where('is_available', true)->count(),
            'by_blood_type' => Donor::select('blood_type', DB::raw('count(*) as count'))
                ->groupBy('blood_type')
                ->get(),
            'by_division' => Donor::select('division', DB::raw('count(*) as count'))
                ->groupBy('division')
                ->orderByDesc('count')
                ->get(),
            'recent_donors' => Donor::latest()->limit(10)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function donors(Request $request)
    {
        $query = Donor::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('blood_type')) {
            $query->where('blood_type', $request->blood_type);
        }

        if ($request->filled('division')) {
            $query->where('division', $request->division);
        }

        $donors = $query->latest()->paginate(20);

        return view('admin.donors', compact('donors'));
    }

    public function editDonor($id)
    {
        $donor = Donor::findOrFail($id);
        return view('admin.edit-donor', compact('donor'));
    }

    public function updateDonor(Request $request, $id)
    {
        $donor = Donor::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11',
            'blood_type' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'is_available' => 'boolean',
            'last_donation_date' => 'nullable|date',
        ]);

        $donor->update($validated);

        return redirect()->route('admin.donors')->with('success', 'Donor updated successfully!');
    }

    public function deleteDonor($id)
    {
        $donor = Donor::findOrFail($id);
        $donor->delete();

        return redirect()->route('admin.donors')->with('success', 'Donor deleted successfully!');
    }
}