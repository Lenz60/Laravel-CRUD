<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

class ManageController extends Controller
{
    //

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        // dd($request->user());

        $user = User::all();
        $user->except('password');
        foreach($user as $users){
            $data[] = $users->toArray();
        }
        // $string = 'stering';
        // dd($data);
        // dd($user);
        return inertia('Manage/Manage', compact('data'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        // dd($request->file());


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }



        $request->user()->save();

        return Redirect::route('profile.edit');
    }
    /**
     * Update the user's profile information.
     */
    public function updateAvatar(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());
        // dd($request->file('avatar'));

        $newAvatar = $request->file('avatar')->store('avatar');

        // dd($newAvatar);
        // dd($request->user()->id);

        $user = User::find($request->user()->id);
        $user->avatar = $newAvatar;
        $user->update();

        // dd($request->user()->avatar($newAvatar));
        // $request
        // $request->user()->avatar()->save($newAvatar);
        // $request->user()->save();

        return redirect()->to('profile');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
