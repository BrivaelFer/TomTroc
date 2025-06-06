document.addEventListener("DOMContentLoaded", function () {
    const menuIcon = document.querySelector(".menu-icon");
    const mainMenus = document.querySelector(".main-menus");

    menuIcon.addEventListener("click", function () {
        mainMenus.classList.toggle("hidden-mob");
    });
});