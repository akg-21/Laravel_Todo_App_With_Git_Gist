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
            <h1>Todo List</h1>
            <ul class="todo-list" id="todoList">
                <li class="todo-item">
                    <span>Title: ${todoTitle}</span>
                    <span>Description: ${todoDescription}</span>
                    <span>Status: ${todoStatus}</span>
                    <span>Created Date: ${todoCreatedDate}</span>
                    <span>Updated Date: ${todoUpdatedDate}</span>
                    <button onclick="deleteTodo(this)">Delete</button>
                </li>
            </ul>
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
                    value="{{ $tododata->todo_name }}"
                />
                <input
                    type="text"
                    name="todoDescription"
                    id="todoDescription"
                    placeholder="Description..."
                />
                <button type="submit">Add</button>
            </form>
        </div>
    </body>
</html>
@foreach($alltodo as $resource)
{{ $resource->todo_name }} @endforeach
