<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project List</title>
    @vite(['resources/css/project.css'])

</head>
<body>
    <div class="container">
        @if ($editdata)
        <div class="add-project-form">
            <h2>Edit Project Name</h2>
            <form action="{{ route('update') }}"  method="POST">
                @csrf
                <label for="project-name">Project Name:</label>
                <input type="text" id="project-name" value="{{ $editdata->name }}" name="project_name" required>
                <button type="submit">Submit</button>
            </form>
        </div>
        @else
        <div class="add-project-form">
            <h2>Add Project</h2>
            <form action="{{ route('insert') }}"  method="POST">
                @csrf
                <label for="project-name">Project Name:</label>
                <input type="text" id="project-name" name="project_name" required>
                <button type="submit">Add Project</button>
            </form>
        </div>
    
        @if ($table->count()==0)
        <div class="project-section">
            <h2 class="section-title">No Projects</h2>
        </div>
        @else
        <div class="project-section">
            <h2 class="section-title">Pending Projects</h2>
        @foreach ($table as $rec)
        @if ($rec->status==0)
            <div class="project-item">
                <h3>{{ $rec->name }}</h3>
                <p>Created Date: January 1, 2024</p>
                <div class="project-actions">
                    <button class="edit"><a href="{{ route('viewdata', $rec->id) }}">Edit </a></button>
                    <button class="delete">Delete</button>
                    <button class="update-status">Mark as Done</button>
                </div>
            </div>
        </div>
        @else
        <div class="project-section">
            <h2 class="section-title">Completed Projects</h2>
            <div class="project-item">
                <h3>Project Name 2</h3>
                <p>Created Date: January 5, 2024</p>
                <div class="project-actions">
                    <button id="" class="edit">Edit</button>
                    <button class="delete">Delete</button>
                    <button class="update-status">Mark as Pending</button>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @endif
        @endif
        
        </div>
</body>
</html>
