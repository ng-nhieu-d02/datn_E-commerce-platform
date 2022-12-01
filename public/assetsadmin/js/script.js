$(document).ready(function() {
    $('.button__toggle__modals').click(function() {
        $('#defaultModal').show();
        $('.container__modals').show();
    });
    $('.button__close__modals').click(function() {
        document.querySelectorAll('#defaultModal').forEach(element => {
            element.style.display = 'none'
        });
        $('.container__modals').hide();
    });
    $('.btn-view-store').click(function() {
        const modals = $(this).attr('data-store');
        $('.'+ modals).show();
        $('.container__modals').show();
    });
    $('.btn-view-code').click(function() {
        const code = $(this).attr('data-code');
        $(this).text(code);
        navigator.clipboard.writeText(code);
        alert("Copied the text: " + code);
    });
});