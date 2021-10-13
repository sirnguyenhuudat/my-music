$(document).ready(function () {
    $('#permissionTable').DataTable();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Create Role
    $('#create_submit').on('click', function () {
        var name = $('#create_form_name').val();
        var description = $('#create_form_description').val();
        var display_name = $('#create_form_display_name').val();
        $.ajax({
            'type': 'POST',
            'url': baseUrl + '/backend/permissions',
            'data': {
                'name': name,
                'display_name': display_name,
                'description': description
            },
            'success': function (result) {
                // Show alert
                var xhtml = '';
                xhtml += '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">';
                xhtml += '<span class="badge badge-pill badge-success">' + result.title + '</span> ';
                xhtml += result.message;
                xhtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                xhtml += '<span aria-hidden="true">×</span>';
                xhtml += '</button>';
                xhtml += '</div>';
                $('div.table-responsive').prepend(xhtml);
                // Show data created
                var data_xhtml = '';
                data_xhtml += '<tr class="table-success">';
                data_xhtml += '<td>#</td>';
                data_xhtml += '<td>' + result.permission.name + '</td>';
                data_xhtml += '<td>' + result.permission.display_name + '</td>';
                data_xhtml += '<td>' + result.permission.description + '</td>';
                data_xhtml += '<td>';
                data_xhtml += '<a href="javascript:void(0)" class="btn btn-primary disabled"><i class="zmdi zmdi-edit"></i></a> ';
                data_xhtml += '<a href="javascriot:void(0)" class="btn btn-danger disabled"><i class="zmdi zmdi-delete"></i></a>';
                data_xhtml += '</td>';
                data_xhtml += '</tr>';
                $('#permissionTable tbody').prepend(data_xhtml);
                // Hiden form create when create success
                $('.dataTables_empty').remove();
                $('#modal_create').fadeOut();
                $('div.modal-backdrop').remove();
                $('#body').removeClass('modal-open');
                $('#create_form_name').val('');
                $('#create_form_display_name').val('');
                $('#create_form_description').val('');
            },
            'error': function( data ) {
                if (data.status === 422) {
                    $('#create_form_name').removeClass('is-invalid');
                    $('#error_create_name').html('');
                    $('#create_form_display_name').removeClass('is-invalid');
                    $('#error_create_display_name').html('');
                    $('#create_form_description').removeClass('is-invalid');
                    $('#error_create_description').html('');
                    var messages = $.parseJSON(data.responseText);
                    $.each(messages.errors, function (key, val) {
                        $('#create_form_' + key).addClass('is-invalid');
                        $('#error_create_' + key).html(val);
                    });
                }
            }
        });
    });
    // Update Role
    $('a.update_permission').on('click', function () {
        var id = $(this).parent().parent().attr('attr-num');
        var url = $(this).attr('href');
        var name = $(this).parent().siblings('td[attr-name]').html();
        var display_name = $(this).parent().siblings('td[attr-display_name]').html();
        var description = $(this).parent().siblings('td[attr-description]').html();
        $('#update_form_name').val(name);
        $('#update_form_display_name').val(display_name);
        $('#update_form_description').val(description);
        $('#update_submit').on('click', function () {
            var name = $('#update_form_name').val();
            var display_name = $('#update_form_display_name').val();
            var description = $('#update_form_description').val();
            var methodUpdate = $('#form-update').attr('method');
            $.ajax({
                'type': methodUpdate,
                'url': url,
                'data': {
                    'name': name,
                    'display_name': display_name,
                    'description': description
                },
                'success': function (result) {
                    // Show alert
                    var xhtml = '';
                    xhtml += '<div class="sufee-alert alert with-close alert-success alert-dismissible fade show">';
                    xhtml += '<span class="badge badge-pill badge-success">' + result.title + '</span> ';
                    xhtml += result.message;
                    xhtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                    xhtml += '<span aria-hidden="true">×</span>';
                    xhtml += '</button>';
                    xhtml += '</div>';
                    $('div.table-responsive').prepend(xhtml);
                    // Show data updated
                    $('tr[attr-num=' + id + ']').addClass('table-info');
                    $('tr[attr-num=' + id + '] td[attr-name=1]').html(result.permission.name);
                    $('tr[attr-num=' + id + '] td[attr-display_name=1]').html(result.permission.display_name);
                    $('tr[attr-num=' + id + '] td[attr-description=1]').html(result.permission.description);
                    // Hiden form create when updated success
                    $('#modal_update').fadeOut();
                    $('div.modal-backdrop').remove();
                    $('#body').removeClass('modal-open');
                    $('#update_form_name').val('');
                    $('#update_form_display_name').val('');
                    $('#update_form_description').val('');
                },
                'error': function( data ) {
                    if (data.status === 422) {
                        var messages = $.parseJSON(data.responseText);
                        $('#update_form_name').removeClass('is-invalid');
                        $('#error_update_name').html('');
                        $('#update_form_display_name').removeClass('is-invalid');
                        $('#error_update_display_name').html('');
                        $('#update_form_description').removeClass('is-invalid');
                        $('#error_update_description').html('');
                        $.each(messages.errors, function (key, val) {
                            $('#update_form_' + key).addClass('is-invalid');
                            $('#error_update_' + key).html(val);
                        });
                    }
                }
            });
        })
    });
});

