function showProfileDetails() {
    element = document.getElementById('personalDetailsHiddenPart');
    if (element.style.display === "none") {
        element.style.display = "contents";
    } else {
        element.style.display = "none";
    }
}

function showAppliedDetails() {
    element = document.getElementById('applicationContainer');
    if (element.style.display === "none") {
        element.style.display = "contents";
    } else {
        element.style.display = "none";
    }
}
