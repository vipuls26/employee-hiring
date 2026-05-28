<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Application;
use App\Models\ApplicationApproval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ManagerController extends Controller
{
    public function show()
    {
        $applications = Application::with(['job.company', 'approvals.user'])
            ->where('overall_status','hr_approved')->latest()->get();

        return view('manager.dashboard', compact('applications'));
    }

    public function decide(Request $request, Application $application)
    {
        $validated = $request->validate([
            'action' => ['required', 'in:accept,reject'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validated['action'] === 'reject' && blank($validated['reason'] ?? null)) {
            return redirect()->route('manager.dashboard')->with('error', 'Rejection reason is required.');
        }

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
                'reason' => $validated['reason'] ?? null,
            ]
        );

        $application->loadMissing('job.company');

        Mail::to($application->employee_email)->send(new SendMail(
            application: $application,
            stage: 'manager',
            action: $validated['action'],
            reason: $validated['reason'] ?? null,
            reviewerName: Auth::user()?->name ?? 'Manager',
        ));

        return redirect()->route('manager.dashboard')->with('success', 'Manager decision saved successfully.');
    }
}
