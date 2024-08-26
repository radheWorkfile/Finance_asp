<input type="hidden" id="base_url" value="<?php echo base_url();?>" />
<!-- JAVASCRIPT -->
<script src="<?php echo base_url() ?>media/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/metismenu/metisMenu.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/simplebar/simplebar.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/node-waves/waves.min.js"></script>

<!-- apexcharts -->
<!--<script src="<?php echo base_url() ?>media/libs/apexcharts/apexcharts.min.js"></script>-->

<!-- Sweet Alerts js -->
<script src="<?php echo base_url() ?>media/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="<?php echo base_url() ?>media/js/pages/sweet-alerts.init.js"></script>

<!-- dashboard init -->
<!--<script src="<?php echo base_url() ?>media/js/pages/dashboard.init.js"></script>-->

<!-- App js -->
<script src="<?php echo base_url() ?>media/js/app.js"></script>

<!-- Required datatable js -->
<script src="<?php echo base_url() ?>media/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Buttons examples -->
<script src="<?php echo base_url() ?>media/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/jszip/jszip.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>media/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/datatables.net-keyTable/js/dataTables.keyTable.min.html"></script>
<script src="<?php echo base_url() ?>media/libs/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/select2/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>media/js/pages/form-advanced.init.js"></script>

<!-- Responsive examples -->
<script src="<?php echo base_url() ?>media/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>media/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="<?php echo base_url() ?>media/js/pages/datatables.init.js"></script>

<!-- jquery step -->
<script src="<?php echo base_url() ?>media/libs/jquery-steps/build/jquery.steps.min.js"></script>
<!-- form wizard init -->
<script src="<?php echo base_url() ?>media/js/pages/form-wizard.init.js"></script>
<script>

function getpaginate(search_data,id,page,plchldr)//id,page,placehldr
{	 
    var base_url=$('#base_url').val();	//"responsive": true,
	$(id).DataTable({"processing": true,"serverSide": true,"order": [],"bDestroy": true,'columnDefs': [{'targets': [1, 2, 3],'orderable': true}],
                "ajax":{"url": base_url+page,"type": "POST", "dataSrc": "data","data": search_data},
                language:{searchPlaceholder:plchldr},
                // dom: 'Bfrtip',
                dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "buttons": []/*"excel", "pdf", "print"*/
            });
	}
function get_search(tbactn,frmId,tbstorage)
{$(frmId).submit(function (e){e.preventDefault(); $(tbstorage).DataTable().clear().destroy();let search = $(frmId).serializeArray();let searchObj={};
$.each(search,function (i,row){searchObj[row.name]=row.value;});tbactn.printTable(searchObj);$('html,body').animate({scrollTop:$(tbstorage).offset().top},'slow');});}


function validatePAN(input) {
let value = input.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
let formattedValue = '';let lettersPart = value.slice(0, 5).replace(/[^A-Z]/g, '');
formattedValue += lettersPart;let digitsPart = value.slice(lettersPart.length, lettersPart.length + 4).replace(/[^0-9]/g, '');formattedValue += digitsPart;
if (formattedValue.length == 9) {let lastLetterPart = value.slice(lettersPart.length + digitsPart.length, lettersPart.length + digitsPart.length + 1).replace(/[^A-Z]/g, '');formattedValue += lastLetterPart; }input.value = formattedValue;
} function validateIFSC(input) {let value = input.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
let formattedValue = '';let lettersPart = value.slice(0, 4).replace(/[^A-Z]/g, '');
formattedValue += lettersPart;let digitsPart = value.slice(lettersPart.length, lettersPart.length + 7).replace(/[^0-9]/g, '');formattedValue += digitsPart;input.value = formattedValue;}
function validateEmail(input) {input.value = input.value.toUpperCase().replace(/[^a-zA-Z@.]/g, '');const emailPattern = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i;const errorMessage = document.getElementById('error-message');if (!emailPattern.test(input.value)) {errorMessage.textContent = "Invalid email address.";
} else {errorMessage.textContent = "";}}
</script>



