// Close alert when close button is clicked
document.addEventListener("DOMContentLoaded", function () {
    var alertCloseButtons = document.querySelectorAll(".alert button.close");
    alertCloseButtons.forEach(function (button) {
        button.addEventListener("click", function () {
            this.parentNode.style.display = "none";
        });
    });
});
