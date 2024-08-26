
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between card flex-sm-row border-0">
            <h4 class="mb-sm-0 font-size-16 fw-bold"><?php echo $title ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                    <li class="breadcrumb-item active"><?php echo $breadcrums ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="ami_dev"><span><i class="bx bx-user"></i></span> <span id="mstrTitle">Create New Fore Closing</span></div>
    <div class="card-body">

        <form id="searchData" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3" style="float: right;">
                        <label class="form-label">Enter client Id</label>
                        <input class="form-control" type="text" name="client_id" id="client_id" placeholder="Enter Client Id"oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9,. ]/g, '').replace(/\s+/g, ' ');"maxlength="10">
                        <input class="form-control" type="hidden" name="interest_type" id="interest_type">

                    </div>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary waves-effect waves-light" style="margin-top:30px;">Search</button>
                </div>
                
            </div>
        </form>


        <form id="add_Loan_Close_data" method="post" accept-charset="utf-8" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Loan No.</label>
                        <input class="form-control" type="text" name="loan_no" id="loan_no"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                        <input class="form-control" type="hidden" name="branch_id" id="branch_id">
                        <input class="form-control" type="hidden" name="center_id" id="center_id">
                        <input class="form-control" type="hidden" name="group_id" id="group_id">
                        <input class="form-control" type="hidden" name="receipt_no" id="receipt_no">
                        <input class="form-control" type="hidden" name="lst_rec_amount" id="lst_rec_amount">
                        <!-- lstRecAmo -->
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Fore Close Date</label>
                        <input class="form-control" type="date" name="loan_close_date" value="<?php echo date('Y-m-d');?>" id="loan_close_date" value="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label">Member Id</label>
                        <input class="form-control" type="text" name="member_id" id="member_id"oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9,. ]/g, '').replace(/\s+/g, ' ');"maxlength="15">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-date-input" class="form-label">Member Name</label>
                        <input class="form-control" type="text" name="member_name" id="member_name"maxlength="25" oninput="this.value = this.value .toLowerCase() .replace(/[^a-z ]/g, '').replace(/\s+/g, ' ').replace(/\b\w/g, char => char.toUpperCase());">
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="example-number-input" class="form-label">Disbursed Loan Amount</label>
                        <input class="form-control" type="text" name="disbursed_loan" id="disbursed_loan"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                    </div>
                </div>


                  <div class="col-lg-6" style="display:none;"> 
                        <div class="mb-3">
                            <label class="form-label">Last Recovered Amount</label>
                            <input class="form-control" type="text" name="las_rec_amo" id="las_rec_amo"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label sum1">Recovered Amount</label>
                            <input class="form-control add" type="text" name="recovered_amount" id="recovered_amount"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                        </div>
                    </div>


                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label sum2">Interest Amount</label>
                        <input class="form-control add" type="text" name="interest_amount" id="interest_amount"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                    </div>
                </div>

                <?php 
                        
                ?>

                <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="example-email-input" class="form-label">Penalty Charges</label>
                            <input class="form-control sum3" type="text" name="penalty_charge" id="penalty_charge"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                        </div>
                    </div>

                <div class="col-lg-6">
                    <div class="form-check form-check-success mb-3">
                        <input class="form-check-input arvCl" type="checkbox" id="arvCl1">
                        <label class="form-check-label" for="formCheckcolor2">
                            Waiveoff Interest Amount
                        </label>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="form-check form-check-success mb-3">
                        <input class="form-check-input arvCl" type="checkbox" id="arvCl2">
                        <label class="form-check-label" for="formCheckcolor2">
                            Waiveoff Penalty Charges
                        </label>
                    </div>
                </div>

</div>
                <div class="row">
                  
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="example-number-input" class="form-label">Foreclose Amount</label>
                            <input class="form-control sum" type="text" name="foreclose_amount" id="foreclose_amount"maxlength="10" oninput="this.value = this.value.toUpperCase().replace(/[^0-9]/g, '').replace(/(\  *?)\  */g, '$1')">
                        </div>
                    </div>

                    <div class="col-lg-6">
                         <div class="mb-3">
                            <label for="example-number-input" class="form-label">Disbursed Date</label>
                            <input class="form-control" type="text" name="disbursed_data" id="disbursed_data">
                         </div>
                   </div>

                  

                   <div class="modal-footer">
                        <button type="submit" id="submit" class="btn btn-danger waves-effect waves-light claculate">calculate</button>
                    </div>

                 


                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Mode of Payment</label>
                            <select class="form-control" name="mop" id="mop">
                                <option value=""> ---- Select One ---- </option>
                                <option value="1">Online</option>
                                <option value="2">Cheque</option>
                                <option value="3">Cash</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Collector</label>
                            <select class="form-control select2" name="collector" id="collector">
                                <option value=""> ---- Select One ---- </option>
                                <?php foreach ($staff as $s) { ?>
                                    <option value="<?php echo $s['id'] ?>"><?php echo $s['full_name'] . "(" . $s['staff_id'] . ")" ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                

                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label class="form-label">Remark</label>
                            <!-- <input class="form-control" type="text" name="remark" id="remark"> -->
                            <textarea class="form-control" type="text" name="remark" id="remark" cols="30" rows="2"maxlength="80"oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9,. ]/g, '').replace(/\s+/g, ' ');"></textarea>
                        </div>
                    </div>

                </div>
                <!-- end row -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Send for Foreclose</button>
                </div>
        </form>
    </div>
</div>
<style>
    .ami_dev {
        padding: 10px 0px 10px 10px;
        background-color: #3b5998;
        color: #fff;
        border: 1px solid #3b5998;
    }

    .ami_dev span i {
        padding: 5px;
        background-color: #fff;
        border-radius: 5px;
        color: #3b5998;
    }
</style>

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/employee/staff.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>


<script>
    var base_url ='<?php echo base_url()?>';
    $('#searchData').on('submit',function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'employee/Fore_closing_loan/create_fore_closing1',
            type: "post",
            data: new FormData(this),
            processData: false,
            dataType: "json",
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {

                if(data.icon =='error')
                {  alert(data.text); }
                else{
                    var mem=data.text
                    console.log(mem.member_name);
                    $('#member_id').val(mem.mem_id);
                    $('#branch_id').val(mem.branch_id);
                    $('#center_id').val(mem.center_id);
                    $('#group_id').val(mem.group_id);
                    $('#receipt_no').val(mem.receipt_no);
                    $('#member_name').val(mem.first_name+" "+mem.mid_name+" "+mem.last_name);
                    $('#loan_no').val(mem.loan_no);
                    $('#disbursed_loan').val(mem.amount);
                    $('#recovered_amount').val(mem.PaIdAmo);
                    $('#disbursed_data').val(mem.loan_start_date);
                    $('#las_rec_amo').val(mem.paid_amount);
                    $('#interest_amount').val(mem.intAmt);
                    $('#foreclose_amount').val(mem.frclsAmt);
                    $('#lst_rec_amount').val(mem.lstRecAmoooo);
                    $('#penalty_charge').val(0);
                  
                }
            }
        });
    });
    // add_Loan_Close_data



    
     


    $("#add_Loan_Close_data").on("submit", function(e) { 
    e.preventDefault();
    $.ajax({
        url: '<?= base_url() ?>employee/Fore_closing_loan/save_closeIng_data',
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




$(document).ready(function(){
    $("#penalty_charge").keyup(function(){
        var recAmoMan =parseInt($("#recovered_amount").val());
        var intAmoMan =parseInt($("#interest_amount").val());
        var panAmoMan =parseInt($("#penalty_charge").val());
        var sum=recAmoMan+intAmoMan+panAmoMan;
        $('#foreclose_amount').val(sum);
    });
    $(".arvCl").change(function(){
        let actnBtn=$(this).attr('id');
        var interest_amount =parseInt($("#interest_amount").val());
        var penalty_charge =parseInt($("#penalty_charge").val());
        var foreclose_amount =parseInt($("#foreclose_amount").val());
        var recovered_amount =parseInt($("#recovered_amount").val());
        if(actnBtn=='arvCl1')
        {
            let newAmt=0;
            if($(this).is(':checked'))
            {
                if(($('#arvCl1').is(':checked')) && ($('#arvCl2').is(':checked'))){ newAmt=recovered_amount; }
                else { newAmt=recovered_amount+penalty_charge;}
            }
            else{ if($('#arvCl2').is(':checked')) { newAmt=recovered_amount+interest_amount;}
                  else{ newAmt=recovered_amount+penalty_charge+interest_amount; }
                } $("#foreclose_amount").val(newAmt)
        }
        else if(actnBtn=='arvCl2')
        {
            let newAmt=0;
            if($(this).is(':checked'))
            {
                if(($('#arvCl1').is(':checked')) && ($('#arvCl2').is(':checked')))
                { newAmt=recovered_amount; } else { newAmt=recovered_amount+interest_amount;}
            }
            else{ if($('#arvCl1').is(':checked'))
                    { newAmt=recovered_amount+penalty_charge;}else{ newAmt=recovered_amount+penalty_charge+interest_amount; }
                    } $("#foreclose_amount").val(newAmt)
        }
    
       
   });
   
   
$("#submit").on('change',function(){ $("foreclose_amount").html();
   if(actNbtn=='3'){$("#show").show();}else{$("#show").hide();}});});


</script>