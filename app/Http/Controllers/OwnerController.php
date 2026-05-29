<?php

namespace App\Http\Controllers;

use App\Http\Requests\job\ApproveRejectRequest;
use App\Http\Requests\owner\RegisterCompany;
use App\Mail\SendMail;
use App\Models\Application;
use App\Models\ApplicationApproval;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OwnerController extends Controller
{
    // show apllication approve by manager
    public function index()
    {
        $applications = Application::where('overall_status', 'manager_approved')->latest()->get();
        return view('owner.dashboard', compact('applications'));
    }

    // show company register form
    public function showForm()
    {
        return view('owner.register-company');
    }

    // add company to db
    public function registerCompany(RegisterCompany $request)
    {
        // fetch user id
        $ownerId = Auth::user()->id;
        // add data to table
        $company = Company::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'description' => $request->description,
            'location' => $request->location,
            'owner_id' => $ownerId
        ]);

        // redirect to dashboard
        if ($company) {
            return redirect()->route('owner.dashboard')->with('success', 'Company register successfully');
        }
    }

    // approve/reject for employee application review by manager
    public function decide(ApproveRejectRequest $request, Application $application)
    {
        // validation check
        $validated = $request->validated();

        // check for rejection reason
        if ($validated['action'] === 'reject' && blank($validated['reason'] ?? null)) {
            return redirect()->route('owner.dashboard')->with('error', 'Rejection reason is required.');
        }

        // update application status
        $application->update([
            'overall_status' => $validated['action'] === 'accept' ? 'owner_approved' : 'owner_rejected',
        ]);

        // add data in application approval table
        ApplicationApproval::updateOrCreate(
            [
                'application_id' => $application->id,
                'role' => 'owner',
            ],
            [
                'user_id' => Auth::id(),
                'action' => $validated['action'],
                'reason' => $validated['reason'] ?? null,
            ]
        );

        // send email
        Mail::to($application->employee_email)->send(new SendMail(
            application: $application,
            stage: 'owner',
            action: $validated['action'],
            reason: $validated['reason'] ?? null,
            reviewerName: Auth::user()?->name ?? 'Owner',
        ));

        // redirect to dashboard
        return redirect()->route('owner.dashboard')->with('success', 'Application status updated.');
    }
}
