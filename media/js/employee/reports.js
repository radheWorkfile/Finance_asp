var reportBranchWise = '';
$(document).ready(function() {
    let searchObj = {};
    var target = $('#target').val();
    reportBranchWise = {
        printTable: function(search_data) {
            $("#brReport").DataTable({
                "responsive": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{ 'targets': [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, ], 'orderable': true }],
                "ajax": { "url": target, "type": "POST", "dataSrc": "data", "data": search_data },
                language: { searchPlaceholder: "Product Id, Name." },
                "drawCallback": function(settings) {
                    var api = new $.fn.dataTable.Api(settings);
                    let getPrdet = api.column(0).data().length;

                    let disbAmt = 0;
                    let prFeeAmt = 0;
                    let extraAmt = 0;
                    let duesRestAmt = 0;
                    let prevEmiAmt = 0;
                    let test_1 = 0;
                    let loanMwithoutInt = 0;
                    let intPaid = 0;
                    let emi_total = 0;
                    let grAtotal = 0;

                    let disTotalAmt = 0;
                    let proFeeTotalAmt = 0;
                    for (var i = 0; i < getPrdet; i++) {
                        disbAmt += parseInt($(api.column(3).data()[i]).text());
                        prFeeAmt += parseInt($(api.column(4).data()[i]).text());
                        extraAmt += parseInt($(api.column(5).data()[i]).text());
                        duesRestAmt += parseInt($(api.column(6).data()[i]).text());
                        prevEmiAmt += parseInt($(api.column(7).data()[i]).text());
                        test_1 += parseInt($(api.column(8).data()[i]).text());
                        loanMwithoutInt += parseInt($(api.column(9).data()[i]).text());
                        intPaid += parseInt($(api.column(10).data()[i]).text());
                        emi_total += parseInt($(api.column(11).data()[i]).text());
                        grAtotal += parseInt($(api.column(12).data()[i]).text());
                        disTotalAmt += parseInt($(api.column(10).data()[i]).text());
                        proFeeTotalAmt += parseInt($(api.column(11).data()[i]).text());
                        // console.log(parseInt($(api.column(3).data()[i]).text()));
                    }
                    //         
                    $('#disbAmt').html(disbAmt);
                    $('#prFeeAmt').html(prFeeAmt);
                    $('#extraAmt').html(extraAmt);
                    $('#duesRestAmt').html(duesRestAmt);
                    $('#prevEmiAmt').html(prevEmiAmt);
                    $('#test_1').html(test_1);
                    $('#loanMwithoutInt').html(loanMwithoutInt);
                    $('#intPaid').html(intPaid);
                    $('#emi_total').html(emi_total);
                    $('#grAtotal').html(grAtotal);

                    $('#disTotalAmt').html(disTotalAmt);
                    $('#proFeeTotalAmt').html(proFeeTotalAmt);

                },
                //dom: 'Bfrtip',
                dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                "buttons": [ /*"excel","pdf","print"*/ /*{extend:'excel',text:'<i class="far fa-file-excel"></i>'}, {extend:'pdf',text:'<i class="fas fa-file-pdf"></i>'},{extend:'print',text:'<i class="fas fa-print"></i>'}*/ ]

            });
        }
    }
    reportBranchWise.printTable(searchObj);



    // ---------------------------- Fore Close Report Section Start ----------------------------------------------

    var reportForClose = '';
    reportForClose = { printTable: function(search_data) { getpaginate(search_data, '#closeLoanReport', target, 'Only For Id,Name.'); } }
    reportForClose.printTable(searchObj);

    // ---------------------------- Fore Close Report Section Start ----------------------------------------------

    $(".ActnCmdByAmi").click(function() {

        let actNbtn = $(this).attr('id');
        if (actNbtn == 'miReports') {

            let uriActn = $('#uriActn').text();

            $('#' + actNbtn).html('<i class="bx bx-cog bx-spin"></i> Please Wait...').removeClass('btn-outline-primary').addClass('btn-outline-dark');
            $.post(uriActn, { miCode: $('#miCode').val(), miActn: actNbtn, strtDt: $('#strtDt').val(), endDt: $('#endDt').val() },
                function(htmlAmi) {
                    $('#' + actNbtn).html('<i class="bx bx-search-alt"></i> Search').removeClass('btn-outline-dark').addClass('btn-outline-primary');
                    if (htmlAmi.icon == 'error') { swlToast(htmlAmi); } else {
                        if (htmlAmi.cWiseReportLn == 'cWiseReportLn') {
                            $('#miPrintReports').removeAttr('disabled');
                            $('#memCode').html(htmlAmi.member_id);
                            $('#memName').html(htmlAmi.full_name);
                            $('#gurdianName').html(htmlAmi.nominee_name);
                            $('#mCenter').html(htmlAmi.center_name + ' (' + htmlAmi.center_id + ')');
                            $('#loanPrps').html(htmlAmi.purpose);
                            $('#disbursDate').html(htmlAmi.lnDisDate);
                            $('#memLnAmt').html(htmlAmi.loanAmt + ' /-');
                            $('#miLnDetailsShow').html(htmlAmi.loanDtl);

                        } else if (htmlAmi.cWiseReportLn == 'centerReportLn') {
                            $('#miPrintReports').removeAttr('disabled');
                            $('#staffName').html(' ' + htmlAmi.full_name + '( ' + htmlAmi.center_id + ' )');
                            $('#schedule_date').html(' ' + htmlAmi.schedule_date + ' ' + htmlAmi.schedule_time);
                            $('#miLnDetailsShow').html(htmlAmi.loanDtl);
                        }
                    }
                }, 'json');
        } else if (actNbtn == 'miPrintReports') {
            let fsdfsdf = $("#miCode").val();
            let fdsfas = $("#brnacDetddddff").val(fsdfsdf);

            //let uriActn=$('#uriPrintActn').text();
            let uriActn = $('#uriActn').text();
            $('#' + actNbtn).html('<i class="bx bx-cog bx-spin"></i> Please Wait...').removeClass('btn-outline-dark').addClass('btn-outline-warning');
            $.post(uriActn, { miCode: $('#miCode').val(), miActn: actNbtn, strtDt: $('#strtDt').val(), endDt: $('#endDt').val() },
                function(htmlAmi) {

                    $('#' + actNbtn).html('<i class="bx bx-printer"></i> Print ').removeClass('btn-outline-warning').addClass('btn-outline-dark');
                    var frame1 = $('<iframe />');
                    frame1[0].name = "frame1";
                    frame1.css({ "position": "absolute", "top": "-1000000px" });
                    $("body").append(frame1);
                    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                    frameDoc.document.open();
                    frameDoc.document.write(htmlAmi);
                    frameDoc.document.close();
                    setTimeout(function() {
                        window.frames["frame1"].focus();
                        window.frames["frame1"].print();
                        frame1.remove();
                    }, 500);
                });
        } else if (actNbtn == 'miBranchWiseReports') {
            let uriActn = $('#uriActn').text();
            $('#' + actNbtn).html('<i class="bx bx-cog bx-spin"></i> Please Wait...').removeClass('btn-outline-success').addClass('btn-outline-warning');
            $.post(uriActn, { endDt: $('#endDt').val(), strtDt: $('#strtDt').val() },
                function(htmlAmi) {

                    $('#' + actNbtn).html('<i class="bx bx-printer"></i> Print ').removeClass('btn-outline-warning').addClass('btn-outline-success');
                    var frame1 = $('<iframe />');
                    frame1[0].name = "frame1";
                    frame1.css({ "position": "absolute", "top": "-1000000px" });
                    $("body").append(frame1);
                    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
                    frameDoc.document.open();
                    frameDoc.document.write(htmlAmi);
                    frameDoc.document.close();
                    setTimeout(function() {
                        window.frames["frame1"].focus();
                        window.frames["frame1"].print();
                        frame1.remove();
                    }, 500);
                });
        }
    });
});







function swlToast(data) {
    if (data.icon == "error") {
        var valid = '';
        $.each(data.text, function(i, item) { valid += item; });
        Swal.fire({ position: "top-end", icon: data.icon, html: valid, showConfirmButton: !1, timer: 1500 });
        // $('#sbmtBtn').html('<i class="bx bx-save"></i> Submit');
    } else {
        Swal.fire({ position: "top-end", icon: data.icon, title: data.text, showConfirmButton: !1, timer: 1500 });
        //$('#sbmtBtn').html('<i class="bx bx-save"></i> Submit');
        setTimeout(function() { window.location.reload(1); }, 1500);
    }

}

function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('currentClock').innerHTML = '<i class="ti-timer"></i> ' + h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);
}

function checkTime(i) { if (i < 10) { i = "0" + i }; return i; }

/** ================================= profile report details ================================= **/

$(document).ready(function() {
    let searchObj = {};
    // Reporting Section
    let reportTable = {
        printTable: function(search_data) {
            $("#profiletable").DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, ],
                    'orderable': true
                }],
                "ajax": {
                    "url": base_url + 'employee/Reports/profile_report_data',
                    "type": "POST",
                    "dataSrc": "data",
                    "data": search_data
                },
                // dom: 'Bfrtip',
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

    $('#filter_report_data').submit(function(e) {
        e.preventDefault();
        $("#profiletable").DataTable().clear().destroy();
        let search = $('#filter_report_data').serializeArray();
        let searchObj = {};
        $.each(search, function(i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
    });
})

// select2 - miCode - container  
// btn btn - outline - primary ActnCmdByAmi
$(document).ready(function() {
    $(".ActnCmdByAmi").click(function() {
        let getValue = $("#miCode").val();
        $(".ActnCmdByAmi").val(getValue);
        $.ajax({
            type: "POST",
            "url": base_url + 'employee/Reports/showData',
            data: {
                'id': getValue
            },
            dataType: "json",
            success: function(datata) {
                $('#brnacDet').html(datata.center_name);
                $('#brnacDetddd').html(datata.center_name);
                console.log(datata.center_name);
            },
        });

    });
});






/** ================================= Cash Submission report details ================================= **/

$(document).ready(function() {
    let searchObj = {};
    // Reporting Section
    let reportTable = {
        printTable: function(search_data) {
            $("#submissiontable").DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, ],
                    'orderable': true
                }],
                "ajax": {
                    "url": base_url + 'employee/Reports/cash_submission_report_data',
                    "type": "POST",
                    "dataSrc": "data",
                    "data": search_data
                },
                // dom: 'Bfrtip',
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

    $('#filter_cash_report_data').submit(function(e) {
        e.preventDefault();
        $("#submissiontable").DataTable().clear().destroy();
        let search = $('#filter_cash_report_data').serializeArray();
        let searchObj = {};
        $.each(search, function(i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
    });
})

/** ================================= OD Payment report details ================================= **/

$(document).ready(function() {
    let searchObj = {};
    // Reporting Section
    let reportTable = {
        printTable: function(search_data) {
            $("#odtable").DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, 5, 6, 7, 8],
                    'orderable': true
                }],
                "ajax": {
                    "url": base_url + 'employee/Reports/od_payment_report_data',
                    "type": "POST",
                    "dataSrc": "data",
                    "data": search_data
                },
                // dom: 'Bfrtip',
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

    $('#filter_report_data').submit(function(e) {
        e.preventDefault();
        $("#odtable").DataTable().clear().destroy();
        let search = $('#filter_report_data').serializeArray();
        let searchObj = {};
        $.each(search, function(i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
    });
})

/** ================================= Post Wise Report Section Start ================================= **/

$(document).ready(function() {
    let searchObj = {};
    // Reporting Section
    let reportTable = {
        printTable: function(search_data) {
            $("#postWiseTable").DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, 5],
                    'orderable': true
                }],
                "ajax": {
                    "url": base_url + 'employee/Reports/posting_wise_report_data',
                    "type": "POST",
                    "dataSrc": "data",
                    "data": search_data
                },
                // dom: 'Bfrtip',
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

    $('#search_report_data').submit(function(e) {
        e.preventDefault();
        $("#postWiseTable").DataTable().clear().destroy();
        let search = $('#search_report_data').serializeArray();
        let searchObj = {};
        $.each(search, function(i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
    });
})

/** ================================= Voucher report details =============================== **/

// $("#vouchertable").DataTable({
//     "responsive": true,
//     "lengthChange": false,
//     "autoWidth": false,
//     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
// }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

/** ================================= Advance Report Manage Sec Start =============================== **/

$(document).ready(function() {
    let searchObj = {};
    // Reporting Section
    let reportTable = {
        printTable: function(search_data) {
            $("#advance_rep_sec_p").DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, 5],
                    'orderable': true
                }],
                "ajax": {
                    "url": base_url + 'employee/Reports/advance_report_manage',
                    "type": "POST",
                    "dataSrc": "data",
                    "data": search_data
                },
                // dom: 'Bfrtip',
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

    $('#search_report_data').submit(function(e) {
        e.preventDefault();
        $("#advance_rep_sec_p").DataTable().clear().destroy();
        let search = $('#search_report_data').serializeArray();
        let searchObj = {};
        $.each(search, function(i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
    });
})

/** ================================= Advance Report Manage Sec end =============================== **/
/** ================================= Due Collection Report Sec Start =============================== **/

$(document).ready(function() {
        let searchObj = {};
        // Reporting Section
        let reportTable = {
            printTable: function(search_data) {
                $("#due_collection").DataTable({
                    "responsive": true,
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    'columnDefs': [{
                        'targets': [1, 2, 3, 4, 5],
                        'orderable': true
                    }],
                    "ajax": {
                        "url": base_url + 'employee/Reports/due_collection_report',
                        "type": "POST",
                        "dataSrc": "data",
                        "data": search_data
                    },
                    // dom: 'Bfrtip',
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

        $('#search_report_data').submit(function(e) {
            e.preventDefault();
            $("#advance_rep_sec_p").DataTable().clear().destroy();
            let search = $('#search_report_data').serializeArray();
            let searchObj = {};
            $.each(search, function(i, row) {
                searchObj[row.name] = row.value;
            });
            reportTable.printTable(searchObj);
        });
    })
    /** ================================= Due Collection Report Sec End =============================== **/