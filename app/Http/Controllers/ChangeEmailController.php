<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChangeEmailController extends Controller
{
    public function showChangeEmailForm()
    {
        return view('profiles.change-email');
    }

    public function changeEmail(Request $request)
    {
        $request->validate([
            'new_email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->user()->id),
            ],
        ]);

        $user = auth()->user();
        $user->update([
            'email' => $request->new_email,
        ]);

        return redirect()->route('posts.index')->with('success', 'Email updated successfully!');
    }
}
