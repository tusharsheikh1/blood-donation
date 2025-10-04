<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Helpers\BangladeshLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class DonorController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegister()
    {
        $divisions = BangladeshLocations::divisions();
        return view('donor.register', compact('divisions'));
    }

    /**
     * Handle donor registration
     */
    public function register(Request $request)
    {
        try {
            // Validate incoming request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:donors,email',
                'phone' => 'required|string|regex:/^01[0-9]{9}$/|max:11|unique:donors,phone',
                'address' => 'required|string|max:500',
                'division' => 'required|string|max:255',
                'district' => 'required|string|max:255',
                'upazila' => 'required|string|max:255',
                'blood_type' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
                'password' => 'required|string|min:6|confirmed',
            ], [
                // Custom error messages
                'name.required' => 'Please enter your full name.',
                'name.max' => 'Name cannot exceed 255 characters.',
                
                'email.required' => 'Please enter your email address.',
                'email.email' => 'Please enter a valid email address.',
                'email.unique' => 'This email address is already registered. Please login or use a different email.',
                
                'phone.required' => 'Please enter your phone number.',
                'phone.regex' => 'Phone number must be in the format: 01XXXXXXXXX (11 digits starting with 01)',
                'phone.max' => 'Phone number must be exactly 11 digits.',
                'phone.unique' => 'This phone number is already registered. Please use a different number.',
                
                'address.required' => 'Please enter your address.',
                'address.max' => 'Address cannot exceed 500 characters.',
                
                'division.required' => 'Please select your division.',
                'district.required' => 'Please select your district.',
                'upazila.required' => 'Please select your upazila.',
                
                'blood_type.required' => 'Please select your blood type.',
                'blood_type.in' => 'Please select a valid blood type from the dropdown.',
                
                'password.required' => 'Please enter a password.',
                'password.min' => 'Password must be at least 6 characters long.',
                'password.confirmed' => 'Password confirmation does not match. Please re-enter your password.',
            ]);

            // Hash the password
            $validated['password'] = Hash::make($validated['password']);

            // Set default values
            $validated['is_available'] = true;
            $validated['last_donation_date'] = null;

            // Create the donor
            $donor = Donor::create($validated);

            // Log the donor in
            Auth::guard('web')->login($donor);

            // Redirect to dashboard with success message
            return redirect()->route('donor.dashboard')
                ->with('success', 'Registration successful! Welcome to Blood Donor Finder, ' . $donor->name . '!');

        } catch (ValidationException $e) {
            // Validation errors - Laravel handles this automatically
            return back()->withErrors($e->errors())->withInput($request->except('password', 'password_confirmation'));

        } catch (QueryException $e) {
            // Database errors
            Log::error('Donor Registration Database Error', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            // Check for duplicate entry error (MySQL error code 23000)
            if ($e->getCode() == 23000) {
                return back()->withErrors([
                    'error' => 'This email or phone number is already registered. Please use a different one or try logging in.'
                ])->withInput($request->except('password', 'password_confirmation'));
            }

            return back()->withErrors([
                'error' => 'A database error occurred. Please try again later or contact support if the problem persists.'
            ])->withInput($request->except('password', 'password_confirmation'));

        } catch (\Exception $e) {
            // Log unexpected errors
            Log::error('Donor Registration General Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'email' => $request->email,
            ]);

            return back()->withErrors([
                'error' => 'Registration failed due to an unexpected error: ' . $e->getMessage() . '. Please try again or contact support.'
            ])->withInput($request->except('password', 'password_confirmation'));
        }
    }

    /**
     * Show the login form
     */
    public function showLogin()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('donor.dashboard');
        }
        return view('donor.login');
    }

    /**
     * Handle donor login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter your password.',
        ]);

        try {
            if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
                $request->session()->regenerate();
                
                $donor = Auth::guard('web')->user();
                return redirect()->route('donor.dashboard')
                    ->with('success', 'Welcome back, ' . $donor->name . '!');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records. Please check your email and password.'
            ])->withInput($request->only('email'));

        } catch (\Exception $e) {
            Log::error('Donor Login Error', [
                'error' => $e->getMessage(),
                'email' => $request->email,
            ]);

            return back()->withErrors([
                'error' => 'Login failed. Please try again later.'
            ])->withInput($request->only('email'));
        }
    }

    /**
     * Handle donor logout
     */
    public function logout(Request $request)
    {
        try {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('home')
                ->with('success', 'You have been logged out successfully!');

        } catch (\Exception $e) {
            Log::error('Donor Logout Error', [
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('home')
                ->with('error', 'Logout failed. Please try again.');
        }
    }

    /**
     * Show donor dashboard
     */
    public function dashboard()
    {
        $donor = Auth::guard('web')->user();
        return view('donor.dashboard', compact('donor'));
    }

    /**
     * Show donor profile edit form
     */
    public function showProfile()
    {
        $donor = Auth::guard('web')->user();
        $divisions = BangladeshLocations::divisions();
        return view('donor.profile', compact('donor', 'divisions'));
    }

    /**
     * Update donor profile
     */
    public function updateProfile(Request $request)
    {
        $donor = Auth::guard('web')->user();

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|regex:/^01[0-9]{9}$/|max:11|unique:donors,phone,' . $donor->id,
                'address' => 'required|string|max:500',
                'division' => 'required|string|max:255',
                'district' => 'required|string|max:255',
                'upazila' => 'required|string|max:255',
                'blood_type' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
                'is_available' => 'nullable|boolean',
                'last_donation_date' => 'nullable|date|before_or_equal:today',
            ], [
                'phone.regex' => 'Phone number must be in the format: 01XXXXXXXXX (11 digits starting with 01)',
                'phone.unique' => 'This phone number is already registered to another donor.',
                'last_donation_date.before_or_equal' => 'Last donation date cannot be in the future.',
            ]);

            // Handle checkbox
            $validated['is_available'] = $request->has('is_available') ? true : false;

            $donor->update($validated);

            return back()->with('success', 'Profile updated successfully!');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            Log::error('Profile Update Error', [
                'error' => $e->getMessage(),
                'donor_id' => $donor->id,
            ]);

            return back()->withErrors([
                'error' => 'Profile update failed: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Get districts by division (API endpoint)
     */
    public function getDistricts($division)
    {
        try {
            $districts = BangladeshLocations::getDistrictsByDivision($division);
            
            if (empty($districts)) {
                return response()->json([
                    'error' => 'No districts found for this division'
                ], 404);
            }
            
            // Return only English names
            return response()->json(array_column($districts, 'en'));

        } catch (\Exception $e) {
            Log::error('Get Districts Error', [
                'error' => $e->getMessage(),
                'division' => $division,
            ]);

            return response()->json([
                'error' => 'Failed to load districts'
            ], 500);
        }
    }

    /**
     * Get upazilas by district (API endpoint)
     */
    public function getUpazilas($district)
    {
        try {
            $upazilas = BangladeshLocations::getUpazilasByDistrict($district);
            
            if (empty($upazilas)) {
                return response()->json([
                    'error' => 'No upazilas found for this district'
                ], 404);
            }
            
            // Return only English names
            return response()->json(array_column($upazilas, 'en'));

        } catch (\Exception $e) {
            Log::error('Get Upazilas Error', [
                'error' => $e->getMessage(),
                'district' => $district,
            ]);

            return response()->json([
                'error' => 'Failed to load upazilas'
            ], 500);
        }
    }
}