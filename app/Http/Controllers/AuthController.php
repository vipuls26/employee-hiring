<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function create(RegisterRequest $request)
    {

        $role = Role::where('role', $request->role)->first();

        // dd($role);

        if (!$role) {
            return redirect()->route('auth.register')->with('message', 'add role in db first');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $role->id,

        ]);

        return redirect()->route('auth.login')->with('message', 'register successfully');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            $roleName = $user->role->role;

            if ($roleName === 'Owner') {
                return redirect()->intended('owner/dashboard');
            }
            if ($roleName === 'Manager') {
                return redirect()->intended('/manager/dashboard');
            }
            if ($roleName === 'HR') {
                return redirect()->intended('/hr/dashboard');
            }

            return redirect()->intended('/employee/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
