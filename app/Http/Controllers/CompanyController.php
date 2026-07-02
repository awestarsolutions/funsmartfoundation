<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('user')->get();
        return view('admin.companies.index', compact('companies'));
    }

    public function create()
    {
        $users = User::role('Corporate Client')->get();
        return view('admin.companies.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'primary_poc_name' => 'nullable|string|max:255',
            'poc_email' => 'nullable|email|max:255',
            'poc_phone' => 'nullable|string|max:20',
            'status' => 'nullable',
            'user_id' => 'nullable|exists:users,id',
            'logo' => 'nullable|image|max:2048'
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('Companies/Logos', 'public');
        }

        Company::create($data);
        return redirect()->route('companies.index')->with('success', 'Created successfully.');
    }

    public function edit(Company $company)
    {
        $users = User::role('Corporate Client')->get();
        return view('admin.companies.edit', ['item' => $company, 'users' => $users]);
    }

    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'primary_poc_name' => 'nullable|string|max:255',
            'poc_email' => 'nullable|email|max:255',
            'poc_phone' => 'nullable|string|max:20',
            'status' => 'nullable',
            'user_id' => 'nullable|exists:users,id',
            'logo' => 'nullable|image|max:2048'
        ]);

        $data['status'] = $request->has('status');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('Companies/Logos', 'public');
        }

        $company->update($data);
        return redirect()->route('companies.index')->with('success', 'Updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Deleted successfully.');
    }
}
