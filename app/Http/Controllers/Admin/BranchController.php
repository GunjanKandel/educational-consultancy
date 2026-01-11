<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        // Show branches ordered by 'order' instead of latest
        $branches = Branch::orderBy('order')->paginate(10);
        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'map_url' => 'nullable|url',
            'is_main' => 'boolean',
            'is_active' => 'boolean',
        ]);

        // Shift existing branches if order conflicts
        Branch::where('order', '>=', $validated['order'])->increment('order');

        Branch::create($validated);

        return redirect()->route('admin.branches.index')
            ->with('success', 'Branch added successfully!');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $validated = $request->validate([
            'order' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'map_url' => 'nullable|url',
            'is_main' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $oldOrder = $branch->order;
        $newOrder = $validated['order'];

        if ($oldOrder != $newOrder) {
            if ($newOrder < $oldOrder) {
                // Move up: increase order of branches between new and old
                Branch::whereBetween('order', [$newOrder, $oldOrder - 1])
                      ->increment('order');
            } else {
                // Move down: decrease order of branches between old and new
                Branch::whereBetween('order', [$oldOrder + 1, $newOrder])
                      ->decrement('order');
            }
        }

        $branch->update($validated);

        return redirect()->route('admin.branches.index')
            ->with('success', 'Branch updated successfully!');
    }

    public function destroy(Branch $branch)
    {
        // Only Admin can delete
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Only Admins can delete courses.');
        }

        $branch->delete();

        return redirect()->route('admin.branches.index')
            ->with('success', 'Branch deleted successfully!');
    }
}
