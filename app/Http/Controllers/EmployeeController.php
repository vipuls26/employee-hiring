<?php

namespace App\Http\Controllers;

use App\Http\Requests\employee\ResumeRequest;
use App\Models\Application;
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    // fetch active job and display on employee dashbaord
    public function index()
    {
        // only active job
        $jobs = JobApplication::with('company')->where('status', 'active')->whereDoesntHave('applications', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest()->get();
        return view('employee.dashboard', compact('jobs'));
    }

    // apply for job
    public function apply($jobId)
    {
        // check if job exist or not
        JobApplication::findOrFail($jobId);

        if (Auth::user()->resume_path === null) {
            return redirect()->route('employee.dashboard')->with('error', 'Add resume before applying to job');
        }

        // add data in db
        Application::create([
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
        return view('employee.add-resume');
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

        // redirect with path link for resume
        return response()->file(
            storage_path('app/public/' . $application->resume_path)
        );
    }

    // view application status
    public function viewApplicationStatus()
    {
        $applications = Application::with('approvals')->where('user_id', Auth::id())->with('job')->latest()->get();
        return view('employee.view-application-status', compact('applications'));
    }
}
