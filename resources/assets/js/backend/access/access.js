$(document).ready(function () {
    $('.role_search_permission_multi').select2();
    $('.permission_search_roles_multi').select2();
    $('.show-table').on('click', function () {
        var table = $(this).attr('attr-table');
        $('#' + table).slideToggle();
        $('a.hidden-table[attr-table=' + table + ']').slideToggle();
        $(this).fadeOut();
    });
    $('.hidden-table').on('click', function () {
        var table = $(this).attr('attr-table');
        $('#' + table).slideToggle();
        $('a.show-table[attr-table=' + table + ']').slideToggle();
        $(this).fadeOut();
    });
});

