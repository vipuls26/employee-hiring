<?php

namespace App\Http\Controllers;

use App\Http\Requests\owner\RegisterCompany;
use App\Models\Application;
use App\Models\ApplicationApproval;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()?->company?->id;

        $applications = Application::with(['job.company', 'approvals.user'])
            ->where('overall_status','manager_approved')
            ->latest()
            ->get();

        return view('owner.dashboard', compact('applications'));
    }

    public function showForm()
    {
        return view('owner.registerCompany');
    }

    public function registerCompany(RegisterCompany $request)
    {

        $ownerId = Auth::user()->id;

        $company = Company::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'description' => $request->description,
            'location' => $request->location,
            'owner_id' => $ownerId
        ]);

        if ($company) {
            return redirect()->route('owner.dashboard')->with('success', 'Company register successfully');
        }
    }

    public function decide(Request $request, Application $application)
    {
        $validated = $request->validate([
            'action' => ['required', 'in:accept,reject'],
        ]);

        if (! in_array($application->overall_status, ['manager_approved', 'manager_rejected', 'owner_approved', 'owner_rejected'], true)) {
            return redirect()->route('owner.dashboard')->with('error', 'Owner can only review applications after Manager.');
        }

        $companyId = Auth::user()?->company?->id;

        if ($companyId && $application->job?->company_id !== $companyId) {
            return redirect()->route('owner.dashboard')->with('error', 'You can only review applications for your company.');
        }

        $application->update([
            'overall_status' => $validated['action'] === 'accept' ? 'owner_approved' : 'owner_rejected',
        ]);

        ApplicationApproval::updateOrCreate(
            [
                'application_id' => $application->id,
                'role' => 'owner',
            ],
            [
                'user_id' => Auth::id(),
                'action' => $validated['action'],
            ]
        );

        return redirect()->route('owner.dashboard')->with('success', 'Owner decision saved successfully.');
    }
}
