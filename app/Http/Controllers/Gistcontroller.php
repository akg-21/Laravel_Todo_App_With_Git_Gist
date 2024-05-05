<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Gistcontroller extends Controller
{
    public function createGist()
    {
        // GitHub API endpoint for creating a Gist
        $url = 'https://api.github.com/gists';

        // Content of your Gist (replace this with your actual content)
        $content = 'Your todo app content here';

        // Data payload for creating the Gist
        $data = [
            'description' => 'Todo App Gist',
            'public' => true,
            'files' => [
                'todo_app.txt' => [
                    'content' => $content
                ]
            ]
        ];

        // Sending a POST request to create the Gist
        $response = Http::withHeaders([
            'Authorization' => 'Bearer YOUR_GITHUB_ACCESS_TOKEN', // Replace with your GitHub access token
            'Accept' => 'application/vnd.github.v3+json'
        ])->post($url, $data);

        // Check if the request was successful
        if ($response->successful()) {
            $gistUrl = $response['html_url']; // URL of the created Gist
            return "Gist created successfully: $gistUrl";
        } else {
            $errorMessage = $response->json()['message']; // Error message from GitHub API
            return "Failed to create Gist: $errorMessage";
        }
    }
}
