<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
        return view('profiles.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('password.change')->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return redirect()->route('posts.index')->with('success', 'Password updated successfully!');
    }
}
