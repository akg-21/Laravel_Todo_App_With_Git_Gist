<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Popup Box on Button Hover</title>
        <style>
            /* Popup container */
            .popup {
                position: relative;
                display: inline-block;
                cursor: pointer;
            }

            /* The actual popup (hidden by default) */
            .popup .popup-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                border: 1px solid #ccc;
                padding: 10px;
                z-index: 1;
                min-width: 200px;
            }

            /* Popup box arrow */
            .popup .popup-content::after {
                content: "";
                position: absolute;
                top: -10px;
                left: 50%;
                margin-left: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: transparent transparent #f9f9f9 transparent;
            }

            /* Show the popup when hovering over the button */
            .popup:hover .popup-content {
                display: block;
            }
        </style>
    </head>
    <body>
        <div class="popup">
            <button>Hover me</button>
            <div class="popup-content">
                <h3>Name: Example Name</h3>
                <p>
                    Description: Lorem ipsum dolor sit amet, consectetur
                    adipiscing elit.
                </p>
                <p>Creation Date: January 1, 2024</p>
                <p>Update Date: February 1, 2024</p>
                <p>Status: Active</p>
                <button>Delete</button>
                <button>Edit</button>
            </div>
        </div>
    </body>
</html>
