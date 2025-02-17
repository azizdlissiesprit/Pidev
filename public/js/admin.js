document.addEventListener("DOMContentLoaded", () => {
    const darkModeToggle = document.getElementById("darkModeToggle");
    const themeIcon = document.getElementById("themeIcon");
    const body = document.body;
    if (localStorage.getItem("dark-mode") === "enabled") {
        body.classList.add("dark-mode");
        themeIcon.classList.replace("fa-moon", "fa-sun");
    }
    darkModeToggle.addEventListener("click", () => {
        body.classList.toggle("dark-mode");
        if (body.classList.contains("dark-mode")) {
            themeIcon.classList.replace("fa-moon", "fa-sun");
            localStorage.setItem("dark-mode", "enabled");
        } else {
            themeIcon.classList.replace("fa-sun", "fa-moon");
            localStorage.setItem("dark-mode", "disabled");
        }
    });
});
