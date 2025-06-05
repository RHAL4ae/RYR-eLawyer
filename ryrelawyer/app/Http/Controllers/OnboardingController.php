<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OnboardingController extends Controller
{
    public function create()
    {
        return view('onboarding.register');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'domain' => 'required|unique:tenants,domain',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ])->validate();

        $tenant = Tenant::create([
            'name' => $request->name,
            'domain' => $request->domain,
            'logo' => $request->logo,
            'data' => ['admin_email' => $request->email],
        ]);

        // Create tenant admin user in central DB
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('onboarding.success');
    }

    public function success()
    {
        return view('onboarding.success');
    }
}
