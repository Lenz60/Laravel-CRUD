<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class AdminProfileController extends Controller
{
    //

     /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        // dd($request->user());
        return Inertia::render('Profile/Admin/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());
        // dd($request->file());



        $request->user()->save();

        return Redirect::route('admin.profile.edit');
    }
}
