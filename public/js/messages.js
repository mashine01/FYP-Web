// JavaScript to control the modal
var modal = document.getElementById('errorModal');
var closeBtn = document.getElementsByClassName("close")[0];

closeBtn.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
