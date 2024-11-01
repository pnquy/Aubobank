document.getElementById('avatar').addEventListener('click', function () {
    var dropdownMenu = document.getElementById('dropdownMenu');
    
    if (dropdownMenu.style.display === "none" || dropdownMenu.style.display === "") {
        dropdownMenu.style.display = "block";
    } else {
        dropdownMenu.style.display = "none";
    }
});

// Close the dropdown menu if the user clicks outside of it
window.addEventListener('click', function (e) {
    var dropdownMenu = document.getElementById('dropdownMenu');
    if (!document.getElementById('avatar').contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.style.display = "none";
    }
});
