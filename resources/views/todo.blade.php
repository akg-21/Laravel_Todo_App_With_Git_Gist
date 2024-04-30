<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Todo App</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 1000px;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                text-align: center;
                margin-bottom: 20px;
            }

            .todo-list {
                list-style: none;
                padding: 0;
            }

            .todo-item {
                background-color: #f9f9f9;
                padding: 15px;
                margin-bottom: 10px;
                border-radius: 5px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .todo-item input[type="checkbox"] {
                margin-right: 10px;
            }

            .add-todo-form {
                margin-top: 20px;
                display: flex;
            }

            .add-todo-form input[type="text"],
            .add-todo-form select,
            .add-todo-form input[type="date"] {
                flex: 1;
                padding: 10px;
                border-radius: 5px;
                border: 1px solid #ccc;
                margin-right: 10px;
                box-sizing: border-box;
            }

            .add-todo-form button {
                padding: 10px 20px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .add-todo-form button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>Todo List</h1>
            <ul class="todo-list" id="todoList">
                <!-- Todo items will be dynamically added here -->
            </ul>
            <form class="add-todo-form" id="addTodoForm">
                <input type="text" id="todoTitle" placeholder="Title..." />
                <input
                    type="text"
                    id="todoDescription"
                    placeholder="Description..."
                />
                <select id="todoStatus">
                    <option value="todo">Todo</option>
                    <option value="inProgress">In Progress</option>
                    <option value="done">Done</option>
                </select>
                <input type="date" id="todoCreatedDate" />
                <input type="date" id="todoUpdatedDate" />
                <button type="submit">Add</button>
            </form>
        </div>

        <script>
            document
                .getElementById("addTodoForm")
                .addEventListener("submit", function (event) {
                    event.preventDefault();

                    const todoTitle = document
                        .getElementById("todoTitle")
                        .value.trim();
                    const todoDescription = document
                        .getElementById("todoDescription")
                        .value.trim();
                    const todoStatus =
                        document.getElementById("todoStatus").value;
                    const todoCreatedDate =
                        document.getElementById("todoCreatedDate").value;
                    const todoUpdatedDate =
                        document.getElementById("todoUpdatedDate").value;

                    if (todoTitle === "" || todoDescription === "") return;

                    const todoItem = document.createElement("li");
                    todoItem.className = "todo-item";
                    todoItem.innerHTML = `
                    <input type="checkbox">
                    <span>Title: ${todoTitle}</span>
                    <span>Description: ${todoDescription}</span>
                    <span>Status: ${todoStatus}</span>
                    <span>Created Date: ${todoCreatedDate}</span>
                    <span>Updated Date: ${todoUpdatedDate}</span>
                    <button onclick="deleteTodo(this)">Delete</button>
                `;

                    document.getElementById("todoList").appendChild(todoItem);

                    document.getElementById("todoTitle").value = "";
                    document.getElementById("todoDescription").value = "";
                    document.getElementById("todoStatus").value = "todo";
                    document.getElementById("todoCreatedDate").value = "";
                    document.getElementById("todoUpdatedDate").value = "";
                });

            function deleteTodo(button) {
                const todoItem = button.parentElement;
                todoItem.remove();
            }
        </script>
    </body>
</html>
