<?php

namespace App\Http\Controllers;

use App\Models\PodCast;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PodCastController extends Controller
{
    public function index()
    {
        $podcasts = PodCast::latest()->paginate(10);
        return view('podcasts.index', compact('podcasts'));
    }

    public function create()
    {
        return view('podcasts.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pod_casts,slug',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_url' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_at' => 'nullable|date',
            'duration' => 'nullable|integer',
            'is_latest' => 'nullable|boolean'
        ], [
            'title.required' => 'The title is required.',
            'video_url.required' => 'The video URL is required.',
            'slug.unique' => 'The slug must be unique.',
            'thumbnail.string' => 'The thumbnail must be a string.',
            'video_url.string' => 'The video URL must be a string.',
            'description.string' => 'The description must be a string.',
            'published_at.date' => 'The published date must be a valid date.',
            'duration.integer' => 'The duration must be an integer.',
            'is_latest.boolean' => 'The is_latest field must be true or false.'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        // Set is_latest to false if not provided
        if (!isset($validated['is_latest'])) {
            $validated['is_latest'] = false;
        }

        PodCast::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Podcast created successfully',
        ], 201);
    }

    public function show($id)
    {
        $podcast = PodCast::findOrFail($id);
        return view('podcasts.show', compact('podcast'));
    }

    public function edit($id)
    {
        $podcast = PodCast::findOrFail($id);
        return view('podcasts.edit', compact('podcast'));
    }

    public function update(Request $request, $id)
    {
        $podcast = PodCast::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pod_casts,slug,' . $podcast->id,
            'thumbnail' => 'nullable|string|max:255',
            'video_url' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_at' => 'nullable|date',
            'duration' => 'nullable|integer',
            'is_latest' => 'nullable|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();
        if (!isset($validated['is_latest'])) {
            $validated['is_latest'] = false;
        }

        $podcast->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Podcast updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $podcast = PodCast::findOrFail($id);
        $podcast->delete();

        return response()->json([
            'success' => true,
            'message' => 'Podcast deleted successfully',
        ]);
    }


    public function getAllPodCast()
    {
        $podcasts = PodCast::latest()->paginate(10);
        
        $podcasts->each(function ($podcast) {
            if ($podcast->created_at) {
                $podcast->formated_date = \Carbon\Carbon::parse($podcast->created_at)->format('d M Y');
            }
        });
        return response()->json([
            'success' => true,
            'data' => $podcasts,
        ]);
    }

    public function latest()
    {
        $latestPodcast = PodCast::where('is_latest', true)
        ->orderBy('created_at', 'desc')
        ->first();

        // If no "latest" is marked, fallback to the most recent podcast
        if (!$latestPodcast) {
            $latestPodcast = PodCast::latest()->first();
        }

        if ($latestPodcast) {
           $latestPodcast->formatted_date = Carbon::parse($latestPodcast->created_at)->format('d M Y');
        }
        
        return response()->json([
            'success' => true,
            'data' => $latestPodcast,
        ]);
    }

    public function getPodCastById($id)
    {
        $podcast = PodCast::findOrFail($id);
        
        $podcast->created_at = \Carbon\Carbon::parse($podcast->created_at)->format('d M Y');

        return response()->json([
            'success' => true,
            'data' => $podcast,
        ]);
    }
}
