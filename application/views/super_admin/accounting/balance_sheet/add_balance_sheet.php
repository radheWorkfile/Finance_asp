<style>
     input[type=text]{ border:none;float:right;}
     input { width: 30%;}
     .hhh{padding-left:1.8rem;}
     .man-box{border-bottom:1px solid #d2d2d2;border-radius:0.5rem;}
     .man-text { margin-top:-0.5rem; }
     .f-right{float:right;}
</style>
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

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <form id="balance_sheet" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row"style="padding:1rem;">
                      
             <table class="table">
                <tr style="background-color:#d2d2d2;line-height:0.6rem;">
                    <td style="font-weight:600;">Bank / Cash</td>
                    <td>
                
                 <input class="bg-transparent size-m hhh" type="text" name="total_amo" id="total_amo" readonly value="<?php
                 if($total_amo[0]['total_amount'] != "")
                 {
                    echo $total_amo[0]['total_amount'];
                 }else{
                    echo "0.00";
                 }
                 ?>">
                
                </td>
                </tr>
            </table>


                <table class="table">   
                <tbody>
                <tr>
                <td>Income</td>
                <td>
                <input type="text" name="income_amo" id="income_amo" readonly value="<?php
                if($total_amo[0]['created_at'] == date('Y-m-d'))
                {
                    echo "0.00";
                }else{
                    echo $income_amo[0]['income_amo'];
                }
                ?>">
                </td>
                </tr>
                <tr>
                <td>Expense</td>
                <td>
                <input type="text"  name="expense_amo" id="expense_amo" readonly value="<?php 
                  if($total_amo[0]['created_at'] == date('Y-m-d'))
                  {
                      echo "0.00";
                  }else{
                    echo $expense_amo[0]['expense_amo'];
                  }
               
                ?>">
                </td>
                </tr>
                <tr>
                <td>Current Assets</td>
                <td>
                <input type="text" name="curr_assets" id="curr_assets" readonly value="<?php 
                 if($total_amo[0]['created_at'] == date('Y-m-d'))
                 {
                     echo "0.00";
                 }else{
                    echo $income_amo[0]['income_amo']-$expense_amo[0]['expense_amo'];
                 }
                ?>">
                </td>
                </tr>
                <tr>
                <td>Total Current Assets</td>
                <td>
                <input type="text" name="total_curr_ass" id="total_curr_ass" readonly value="<?php 
                 if($total_amo[0]['created_at'] == date('Y-m-d'))
                 {
                     echo "0.00";
                 }else{
                    echo $income_amo[0]['income_amo']-$expense_amo[0]['expense_amo']+$total_amo[0]['total_amount'];
                 }
               
                ?>">
                </td>
                </tr>
                </tbody>           
                </table>
                
                       
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <div class="col-md-2"></div>

</div>
<!-- end row -->

<!-- JavaScript -->
<script src="<?php echo base_url() ?>media/js/super_admin/accounting/income.js"></script>
<script src="<?php echo base_url() ?>media/old_file/js/js.js"></script>
<script>
    // $(document).ready(function(){
    //     var total_amo = $("#total_amo").val();
    //     var total_curr_ass = $("#total_curr_ass").val();
    //     var sum = parseInt(total_amo)+ parseInt(total_curr_ass);
    //     var final_amo = $("#total_amo").val(sum);
    // });

    $('#balance_sheet').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/accounting/Balance_sheet/add_balance_sheet',
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
            }else {
                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    title: data.text,
                    showConfirmButton: !1,
                    timer: 1500
                });
                setTimeout(function() {
                    window.location.reload(1);
                    window.location.href = base_url + 'super_admin/accounting/Balance_sheet';
                }, 1500);
            }
        }
    });
});
</script>