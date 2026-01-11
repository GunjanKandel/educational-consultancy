<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutTopic;
use Illuminate\Http\Request;

class AboutTopicController extends Controller
{
    public function index()
    {
        $topics = AboutTopic::orderBy('order', 'asc')->get(); // order by 'order'
        return view('admin.about_topics.index', compact('topics'));
    }

    public function create()
    {
        return view('admin.about_topics.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        // Fix checkbox & order
        $data['is_active'] = $request->has('is_active') ? 1 : 0; // 1 if checked, 0 if not
        $data['order'] = (int) $request->input('order', 0);

        AboutTopic::create($data);

        return redirect()->route('admin.about-topics.index')
            ->with('success', 'Topic added successfully.');
    }

    public function edit(AboutTopic $aboutTopic)
    {
        return view('admin.about_topics.edit', compact('aboutTopic'));
    }

    public function update(Request $request, AboutTopic $aboutTopic)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        // Fix checkbox & order
        $data['is_active'] = $request->has('is_active') ? 1 : 0; // 1 if checked, 0 if not
        $data['order'] = (int) $request->input('order', 0);

        $aboutTopic->update($data);

        return redirect()->route('admin.about-topics.index')
            ->with('success', 'Topic updated successfully.');
    }

    public function destroy(AboutTopic $aboutTopic)
    {
        $aboutTopic->delete();

        return redirect()->route('admin.about-topics.index')
            ->with('success', 'Topic deleted successfully.');
    }
}
