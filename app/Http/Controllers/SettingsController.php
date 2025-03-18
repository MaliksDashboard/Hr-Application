<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function showSettings()
    {
        return view('settings');
    }

    public function updateSettings(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'third_color' => 'required|string',
            'font' => 'required|string',
        ]);

        // Store the settings in the session
        session([
            'third_color' => $request->third_color,
            'font' => $request->font,
        ]);

        // Send success response
        return back()->with('success', 'Settings updated successfully.');
    }

    public function resetSettings()
    {
        // Reset session values to default
        session([
            'third_color' => '#ff5733', // Default third color
            'font' => 'Play', // Default font
        ]);

        // Redirect back with a success message
        return redirect()->route('settings')->with('success', 'Settings reset to default.');
    }
}
