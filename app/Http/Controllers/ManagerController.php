<?php

namespace App\Http\Controllers;

use App\Http\Requests\job\ApproveRejectRequest;
use App\Mail\SendMail;
use App\Models\Application;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ManagerController extends Controller
{
    // show apllication approve by hr
    public function show()
    {
        // find company id for login user
        $companyId = Company::where('manager_id', Auth::id())->value('id');

        // fetch application with belong this manager and approved by hr
        $applications = Application::with('job.company')
            ->where('overall_status', 'hr_approved')
            ->whereRelation('job', 'company_id', $companyId)
            ->latest()
            ->get();

        return view('manager.dashboard', compact('applications'));
    }

    // approve/reject for employee application review by hr
    public function applicationStatus(ApproveRejectRequest $request, Application $application)
    {
        // validation check
        $validated = $request->validated();

        // check for rejection reason
        if ($validated['action'] === 'reject' && blank($validated['reason'] ?? null)) {
            return redirect()->route('manager.dashboard')->with('error', 'Rejection reason is required.');
        }
        // update application status
        $application->update([
            'overall_status' => $validated['action'] === 'accept' ? 'manager_approved' : 'manager_rejected',
            'reject_reason' => $validated['action'] === 'reject' ? $validated['reason'] : null,
        ]);

        // send email
        Mail::to($application->employee_email)->send(new SendMail(
            application: $application,
            stage: 'manager',
            action: $validated['action'],
            reason: $validated['reason'] ?? null,
            reviewerName: Auth::user()?->name ?? 'Manager',
        ));
        // redirect to dashboard
        return redirect()->route('manager.dashboard')->with('success', 'Application status updated.');
    }
}
