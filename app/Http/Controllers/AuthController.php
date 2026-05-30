<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // show register form
    public function register()
    {
        // fetch company where hr_id is null
        $hrCompanies = Company::whereNull('hr_id')
            ->orderBy('name')
            ->get(['id', 'name']);

        // fetch company where manager_id is null
        $managerCompanies = Company::whereNull('manager_id')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('auth.register', compact('hrCompanies', 'managerCompanies'));
    }

    // register method
    public function create(RegisterRequest $request)
    {
        $validated = $request->validated();

        // fetch role from db
        $role = Role::where('role', $validated['role'])->first();
        // check if role exist in db
        if (!$role) {
            return redirect()->route('auth.register')->with('message', 'Add role in db first');
        }

        // create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role_id' => $role->id,
        ]);

        // add hr id in company table by finding company id
        if ($validated['role'] === 'HR') {
            Company::findOrFail($validated['company_id'])
                ->update([
                    'hr_id' => $user->id,
                ]);
        }

        // add manager id in company table by finding company id
        if ($validated['role'] === 'Manager') {
            Company::findOrFail($validated['company_id'])
                ->update([
                    'manager_id' => $user->id,
                ]);
        }

        // redirect to login page
        return redirect()->route('auth.login')->with('success', 'register successfully');
    }

    // show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // login
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            // generate session
            $request->session()->regenerate();
            // authenicate user
            $user = Auth::user();
            // fetch user role
            $roleName = $user->role->role;

            // redirect based on role
            if ($roleName === 'Owner') {
                return redirect()->intended('owner/dashboard')->with('success', 'welcome to dashboard');
            }
            if ($roleName === 'Manager') {
                return redirect()->intended('/manager/dashboard')->with('success', 'welcome to dashboard');
            }
            if ($roleName === 'HR') {
                return redirect()->intended('/hr/dashboard')->with('success', 'welcome to dashboard');
            }

            return redirect()->intended('/employee/dashboard')->with('success', 'welcome to dashboard');
        }

        // if email not found then redirect to with msg
        return back()->withErrors([
            'email' => 'Credentials provided do not match',
        ])->onlyInput('email');
    }

    // logout
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
