// ===================================== Expense Category section start ======================================

$(document).ready(function() {
    let searchObj = {};
    // Reporting Section
    let reportTable = {
        printTable: function(search_data) {
            $("#expense_category").DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, ],
                    'orderable': true
                }],

                "ajax": {

                    "url": base_url + 'super_admin/category/Expense/manage_expense',
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

$('#expenseListMan').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/category/Expense/create_expense',
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

function view_manage_expense(id) {
    $.ajax({
        url: base_url + 'super_admin/category/Expense/view_manage_expense',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_expense_category').html(data);
        },
    });
}

function update_manage_expense(id) {
    $.ajax({
        url: base_url + 'super_admin/category/Expense/update_expense',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#update_expense').html(data);
        },
    });
}

$('#expense_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/category/Expense/expense_updata',
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


// ===================================== Expense Category section end ======================================



// ========================== Miscellaneous expense_category section start ===================================

$(document).ready(function() {
    let searchObj = {};
    // Reporting Section
    let reportTable = {
        printTable: function(search_data) {
            $("#mis_expense_category").DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, ],
                    'orderable': true
                }],

                "ajax": {

                    "url": base_url + 'super_admin/category/Expense/miscellaneous_expense_man',
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

$('#createMisExp').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/category/Expense/create_mis_expense',
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

function view_mis_expense(id) {
    $.ajax({
        url: base_url + 'super_admin/category/Expense/view_mis_expense',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#view_mis_expense').html(data);
        },
    });
}




function update_mis_expense(id) {
    $.ajax({
        url: base_url + 'super_admin/category/Expense/update_mis_expense',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#update_mis_expense').html(data);
        },
    });
}

$('#mis_expense_update').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/category/Expense/mis_expense_update',
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


// ========================== add_expense section start of accounting part ===================================== 
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


$('#exp').on('change', function() {
    let expense = this.value;
    if (expense == 1) {
        $('#expense').show('slow');
        $('#miscellaneous_exp').hide('slow');
    } else if (expense == 2) {
        $('#expense').hide('slow');
        $('#miscellaneous_exp').show('slow');
    } else {
        $('#expense').hide('slow');
        $('#miscellaneous_exp').hide('slow');
    }
});

function upload_proof(proof_id) {

    if (proof_id == 0) {

        $('#proof_image_section').hide('slow');

    } else {
        $('#proof_image_section').show('slow');
    }
}

$('#addExpenseDetails').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/category/Expense/expense_details',
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

// ========================== add_expense section start of accounting end =====================================


// ========================== manage expense section start of accounting start =================================
// ========================== manage expense section start of accounting end  =================================