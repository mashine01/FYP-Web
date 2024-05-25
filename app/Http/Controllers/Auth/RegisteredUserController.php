<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function edit_profile(Request $request)
    {
        return view('auth.edit_profile');
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'avatar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            ],
            [
                'avatar.required' => 'Please select an image',
                'avatar.image' => 'Please select an image',
                'avatar.mimes' => 'Please select a jpeg or jpg image',
                'avatar.max' => 'Please select an image less than 2MB',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->hasFile('avatar')) {
            $oldAvatarPath = $request->user()->avatar;

            // Check if the user has an existing avatar and delete it
            if ($oldAvatarPath && file_exists(public_path($oldAvatarPath))) {
                if (basename($oldAvatarPath) !== 'user.png') {
                    unlink(public_path($oldAvatarPath));
                }
            }
            $avatar = $request->file('avatar');
            $avatarName = $request->user()->email . '.' . $avatar->getClientOriginalExtension();
            $customPath = '/images/avatars/';
            $avatar->move(public_path($customPath), $avatarName);
            $request->user()->update([
                'avatar' => $customPath . $avatarName,
            ]);
            return redirect()->route('edit_profile')->with('success', 'Profile updated successfully');
        }
        return redirect()->route('edit_profile')->with('error', 'Error updating profile');
    }
}
