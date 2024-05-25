<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,jpg|max:2048',
        ]);
        $avatar = $request->file('avatar');
        $avatarName = $request->user()->email . '.' . $avatar->getClientOriginalExtension();
        $customPath = '/images/';
        $avatar->storeAs($customPath, $avatarName);
        $request->user()->update([
            'avatar' => $customPath . $avatarName,
        ]);
        return redirect()->route('edit_profile')->with('success', 'Profile updated successfully');
    }
}
