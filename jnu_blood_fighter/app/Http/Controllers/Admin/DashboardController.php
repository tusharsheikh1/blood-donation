<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\BangladeshLocations;

class DashboardController extends Controller
{
    /**
     * Admin dashboard with some quick stats.
     */
    public function index()
    {
        $stats = [
            'total_donors'      => Donor::count(),
            'available_donors'  => Donor::where('is_available', true)->count(),
            'by_blood_type'     => Donor::select('blood_type', DB::raw('count(*) as count'))
                                        ->groupBy('blood_type')
                                        ->orderByDesc('count')
                                        ->get(),
            'by_division'       => Donor::select('division', DB::raw('count(*) as count'))
                                        ->groupBy('division')
                                        ->orderByDesc('count')
                                        ->get(),
            'recent_donors'     => Donor::latest()->limit(10)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Donor list with filters + pagination.
     */
    public function donors(Request $request)
    {
        $query = Donor::query();

        // Search (name/email/phone)
        if ($request->filled('search')) {
            $s = trim($request->string('search'));
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%");
            });
        }

        // Blood type
        if ($request->filled('blood_type')) {
            $query->where('blood_type', $request->string('blood_type'));
        }

        // Availability (1/0)
        if ($request->filled('available')) {
            $query->where('is_available', (bool) ((int) $request->input('available')));
        }

        // Location filters
        if ($request->filled('division')) {
            $query->where('division', $request->string('division'));
        }
        if ($request->filled('district')) {
            $query->where('district', $request->string('district'));
        }
        if ($request->filled('upazila')) {
            $query->where('upazila', $request->string('upazila'));
        }

        $donors = $query->latest()->paginate(15);

        // Provide divisions for the filter dropdown
        $divisions = BangladeshLocations::divisions();

        return view('admin.donors', compact('donors', 'divisions'));
    }

    /**
     * Show create form (admin adds donors who will NOT log in).
     */
    public function createDonor()
    {
        $divisions = BangladeshLocations::divisions();
        return view('admin.create-donor', compact('divisions'));
    }

    /**
     * Store a new donor added by admin (no email/password required).
     */
    public function storeDonor(Request $request)
    {
        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'email'                => 'nullable|email|max:255|unique:donors,email',
            'phone'                => ['required','string','regex:/^01[0-9]{9}$/','max:11','unique:donors,phone'],
            'address'              => 'required|string|max:500',
            'division'             => 'required|string|max:255',
            'district'             => 'required|string|max:255',
            'upazila'              => 'required|string|max:255',
            'blood_type'           => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'gender'               => 'nullable|in:male,female,other',
            'height_cm'            => 'nullable|integer|min:50|max:250',
            'weight_kg'            => 'nullable|integer|min:20|max:300',
            'age'                  => 'nullable|integer|min:16|max:100',
            'is_available'         => 'nullable|boolean',
            'last_donation_date'   => 'nullable|date',
            // No password here on purpose—admin-created donors won't log in
        ]);

        $validated['is_available'] = (bool) ($validated['is_available'] ?? false);

        Donor::create($validated);

        return redirect()->route('admin.donors')->with('success', 'Donor created successfully!');
    }

    /**
     * Edit donor form.
     */
    public function editDonor($id)
    {
        $donor = Donor::findOrFail($id);
        $divisions = BangladeshLocations::divisions();

        // You can optionally preload districts/upazilas if your view expects them.
        return view('admin.edit-donor', compact('donor', 'divisions'));
    }

    /**
     * Update donor.
     */
    public function updateDonor(Request $request, $id)
    {
        $donor = Donor::findOrFail($id);

        $validated = $request->validate([
            'name'                 => 'required|string|max:255',
            'email'                => 'nullable|email|max:255|unique:donors,email,' . $donor->id,
            'phone'                => ['required','string','regex:/^01[0-9]{9}$/','max:11','unique:donors,phone,' . $donor->id],
            'address'              => 'required|string|max:500',
            'division'             => 'required|string|max:255',
            'district'             => 'required|string|max:255',
            'upazila'              => 'required|string|max:255',
            'blood_type'           => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'gender'               => 'nullable|in:male,female,other',
            'height_cm'            => 'nullable|integer|min:50|max:250',
            'weight_kg'            => 'nullable|integer|min:20|max:300',
            'age'                  => 'nullable|integer|min:16|max:100',
            'is_available'         => 'nullable|boolean',
            'last_donation_date'   => 'nullable|date',
        ]);

        $validated['is_available'] = (bool) ($validated['is_available'] ?? false);

        $donor->update($validated);

        return redirect()->route('admin.donors')->with('success', 'Donor updated successfully!');
    }

    /**
     * Delete donor.
     */
    public function deleteDonor($id)
    {
        $donor = Donor::findOrFail($id);
        $donor->delete();

        return redirect()->route('admin.donors')->with('success', 'Donor deleted successfully!');
    }
}
