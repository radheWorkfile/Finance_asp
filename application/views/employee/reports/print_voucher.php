<style>

.header-green {background-color: #008288;color: #fff;}
.ami_dev{padding:10px 0px 10px 10px;background-color:#3b5998;color:#fff;border:1px solid #3b5998;text-transform:uppercase;font-weight:bold;}
.ami_dev span i{padding:5px;background-color:#fff;border-radius:5px;color:#3b5998;}
.fntClr{color:#007a80;}
.srcText{ font-weight:900;color: #8a0505;font-size: 0.75rem}
.cmpnyHedng{text-align: center;font-weight: bold;color: #0576B9;font-size: 1.6rem;line-height: 1.3;margin-bottom: 5px;text-transform: uppercase;}
.brAddr{ font-size:1rem !important;text-transform: capitalize;}
.tTyp{ font-size: 0.75rem;font-weight:bold;}
#uriActn,#uriPrintActn{ display:none;}

:root{--mi-bar-color: #229197;--mi-bar-bg-color: #fff;--mi-bar_color: #fff;}
.table-responsive:hover{scrollbar-color: var(--mi-bar-color) var(--mi-bar-bg-color);}
.table-responsive{overflow-x:scroll;scrollbar-width:thin;scrollbar-color:var(--mi-bar_color) var(--mi-bar-bg-color);padding-bottom:15px;}
.noDTfound{text-align:center;padding:10px;margin:-12px;color: #b72200;text-transform:uppercase;font-weight:bold;}

.noDTfound i{color:#fff;background-color:#b72200;padding:5px;border-radius:7px;}
#miLnDetailsShow tr td,th{ text-align:center !important;}
#miLnDetailsShow span {color:#ff6000;font-weight: bold;}
#miLnDetailsShow label {color:green;font-weight: bold;}
#miLnDetailsShow div {border-bottom: 1px dashed #000;}
.mtNtFnd div{ border-bottom: 0px dashed #000 !important;}
.partiallyPaid{ color:#3E9593 !important;}
#currentClock{ color:#345829 !important;font-size:.95rem !important;}
.tfntBld{font-weight:900;}

</style>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div style="padding:10px;">
                <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br />
                    <div class="brAddr">Weekly voucher Report | <?php echo $this->session->userdata('branch_office') ?></div>
                </div>
            </div>
            <div class="row">
                        <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                    </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6"><span class="tTyp">V. No. </span>:<span class="srcText">----------</span></div>
                    <div class="col-lg-6">
                        <div style="float:right;">
                            <span class="tTyp">Date & Time</span> : <span class="srcText"><?php echo date('d-M-Y');?>  <span id="currentClock">09:00 AM</span></span>
                        </div>
                    </div>                   
                </div>
                <table id="vouchertable" class="table table-bordered table-striped" style="width: 100%;">
                    <thead class="header-green" style="border: 1px solid black;">
                        <tr>
                            <th>S.No.</th>
                            <th>Account Head</th>
                            <th>No. Client</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody style="border: 1px solid black;">
                        <tr>
                            <th style="border: 1px solid black;">1</th>
                            <td style="border: 1px solid black;">Loan To Member A/C</td>
                            <td style="border: 1px solid black;text-align:center;"><?php echo $voucher_loan_report['total_client'] ?></td>
                            <td style="border: 1px solid black;"><?php echo $voucher_loan_report['loan_amount'] ?></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid black;">2</th>
                            <td style="border: 1px solid black;">Interest on Loan To Member A/C</td>
                            <td style="border: 1px solid black;text-align:center;"><?php echo $voucher_loan_report['total_client'] ?></td>
                            <td style="border: 1px solid black;"><?php echo $voucher_loan_report['loan_interest_amount'] ?></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid black;">3</th>
                            <td style="border: 1px solid black;">Loan To Member OD A/C</td>
                            <td style="border: 1px solid black;text-align:center;"><?php echo $voucher_od_report['total_od_client'] ?></td>
                            <td style="border: 1px solid black;"><?php echo $voucher_od_report['od_amount'] ?></td>
                        </tr>
                        <tr>
                            <th style="border: 1px solid black;">4</th>
                            <td style="border: 1px solid black;">Interest on Loan To Member OD A/C</td>
                            <td style="border: 1px solid black;text-align:center;"><?php echo $voucher_od_report['total_od_client'] ?></td>
                            <td style="border: 1px solid black;"><?php echo $voucher_od_report['od_interest_amount'] ?></td>
                        </tr>
                        <?php $total = $voucher_loan_report['loan_amount'] + $voucher_loan_report['loan_interest_amount'] + $voucher_od_report['od_amount'] + $voucher_od_report['od_interest_amount']; ?>
                        <tr>
                            <th style="border: 1px solid black;">Total</th>
                            <th colspan="2" style="border: 1px solid black;"><?php echo $get=$this->common->getIndianCurrency($total). '/-'; 
                            ?></th>
                            <th style="text-align: left; border: 1px solid black;"><?php echo "₹ ".$total; ?></th>
                        </tr>
                    </tbody>
                </table>
                <br><br><br><br><br>
<p><span class="float-lg-start" style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-top:5rem;">&nbsp;&nbsp;&nbsp;&nbsp;Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-left:27rem;">&nbsp;&nbsp;&nbsp;&nbsp;B.M Signature&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
      
    
    </div>
    <!-- end col -->
</div>