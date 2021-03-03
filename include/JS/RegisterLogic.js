jQuery(document).ready(function($) {
    $('.registrationload').click(function(e, ) {
        e.preventDefault();
        let login = $('input[name="login"]').val();
        let password = $('input[name="password"]').val();
        let password_repeat = $('input[name="password_repeat"]').val();
        let email = $('input[name="email"]').val();
        let name = $('input[name="name"]').val();
        $.ajax({
            url: 'include/RegisterPHP.php',
            type: 'POST',
            datatype: 'json',
            data: {
                login: login,
                password: password,
                password_repeat: password_repeat,
                email: email,
                name: name

            },
            success(data) {
                data = JSON.parse(data);
                if (data.type == '0') {
                    document.location.href = 'index.html';
                } else {
                    if (data.type == '1') {
                        $('loginValidation').text(data.message);
                    }
                    if (data.type == '2') {
                        $('.passwordValidation').text(data.message);
                    }
                    if (data.type == '3') {
                        $('.password_repeatValidation').text(data.message);
                    }
                    if (data.type == '4') {
                        $('.emailValidation').text(data.message);
                    }
                    if (data.type == '5') {
                        $('.nameValidation').text(data.message);
                    }
                    if (data.type == '6') {
                        $('.userValidation').text(data.message);
                    }
                }
                data = '';
            }
        });
    });
});