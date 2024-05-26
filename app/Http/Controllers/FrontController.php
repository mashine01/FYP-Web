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
            $response = $client->post('https://b5a9-34-82-198-170.ngrok-free.app/prompt', [
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
}
