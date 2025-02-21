<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show()
    {
        return view('auth.profile');
    }

    public function update(ProfileUpdateRequest $request)
    {
        // Task: fill in the code here to update name and email
        // Also, update the password if it is set

        if (auth()->check()) {
            $loggedUser = auth()->user();
            $profileInfo = $request->validated();

            if (isset($profileInfo['password'])) $profileInfo['password'] = bcrypt($profileInfo['password']);

            $loggedUser->update($profileInfo);
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
