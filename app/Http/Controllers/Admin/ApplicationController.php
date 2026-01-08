<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ApplicationStatusMail;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['course', 'country'])
            ->latest()
            ->paginate(15);
        
        return view('admin.applications.index', compact('applications'));
    }

    public function show(Application $application)
    {
        $application->load(['course', 'country']);
        return view('admin.applications.show', compact('application'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewing,approved,rejected,document_required',
            'admin_notes' => 'nullable|string',
        ]);

        $application->update($validated);

        // Send email notification
        try {
            Mail::to($application->email)->send(new ApplicationStatusMail($application));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('warning', 'Status updated but email could not be sent.');
        }

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application status updated successfully!');
    }

    public function destroy(Application $application)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Only Admins can delete courses.');
        }

        $application->delete();

        return redirect()->route('admin.applications.index')
            ->with('success', 'Application deleted successfully!');
    }

    public function exportExcel()
    {
        $applications = Application::with(['course', 'country'])->get();
        
        // You'll need to install maatwebsite/excel package
        // composer require maatwebsite/excel
        
        return response()->json(['message' => 'Export functionality to be implemented']);
    }
}
