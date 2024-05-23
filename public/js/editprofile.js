
function loadFile(event) {
    var image = document.getElementById('profile-image');
    image.src = URL.createObjectURL(event.target.files[0]);
}

function loadFile(event) {
    const output = document.getElementById('profile-image');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = () => {
        URL.revokeObjectURL(output.src);
    };
}