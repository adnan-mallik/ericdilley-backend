<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function index(){

        $messages = ContactMessage::paginate(10);

        // Logic to display the contact form
        return view('contact.index', compact('messages'));
    }

    /**
     * Handle the contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit(Request $request)
    {

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'service' => 'nullable|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        
        $validatedData = $validator->validated();


        // Create a new contact message
        \App\Models\ContactMessage::create($validatedData);

        // Return a success response
        return response()->json(['status' => 'success', 'message' => 'Contact message submitted successfully.']);
    }
}
