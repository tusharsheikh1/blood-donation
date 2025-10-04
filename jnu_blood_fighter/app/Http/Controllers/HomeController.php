<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Helpers\BangladeshLocations;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Donor::where('is_available', true);

        if ($request->filled('blood_type')) {
            $query->where('blood_type', $request->blood_type);
        }

        if ($request->filled('division')) {
            $query->where('division', $request->division);
        }

        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        if ($request->filled('upazila')) {
            $query->where('upazila', $request->upazila);
        }

        $donors = $query->latest()->paginate(10);
        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        
        // Get division names (English only)
        $divisions = BangladeshLocations::getDivisionNamesEn();

        return view('home', compact('donors', 'bloodTypes', 'divisions'));
    }
}