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
            success() {
                async function getinfo() {
                    let info = await fetch('include/JS_AJAX/' + login + '.json');
                    let content = await info.json();
                    if (content[0].status === true) {
                        $.cookie('login', login);
                        document.location.href = 'UserPage.html';
                    }
                    if ((content[0].status === false) && (content[0].type == '0')) {
                        $('.PasswordValidation').text(content[0].message);
                    }
                    if ((content[0].status === false) && (content[0].type == '1')) {
                        $('.LoginValidation').text(content[0].message);
                    }
                    if ((content[0].status === false) && (content[0].type == '2')) {
                        $('.PasswordValidation').text(content[0].message);
                    }
                    if ((content[0].status === false) && (content[0].type == '3')) {
                        $('.PasswordValidation').text(content[0].message);
                    }
                }
                getinfo();
            }
        });
    });
});