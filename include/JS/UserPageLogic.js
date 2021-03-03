$('.msg').text('Hello' + $.cookie('login'));
jQuery(document).ready(function($) {
    $('.end').click(function(e, ) {
        let login = $.cookie('login');
        $.ajax({
            url: 'include/DeletePHP.php',
            type: 'POST',
            datatype: 'json',
            data: {
                login: login
            }
        })
        document.location.href = 'index.html';
    })
})