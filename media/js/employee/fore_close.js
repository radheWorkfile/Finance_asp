var reportDAttendnce = '';
$(document).ready(function() {
    let searchObj = {};
    var target = $('#target').val();
    reportDAttendnce = { printTable: function(search_data) { getpaginate(search_data, '#leadtable', target, 'Only For Id, Name.'); } }
    reportDAttendnce.printTable(searchObj);

});

function view_data(id) {
    //
    (id);
    let target = $('#base_url').val() + 'employee/Fore_closing_loan/view_data';
    $.ajax({
        type: "POST",
        url: target,
        data: {
            'id': id
        },
        success: function(data) {
            console.log(data);
            $('#viewDetails').html(data);
        },
    });
}

function changeLoanStatus(id, status, table, loader) {

    if (confirm("Do You Want To Changes")) {
        $("#" + id).html('<img src="' + base_url + 'media/images/loading.gif" style="width:57px;" />');
        $.ajax({
            type: 'POST',
            url: base_url + loader,
            data: { 'id': id, 'status': status, 'table': table, 'loader': loader },
            success: function(data) {
                $("#" + id).html(data);
                // console.log(data);
                //setTimeout(location.reload.bind(location), 500);
            }
        })
    }
}