<?php

namespace App\Http\Controllers;

use App\Http\Requests\employee\ResumeRequest;
use App\Models\Application;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // fetch active job and display on employee dashbaord
    public function index()
    {
        // only active job
        // $jobs = JobApplication::where('status','active')->get();
        $jobs = JobApplication::with('company')->where('status','active')->get();
        return view('employee.dashboard', compact('jobs'));
    }

    // apply for job
    public function apply(Request $request, $jobId)
    {
        // check if job exist or not
        $job = JobApplication::findOrFail($jobId);

        // add data in db
        $jobApplication = Application::create([
            'employee_name' => Auth::user()->name,
            'employee_email' => Auth::user()->email,
            'job_id' => $jobId,
            'user_id' => Auth::id(),
            'resume_path' => Auth::user()->resume_path,
        ]);

        // redirect to dashboard
        return redirect()->route('employee.dashboard')->with('success', 'Apply for this job successfully');
    }

    // show resume upload form
    public function addResumeForm()
    {
        return view('employee.addResume');
    }

    // store resume in db
    public function storeResume(ResumeRequest $request)
    {
        // validate resume
        $request->validated();

        // store resume with path
        $resumePath = $request->file('resume')->store('resumes', 'public');

        // find user detail
        $user = Auth::user();

        // save resume path in user table
        $user->resume_path = $resumePath;
        $user->save();

        // redirect user to dashboard after successfully resume upload
        return redirect()->route('employee.dashboard')->with('success', 'Resume uploaded successfully');
    }

    // view resume
    public function viewResume()
    {
        // fetch user detail
        $user = Auth::user();
        // fetch path for resume
        $resumePath = $user->resume_path;

        // check if path exist
        if (!$resumePath) {
            return redirect()->route('employee.dashboard')->with('error', 'No resume found');
        }

        // redirect to resume in new tab
        return response()->file(storage_path('app/public/' . $resumePath));
    }

    // view applicate resume by hr, manager, owner
    public function viewApplicationResume(Application $application)
    {
        // check if resume exist in db
        if (!$application->resume_path) {
            return back()->with('error', 'No resume found for this application.');
        }

        // check if file present in exist in storage
        if (!Storage::disk('public')->exists($application->resume_path)) {
            return back()->with('error', 'Resume file could not be found.');
        }

        // redirect with path link for resume
        return response()->file(
            storage_path('app/public/' . $application->resume_path)
        );
    }
}
