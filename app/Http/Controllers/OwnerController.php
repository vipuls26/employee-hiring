<?php

namespace App\Http\Controllers;

use App\Http\Requests\Owner\RegisterCompany;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index()
    {
        return view('owner.dashboard');
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
            return redirect(route('owner.dashboard'));
        }
    }
}
