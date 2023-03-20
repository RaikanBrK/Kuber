const image = $('#campoImageProfile');

image.on('change', e => {
    let image = e.target;
    const reader = new FileReader();
    reader.onload = function() {
        var dataURL = reader.result;
        var output = document.getElementById('imageProfile');
        output.src = dataURL;
    }
    if (image.files.length > 0) {
        reader.readAsDataURL(image.files[0]);
    }

    e.preventDefault();
});

$('#checkBoxChangePassword').on('change', e => {
    let checkbox = $(e.target)
    let changePassword = $('#changePassword');
    let passwordInput = $('#password');
    let passwordConfirmInput = $('#password_confirmation');

    if (checkbox.prop("checked")) {
        passwordInput.val('');
        passwordConfirmInput.val('');
        changePassword.removeClass('d-none');
    } else {
        changePassword.addClass('d-none');
    }
});