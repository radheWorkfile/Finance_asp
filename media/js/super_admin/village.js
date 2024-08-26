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
            //$("#locTrgt").val('super_admin/master/village/cStatus');
            $("#locTrgt").val($('#minBtnActn').text());
        } else if (actNbtn == 'miBck') {
            $("#miniMize").hide();
            $("#AddNew").show();
            $("#mstrTitle").html($(this).attr('data-id'));
            $("#sbmtBtn").hide();
            $("#vCreateNew").hide();
            $("#vTbleShw").show();
            //$("#locTrgt").val('super_admin/master/village/cStatus');\
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
        var state_id = $("#state").val();
        var actNbtn = $(this).attr('id');
        var getResource = $('#base_url').val();
        if (actNbtn == 'state') {
            $('#district').html('<option>Please Wait.....</option>');
            $('#district').css('color', '#099b7e');
            $.post(getResource + "super_admin/master/cityList", { id: $('#' + actNbtn).val() }, function(htmlAmi) {
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

$('#villageMaster').submit(function(e) {
    let target = $('#base_url').val() + $('#locTrgt').val();
    $('#sbmtBtn').html('<i class="bx bx-cog bx-spin"></i> Please Wait...');
    e.preventDefault();
    $.ajax({
        url: target,
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
                $('#sbmtBtn').html('<i class="bx bx-save"></i> Submit');
            } else {

                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    title: data.text,
                    showConfirmButton: !1,
                    timer: 1500
                });
                $('#sbmtBtn').html('<i class="bx bx-save"></i> Submit');
                setTimeout(function() { window.location.reload(1); }, 1500);
            }
        }
    });
});

function manageVillage(str, target, acTyp) {
    let getResource = $('#base_url').val() + target;
    if (acTyp == 'view') { $("#sbmtBtn").hide(); } else if (acTyp == 'edit') { $("#sbmtBtn").show(); }
    $("#locTrgt").val('super_admin/master/village/editDetails');
    $("#miniMize").show();
    $("#AddNew").hide();
    $("#vTbleShw").hide();
    $("#vCreateNew").show();
    $('#target').val(str);
    $.post(getResource, { id: str, acTyp: acTyp }, function(htmlAmi) {
        setSelect('#district', htmlAmi.miData.district_id);
        setSelect('#vill_cate', htmlAmi.miData.village_category);
        setSelect('#staffID', htmlAmi.miData.staff_id);
        $("#vCode").val(htmlAmi.miData.vlg_code);
        $("#village_name").val(htmlAmi.miData.name);
        $("#distance").val(htmlAmi.miData.distance);
        $("#openingDate").val(htmlAmi.miData.open_date);
        $("#noCentr").val(htmlAmi.miData.no_center);
    }, 'json');



}

function manageFieldSchedule(str, target, acTyp) {
    let getResource = $('#base_url').val() + target;
    if (acTyp == 'view') { $("#sbmtBtn").hide(); } else if (acTyp == 'edit') { $("#sbmtBtn").show(); }
    $("#locTrgt").val('super_admin/master/field_schedule/editDetails');
    $("#miniMize").show();
    $("#AddNew").hide();
    $("#vTbleShw").hide();
    $("#vCreateNew").show();
    $('#target').val(str);
    $.post(getResource, { id: str, acTyp: acTyp }, function(htmlAmi) {
        $("#vCode").val(htmlAmi.miData.schCode);
        setSelect('#centerName', htmlAmi.miData.center_id);
        setSelect('#staffID', htmlAmi.miData.staff_id);
        $("#fSchDate").val(htmlAmi.miData.schedule_date);
        $("#dayName").val(htmlAmi.miData.schedule_day);
        $("#scheduleTime").val(htmlAmi.miData.schedule_time);
    }, 'json');

}

function manageCenter(str, target, acTyp) {
    let getResource = $('#base_url').val() + target;
    if (acTyp == 'view') { $("#sbmtBtn").hide(); } else if (acTyp == 'edit') { $("#sbmtBtn").show(); }
    $("#locTrgt").val('super_admin/master/center/editDetails');
    $("#miniMize").show();
    $("#AddNew").hide();
    $("#vTbleShw").hide();
    $("#vCreateNew").show();
    $('#target').val(str);
    $.post(getResource, { id: str, acTyp: acTyp }, function(htmlAmi) {
        $("#centerCode").val(htmlAmi.miData.center_id);
        setSelect('#villageID', htmlAmi.miData.vll_id);
        $("#center_name").val(htmlAmi.miData.center_name);
        $("#openingDate").val(htmlAmi.miData.open_date);
        setSelect('#staffID', htmlAmi.miData.staff_id);
        $("#distance").val(htmlAmi.miData.distance);
        $("#noGroup").val(htmlAmi.miData.no_of_grp);
    }, 'json');
}


function manageGroup(str, target, acTyp) {
    let getResource = $('#base_url').val() + target;
    if (acTyp == 'view') { $("#sbmtBtn").hide(); } else if (acTyp == 'edit') { $("#sbmtBtn").show(); }
    $("#locTrgt").val('super_admin/master/group/editDetails');
    $("#vTbleShw").hide();
    $("#vCreateNew").show();
    $('#target').val(str);
    $.post(getResource, { id: str, acTyp: acTyp }, function(htmlAmi) {
        $("#grpCode").val(htmlAmi.miData.grp_id);
        $("#group_name").val(htmlAmi.miData.name);
        setSelect('#centerID', htmlAmi.miData.center_id);
        $("#openingDate").val(htmlAmi.miData.create_date);
        setSelect('#staffID', htmlAmi.miData.staff_id);
    }, 'json');
}


function manageBranch(str, target, acTyp) {
    let getResource = $('#base_url').val() + target;
    if (acTyp == 'view') { $("#sbmtBtn").hide(); } else if (acTyp == 'edit') { $("#sbmtBtn").show(); }
    $("#locTrgt").val('super_admin/master/branch/editDetails');
    $("#miniMize").show();
    $("#AddNew").hide();
    $("#vTbleShw").hide();
    $("#vCreateNew").show();
    $('#target').val(str);
    $.post(getResource, { id: str, acTyp: acTyp }, function(htmlAmi) {
        var url = base_url + "employee/Dashboard";
        if (htmlAmi.icon == 'error') {
            window.location.reload();
        } else if (htmlAmi.icon == 'success') {
            window.open(url);
        }
        $("#branchCode").val(htmlAmi.miData.br_id);
        $("#branch_name").val(htmlAmi.miData.branch_name);
        $("#mobile").val(htmlAmi.miData.mobile_nu);
        $("#email").val(htmlAmi.miData.email_id);
        $("#off_addr").val(htmlAmi.miData.address);
        $("#off_addr").val(htmlAmi.miData.address);
        setSelect('#state', htmlAmi.miData.state_id);
        $("#district").html(htmlAmi.dist);
        setSelect('#district', htmlAmi.miData.district);
        $("#zipcode").val(htmlAmi.miData.zipcode);
        $("#openingDate").val(htmlAmi.miData.opening_date);
    }, 'json');
}

function setSelect(id, val) { $(id + ' option').each(function() { if ($(this).val() == val) { $(this).prop("selected", true); } }); }

function mStatus(str) {
    var getResource = $('#base_url').val() + $('#locTrgt').val();
    var datastring = "getParamtr=" + str;
    $.ajax({
        method: "POST",
        url: getResource,
        data: datastring,
        timeout: 100000,
        beforeSend: function() { $("#ms" + str).html('<i class="bx bx-cog bx-spin"></i> Wait...'); },
        complete: function() {},
        success: function(data) {
            if (data == '1') {
                $("#ms" + str).html('<i class="bx bx-lock-open-alt"></i> Active').addClass('bg-olive').removeClass('bg-orange');
                $('#defaultMsg').fadeOut();
            } else if (data == '0') {
                $("#ms" + str).html('<i class="bx bx-lock-alt"></i> Deactive').addClass('bg-orange').removeClass('bg-olive');
                $('#defaultMsg').fadeOut();
            } else {
                $('#defaultMsg').html("Oooop's Something wrong here please refresh").fadeIn();
            }
        },
        error: function() {
            alert('Ooops Something wrong here please Refresh');
        }
    });
}