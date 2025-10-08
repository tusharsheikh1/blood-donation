<?php

namespace App\Http\Controllers;

use App\Models\BloodRequest;
use App\Helpers\BangladeshLocations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BloodRequestController extends Controller
{
    /**
     * Show blood request creation form
     */
    public function create()
    {
        $donor = Auth::guard('web')->user();
        $divisions = BangladeshLocations::divisions();
        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        
        return view('donor.create-request', compact('donor', 'divisions', 'bloodTypes'));
    }

    /**
     * Store blood request
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'patient_name' => 'required|string|max:255',
                'disease' => 'required|string|max:255',
                'blood_type' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
                'blood_quantity' => 'required|integer|min:1|max:10',
                'is_emergency' => 'nullable|boolean',
                'needed_date' => 'nullable|required_if:is_emergency,0|date|after_or_equal:today',
                'hospital_name' => 'required|string|max:255',
                'hospital_location' => 'required|string|max:500',
                'hospital_map_link' => 'nullable|url|max:500', // <-- ADDED VALIDATION
                'division' => 'required|string|max:255',
                'district' => 'required|string|max:255',
                'upazila' => 'required|string|max:255',
                'contact_number' => 'required|string|regex:/^01[0-9]{9}$/|max:11',
                'additional_notes' => 'nullable|string|max:1000',
            ], [
                'patient_name.required' => 'Please enter the patient name.',
                'disease.required' => 'Please specify the disease or reason for blood requirement.',
                'blood_type.required' => 'Please select the required blood type.',
                'blood_quantity.required' => 'Please specify how many bags of blood are needed.',
                'blood_quantity.min' => 'At least 1 bag is required.',
                'blood_quantity.max' => 'Maximum 10 bags can be requested at once.',
                'needed_date.required_if' => 'Please specify when the blood is needed (unless it\'s an emergency).',
                'needed_date.after_or_equal' => 'The needed date cannot be in the past.',
                'hospital_name.required' => 'Please enter the hospital name.',
                'hospital_location.required' => 'Please enter the hospital location.',
                'hospital_map_link.url' => 'The Google Map Link must be a valid URL.', // <-- ADDED ERROR MESSAGE
                'contact_number.required' => 'Please provide a contact number.',
                'contact_number.regex' => 'Contact number must be in the format: 01XXXXXXXXX (11 digits starting with 01)',
            ]);

            // Set donor_id
            $validated['donor_id'] = Auth::guard('web')->id();
            
            // Handle emergency - if emergency, set needed_date to now
            $validated['is_emergency'] = $request->has('is_emergency') ? true : false;
            if ($validated['is_emergency']) {
                $validated['needed_date'] = now();
            }

            // Create blood request
            $bloodRequest = BloodRequest::create($validated);

            return redirect()->route('donor.dashboard')
                ->with('success', 'Blood request posted successfully! Your request is now visible to potential donors.');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();

        } catch (\Exception $e) {
            Log::error('Blood Request Creation Error', [
                'error' => $e->getMessage(),
                'donor_id' => Auth::guard('web')->id(),
            ]);

            return back()->withErrors([
                'error' => 'Failed to create blood request: ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Show donor's blood requests
     */
    public function myRequests()
    {
        $donor = Auth::guard('web')->user();
        $requests = BloodRequest::where('donor_id', $donor->id)
            ->latest()
            ->paginate(10);

        return view('donor.my-requests', compact('requests'));
    }

    /**
     * Update blood request status
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $bloodRequest = BloodRequest::where('donor_id', Auth::guard('web')->id())
                ->findOrFail($id);

            $validated = $request->validate([
                'status' => 'required|in:active,fulfilled,cancelled'
            ]);

            $bloodRequest->update($validated);

            return back()->with('success', 'Request status updated successfully!');

        } catch (\Exception $e) {
            Log::error('Blood Request Status Update Error', [
                'error' => $e->getMessage(),
                'request_id' => $id,
            ]);

            return back()->withErrors([
                'error' => 'Failed to update request status.'
            ]);
        }
    }

    /**
     * Delete blood request
     */
    public function destroy($id)
    {
        try {
            $bloodRequest = BloodRequest::where('donor_id', Auth::guard('web')->id())
                ->findOrFail($id);

            $bloodRequest->delete();

            return back()->with('success', 'Blood request deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Blood Request Delete Error', [
                'error' => $e->getMessage(),
                'request_id' => $id,
            ]);

            return back()->withErrors([
                'error' => 'Failed to delete blood request.'
            ]);
        }
    }
}