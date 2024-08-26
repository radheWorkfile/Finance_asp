/* User Section*/

function pass(ps) {
    var sto = $('#ps').val();
    var datas = sto + '&nbsp;<a href="javascript:void(0);" onclick="pass(0)"><i class="fas fa-eye-slash"></i></a>';
    var datah = '***** &nbsp;<a href="javascript:void(0);" onclick="pass(1)"><i class="fas fa-eye"></i></a>';
    if (ps == 1) {
        $('#show_pass').html(datas);
    } else {
        $('#show_pass').html(datah);
    }

}

function get_data_user(id) {
    $.ajax({
        url: base_url + 'admin/user/view_user',
        type: "POST",
        data: {
            'id': id
        },
        success: function (data) {
            $('#view_user').html(data);
        },
    });
}

$('#add_user').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'admin/user/add_user',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function (data) {
            if (data.icon == "error") {
                var valid = '';
                $.each(data.text, function (i, item) {
                    valid += item;
                });
                Toast.fire({
                    icon: data.icon,
                    html: valid,
                })

            } else {
                Toast.fire({
                    icon: data.icon,
                    text: data.text
                })
                window.location.reload(true);
            }
        }
    });
});

function get_data_edit_user(id) {
    $.ajax({
        url: base_url + 'admin/user/edit_user',
        type: "POST",
        data: {
            'id': id
        },
        success: function (data) {
            $('#edit_user').html(data);
        },
    });
}

$('#update_user').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'admin/user/update_user',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function (data) {
            if (data.icon == "error") {
                var valid = '';
                $.each(data.text, function (i, item) {
                    valid += item;
                });
                Toast.fire({
                    icon: data.icon,
                    html: valid,
                })

            } else {
                Toast.fire({
                    icon: data.icon,
                    text: data.text
                })
                window.location.reload(true);
            }
        }
    });
});
