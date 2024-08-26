$('#user_search').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/Loan/fetched_loan_data',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            $('#user_data').html(data);
        }
    });
});

function view_chrt_fxd(value) {
    if (value == 1) {
        $('#btn_fixed').show('slow');
        $('#btn_reducing').hide('slow');
    }
}

function view_chrt_reducng(value) {

    if (value == 2) {
        $('#btn_reducing').show('slow');
        $('#btn_fixed').hide('slow');
    }

}

function loan_product_data(id) {

    $.ajax({
        url: base_url + 'super_admin/Loan/get_loan_product_data',
        type: "POST",
        data: {
            'id': id
        },
        dataType: 'json',
        success: function(data) {
            $('#amount').val(data.amount);
            $('#roi').val(data.interest_percentage + data.interest_amount);
            $('#interest_type').val(data.interest_type);
            var int_type = data.interest_type;
            if (int_type == 1) {
                $('#reducing_section').show('slow')
            } else {
                $('#reducing_section').hide('slow');
                $('#btn_reducing').hide('slow');
            }
        },
    });
}

// Fixed EMI Section
$("#view_chart_btn_fixed").on('click', function() {
    $('.view_chart_fixed').show('slow');

    var amt = $('#amount').val();
    var tenure = parseInt($('#tenure').val());
    var tenure_type = $('#tenure_type').val();
    var roi_amt = $('#roi').val();
    var roi_type = $('#interest_type').val();
    var st_date = $('#loan_start_date').val()
    var start_date = new Date(st_date);
    var strt_dt = start_date.getDate();
    var start_week = start_date.getDate() + 7;
    var start_month = start_date.getMonth() + 1;
    var start_year = start_date.getFullYear();
    start_date.setMonth(start_date.getMonth() + 1);

    if (tenure_type == 1) {

        var Payment_start_date = (start_date.getDate() + 1) + '/' + start_date.getMonth() + '/' + start_date.getFullYear();
    } else if (tenure_type == 2) {

        var Payment_start_date = (start_date.getDate() + 7) + '/' + start_date.getMonth() + '/' + start_date.getFullYear();
    } else if (tenure_type == 3) {

        var Payment_start_date = start_date.getDate() + '/' + (start_date.getMonth() + 1) + '/' + start_date.getFullYear();
    }

    if (roi_type == 1) {

        if (tenure_type == 1) {

            var intrst_amt_multiple = amt * roi_amt / 100;
            var intrst_amt = intrst_amt_multiple / 30;
        } else if (tenure_type == 2) {

            var intrst_amt_multiple = amt * roi_amt / 100;
            var intrst_amt = intrst_amt_multiple / 7;
        } else if (tenure_type == 3) {

            var intrst_amt_multiple = amt * roi_amt / 100;
            var intrst_amt = intrst_amt_multiple / 12;
        }

    } else if (roi_type == 2) {

        var intrst_amt = roi_amt;
    }

    var prin_amt = amt / tenure;
    var principal_amt = amt;

    var emi_amt = parseInt(intrst_amt) + parseInt(prin_amt);

    let i = 0;
    let str = '';
    principal_amt = principal_amt;
    let primary = prin_amt;
    var last_principal_amt = 0;
    var lastPrimary = 0;

    let dt = start_date.setDate(start_date.getDate() + 7);
    for (i = 1; i <= tenure; i++) {

        if (tenure_type == 1) {

            strt_dt++;
        } else if (tenure_type == 2) {

            var repeat_date = 7 * i - 7;
            var last = new Date(dt);
            last.setDate(last.getDate() + repeat_date);
        } else if (tenure_type == 3) {

            start_month++;
        }

        if (i > 1) {

            principal_amt = parseFloat(principal_amt) - parseFloat(Math.abs(primary));
            if (start_month > 12) {

                start_year++;

            }

            if (tenure_type == 3 || tenure_type == 1) {

                start_month = start_month > 12 ? start_month - 12 : start_month;
                if (strt_dt == 32) {

                    start_month++;
                    strt_dt = strt_dt > 31 ? strt_dt - 31 : strt_dt;
                } else if (strt_dt == 31) {

                    strt_dt = strt_dt > 31 ? strt_dt - 30 : strt_dt;
                }
                Payment_start_date = strt_dt + '/' + start_month + '/' + start_year;

            }

            if (tenure_type == 2) {

                Payment_start_date = last.getDate() + '/' + last.getMonth() + '/' + last.getFullYear();
            }

        }

        if (i == tenure) {

            primary = principal_amt;
        }

        balance_amt = principal_amt - primary;
        str += `<tr><td>${i}</td><td>${Payment_start_date}</td><td >${Math.round(principal_amt)}</td><td>${(Math.round(emi_amt))}</td><td>${Math.round(intrst_amt)}</td><td>${Math.round(primary)}</td><td>${Math.round(balance_amt)}</td></tr>`;

    }
    $('#emi_chart_fixed').html(str);
});

// Reducing EMI
$("#view_chart_btn_reducing").on('click', function() {
    $('.view_chart_reducing').show('slow');

    var amt = $('#amount').val();
    var tenure_type = $('#tenure_type').val();
    var tenure = parseInt($('#tenure').val());
    var roi_amt = $('#roi').val();
    var roi_type = $('#interest_type').val();
    var st_date = $('#loan_start_date').val();
    var start_date = new Date(st_date);
    var strt_dt = start_date.getDate();
    var start_week = start_date.getDate() + 7;
    let start_month = start_date.getMonth() + 1;
    let start_year = start_date.getFullYear();
    start_date.setMonth(start_date.getMonth() + 1);

    if (tenure_type == 1) {

        var Payment_start_date = (start_date.getDate() + 1) + '/' + start_date.getMonth() + '/' + start_date.getFullYear();
    } else
    if (tenure_type == 2) {

        var Payment_start_date = (start_date.getDate() + 7) + '/' + start_date.getMonth() + '/' + start_date.getFullYear();
    } else if (tenure_type == 3) {

        var Payment_start_date = start_date.getDate() + '/' + (start_date.getMonth() + 1) + '/' + start_date.getFullYear();
    }

    if (tenure_type == 1) {

        var effe_intrst_amt = roi_amt / (100 * 30);
    } else if (tenure_type == 2) {

        var effe_intrst_amt = roi_amt / (100 * 7);
    } else if (tenure_type == 3) {

        var effe_intrst_amt = roi_amt / (100 * 12)
    }

    var emi_amt = ((amt * effe_intrst_amt) * ((Math.pow(1 + effe_intrst_amt, tenure)) / (Math.pow(1 + effe_intrst_amt, tenure) - 1)));

    var intrest_paid = (amt * effe_intrst_amt);

    var prin_amt = (emi_amt - intrest_paid);
    var principal_amt = amt;
    balance = principal_amt - prin_amt;
    let i = 0;
    let str = '';
    principal_amt = principal_amt;
    let primary = prin_amt;
    var last_principal_amt = 0;
    var lastPrimary = 0;
    var counter = 1;

    let dt = start_date.setDate(start_date.getDate() + 7);
    for (i = 0; i < tenure; i++) {

        if (tenure_type == 1) {

            strt_dt++;
        } else if (tenure_type == 2) {

            var repeat_date = 7 * i;
            var last = new Date(dt);
            last.setDate(last.getDate() + repeat_date);
        } else if (tenure_type == 3) {

            start_month++;
        }

        if (i > 0) {

            principal_amt = parseFloat(principal_amt) - parseFloat(Math.abs(primary));
            intrest_paid = Math.round(principal_amt * effe_intrst_amt);
            primary = Math.round(emi_amt - intrest_paid);
            balance = principal_amt - primary;

            if (start_month > 12) {

                start_year++;

            }

            if (tenure_type == 3 || tenure_type == 1) {

                start_month = start_month > 12 ? start_month - 12 : start_month;
                if (strt_dt == 32) {

                    start_month++;
                    strt_dt = strt_dt > 31 ? strt_dt - 31 : strt_dt;
                } else if (strt_dt == 31) {

                    strt_dt = strt_dt > 31 ? strt_dt - 30 : strt_dt;
                }
                Payment_start_date = strt_dt + '/' + start_month + '/' + start_year;

            }

            if (tenure_type == 2) {

                Payment_start_date = last.getDate() + '/' + last.getMonth() + '/' + last.getFullYear();
            }

            if (i == tenure - 1) {

                emi_amt = parseFloat(principal_amt) + parseFloat(intrest_paid);
                primary = principal_amt;
                balance = balance < 0 ? balance : 0;
                balance = balance > 0 ? balance : 0;

            }

        }
        str += `<tr><td>${parseInt(i) + parseInt(counter)}</td><td>${Payment_start_date}</td><td >${Math.round(principal_amt)}</td><td>${Math.round(emi_amt)}</td><td>${Math.round(intrest_paid)}</td><td>${Math.round(primary)}</td><td>${Math.round(balance)}</td></tr>`;
    }
    $('#emi_chart_reducing').html(str);
});

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

                    "url": base_url + 'super_admin/Loan/all_loan_data/',
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

$('#add_loan_data').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/Loan/add_loan_data',
        type: "POST",
        data: $(this).serialize(),
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
                    window.location.href = base_url + 'super_admin/Loan/manage_loan';
                }, 1500);
            }
        }
    });
});

function view_loan_details(id) {

    $.ajax({

        url: base_url + 'super_admin/Loan/view_loan_details',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_loan').html(data);
        },

    });

}

function update_loan_details(id) {

    $.ajax({
        url: base_url + 'super_admin/Loan/update_loan_details',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#up_loan').html(data);
        },
    });

}

$('#loan_updata').submit(function(e) {

    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/Loan/update_loan_data',
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