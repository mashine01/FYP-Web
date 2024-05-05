<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

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
            $response = $client->post('https://9474-35-232-212-70.ngrok-free.app/prompt', [
                'query' => $request->all()
            ]);
            $statusCode = $response->getStatusCode();
        
            if ($statusCode >= 200 && $statusCode < 300) {
                $data = json_decode($response->getBody(), true);
                return $data;
            } else {
                // Handle the error response
                return "Error occurred while processing your request.";
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return "An unexpected error occurred while processing your request.";
        }
    }
}