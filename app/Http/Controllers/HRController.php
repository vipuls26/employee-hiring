<?php

namespace App\Http\Controllers;

use App\Http\Requests\hr\AddJob;
use App\Models\Application;
use App\Models\ApplicationApproval;
use App\Models\Company;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HRController extends Controller
{
    public function index()
    {
        $applications = Application::with(['job.company', 'approvals.user'])->where('overall_status','pending')->latest()->get();
        return view('hr.dashboard', compact('applications'));
    }

    public function show()
    {
        return view('hr.addJob');
    }

    public function create(AddJob $request)
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
        ]);

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
            ]
        );

        return redirect()->route('hr.dashboard')->with('success', 'HR decision saved successfully.');
    }
}
