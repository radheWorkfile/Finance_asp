<style>
    .firstBox{width:70%;padding-left:1rem;}
    /* .secBox{Width:46%;text-align:center;} */
    .secBox{Width:28%;}
    .textMan{color:#0576b9;font-weight:800;}
</style>
<section style="padding:1rem;">
    <div class="container">
        <div class="row">

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Client Name</p></div>
                <div class="secBox"><p><?php echo $Mem_details['member_name'];?></p></div>
            </div>

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Loan Number </p></div>
                <div class="secBox"><p><?php echo $Mem_details['loan_no'];?></p></div>
            </div>

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Disbursed Amount </p></div>
                <div class="secBox"><p><?php echo $Mem_details['disbursed_loan'] ?></p></div>
            </div>

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Disbursed Date </p></div>
                <div class="secBox"><p><?php echo $Mem_details['disbursed_data'] ?></p></div>
            </div>

         

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Force Close Amount</p></div>
                <div class="secBox"><p><?php echo $Mem_details['foreclose_amount'] ?></p></div>
            </div>

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Fore Close Date</p></div>
                <div class="secBox"><p><?php echo $Mem_details['loan_close_date'];?></p></div>
            </div>

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Total Rec Amount</p></div>
                <div class="secBox"><p><?php echo $Mem_details['recovered_amount'] ?></p></div>
            </div>

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Lst Rec Amount</p></div>
                <div class="secBox"><p><?php echo $Mem_details['lst_rec_amount'] ?></p></div>
            </div>

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Penalty Charge</p></div>
                <div class="secBox"><p><?php echo $Mem_details['penalty_charge'] ?></p></div>
            </div>

            <div class="col-md-12"style="display:flex;">
                <div class="firstBox"><p class="textMan"> - Interest amount</p></div>
                <div class="secBox"><p><?php echo $Mem_details['interest_amount'] ?></p></div>
            </div>

          

           

        </div>
    </div>
</section>