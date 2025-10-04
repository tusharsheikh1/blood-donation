<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Models\BloodRequest;
use App\Helpers\BangladeshLocations;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Donors Query
        $donorQuery = Donor::where('is_available', true);

        if ($request->filled('blood_type')) {
            $donorQuery->where('blood_type', $request->blood_type);
        }

        if ($request->filled('division')) {
            $donorQuery->where('division', $request->division);
        }

        if ($request->filled('district')) {
            $donorQuery->where('district', $request->district);
        }

        if ($request->filled('upazila')) {
            $donorQuery->where('upazila', $request->upazila);
        }

        $donors = $donorQuery->latest()->paginate(10);

        // Blood Requests Query - Only active requests
        $requestQuery = BloodRequest::where('status', 'active')
            ->with('donor');

        if ($request->filled('blood_type')) {
            $requestQuery->where('blood_type', $request->blood_type);
        }

        if ($request->filled('division')) {
            $requestQuery->where('division', $request->division);
        }

        if ($request->filled('district')) {
            $requestQuery->where('district', $request->district);
        }

        if ($request->filled('upazila')) {
            $requestQuery->where('upazila', $request->upazila);
        }

        // Order by emergency first, then by latest
        $bloodRequests = $requestQuery
            ->orderByDesc('is_emergency')
            ->latest()
            ->paginate(6, ['*'], 'requests_page');

        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        
        // Get division names (English only)
        $divisions = BangladeshLocations::getDivisionNamesEn();

        return view('home', compact('donors', 'bloodRequests', 'bloodTypes', 'divisions'));
    }
}