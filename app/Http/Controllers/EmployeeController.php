<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $jobs = JobApplication::all();
        return view('employee.dashboard', compact('jobs'));
    }

    public function apply(Request $request, $jobId)
    {
        $job_detail = JobApplication::findOr($jobId);

        $jobApplication = Application::create([
            'employee_name' => Auth::user()->name,
            'employee_email' => Auth::user()->email,
            'job_id' => $jobId,
            'user_id' => Auth::id(),
            'resume_path' => Auth::user()->resume,

        ]);

        return redirect()->route('employee.dashboard')->with('success', 'Apply for this job successfully');
    }

    public function addResumeForm()
    {
        return view('employee.addResume');
    }

    public function storeResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $resumePath = $request->file('resume')->store('resumes', 'public');

        $user = Auth::user();
        $user->resume = $resumePath;
        $user->save();

        return redirect()->route('employee.dashboard')->with('success', 'Resume uploaded successfully');
    }
}
