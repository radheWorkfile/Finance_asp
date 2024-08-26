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
    .heaMan{color:#fff;word-wrap:break-word;}
    .textSize{font-size:0.9rem;border:1px solid #e2e2e2;}

</style>
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div style="padding:10px;">
                <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br />
                    <div class="brAddr">Due Collection Report | <?php echo $this->session->userdata('branch_office') ?></div>
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
                <table id="profiletable" class="table align-middle table-striped table-nowrap mb-0 table-responsive">
                    <thead class="header-green">
                        <tr>
                            <th class="heaMan textSize">Sl. No.</th>  
                            <th class="heaMan textSize">Center ID</th>
                            <th class="heaMan textSize">Center Name</th>
                            <th class="heaMan textSize">Staff Name</th>
                            <th class="heaMan textSize">Clients</th>
                            <th class="heaMan textSize">Recovery</th>
                            <th class="heaMan textSize">Due Recovery</th>
                            <th class="heaMan textSize">Sum Reco</th>
                            <th class="heaMan textSize">Rec Post</th>
                            <th class="heaMan textSize">Due Post</th>
                            <th class="heaMan textSize">Receive Sum</th>
                            <th class="heaMan textSize">Rec Due</th>


                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php foreach($print_data as $pro => $profile) {  ?>
                            <tr>
                                <th class="textSize"><?php echo $pro +1; ?></th>
                                <th class="textSize"><?php echo $profile['center_id']; ?></th>
                                <th class="textSize"><?php echo $profile['center_name']; ?></th> 
                                <th class="textSize"><?php echo $profile['full_name']; ?></th>
                                <th class="textSize"><?php echo $profile['member_count']; ?></th>
                                <th class="textSize"><?php echo $profile['paid_amount']; ?></th>
                                <th class="textSize"><?php echo $profile['dues_total']; ?></th> 
                                <th class="textSize"><?php echo $profile['sum_reco']; ?></th> 
                                <th class="textSize"><?php echo $profile['rec_Posting_amo']; ?></th>
                                <th class="textSize"><?php echo $profile['due_posting']; ?></th>
                                <th class="textSize"><?php echo $profile['sum_rec_posting']; ?></th>
                                <th class="textSize"><?php echo $profile['rec_Dues']; ?></th>
                               
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br><br><br><br><br>
<p><span class="float-lg-start" style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-top:5rem;">&nbsp;&nbsp;&nbsp;&nbsp;Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-left:28rem;">&nbsp;&nbsp;&nbsp;&nbsp;B.M Signature&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>