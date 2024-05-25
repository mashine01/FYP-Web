<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function prompt(Request $request)
    {
        try {
            $client = new Client();
            $response = $client->post('https://9a6f-34-71-91-63.ngrok-free.app/prompt', [
                'query' => $request->all()
            ]);
            $statusCode = $response->getStatusCode();

            if ($statusCode >= 200 && $statusCode < 300) {
                $data = json_decode($response->getBody(), true);
                return $data;
            } else {
                // Handle the error response
                return "Error fetching prompt data" . $statusCode;
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return "Error fetching prompt data";
        }
    }

    public function edit_profile(Request $request)
    {
        return view('front.edit_profile');
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
