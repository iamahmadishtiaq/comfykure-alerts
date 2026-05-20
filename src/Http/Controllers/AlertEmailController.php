<?php
namespace AhmadIshtiaq\ComfykureAlerts\Http\Controllers;

use App\Http\Controllers\Controller;
use AhmadIshtiaq\ComfykureAlerts\Models\AlertEmail;
use Illuminate\Http\Request;

class AlertEmailController extends Controller {
    public function index() {
        $emails = AlertEmail::all();
        return view('comfykure::crud', compact('emails'));
    }

    public function store(Request $request) {
        $request->validate(['email' => 'required|email|unique:alert_emails']);
        AlertEmail::create($request->only('email'));
        return back()->with('success', 'Email added successfully!');
    }

    public function destroy($id) {
        AlertEmail::destroy($id);
        return back()->with('success', 'Email deleted!');
    }
}
