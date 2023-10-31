<?php

namespace App\Http\Controllers\Auth;

use Rules\Password;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'name' => 'required|string|max:255',
            'password' => 'required|confirmed|min:5',
            'avatar' => 'image|file|max:1024'

        ]);

        // $image = $request->avatar;

        // dd($request->file('avatar'));
        // ddd($request);

        // $data = [
        //     'email' => $request->email,
        //     'ktp' => $request->ktp,
        //     'name' => $request->name,
        //     'password' => Hash::make($request->password),
        //     'telephone' => $request->telephone,
        //     'birth' => $request->birth,
        //     'gender' => $request->gender,
        //     'avatar' => $request->file('avatar')->store('avatar'),
        // ];
        // // dd($data);

        $user = User::create([
            'email' => $request->email,
            'ktp' => $request->ktp,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'birth' => $request->birth,
            'gender' => $request->gender,
            'avatar' => $request->file('avatar')->store('avatar'),
        ]);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
