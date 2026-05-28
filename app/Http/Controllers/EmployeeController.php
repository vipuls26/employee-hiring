<?php

namespace App\Http\Controllers;

use App\Http\Requests\employee\ResumeRequest;
use App\Models\Application;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        // only active job 
        $jobs = JobApplication::where('status','active')->get();
        return view('employee.dashboard', compact('jobs'));
    }

    public function apply(Request $request, $jobId)
    {
        $job = JobApplication::findOrFail($jobId);

        $jobApplication = Application::create([
            'employee_name' => Auth::user()->name,
            'employee_email' => Auth::user()->email,
            'job_id' => $jobId,
            'user_id' => Auth::id(),
            'resume_path' => Auth::user()->resume_path,
        ]);

        return redirect()->route('employee.dashboard')->with('success', 'Apply for this job successfully');
    }

    public function addResumeForm()
    {
        return view('employee.addResume');
    }

    public function storeResume(ResumeRequest $request)
    {
        $request->validated();

        $resumePath = $request->file('resume')->store('resumes', 'public');

        $user = Auth::user();
        $user->resume_path = $resumePath;
        $user->save();

        return redirect()->route('employee.dashboard')->with('success', 'Resume uploaded successfully');
    }

    public function viewResume()
    {
        $user = Auth::user();
        $resumePath = $user->resume_path;

        if (!$resumePath) {
            return redirect()->route('employee.dashboard')->with('error', 'No resume found');
        }

        return response()->file(storage_path('app/public/' . $resumePath));
    }
}
