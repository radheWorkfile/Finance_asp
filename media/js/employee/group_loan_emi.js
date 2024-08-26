function view_group_loan_emi_details(id) {

    $.ajax({

        url: base_url + 'employee/Group_loan/view_group_loan_emi_details',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_group_loan_emi').html(data);
        },

    });

}

function pay_group_loan_emi(id) {

    $.ajax({
        url: base_url + 'employee/Group_loan/pay_group_loan_emi',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#group_loan_emi_data').html(data);
        },
    });

}

$('#group_loan_emi_updata').submit(function(e) {

    e.preventDefault();
    $.ajax({
        url: base_url + 'employee/Group_loan/add_pay_group_loan_emi_data',
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

function view_group_loan_paid_emi(id) {

    $.ajax({

        url: base_url + 'employee/Group_loan/view_group_loan_paid_emis',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#show_group_loan_paid_emi').html(data);
        },

    });

}

function grp_loan_paid_emi_print_bill(id) {

    $.ajax({
        url: base_url + 'employee/Group_loan/group_loan_paid_emi_print_bill',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            popup(data);
        },
    });

}

function popup(data) {
    
    var base_url = '<?php echo base_url() ?>';
    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({
        "position": "absolute",
        "top": "-1000000px"
    });
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
    frameDoc.document.open();
    //Create a new HTML document.
    frameDoc.document.write('<html>');
    frameDoc.document.write('<head>');
    frameDoc.document.write('<title></title>');
    frameDoc.document.write('</head>');
    frameDoc.document.write('<body>');
    frameDoc.document.write(data);
    frameDoc.document.write('</body>');
    frameDoc.document.write('</html>');
    frameDoc.document.close();
    setTimeout(function() {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
    }, 500);
    return true;

}

function refresh_paid_emi(id) {

    $.ajax({

        url: base_url + 'employee/Group_loan/refresh_paid_emi_data',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#refresh_paid_emi_data').html(data);
        },

    });

}

$('#refresh_paid_emi_datas').submit(function(e) {

    e.preventDefault();
    $.ajax({
        url: base_url + 'employee/Group_loan/update_refresh_paid_emi_data',
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

function refresh_disburse_loan(id) {

    $.ajax({
        url: base_url + 'employee/Group_loan/refresh_disbursmnet_data',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {
            $('#refresh_disburse_loan_data').html(data);
        },
    });

}

$('#refresh_disburse_loan').submit(function(e) {

    e.preventDefault();
    $.ajax({
        url: base_url + 'employee/Group_loan/update_refresh_disburse_data',
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