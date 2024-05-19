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
<<<<<<< Updated upstream
            $response = $client->post('https://e8ed-34-125-221-252.ngrok-free.app/prompt', [
=======
            $response = $client->post('https://28e9-34-125-161-165.ngrok-free.app/prompt', [
>>>>>>> Stashed changes
                'query' => $request->all()
            ]);
            $statusCode = $response->getStatusCode();

            if ($statusCode >= 200 && $statusCode < 300) {
                $data = json_decode($response->getBody(), true);
                return $data;
            } else {
                // Handle the error response
                return "Error: " . $statusCode;
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur
            return "Error: " . $e->getMessage();
        }
    }
}