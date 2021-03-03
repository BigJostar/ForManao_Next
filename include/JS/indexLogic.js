jQuery(document).ready(function($) {
    $('.load').click(function(e, ) {
        e.preventDefault();
        let login = $('input[name="login"]').val();
        let password = $('input[name="password"]').val();
        $.ajax({
            url: 'include/PHPLogin.php',
            type: 'POST',
            datatype: 'json',
            data: {
                login: login,
                password: password

            },
            success(data) {
                data = JSON.parse(data);
                if (data.type == '0') {
                    $.cookie('login', login);
                    document.location.href = 'UserPage.html';
                } else {
                    if (data.type == '1') {
                        $('.LoginValidation').text(data.message);
                    }
                    if (data.type == '2') {
                        $('.PasswordValidation').text(data.message);
                    }
                    if (data.type == '3') {
                        $('.PasswordValidation').text(data.message);
                    }
                    if (data.type == '4') {
                        $('.LoginValidation').text(data.message);
                    }
                }
                data = '';
            }
        });
    });
});