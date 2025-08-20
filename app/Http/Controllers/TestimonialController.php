<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    

    /**
     * 
     * 
     * 
     * 
     * Display a listing of the testimonials.
     */
    public function index()
    {
        $testimonials = Testimonial::all(); // Retrieve all testimonials from the database

        // Logic to retrieve and display testimonials
        return view('testimonials.index', compact('testimonials'));
    }


    /**
     * 
     * 
     * 
     * 
     * 
     * Display a listing of the testimonials for API.
     */
    public function getTestimonials(Request $request)
    {
        // Logic to retrieve testimonials for API
        $testimonials = Testimonial::where('type', $request->input('type', 'live_transformed'))
            ->orderBy('created_at', 'desc')
            ->get();

        $testimonials->transform(function ($testimonial) {
            $testimonial->rating = 5; // or rand(3, 5)
            return $testimonial;
        });

        return response()->json([
            'status' => 'success',
            'data' => $testimonials
        ]);
    }


    /**
     * 
     * 
     * 
     * 
     * 
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        // Logic to show the form for creating a new testimonial
        return view('testimonials.add');
    }


    /**
     * 
     * 
     * 
     * 
     * 
     * 
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        // Logic to store a new testimonial
        $validate = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'designation'   => 'required|string|max:255',
            'message'       => 'required|string|max:1000',
            'type'          => 'required|string|max:50',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors()
            ], 422);
        }


        // If validation passes, save the testimonial
        $testimonials               = new Testimonial();
        $testimonials->name         = $request->input('name');
        $testimonials->designation  = $request->input('designation');
        $testimonials->message      = $request->input('message');
        $testimonials->type         = $request->input('type');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $testimonials->photo = 'uploads/testimonials/' . $filename;
        }

        $testimonials->save();
        // Save the testimonial to the database (not implemented here)
        
        return response()->json([
            'status' => 'success',
            'message' => 'Testimonial created successfully!'
        ], 201);
    }
}
