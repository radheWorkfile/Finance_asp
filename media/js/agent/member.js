function get_document_type_data(id) {

    $.ajax({

        url: base_url + 'agent/Member/get_sub_documnet_data',
        type: "POST",
        data: {

            'id': id

        },

        dataType: 'json',
        success: function(data) {

            let str = '';

            $('#documnt').empty(str);

            $.each(data, function(i, item) {

                str = `<div class="col-lg-6"><label for="example-number-input" class="form-label"> ${item.sub_document_name} </label> <span class="text-danger" style="font-weight: 600; font-family: 'Font Awesome 5 Free'; font-size: 15px;">(Maximum Size 2MB)</span><br>
                <input class="form-control" type="file" name="${item.input_name}" id="${item.input_name}"></div>`;
                $('#documnt').append(str);

            });

        },

    });

}

$(document).ready(function() {

    let searchObj = {};

    let reportTable = {

        printTable: function(search_data) {

            $("#leadtable").DataTable({

                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, 5, ],
                    'orderable': true
                }],

                "ajax": {

                    "url": base_url + 'agent/Member/member_data',
                    "type": "POST",
                    "dataSrc": "data",
                    "data": search_data

                },

                dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],

                "buttons": ["excel", "pdf", "print"]

            });

        }

    }

    reportTable.printTable(searchObj);
});

$('#add_member_data').submit(function(e) {

    e.preventDefault();
    $.ajax({

        url: base_url + 'agent/Member/add_member_data',
        type: "POST",
        // data: $(this).serialize(),
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function(data) {
            if (data.icon == "error") {
                var valid = '';
                $.each(data.text, function(i, item) {
                    valid += item;
                });
                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    html: valid,
                    showConfirmButton: !1,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    title: data.text,
                    showConfirmButton: !1,
                    timer: 1500
                });
                setTimeout(function() {
                    window.location.reload(1);
                    window.location.href = base_url + 'agent/Member/manage_member';
                }, 1500);
            }
        }
    });
});

function view_member(id) {
    $.ajax({
        url: base_url + 'agent/Member/view_member_data',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_member').html(data);
        },
    });
}

function update_member(id) {
    $.ajax({
        url: base_url + 'agent/Member/update_members',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#up_member').html(data);
        },
    });
}

$('#member_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'agent/Member/update_member_data',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function(data) {
            if (data.icon == "error") {
                var valid = '';
                $.each(data.text, function(i, item) {
                    valid += item;
                });
                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    html: valid,
                    showConfirmButton: !1,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    title: data.text,
                    showConfirmButton: !1,
                    timer: 1500
                });
                setTimeout(function() {
                    window.location.reload(1);
                }, 1500);
            }
        }
    });
});

function add_group(id) {
    $.ajax({
        url: base_url + 'agent/Member/add_group',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#up_grup').html(data);
        },
    });
}
$('#group_name_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'agent/Member/update_group_data',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function(data) {
            if (data.icon == "error") {
                var valid = '';
                $.each(data.text, function(i, item) {
                    valid += item;
                });
                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    html: valid,
                    showConfirmButton: !1,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    title: data.text,
                    showConfirmButton: !1,
                    timer: 1500
                });
                setTimeout(function() {
                    window.location.reload(1);
                }, 1500);
            }
        }
    });
});