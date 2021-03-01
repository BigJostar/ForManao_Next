async function getAsync() {

    let info = await fetch('include/JS_AJAX/' + $.cookie('login') + '.json');
    let content = await info.json();
    $('.Message').text('Hello' + (content[0].login));


};
getAsync();
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
debugger;