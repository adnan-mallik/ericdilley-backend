<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpeakingRequest;
use Illuminate\Support\Facades\Validator;

class SpeakingRequestController extends Controller
{
    
    /**
     * Display the speaking request form.
     */
    public function show()
    {
        $speakingRequests = SpeakingRequest::paginate(10);

        return view('speaking.request', compact('speakingRequests'));

    }

    /**
     * Handle the speaking request form submission.
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'         => 'required|string|max:255',
            'last_name'          => 'required|string|max:255',
            'email'              => 'required|email|max:255',
            'phone'              => 'nullable|string|max:20',
            'organization'       => 'nullable|string|max:255',
            'event_type'         => 'nullable|string|max:255',
            'event_date'         => 'nullable|date',
            'expected_attendees' => 'nullable|string|max:255',
            'event_location'     => 'nullable|string|max:255',
            'budget_range'       => 'nullable|string|max:255',
            'additional_details' => 'nullable|string',
        ],[
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'email.required'      => 'Email is required.',
            'email.email'         => 'Email must be a valid email address.',
            'phone.max'           => 'Phone number cannot exceed 20 characters.',
            'organization.max'    => 'Organization name cannot exceed 255 characters.',
            'event_type.max'      => 'Event type cannot exceed 255 characters.',
            'event_date.date'     => 'Event date must be a valid date.',
            'expected_attendees.max' => 'Expected attendees cannot exceed 255 characters.',
            'event_location.max'  => 'Event location cannot exceed 255 characters.',
            'budget_range.max'    => 'Budget range cannot exceed 255 characters.',
            'additional_details.max' => 'Additional details cannot exceed 65535 characters.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validated();

        SpeakingRequest::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Speaking request submitted successfully.',
        ], 201);
    }
}
