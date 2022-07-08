$(function() {
    // Sidebar toggle behavior
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar, #content').toggleClass('active');
    });
});


function hideYourself() {
    var x = document.getElementById("name-form");
    var y = document.getElementById("email-form");
    var z = document.getElementById("password-form");
    var w = document.getElementById("pic-form");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
    if (y.style.display === "none") {
        y.style.display = "block";
    } else {
        y.style.display = "none";
    }
    if (z.style.display === "none") {
        z.style.display = "block";
    } else {
        z.style.display = "none";
    }
    if (w.style.display === "none") {
        w.style.display = "block";
    } else {
        w.style.display = "none";
    }
}