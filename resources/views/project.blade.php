<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project List</title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="container">
        <div class="project-section">
            <h2 class="section-title">Pending Projects</h2>
            <div class="project-item">
                <h3>Project Name 1</h3>
                <p>Created Date: January 1, 2024</p>
                <div class="project-actions">
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                    <button class="update-status">Mark as Done</button>
                </div>
            </div>
            <div class="project-item">
                <h3>Project Name 1</h3>
                <p>Created Date: January 1, 2024</p>
                <div class="project-actions">
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                    <button class="update-status">Mark as Done</button>
                </div>
            </div>
            <!-- Add more pending project items as needed -->
        </div>
    </div>
    
    <div class="container">
        <div class="project-section">
            <h2 class="section-title">Completed Projects</h2>
            <div class="project-item">
                <h3>Project Name 2</h3>
                <p>Created Date: January 5, 2024</p>
                <div class="project-actions">
                    <button class="edit">Edit</button>
                    <button class="delete">Delete</button>
                    <button class="update-status">Mark as Pending</button>
                </div>
            </div>
            <!-- Add more completed project items as needed -->
        </div>
    </div>
</body>
</html>
