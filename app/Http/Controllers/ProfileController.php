<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Events\ProfileUpdated;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the authenticated user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();

        return view('auth.edit', compact('user'));
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        // Authorize the update action
        $this->authorize('update', $user);

        // Retrieve validated data
        $validatedData = $request->validated();

        // Track original data before update
        $originalData = $user->only(['name', 'sensitive_data', 'profile_photo']);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new profile photo
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $validatedData['profile_photo'] = $path;
        }

        // Update user data
        $user->update($validatedData);

        // Determine what changed
        $changedData = $user->only(['name', 'sensitive_data', 'profile_photo']);
        $changes = array_diff_assoc($changedData, $originalData);

        // Dispatch the ProfileUpdated event
        event(new ProfileUpdated($user, $changes));

        // Redirect back with success message
        return redirect()->back()->with('status', 'Profile updated successfully!');
    }
}
