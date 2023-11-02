<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Admin;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

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
        return inertia('Admin/Manage', compact('data'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // $request->user()->fill($request->validated());
        // dd($request->all());
        $user = User::find($request->id);

        if ($user) {
            $user->update($request->only(['name', 'email', 'ktp', 'telephone', 'gender', 'birth']));
        }

        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->ktp = $request->ktp;
        // $user->telephone = $request->telephone;
        // $user->gender = $request->gender;
        // $user->birth = $request->birth;

        // $user->save();

        return Redirect::route('manage.edit');
    }

    public function addMember(Request $request){

        // dd($request->all());
        $request->validate([
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'name' => 'required|string|max:255',
            'password' => 'required|confirmed|min:5',
            'avatar' => 'image|file|max:1024'

        ]);

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

        return Redirect::route('manage.edit');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // dd($request->all());
        $user = User::find($request->id);

        if($user){
            $user->delete();
        }
        return Redirect::route('manage.edit');
    }

    public function addAdminView(){

        $user = Admin::all();
        $user->except('password');
        foreach($user as $users){
            $data[] = $users->toArray();
        }
        return inertia('Admin/Add', compact('data'));
    }

    public function addAdmin(Request $request){
        // dd($request->all());

        $request->validate([
            'username' => 'required|string|unique:'.Admin::class,
            'name' => 'required|string|max:255',
            'password' => 'required|min:5',

        ]);

        $admin = Admin::create([
                    'username' => $request->username,
                    'name' => $request->name,
                    'password' => Hash::make($request->password)
                ]);
        $admin->fill($request->validated());


        // dd($admin);
    }

    public function jsonMember(){
        $user = User::all();
        $user->except('password');
        foreach($user as $users){
            $data[] = $users->toArray();
        }
        $encodedJson = json_encode($data);
        // dd($encodedJson);
        return inertia('Admin/MemberJson', compact('encodedJson'));

    }


}
