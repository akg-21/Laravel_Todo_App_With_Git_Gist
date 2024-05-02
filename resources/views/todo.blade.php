<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Todo App</title>
        @vite(['resources/css/todo.css'])
    </head>
    <body>
        <div class="container">
            <h1>{{ $projectdata->name }}</h1>

            <form
                class="add-todo-form"
                id="addTodoForm"
                method="post"
                action="{{ route('insert_todo') }}"
            >
                @csrf
                <input
                    type="text"
                    id="todoTitle"
                    name="todoTitle"
                    placeholder="Title..."
                />
                <input
                    type="hidden"
                    name="project_id"
                    id="project_id"
                    value="{{ $projectdata->project_id }}"
                />
                <input
                    type="text"
                    name="todoDescription"
                    id="todoDescription"
                    placeholder="Description..."
                />
                <button type="submit">Add</button>
            </form>
            <!-- <ul class="todo-list" id="todoList">
                @foreach($alltodo as $resource)
                <li class="todo-item">
                    <span>Title:{{ $resource->todo_name }}</span>
                    <span>Description: {{ $resource->todo_Description }}</span>
                    <span>Status: {{ $resource->todo_status }}</span>
                    <span>Created Date: {{ $resource->created_at }}</span>
                    <span>Updated Date: {{ $resource->updated_at }}</span>
                    <button onclick="deleteTodo(this)">Delete</button>
                </li>
                @endforeach
            </ul> -->
        </div>

        <div class="container">
            @if($pendingCount!=0)
            <div id="todo-item-template">
                <h2>Pending Todos</h2>
                <!-- </div>            
            <div id="todo-item-template2"> -->
                <table>
                    @foreach($alltodo as $resource)
                    @if($resource->todo_status==0)
                    <tr>
                        <td>
                            <h2 class="title">{{ $resource->todo_name }}</h2>
                        </td>
                        <td>
                            <p>
                                Updated:
                                <span class="update-date">
                                    {{ $resource->updated_at }}</span
                                >
                            </p>
                        </td>
                        <td>
                            <button class="btn btn-primary edit">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-primary status">
                                <a
                                    href="{{ route('statusUp_todo', $resource->todo_id) }}"
                                    >Mark as Completed</a
                                >
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger delete">
                                <a
                                    href="{{ route('delete_todo', $resource->todo_id) }}"
                                    >Delete</a
                                >
                            </button>
                        </td>
                        <td>
                            <div class="popup">
                                <button class="btn btn-primary hover">
                                    Hover me
                                </button>
                                <div class="popup-content">
                                    <h3>Title:{{ $resource->todo_name }}</h3>
                                    <p>
                                        {{ $resource->todo_Description }}
                                    </p>
                                    <p>
                                        Creation Date:
                                        {{ $resource->created_at }}
                                    </p>
                                    <p>
                                        Update Date: {{ $resource->updated_at }}
                                    </p>
                                    <p>Status:{{ $resource->todo_status }}</p>
                                    <button class="btn btn-danger delete">
                                        <a
                                            href="{{ route('delete_todo', $resource->todo_id) }}"
                                            >Delete</a
                                        >
                                    </button>
                                    <button>Edit</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif @endforeach
                </table>
                @else
                <div id="todo-item-template">
                    <h2>No Pending Todos</h2>
                </div>
                @endif

                <!-- @foreach($alltodo as $resource)
                <div class="todo-item">
                    <h2 class="title">{{ $resource->todo_name }}</h2>

                    <p>
                        Status:
                        <span class="status">{{ $resource->todo_status }}</span>
                    </p>
                    <p>
                        Updated:
                        <span class="update-date">
                            {{ $resource->updated_at }}</span
                        >
                    </p>
                    <div class="actions">
                        <button class="btn btn-primary edit">Edit</button>
                        <button class="btn btn-danger delete">Delete</button>

                        <div class="popup">
                            <button>Hover me</button>
                            <div class="popup-content">
                                <h3>Title:{{ $resource->todo_name }}</h3>
                                <p>
                                    {{ $resource->todo_Description }}
                                </p>
                                <p>
                                    Creation Date: {{ $resource->created_at }}
                                </p>
                                <p>Update Date: {{ $resource->updated_at }}</p>
                                <p>Status:{{ $resource->todo_status }}</p>
                                <button>Delete</button>
                                <button>Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach -->
            </div>
        </div>
        <div class="container">
            @if($completedCount!=0)
            <div id="todo-item-template">
                <h2>Completed Todos</h2>
                <!-- </div>            
            <div id="todo-item-template2"> -->
                <table>
                    @foreach($alltodo as $resource)
                    @if($resource->todo_status==1)
                    <tr>
                        <td>
                            <h2 class="title">{{ $resource->todo_name }}</h2>
                        </td>
                        <td>
                            <p>
                                Updated:
                                <span class="update-date">
                                    {{ $resource->updated_at }}</span
                                >
                            </p>
                        </td>
                        <td>
                            <button class="btn btn-primary edit">Edit</button>
                        </td>
                        <td>
                            <button class="btn btn-primary status">
                                <a
                                    href="{{ route('statusUp_todo', $resource->todo_id) }}"
                                    >Mark as Pending</a
                                >
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger delete">
                                <a
                                    href="{{ route('delete_todo', $resource->todo_id) }}"
                                    >Delete</a
                                >
                            </button>
                        </td>
                        <td>
                            <div class="popup">
                                <button class="btn btn-primary hover">
                                    Hover me
                                </button>
                                <div class="popup-content">
                                    <h3>Title:{{ $resource->todo_name }}</h3>
                                    <p>
                                        {{ $resource->todo_Description }}
                                    </p>
                                    <p>
                                        Creation Date:
                                        {{ $resource->created_at }}
                                    </p>
                                    <p>
                                        Update Date: {{ $resource->updated_at }}
                                    </p>
                                    <p>Status:{{ $resource->todo_status }}</p>
                                    <button class="btn btn-danger delete">
                                        <a
                                            href="{{ route('delete_todo', $resource->todo_id) }}"
                                            >Delete</a
                                        >
                                    </button>
                                    <button>Edit</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif @endforeach
                </table>
                @else
                <div id="todo-item-template">
                    <h2>No Completed Todos</h2>
                </div>
                @endif

                <!-- @foreach($alltodo as $resource)
                <div class="todo-item">
                    <h2 class="title">{{ $resource->todo_name }}</h2>

                    <p>
                        Status:
                        <span class="status">{{ $resource->todo_status }}</span>
                    </p>
                    <p>
                        Updated:
                        <span class="update-date">
                            {{ $resource->updated_at }}</span
                        >
                    </p>
                    <div class="actions">
                        <button class="btn btn-primary edit">Edit</button>
                        <button class="btn btn-danger delete">Delete</button>

                        <div class="popup">
                            <button>Hover me</button>
                            <div class="popup-content">
                                <h3>Title:{{ $resource->todo_name }}</h3>
                                <p>
                                    {{ $resource->todo_Description }}
                                </p>
                                <p>
                                    Creation Date: {{ $resource->created_at }}
                                </p>
                                <p>Update Date: {{ $resource->updated_at }}</p>
                                <p>Status:{{ $resource->todo_status }}</p>
                                <button>Delete</button>
                                <button>Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach -->
            </div>
        </div>
    </body>
</html>
