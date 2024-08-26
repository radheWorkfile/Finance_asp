/* ============================================================ Posting Section ============================================================ */

$(document).ready(function() {
    let searchObj = {};

    let reportTable = {

        printTable: function(search_data) {

            $("#paidtable").DataTable({

                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, 5, ],
                    'orderable': true
                }],

                "ajax": {

                    "url": base_url + 'employee/Transaction/all_recovery_posting_data',
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
    $('#filter_recovery_date').submit(function(e) {
        e.preventDefault();
        $("#paidtable").DataTable().clear().destroy();
        let search = $('#filter_recovery_date').serializeArray();
        let searchObj = {};
        $.each(search, function(i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
        center_id = $('#center').val();
        $('#psCenterId').val(center_id);
    });
});

$('#postingDAta').on("submit", function(e) {
    e.preventDefault();
    var id = $('#psCenterId').val();
    $.ajax({
        url: base_url + 'employee/Transaction/save_posting_data',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            console.log(data);
            window.location.reload(1);
        },
    });
});

function update_recovery_conformation(id) {
    $.ajax({
        url: base_url + 'employee/Transaction/recovery_posting_conformation',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#up_details').html(data);
        },
    });
}

$('#recovery_conformation_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'employee/Transaction/update_recovery_posting_data',
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

function remove_od(id) {
    $.ajax({
        url: base_url + 'employee/Transaction/remove_od',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#remove_od_details').html(data);
        },
    });

}

function adv_payment(id) {
    $.ajax({
        url: base_url + 'employee/Transaction/manage_adv_payment',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#adv_payment_details').html(data);
        },
    });
}




$('#adv_payment_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'employee/Transaction/adv_payment_updata',
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



$('#remove_od_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'employee/Transaction/remove_od_data',
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

/* ============================================================ OD Section ============================================================ */
$(document).ready(function() {
    let searchObj = {};

    let reportTable = {

        printTable: function(search_data) {

            $("#odtable").DataTable({

                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, ],
                    'orderable': true
                }],

                "ajax": {

                    "url": base_url + 'employee/Transaction/all_od_posting_data',
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
    $('#filter_od_data').submit(function(e) {
        e.preventDefault();
        $("#odtable").DataTable().clear().destroy();
        let search = $('#filter_od_data').serializeArray();
        let searchObj = {};
        $.each(search, function(i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
    });

});





function update_od_recovery_conformation(id) {

    $.ajax({
        url: base_url + 'employee/Transaction/recovery_od_conformation',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#up_od_recovery').html(data);
        },
    });

}

$('#od_recovery_conformation_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'employee/Transaction/update_recovery_od_data',
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
$(document).ready(function() {
    let searchObj = {};

    let reportTable = {

        printTable: function(search_data) {

            $("#advRecData").DataTable({

                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, ],
                    'orderable': true
                }],

                "ajax": {

                    "url": base_url + 'employee/Transaction/all_ad_posting_data',
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
    $('#filter_ad_data').submit(function(e) {
        e.preventDefault();
        $("#advRecData").DataTable().clear().destroy();
        let search = $('#filter_ad_data').serializeArray();
        let searchObj = {};
        $.each(search, function(i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
    });

});

function update_ad_recovery_conformation(id) {
    $.ajax({
        url: base_url + 'employee/Transaction/recovery_ad_conformation',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#up_ad_recovery').html(data);
        },
    });
}


$('#ad_recovery_conformation_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'employee/Transaction/update_recovery_ad_data',
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