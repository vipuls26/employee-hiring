<?php

namespace App\Http\Controllers;

use App\Http\Requests\job\AddJobRequest;
use App\Http\Requests\job\ApproveRejectRequest;
use App\Http\Requests\job\EditJobRequest;
use App\Mail\SendMail;
use App\Models\Application;
use App\Models\ApplicationApproval;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HRController extends Controller
{
    // show application with pending status
    public function index()
    {
        $applications = Application::with(['job.company', 'approvals.user'])->where('overall_status', 'pending')->latest()->get();
        return view('hr.dashboard', compact('applications'));
    }

    // show add job form
    public function show()
    {
        return view('hr.addJob');
    }

    // add job detail in db
    public function create(AddJobRequest $request)
    {
        // validation check
        $validated = $request->validated();

        // add job to db
        $job = JobApplication::create([
            'name' => $validated['name'],
            'salary' => $validated['salary'],
            'type' => $validated['type'],
            'company_id' => 1,   // currently hardcode for one company
        ]);
        // redirect to dashboard
        if ($job) {
            return redirect()->route('hr.dashboard')->with('success', 'Job added successfully.');
        }

        return redirect()->route('hr.showForm')->with('error', 'Job not added');
    }

    // job list
    public function jobList()
    {
        $jobs = JobApplication::with('company')->latest()->get();
        return view('hr.joblist', compact('jobs'));
    }

    // show job detail update form
    public function edit(JobApplication $job)
    {
        return view('hr.editJob', compact('job'));
    }

    // update job detial
    public function update(EditJobRequest $request, JobApplication $job)
    {
        // validation check
        $validated = $request->validated();

        // update job detail
        $job->update([
            'name' => $validated['name'],
            'salary' => $validated['salary'],
            'type' => $validated['type'],
            'status' => $validated['status']
        ]);

        // redirect to dashboard
        return redirect()->route('hr.jobList')->with('success', 'Job updated successfully.');
    }

    // delete job
    public function destroy(JobApplication $job)
    {
        // check of any application before deleting job post
        if ($job->applications()->exists()) {
            return redirect()->route('hr.jobList')->with('error', 'You cannot delete a job that already has applications.');
        }

        $job->delete();

        return redirect()->route('hr.jobList')->with('success', 'Job deleted successfully.');
    }

    // approve/reject for employee application
    public function decide(ApproveRejectRequest $request, Application $application)
    {
        // validation check
        $validated = $request->validated();

        // check for rejection reason
        if ($validated['action'] === 'reject' && blank($validated['reason'] ?? null)) {
            return redirect()->route('hr.dashboard')->with('error', 'Rejection reason is required.');
        }

        // update application status
        $application->update([
            'overall_status' => $validated['action'] === 'accept' ? 'hr_approved' : 'hr_rejected',
        ]);

        // add data in application approval table
        ApplicationApproval::updateOrCreate(
            [
                'application_id' => $application->id,
                'role' => 'hr',
            ],
            [
                'user_id' => Auth::id(),
                'action' => $validated['action'],
                'reason' => $validated['reason'] ?? null,
            ]
        );

        $application->loadMissing('job.company');

        // send email
        Mail::to($application->employee_email)->send(new SendMail(
            application: $application,
            stage: 'hr',
            action: $validated['action'],
            reason: $validated['reason'] ?? null,
            reviewerName: Auth::user()?->name ?? 'HR',
        ));

        // redirect to dashboard
        return redirect()->route('hr.dashboard')->with('success', 'Application status updated.');
    }
}
