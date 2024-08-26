function get_agent_data(id) {
    $.ajax({
        url: base_url + 'agent/Customer/get_agent_data',
        type: "POST",
        data: {
            'id': id
        },
        dataType: 'json',
        success: function(data) {

            var a = data.software;
            $('#id').val(data.id);
            $('#identifier_number').val(data.mobile_no);
            $('#identifier_email').val(data.email);

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

                    "url": base_url + 'agent/Customer/approve_customer_data',
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

$('#add_customer_data').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'agent/Customer/add_customer_data',
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
                    window.location.href = base_url + 'agent/Customer/manage_customer';
                }, 1500);
            }
        }
    });
});

function view_customer(id) {

    $.ajax({
        url: base_url + 'agent/Customer/view_customer',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_customer').html(data);
        },
    });

}

function view_pending_response(id) {

    $.ajax({
        url: base_url + 'agent/Customer/view_pending_response',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_pending_response').html(data);
        },
    });

}

function view_approve_response(id) {

    $.ajax({
        url: base_url + 'agent/Customer/view_approve_response',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_approve_response').html(data);
        },
    });

}

function view_reject_response(id) {

    $.ajax({
        url: base_url + 'agent/Customer/view_reject_response',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_reject_response').html(data);
        },
    });

}

function update_customer(id) {
    $.ajax({
        url: base_url + 'agent/Customer/update_customer',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#up_customer').html(data);
        },
    });
}

$('#customer_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'agent/Customer/update_basic_customer_data',
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