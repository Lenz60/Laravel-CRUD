<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Firebase\JWT\JWT;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }
    //
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/AdminLogin', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // dd($authAdmin);
        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::ADMIN);

        // // dd($request);
        // $admin = Admin::find($request->username);

        // if($admin){
        //     $data = $admin->where('username', $request->username)->get()->first();
        //     if($data){
        //         // dd($data);
        //         $payload = [
        //             'username'=>$data->username,
        //             'name' => $data->name,
        //         ];
        //         $token = JWT::encode($payload, config('app.jwt_key'),'HS256');
        //         setcookie('userData', $token);
        //     }
        //     $request->session()->regenerate();

        //     return redirect()->intended(RouteServiceProvider::ADMIN);
        // }



    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function authenticate($username, $password){
        if (! Auth::attempt($this->only('username', 'password'), $this->boolean('remember'))) {
                RateLimiter::hit($this->throttleKey());

                // throw ValidationException::withMessages([
                //     'username' => trans('auth.failed'),
                // ]);
            }
    }
}
