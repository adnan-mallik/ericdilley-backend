<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    
    public function index()
    {
        // $blogs = Blog::where('published', true)->get();

        $blogs = Blog::paginate(10); // Fetching 10 blogs per page

        return view('resources.index', compact('blogs')); // Assuming you have a view for listing resources

    }

    public function show($slug)
    {
        // Logic to display a single resource (blog post) by slug

        return view('resources.show', ['slug' => $slug]); // Assuming you have a view for showing a single resource
    }

    public function create()
    {
        // Logic to show the form for creating a new resource (blog post)
        return view('resources.create'); // Assuming you have a view for creating a new resource
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'slug' => 'required|string|unique:blogs,slug|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'published' => 'boolean',
        ],
        [
            'title.required' => 'The title is required.',
            'content.required' => 'The content is required.',
            'slug.required' => 'The slug is required.',
            'slug.unique' => 'The slug must be unique.',
            'image.image' => 'The image must be a valid image file.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image       = $request->file('image');
            $imageName   = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath   = 'images/' . $imageName;
        } else {
            $imagePath = $model->image; // keep old image if not updating
        }

        // If validation passes, proceed to store the resource
        // $data = $request->only(['title', 'content', 'author', 'slug', 'image' , 'published']);
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'author' => $request->author,
            'slug' => $request->slug,
            'image' => $imagePath,
            'published' => $request->published,
        ];
        

        if($data['published']):
            $data['published_at'] = now();
        endif;
        
        // Assuming you have a Blog model to handle the database interaction
        $blog = Blog::create($data);


        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Resource created successfully',
            'data' => $data
        ], 201);

    }


    public function getBlogs()
    {
        // Fetch all blogs
        $blogs = Blog::where('published', 1)
        ->orderBy('published_at', 'desc')
        ->paginate(10);
        // ->makeHidden(['created_at', 'updated_at']); // Hiding timestamps if not needed

        $blogs->each(function ($blog) {
            $blog->image = $blog->image ? asset('storage/' . $blog->image) : null;
            if ($blog->published_at) {
                $blog->published_at = \Carbon\Carbon::parse($blog->published_at)->format('d M Y');
            } else {
                $blog->published_at = 'Draft';
            }
        });
        

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ], 200);
    }

    public function getBlog($id)
    {
        // Fetch a single blog by ID
        $blog = Blog::findOrFail($id);
        $blog->image = $blog->image ? asset('storage/' . $blog->image) : null;
        if ($blog->published_at) {
            $blog->published_at = \Carbon\Carbon::parse($blog->published_at)->format('d M Y');
        } else {
            $blog->published_at = 'Draft';
        }

        return response()->json([
            'success' => true,
            'data' => $blog,
        ], 200);
    }

    // defne media method to handle video uploads
    public function uploadMedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video' => 'required|file|mimes:mp4,avi,mov|max:20480', // 20MB max size
        ], [
            'video.required' => 'The video file is required.',
            'video.file' => 'The uploaded file must be a valid file.',
            'video.mimes' => 'The video must be a file of type: mp4, avi, mov.',
            'video.max' => 'The video must not be greater than 20MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }
        // If validation passes, proceed to store the video
        $videoPath = $request->file('video')->store('videos', 'public');
        return response()->json([
            'success' => true,
            'message' => 'Video uploaded successfully',
            'data' => [
                'video_path' => asset('storage/' . $videoPath),
            ],
        ], 201);
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('resources.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'nullable|string|max:255',
            'slug' => 'required|string|unique:blogs,slug,' . $id . '|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'published' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = $request->only(['title', 'content', 'author', 'slug', 'published']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        if($data['published']):
            $data['published_at'] = now();
        else:
            $data['published_at'] = null;
        endif;

        $blog->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Resource updated successfully',
        ], 200);
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Resource deleted successfully',
        ], 200);
    }
}
