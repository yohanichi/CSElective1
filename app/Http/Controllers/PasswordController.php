<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * Show the change password form
     */
    public function edit()
    {
        return view('password.edit');
    }

    /**
     * Update the user's password
     */
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        // Update password with updated_on and updated_by tracking
        $user->update([
            'password' => Hash::make($request->new_password),
            'updated_on' => now(),
            'updated_by' => $user->id,
        ]);

        return redirect()->route('home')
            ->with('success', 'Password changed successfully!');
    }
}
