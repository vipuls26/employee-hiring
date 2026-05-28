<?php

namespace App\Http\Controllers;

use App\Http\Requests\hr\AddJobRequest;
use App\Http\Requests\hr\EditJobRequest;
use App\Mail\SendMail;
use App\Models\Application;
use App\Models\ApplicationApproval;
use App\Models\Company;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HRController extends Controller
{
    public function index()
    {
        $applications = Application::with(['job.company', 'approvals.user'])->where('overall_status', 'pending')->latest()->get();
        return view('hr.dashboard', compact('applications'));
    }

    public function show()
    {
        return view('hr.addJob');
    }

    public function create(AddJobRequest $request)
    {
        $company = Auth::user()?->company ?? Company::query()->first();

        if (! $company) {
            return redirect()->route('hr.showForm')->with('error', 'Please register a company before adding a job.');
        }

        $validated = $request->validated();

        $job = JobApplication::create([
            'name' => $validated['name'],
            'salary' => $validated['salary'],
            'type' => $validated['type'],
            'company_id' => $company->id,
        ]);

        if ($job) {
            return redirect()->route('hr.dashboard')->with('success', 'Job added successfully.');
        }

        return redirect()->route('hr.showForm')->with('error', 'Job not added');
    }

    public function decide(Request $request, Application $application)
    {
        $validated = $request->validate([
            'action' => ['required', 'in:accept,reject'],
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validated['action'] === 'reject' && blank($validated['reason'] ?? null)) {
            return redirect()->route('hr.dashboard')->with('error', 'Rejection reason is required.');
        }

        $application->update([
            'overall_status' => $validated['action'] === 'accept' ? 'hr_approved' : 'hr_rejected',
        ]);

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

        Mail::to($application->employee_email)->send(new SendMail(
            application: $application,
            stage: 'hr',
            action: $validated['action'],
            reason: $validated['reason'] ?? null,
            reviewerName: Auth::user()?->name ?? 'HR',
        ));

        return redirect()->route('hr.dashboard')->with('success', 'HR decision saved successfully.');
    }

    public function jobList()
    {
        $jobs = JobApplication::with('company')->latest()->get();
        return view('hr.joblist', compact('jobs'));
    }

    public function edit(JobApplication $job)
    {

        return view('hr.editJob', compact('job'));
    }

    public function update(EditJobRequest $request, JobApplication $job)
    {
        $validated = $request->validated();
        
        $job->update([
            'name' => $validated['name'],
            'salary' => $validated['salary'],
            'type' => $validated['type'],
            'status' => $validated['status']
        ]);

        return redirect()->route('hr.jobList')->with('success', 'Job updated successfully.');
    }

    public function destroy(JobApplication $job)
    {
        if ($job->applications()->exists()) {
            return redirect()->route('hr.jobList')->with('error', 'You cannot delete a job that already has applications.');
        }

        $job->delete();

        return redirect()->route('hr.jobList')->with('success', 'Job deleted successfully.');
    }
}
