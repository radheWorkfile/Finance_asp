var reportEmployee = '';
$(document).ready(function() {

    let searchObj = {};
    var target = $('#target').val();
    reportEmployee = { printTable: function(search_data) { getpaginate(search_data, '#villagetable', target, 'Only For Id,Name.'); } }
    reportEmployee.printTable(searchObj);
    $(".miAction").click(function() {

        let actNbtn = $(this).attr('id');
        if (actNbtn == 'AddNew') {
            $("#AddNew").hide();
            $("#miniMize").show();
            $("#mstrTitle").html($(this).attr('data-id'));
            $(".miCln").val('');
            $("#vTbleShw").hide();
            $("#vCreateNew").show();
            $(".mIsCode").val($('#nCreateCode').text());
            $("#locTrgt").val($('#adBtnActn').text());
        } else if (actNbtn == 'miniMize') {
            $("#miniMize").hide();
            $("#AddNew").show();
            $("#mstrTitle").html($(this).attr('data-id'));
            $("#vCreateNew").hide();
            $("#vTbleShw").show();
            //$("#locTrgt").val('employee/master/village/cStatus');
            $("#locTrgt").val($('#minBtnActn').text());
        } else if (actNbtn == 'miBck') {
            $("#miniMize").hide();
            $("#AddNew").show();
            $("#mstrTitle").html($(this).attr('data-id'));
            $("#sbmtBtn").hide();
            $("#vCreateNew").hide();
            $("#vTbleShw").show();
            $("#locTrgt").val($('#minBtnActn').text());
        } else if (actNbtn == 'changeAmPm' || actNbtn == 'changePmAm') {
            let getAMpm = $('#schTimeType').val();
            if (getAMpm == 'AM') { $('#schTimeType').val('PM'); } else { $('#schTimeType').val('AM'); }
            let curentTime = $('#schHour').val() + ":" + $('#schMinute').val() + ":00 " + $('#schTimeType').val();
            $('#scheduleTime').val(curentTime);
        } else if (actNbtn == 'minuteUp') {
            let getAMpm = $('#schMinute').val();
            if (getAMpm < 59) { let increment = parseInt(getAMpm) + parseInt(1); if (increment < 10) { $('#schMinute').val("0" + increment); } else { $('#schMinute').val(increment); } }
            let curentTime = $('#schHour').val() + ":" + $('#schMinute').val() + ":00 " + $('#schTimeType').val();
            $('#scheduleTime').val(curentTime);
        } else if (actNbtn == 'minuteDown') {
            let getAMpm = $('#schMinute').val();
            if (getAMpm > 0) {
                let increment = parseInt(getAMpm) - parseInt(1);
                if (increment < 10) { $('#schMinute').val("0" + increment); } else { $('#schMinute').val(increment); }
                let curentTime = $('#schHour').val() + ":" + $('#schMinute').val() + ":00 " + $('#schTimeType').val();
                $('#scheduleTime').val(curentTime);
            }
        } else if (actNbtn == 'hourUp') {
            let getAMpm = $('#schHour').val();
            if (getAMpm < 12) {
                let increment = parseInt(getAMpm) + parseInt(1);
                if (increment < 10) { $('#schHour').val("0" + increment); } else { $('#schHour').val(increment); }
                let curentTime = $('#schHour').val() + ":" + $('#schMinute').val() + ":00 " + $('#schTimeType').val();
                $('#scheduleTime').val(curentTime);
            }
        } else if (actNbtn == 'hourDown') {
            let getAMpm = $('#schHour').val();
            if (getAMpm > 1) {
                let increment = parseInt(getAMpm) - parseInt(1);
                if (increment < 10) { $('#schHour').val("0" + increment); } else { $('#schHour').val(increment); }
                let curentTime = $('#schHour').val() + ":" + $('#schMinute').val() + ":00 " + $('#schTimeType').val();
                $('#scheduleTime').val(curentTime);
            }
        }
    });

    $(".empSelectR").change(function() {
        var actNbtn = $(this).attr('id');
        var getResource = $('#base_url').val();
        if (actNbtn == 'state') {
            $('#district').html('<option>Please Wait.....</option>');
            $('#district').css('color', '#099b7e');
            $.post(getResource + "employee/master/cityList", { id: $('#' + actNbtn).val() }, function(htmlAmi) {
                $('#district').html(htmlAmi);
                $('#district').css('color', 'rgb(62, 62, 62)')
            });
        } else if (actNbtn == 'fSchDate') {
            const date_str = $('#fSchDate').val();
            const date = new Date(date_str);
            const full_day_name = date.toLocaleDateString('default', { weekday: 'long' });
            $('#dayName').val(full_day_name);
        }
    });

});



/* ==================================== OD Section =============================================== */


$(document).ready(function() {
    let searchObj = {};
    let reportTable = {
        printTable: function(search_data) {
            $("#dayEnd").DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4, 5, ],
                    'orderable': true
                }],
                "ajax": {

                    "type": "POST",
                    "url": base_url + 'employee/Day_end/manage_day_end',
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

function update_is_od(id) {
    $.ajax({
        type: "POST",
        url: base_url + 'employee/day_end/update_is_od',
        data: {
            'id': id
        },
        success: function(data) {
            console.log(data);
            window.location.reload(true);
        },
    });
}

function update_recovery_conformation(id) {
    $.ajax({
        url: base_url + 'employee/Day_end/recovery_posting_conformation',
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
        url: base_url + 'employee/Day_end/update_recovery_posting_data',
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
        url: base_url + 'employee/Day_end/remove_od',
        type: "POST",
        data: {
            'id': id
        },
        success: function(data) {

            $('#remove_od_details').html(data);
        },
    });

}


$('#remove_od_updata').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'employee/Day_end/remove_od_data',
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