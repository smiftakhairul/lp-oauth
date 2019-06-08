<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp;

class LoginController extends Controller
{
    public function handleProviderCallback(Request $request)
    {
        $http = new GuzzleHttp\Client;

        $response = $http->post('http://localhost:8080/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '3',
                'client_secret' => 'fgr33eyE61Opfs3M436sR8ElA5laHmPu3DTazJDq',
                'redirect_uri' => 'http://localhost:8000/callback',
                'code' => $request->code,
            ],
        ]);

        $generatedToken = json_decode((string) $response->getBody(), true);
        $accessToken = $generatedToken['access_token'];

        $userDataResponse = $http->get('http://localhost:8080/api/user', [
            'headers' => [
                'Authorization' => 'Bearer '.$accessToken
            ]
        ]);

        return json_decode((string) $userDataResponse->getBody(), true);
    }
}
