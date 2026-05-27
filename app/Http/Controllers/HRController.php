<?php

namespace App\Http\Controllers;

use App\Http\Requests\Hr\AddJob;
use App\Models\Company;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class HRController extends Controller
{
    public function index()
    {
        return view('hr.dashboard');
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

        return redirect()->route('hr.showForm')->with('error', 'Unable to add job right now.');
    }
}
