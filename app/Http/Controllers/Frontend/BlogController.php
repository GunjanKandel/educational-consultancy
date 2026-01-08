<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::where('is_published', true);

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $blogs = $query->latest('published_at')->paginate(9)->withQueryString();

        $categories = Blog::where('is_published', true)
            ->select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category');

        $recent_posts = Blog::where('is_published', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('frontend.blogs.index', compact('blogs', 'categories', 'recent_posts'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('is_published', true)
            ->with('user')
            ->firstOrFail();

        // Increment views
        $blog->incrementViews();

        // Get related posts
        $related_posts = Blog::where('category', $blog->category)
            ->where('id', '!=', $blog->id)
            ->where('is_published', true)
            ->take(3)
            ->get();

        return view('frontend.blogs.show', compact('blog', 'related_posts'));
    }
}