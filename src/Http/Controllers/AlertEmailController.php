<?php

namespace AhmadIshtiaq\ComfykureAlerts\Http\Controllers;

use App\Http\Controllers\Controller;
use AhmadIshtiaq\ComfykureAlerts\Models\AlertEmail;
use Illuminate\Http\Request;

class AlertEmailController extends Controller
{
    public function index()
    {
        $emails = AlertEmail::latest()->get();
        return view('comfykure::index', compact('emails'));
    }

    public function create()
    {
        return view('comfykure::create');
    }

    // 🔴 1. STORE FUNCTION WITH FAMOUS DOMAIN VALIDATION
    public function store(Request $request)
    {
        // Famous domains ki list
        $allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];

        $request->validate([
            'email' => [
                'required',
                'email',
                'unique:alert_emails,email',
                // Custom rule domain check karne ke liye
                function ($attribute, $value, $fail) use ($allowedDomains) {
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array(strtolower($domain), $allowedDomains)) {
                        $fail('🚨 Only famous email domains (gmail.com, yahoo.com, outlook.com, hotmail.com) are allowed!');
                    }
                },
            ],
        ], [
            'email.unique' => '🚨 This developer email is already registered in ComfyKure Alerts!'
        ]);

        AlertEmail::create([
            'email' => $request->email,
            'is_active' => true
        ]);

        return redirect('comfykure-alerts/emails')->with('success', 'Node added successfully!');
    }

    public function edit($id)
    {
        $email = AlertEmail::findOrFail($id);
        return view('comfykure::edit', compact('email'));
    }

    // 🔴 2. UPDATE FUNCTION WITH FAMOUS DOMAIN VALIDATION
    public function update(Request $request, $id)
    {
        $allowedDomains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];

        $request->validate([
            'email' => [
                'required',
                'email',
                'unique:alert_emails,email,' . $id,
                function ($attribute, $value, $fail) use ($allowedDomains) {
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array(strtolower($domain), $allowedDomains)) {
                        $fail('🚨 Only famous email domains (gmail.com, yahoo.com, outlook.com, hotmail.com) are allowed!');
                    }
                },
            ],
        ], [
            'email.unique' => '🚨 Cannot update: This email is already taken by another node!'
        ]);

        $email = AlertEmail::findOrFail($id);
        $email->update([
            'email' => $request->email
        ]);

        return redirect('comfykure-alerts/emails')->with('success', 'Node updated successfully!');
    }

    public function destroy($id)
    {
        $email = AlertEmail::findOrFail($id);
        $email->delete();

        return back()->with('success', 'Node removed successfully!');
    }
}