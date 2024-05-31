<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('profile.edit', [
            'user' => $user,
            'resume_cv_file_path' => $user->resume_cv_file_path, // Pass the file path
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user(); // Defined the user variable
        $user->fill($request->validated());

        if ($request->hasFile('resume_cv_file_path')) {
            $path = $request->file('resume_cv_file_path')->store('resumes', 'public');
            $user->resume_cv_file_path = $path; // Use the user variable to assign the file path
        }

        if ($user->isDirty('email')) { // Use the user variable to check for email changes
            $user->email_verified_at = null;
        }

        $user->save(); // Use the user variable to save the changes

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}


// now I can save the file but I cannot see it as the page said no file chosen on front view I want to see it and also want to able to download it
