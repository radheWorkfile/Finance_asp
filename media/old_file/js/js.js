// function changeStatus(id, status, table, loader) {
//     if (confirm("Do You Want To Changes")) {
//         $("#" + id).html('<img src="' + base_url + '/media/images/loading.gif" style="width:57px;" />');
//         $.ajax({
//             type: 'POST',
//             url: base_url + loader,
//             data: { 'id': id, 'status': status, 'table': table, 'loader': loader },
//             success: function(data) {
//                 $("#" + id).html(data);
//                 // console.log(data);
//             }
//         })
//     }
// }

function changeStatus(id, status, table, loader) {
    if (confirm("Do You Want To Changes")) {
        $("#" + id).html('<img src="' + base_url + 'media/images/loading.gif" style="width:57px;" />');
        $.ajax({
            type: 'POST',
            url: base_url + loader,
            data: { 'id': id, 'status': status, 'table': table, 'loader': loader },
            success: function(data) {
                $("#" + id).html(data);
                setTimeout(location.reload.bind(location), 500);
            }
        })
    }
}