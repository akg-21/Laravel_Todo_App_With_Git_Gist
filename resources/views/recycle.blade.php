<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Deleted Projects and Todos</title>
        @vite(['resources/css/recycle.css'])
    </head>
    <body>
        <div class="container">
            <h2>Deleted Projects and Todos</h2>

            <div class="deleted-items">
                @if($projects) @foreach($projects as $project)
                <div class="item">
                    <h3>Project Name: {{ $project->name }}</h3>
                    <p>Description: {{ $project->Description }}.</p>
                    <p>Deleted Date: January 10, 2024</p>
                    <button class="recover-btn">Recover</button>
                </div>
                @endforeach @elseif($todos) @foreach($todos as $todo)
                <div class="item">
                    <h3>Todo Name: {{ $todo->name }}</h3>
                    <p>Description: This is a deleted todo.</p>
                    <p>Deleted Date: January 12, 2024</p>
                    <button class="recover-btn">Recover</button>
                </div>
                @endforeach @else
                <div class="item">
                    <h3>No Data</h3>
                </div>
                @endif

                <!-- Add more items as needed -->
            </div>

            <button class="recover-all-btn">Recover All</button>
        </div>
    </body>
</html>