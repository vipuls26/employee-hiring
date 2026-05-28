<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function show()
    {
        $applications = Application::with(['job.company', 'approvals.user'])
            ->whereIn('overall_status', ['hr_approved', 'hr_rejected', 'manager_approved', 'manager_rejected'])
            ->orderByRaw("CASE WHEN overall_status IN ('hr_approved', 'hr_rejected') THEN 0 ELSE 1 END")
            ->latest()
            ->get();

        return view('manager.dashboard', compact('applications'));
    }

    public function decide(Request $request, Application $application)
    {
        $validated = $request->validate([
            'action' => ['required', 'in:accept,reject'],
        ]);

        if (! in_array($application->overall_status, ['hr_approved', 'hr_rejected', 'manager_approved', 'manager_rejected'], true)) {
            return redirect()->route('manager.dashboard')->with('error', 'Manager can only review applications after HR.');
        }

        $application->update([
            'overall_status' => $validated['action'] === 'accept' ? 'manager_approved' : 'manager_rejected',
        ]);

        ApplicationApproval::updateOrCreate(
            [
                'application_id' => $application->id,
                'role' => 'manager',
            ],
            [
                'user_id' => Auth::id(),
                'action' => $validated['action'],
            ]
        );

        return redirect()->route('manager.dashboard')->with('success', 'Manager decision saved successfully.');
    }
}
