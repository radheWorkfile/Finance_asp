$('#mop').on('change', function() {
    let mode = this.value;
    if (mode == 1) {

        $('#cash_received_section').show('slow');
        $('#received_acc_section').hide('slow');

    } else if (mode == 2 || mode == 3) {

        $('#received_acc_section').show('slow');
        $('#cash_received_section').hide('slow');

    } else {

        $('#received_acc_section').hide('slow');
        $('#cash_received_section').hide('slow');

    }
});

function upload_proof(proof_id) {

    if (proof_id == 0) {

        $('#proof_image_section').hide('slow');

    } else {
        $('#proof_image_section').show('slow');

    }

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

                    "url": base_url + 'super_admin/Agent/agent_data',
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


$('#add_income_data').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/accounting/income/add_income_data',
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
                    window.location.href = base_url + 'super_admin/accounting/Income/manage_incomes';
                }, 1500);
            }
        }
    });
});

function view_agent(id) {
    $.ajax({
        url: base_url + 'super_admin/Agent/view_agent_data',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_agent').html(data);
        },
    });
}

function update_agent(id) {
    $.ajax({
        url: base_url + 'super_admin/Agent/update_agent',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#up_agent').html(data);
        },
    });
}

$('#agent_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/Agent/update_agent_data',
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
        url: base_url + 'super_admin/Agent/add_group',
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
        url: base_url + 'super_admin/Agent/update_group_data',
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