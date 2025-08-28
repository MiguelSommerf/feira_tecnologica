document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("mobile-menu").addEventListener("click", function () {
        this.classList.toggle("active");
        openMenu();
    });
    document.getElementById("close-btn").addEventListener("click", function () {
        closeMenu();
    });
    function openMenu() {
      document.getElementById("mySideMenu").style.width = "250px";
    }
    function closeMenu() {
      document.getElementById("mySideMenu").style.width = "0";
      document.getElementById("mobile-menu").classList.remove("active");
    }
});