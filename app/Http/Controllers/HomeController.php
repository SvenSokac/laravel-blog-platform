<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Reaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('reactions')->orderBy('published_date', 'desc')->get();
        return view('home', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::with('reactions')->findOrFail($id);
        return view('blog-details', compact('blog'));
    }

    public function addReaction(Request $request, $blogId)
    {
        $blog = Blog::findOrFail($blogId);
        $emoji = $request->input('emoji');

        $reaction = Reaction::firstOrCreate(
            ['blog_id' => $blogId, 'emoji' => $emoji],
            ['count' => 0]
        );

        $reaction->increment('count');

        return response()->json([
            'success' => true,
            'count' => $reaction->count,
            'emoji' => $emoji,
        ]);
    }
}
