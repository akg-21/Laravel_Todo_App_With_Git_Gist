<?php

namespace App\Http\Controllers;

use App\Models\projects;
use App\Models\todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class Gistcontroller extends Controller
{
    public function checkStatus($status)
    {
        if ($status == 0) {
            return "Pending";
        } elseif ($status == 1) {
            return "Completed";
        }
    }
    public function createGist(string $id)
    {
        // GitHub API endpoint for creating a Gist
        $url = 'https://api.github.com/gists';

        // Content of your Gist (replace this with your actual content)
        $projectdata = DB::table('projects')->where('project_id', $id)->first();
        $tododata = DB::table('todos')->where('project_id', $id)->get();


        if ($projectdata) {
            // dd($projectdata);
            if ($projectdata->status == 0) {
                $status = "Pending";
            } else {
                $status = "Completed";
            }

            $result = "";


            foreach ($tododata as $todo) {
                $result .= "\n \n Todo Title: " . $todo->todo_name .
                    "\n Todo Description: " . $todo->todo_Description .
                    "\n Todo Status: " . $this->checkStatus($todo->todo_status) .
                    "\n Created At: " . $todo->created_at .
                    "\n Updated At: " . $todo->updated_at .
                    "\n";
            }
            // echo ($result);



            $content = "Project Name: " . $projectdata->name . "\n" .
                "Created At: " . $projectdata->created_at . "\n" .
                "Updated At: " . $projectdata->updated_at . "\n" .
                "Status: " . $this->checkStatus($projectdata->status) . "\n" .
                "Todos: ";
            // "Todos: " . $result;
            //     print("\nTodo Title: " . $todo->todo_name);
            //     echo "Todo Description: " . $todo->todo_Description;
            //     echo  "Status: " . $todo->todo_status;
            // };


            //     // Get the GitHub access token
            $token = env('GIST_HUB_TOKEN');
            //     // Debug: Output the token
            //     // dd($token);

            //     // Data payload for creating the Gist
            $data = [
                'description' => 'Todo App Gist',
                'public' => true,
                'files' => [
                    'todo_app.txt' => [
                        'content' => $content . $result
                    ]
                ]
            ];

            // Sending a POST request to create the Gist
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token, // Include the token in the Authorization header
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
        } else {
            $errorMessage = "no todo in this project";
            return "Failed to create Gist: $errorMessage";
        }
    }
}
