<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Project List</title>
        @vite(['resources/css/project.css'])
    </head>
    <body>
        <div class="container">
            @if ($editdata)
            <div class="add-project-form">
                <h2>Edit Project Name</h2>
                <form action="{{ route('update') }}" method="POST">
                    @csrf
                    <label for="project-name">Project Name:</label>
                    <input
                        type="text"
                        id="project-name"
                        value="{{ $editdata->name }}"
                        name="project_name"
                        required
                    />
                    <input
                        type="hidden"
                        name="id"
                        value="{{ $editdata->project_id }}"
                    />
                    <button type="submit">Submit</button>
                </form>
            </div>
            @else
            <div class="add-project-form">
                <h2>Add Project</h2>
                <form action="{{ route('insert') }}" method="POST">
                    @csrf
                    <label for="project-name">Project Name:</label>
                    <input
                        type="text"
                        id="project-name"
                        name="project_name"
                        required
                    />
                    <button type="submit">Add Project</button>
                </form>
            </div>

            @if ($pendingCount==0)
            <div class="project-section">
                <h2 class="section-title">No Pending Projects</h2>
            </div>
            @else
            <div class="project-section">
                <h2 class="section-title">Pending Projects</h2>
                @foreach ($table as $rec) @if ($rec->status==0)
                <div class="project-item">
                    <h3>{{ $rec->name }}</h3>
                    <p>Updated Date: {{ $rec->updated_at }}</p>
                    <p>Created Date: {{ $rec->created_at }}</p>
                    <div class="project-actions">
                        <button class="addtodo"><a
                            class="edit"
                            href="{{ route('view_todo', $rec->project_id) }}"
                            >Add Todo
                        </a></button>
                        <button class="edit">
                            <a
                                class="edit"
                                href="{{ route('viewdata', $rec->project_id) }}"
                                >Edit
                            </a>
                        </button>
                        <button class="delete">
                            <a href="{{ route('delete', $rec->project_id) }}">Delete</a>
                        </button>
                        <button class="update-status"> <a href="{{ route('statusUp', $rec->project_id) }}">Mark as Done</a></button>
                    </div>
                </div>
                @endif @endforeach
            </div>
            @endif @if($completedCount==0)
            <div class="project-section">
                <h2 class="section-title">No Completed Projects</h2>
            </div>
            @else
            <div class="project-section">
                @foreach ($table as $rec) @if ($rec->status==1)
                <div class="project-section">
                    <h2 class="section-title">Completed Projects</h2>
                    <div class="project-item">
                    <h3>{{ $rec->name }}</h3>
                    <p>Updated Date: {{ $rec->updated_at }}</p>
                    <p>Created Date: {{ $rec->created_at }}</p>
                    <div class="project-actions">
                        <button class="addtodo"><a
                            class="edit"
                            href="{{ route('view_todo', $rec->project_id) }}"
                            >Add Todo
                        </a></button>
                        <button class="edit">
                            <a
                                class="edit"
                                href="{{ route('viewdata', $rec->project_id) }}"
                                >Edit
                            </a>
                        </button>
                        <button class="delete">
                            <a href="{{ route('delete', $rec->project_id) }}">Delete</a>
                        </button>
                        <button class="update-status"> <a href="{{ route('statusUp', $rec->project_id) }}">Mark as Pending</a></button>
                    </div>
                </div>
                @endif @endforeach
            </div>
            @endif
            @endif
        </div>
    </body>
</html>
