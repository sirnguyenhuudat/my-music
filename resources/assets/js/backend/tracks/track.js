$(document).ready(function () {
    $('#trackTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: baseUrl + '/backend/tracks/get-datatables',
        columns: [
            {
                data: 'stt'
            },
            {
                data: 'name'
            },
            {
                data: 'author'
            },
            {
                data: 'artist'
            },
            {
                data: 'source'
            },
            {
                data: 'genres'
            },
            {
                data: 'actions'
            }
        ],
    });
    $('body').on('click', '.add_trending', function () {
        var track_id = $(this).attr('attr-id');
        $.ajax({
            'type': 'get',
            'url': baseUrl + '/backend/track/trending/' + track_id,
            'async': true,
            'success': function (result) {
                var tmpThis = $('a[attr-id=' + track_id + ']');
                alert(result.success);
                var tag_i = tmpThis.children();
                if (result.trend) {
                    tmpThis.removeClass('btn-info');
                    tmpThis.addClass('btn-danger');
                    tag_i.removeClass('zmdi-trending-up');
                    tag_i.addClass('zmdi-trending-down');
                    tmpThis.attr('trending', 0);
                } else {
                    tmpThis.removeClass('btn-danger');
                    tmpThis.addClass('btn-info');
                    tag_i.removeClass('zmdi-trending-down');
                    tag_i.addClass('zmdi-trending-up');
                    tmpThis.attr('trending', 1);
                }
            }
        })
    })
});

