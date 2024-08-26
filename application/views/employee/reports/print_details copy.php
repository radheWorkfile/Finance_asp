<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>&nbsp;</title>
    <link href="<?php echo base_url('media/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <style>
        * {
            color-adjust: exact;
            -webkit-print-color-adjust: exact; 
            print-color-adjust: exact;
        }

        #miLnDetailsShow {
            border: 1px solid black;
            line-height: 0;
        }

        .myTparGrf {
            border: 2px solid #000 !important;
            padding: 0.5em;
            color: green;
            text-align: center;
            background-color: #999999 !important;
        }

        body {
            <?php if ($miActn == 'clientWiseLoanReport') { ?>margin: 3mm 8mm 8mm 3mm;
            <?php } else { ?>margin: 8mm 8mm 8mm 8mm;
            <?php } ?>
        }

        .noDTfound {
            text-align: center;
            padding: 10px;
            margin: -12px;
            color: #b72200;
            text-transform: uppercase;
            font-weight: bold;
            background-color: #fff !important;
        }

        .header-green {
            background-color: #008288;
            color: #fff;
        }

        .srcText {
            font-weight: 900;
            color: #8a0505;
            font-size: 0.75rem
        }

        .cmpnyHedng {
            /* text-align: center; */
            /* margin-left:6rem; */
            font-weight: bold;
            color: #0576B9;
            font-size: 1.6rem;
            line-height: 1.3;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .brAddr {
            font-size: 1rem !important;
            text-transform: capitalize;
        }

        .tTyp {
            font-size: 0.75rem;
            font-weight: bold;
        }

        .ctTyp {
            font-size: 1rem;
            font-weight: bold;
        }

        .cSrcText {
            font-weight: 900;
            color: #8a0505;
            font-size: 1rem
        }

        @media print {
            @page {
                margin: 0;
            }

            body {
                display: table;
                table-layout: fixed;
                padding-top: 10px;
                padding-bottom: 10px;
                height: auto;
            }

            .container {
                display: inline;
            }
        }
    </style>

</head>

<body>
    <?php if ($miActn == 'clientWiseLoanReport') { ?>
        <!---------------------------------------------------------------------------------------->
        <style>
            #customers,
            .hdr {
                width: 100%;
            }

            .hdr {
                margin-bottom: -10px !important;
            }

            .hdr td {
                /* border: 1px solid #ddd;*/
                padding: 2px 0px 2px 8px !important;
            }


            #customers tbody>td {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #customers tbody>tr:hover {
                background-color: #ddd;
            }

            #customers thead>th {
                padding-top: 12px !important;
                padding-bottom: 12px !important;
                text-align: left;
                background-color: #04AA6D;
                color: white;
            }

            #customers tbody>tr>th,
            #customers tbody>tr>td {
                border: 1px solid black !important;
            }

            /* .priSecMan{margin-left:1.5rem;width:135%;} */
            /* .priSecManNe{margin-left:1.5rem;width:130%;} */
            #customers tbody>tr>th {
                font-size: .75rem;
            }

            #customers tbody>tr>td {
                font-size: .7rem;
                padding: 0px 1px 0px 1px;
            }

            #customers tbody>tr>th {
                text-align: center
            }
        </style>


        <div class="row priSecMan">
            <div class="col-lg-12">
                <div style="padding:0px 10px 10px 10px;">
                    <div class="cmpnyHedng" style="margin-bottom:-20px;font-size: 1.3rem !important; "><?php echo config_item('company_name') ?> <br />
                        <div class="brAddr"><?php echo $this->session->userdata('branch_office') ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">&nbsp;&nbsp;<span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                    </div>
                    <table class="hdr align-middle table-nowrap mb-0">
                        <tr>
                            <td><span class="tTyp">Member Code </span>:<span id="memCode" class="srcText"><?php echo $getClient->member_id; ?></span></td>
                            <td><span class="tTyp">Member Name</span>:<span id="memName" class="srcText"><?php echo $getClient->full_name; ?></span></td>
                            <td><span class="tTyp">Loan Purpose</span>:<span id="loanPrps" class="srcText"><?php echo $getClient->purpose; ?></span></td>
                            <td><span class="tTyp">Disbursement Date</span>:<span id="disbursDate" class="srcText"><?php echo $getClient->lnDisDate; ?></span></td>
                        </tr>
                        <tr>
                            <td><span class="tTyp">Center</span> :<span id="mCenter" class="srcText"><?php echo $getClient->center_name . '(' . $getClient->center_id . ')'; ?></span></td>
                            <td><span class="tTyp">Guardian Name</span> : <span id="gurdianName" class="srcText"><?php echo $getClient->guardian_name; ?></span></td>
                            <td><span class="tTyp">Disbursement Type</span> : <span id="memCode1" class="srcText">Cash</span></td>
                            <td><span class="tTyp">Loan Amount</span> : <span id="memLnAmt" class="srcText"><?php echo $getClient->loanAmt; ?> /-</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row priSecManNe">
            <div class="col-lg-12">
                <table id="customers" class=" align-middle table-striped table-nowrap mb-0">
                    <thead class="header-green" style="border: 1px solid black;height: 35px;">
                        <tr>
                            <th>S No.</th>
                            <th>Week</th>
                            <th>Exp Date</th>
                            <th>Collection</th>
                            <th>OS</th>
                            <th>Rec Date</th>
                            <th>Recovery Rs.</th>
                            <th>Payment Status</th>
                            <th>Customer Sign.</th>
                            <th>Center Manger.</th>
                            <th>Visitor Sign.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($getClientEmi) {
                            $ctn = 0;
                            foreach ($getClientEmi as $listD) {
                                ++$ctn;
                                $getEmiDet = $this->reports->getRecvdAmtByClient($getClient->id, $listD->id);
                                if ($getEmiDet) {
                                    if ($getEmiDet->emi_date) {
                                        $recvDate = date('d-M-Y', strtotime($getEmiDet->emi_date));
                                    } else {
                                        $recvDate = '';
                                    }
                                    if ($getEmiDet->recvAmt) {
                                        $recvAmt = $getEmiDet->recvAmt;
                                    } else {
                                        $recvAmt = '';
                                    }
                                } else {
                                    $recvDate = '';
                                    $recvAmt = '';
                                }
                                if ($listD->payment_status == '2') {
                                    $paySts = '<label>Paid</label>';
                                } else {
                                    if ($getEmiDet) {
                                        if ($listD->monthly_emi > $getEmiDet->recvAmt) {
                                            $paySts = '<span class="partiallyPaid">Part Paid</span>';
                                        } else {
                                            $paySts = '';
                                        }
                                    } else {
                                        $paySts = '';
                                    }
                                }

                                $getDataDetails .= '<tr>
                                    <th>' . $ctn . '.</th>
                                    <td>' . $ctn . '</td>
                                   <td>' . date('d-M-Y', strtotime($listD->payment_date)) . '</td>
                                   <td>' . $listD->monthly_emi . '</td>
                                   <td>' . $listD->principal_amt . '</td>
                                   <td>' . $recvDate . '</td>
                                   <td>' . $recvAmt . '</td>
                                   <td>' . $paySts . '</td>
                                   <td><div></div></td>
                                   <td><div></div></td>
                                   <td><div></div></td>
                                </tr>';
                            }
                        } else {
                            $getDataDetails = '<tr><td colspan="11"><div class="noDTfound"><div><i class="bx bx-error"></i> Oops there is no data found</div> <img src="' . base_url('uploads/notFound.svg') . '"></div> </td> </tr>';
                        }
                        echo $getDataDetails;
                        ?>
                    </tbody>
                </table>
                <br> <br><br>
                <p><span class="float-lg-start" style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-top:0rem;">&nbsp;&nbsp;&nbsp;&nbsp;Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="border-bottom:1px solid black;padding-bottom:0.2rem; float:right">&nbsp;&nbsp;&nbsp;&nbsp;B.M Signature&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
            </div>
        </div>




        <!---------------------------------------------------------------------------------------->

    <?php } else if ($miActn == 'centerWiseLoanReport') {
        //print_r($getStaffOnCenter);
    ?>
        <style>
            .miGrA {
                text-align: left;
                border-bottom: 0px;
                color: #8a0505;
                background-color: #d7c566;
                margin: -12px -12px -12px -12px;
                padding: 5px 0px 5px 15px;
            }

            .tfntBld {
                font-weight: 900;
            }
        </style>
        <!-- <div class="row" style="width:135vh;margin-top:-1rem;"> -->
        <div class="row" style="width:45vh;margin-top:-1rem;">

            <div class="col-lg-12">

                <div style="padding:10px;margin-left:8rem;">
                    <div class="cmpnyHedng" style="font-size:1.9rem; line-height:1.3;">
                        <?php echo config_item('company_name') ?> <br />
                        <div class="brAddr"><?php echo $this->session->userdata('branch_office') ?></div>
                    </div>


                </div>
                <div class="row" style="margin-top:-2rem;">
                    <div class="col-lg-6">&nbsp;&nbsp;<span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                    <table class="table align-middle table-nowrap mb-0" style="font-size:1rem;">
                        <tr>
                            <td style="text-align:left;">
                                <span class="ctTyp">Staff Name</span>:
                                <span id="memCode" class="cSrcText"><?php echo $getStaffOnCenter->full_name . ' (' . $getStaffOnCenter->staff_id; ?>)</span>
                            </td>
                            <td style="text-align:right;">
                                <span class="ctTyp">Date & Time</span>:
                                <span id="disbursDate" class="cSrcText"><?php echo date('d-M-Y'); ?>&nbsp;&nbsp;&nbsp;<?php echo date('h:i:s a'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>



            </div>
            <div class="container">
                <div class="col-lg-12">
                    <table id="miPrintDocResult" class="table align-middle table-striped table-nowrap mb-0">
                        <thead class="header-green">
                            <tr style="border: 1px solid black;">
                                <th>S No.</th>
                                <th>M.Code</th>
                                <th>Member Name</th>
                                <th>Guardian</th>
                                <th>Dis Date</th>
                                <th>Dw.</th>
                                <th>INT.</th>
                                <th>Loan</th>
                                <th>Recovered</th>
                                <th>OS Due.</th>
                                <th>Rec.</th>
                                <th>Due</th>
                                <th>Note.</th>
                            </tr>
                        </thead>
                        <tbody id="miLnDetailsShow">
                            <?php

                            if ($getCenterWiseGroup) {
                                $cnt = 0;
                                $centWiseAmt = 0;
                                $centWiseRcvrdAmt = 0;
                                $centWiseEmiTtlAmt = 0;
                                $centWiseOsDueAmt = 0;
                                $centDueTotlTamt = 0;
                                foreach ($getCenterWiseGroup as $grpR) {
                                    $getCenterReport = $this->reports->centerWiseByLoanReport($getStaffOnCenter->id, $grpR->group_id);
                                    $getLoadDetails .= '<tr><th colspan="13"><div class="miGrA">' . $grpR->groupName . ' (' . $grpR->group_id . ').</div></th></tr>';
                                    if ($getCenterReport) {
                                        $sanctionAmt = 0;
                                        $recvrdAmt = 0;
                                        $emiTotalAmt = 0;
                                        $osDueTamt = 0;
                                        $dueTotlTamt = 0;
                                        foreach ($getCenterReport as $grpChild) {
                                            ++$cnt;
                                            if ($grpChild->disDate) {
                                                $disDate = date('d-M-Y', strtotime($grpChild->disDate));
                                            } else {
                                                $disDate = '<span>N/A</span>';
                                            }

                                            if ($grpChild->nominee_name) {
                                                $guardian = $grpChild->nominee_name;
                                            } else {
                                                $guardian = '<span>N/A</span>';
                                            }
                                            if ($grpChild->week) {
                                                $dis_week = $grpChild->week;
                                            } else {
                                                $dis_week =  '<span>N/A</span>';
                                            }

                                            $mon_emi = $this->common->all_data_con('group_loan_payment_details', array('group_loan_id' => $grpChild->id, 'payment_status' => 2), 'monthly_emi');

                                            if ($mon_emi) {
                                                $emi_weekly = count($mon_emi);
                                            } else {
                                                $emi_weekly = '<span>N/A</span>';
                                            }

                                            $sanctionAmt += $grpChild->amount;
                                            $centWiseAmt += $grpChild->amount;
                                            $whereConGetDw = array('group_loan_id' => $grpChild->id, 'payment_status' => '2');
                                            $getDw = $this->common->get_data('group_loan_payment_details', array('group_loan_id' => $grpChild->id, 'payment_status' => '1'), 'count(id) as dw,monthly_emi');
                                            $getPartialDue = $this->common->get_data('group_member_payment_details', array('group_loan_id' => $grpChild->id, 'status' => '2'), 'sum(rest_amount) as dueTotal');
                                            $getRcvr = $this->common->get_data('group_loan_payment_details', array('group_loan_id' => $grpChild->id, 'payment_status' => 2), 'sum(paid_amount) as amt');
                                            $getint = $this->common->get_data('group_loan_payment_details', array('group_loan_id' => $grpChild->id, 'payment_status' => 2), 'count(id) as total_int');


                                            //  if ($getDw) {
                                            //                                                $down = $getDw['dw'];
                                            //                                            } else {
                                            //                                                $down = '0';
                                            //                                            }
                                            if ($getRcvr) {
                                                if ($getRcvr['amt'] != 0) {
                                                    $recovery = $getRcvr['amt'];
                                                } else {
                                                    $recovery = 0;
                                                }
                                            } else {
                                                $recovery = 0;
                                            }
                                            $restDw = $dis_week;
                                            $recvrdAmt += $recovery;
                                            $centWiseRcvrdAmt += $recovery;
                                            $emiTotalAmt += $getDw['monthly_emi'];
                                            $centWiseEmiTtlAmt += $getDw['monthly_emi'];
                                            $osDue = ($grpChild->tenure * $getDw['monthly_emi']) - $recovery;
                                            $centWiseOsDueAmt += $osDue;
                                            $osDueTamt += $osDue;
                                            $dueTotlTamt += $getPartialDue['dueTotal'];
                                            $centDueTotlTamt += $getPartialDue['dueTotal'];
                                            $getLoadDetails .= '<tr><th style="border: 1px solid black;">' . $cnt . '.</th><td  style="border: 1px solid black;">' . $grpChild->member_id . '</td><td  style="border: 1px solid black;">' . $grpChild->full_name . '</td><td  style="border: 1px solid black;">' . $guardian . '</td>
                                              <td  style="border: 1px solid black;">' . $disDate . '</td><td  style="border: 1px solid black;">' . $restDw . '</td><td  style="border: 1px solid black;">' . $emi_weekly . '</td><td style="border: 1px solid black;">' . $grpChild->amount . '</td>
                                              <td  style="border: 1px solid black;">' . $recovery . '</td><td  style="border: 1px solid black;">' . $osDue . '</td><td>' . $getDw['monthly_emi'] . '</td><td  style="border: 1px solid black;">' . $getPartialDue['dueTotal'] . '</td>
                                              <td  style="border: 1px solid black;"><div></div></td></tr>';
                                        }
                                        $getLoadDetails .= '<tr><td colspan="3"></td><td colspan="4"><div style="font-weight:900;text-align:right;border-bottom:0px;">Group-Total</div></td>
                                      <td class="tfntBld" style="border: 1px solid black;">' . $sanctionAmt . '</td><td class="tfntBld" style="border: 1px solid black;">' . $recvrdAmt . '</td><td  style="border: 1px solid black;" class="tfntBld">' . $osDueTamt . '</td>
                                      <td class="tfntBld" style="border: 1px solid black;">' . $emiTotalAmt . '</td><td  style="border: 1px solid black;" class="tfntBld">' . $dueTotlTamt . '</td><td  style="border: 1px solid black;"><div></div></td></tr>';
                                    }
                                }


                                $getLoadDetails .= '<tr><td colspan="3"></td><td colspan="4"><div style="font-weight:900;text-align:right;border-bottom:0px;">Center-Total</div></td>
                              <td class="tfntBld"  style="border: 1px solid black;">' . $centWiseAmt . '</td><td style="border: 1px solid black;" class="tfntBld">' . $centWiseRcvrdAmt . '</td><td style="border: 1px solid black;" class="tfntBld">' . $centWiseOsDueAmt . '</td>
                              <td class="tfntBld" style="border: 1px solid black;">' . $centWiseEmiTtlAmt . '</td><td class="tfntBld" style="border: 1px solid black;">' . $centDueTotlTamt . '</td><td style="border: 1px solid black;"><div></div></td></tr>';
                                echo $getLoadDetails;
                            } else { ?>
                                <tr>
                                    <td colspan="14" class="mtNtFnd">
                                        <div class="noDTfound">
                                            <div><i class="bx bx-error"></i> Oops there is no data found</div>
                                            <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br><br><br><br>

                    <div class="col-lg-12" style="padding:2rem 10px 10px 10px; font-weight:900; font-size:.8rem;">
                        <span style="float:left;">Center Leader</span>
                        <div style=" text-align:center;">Staff Signature</div>
                        <div style="float:right; margin-top:-20px;">Visitor / Verifier</div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else if ($miActn == 'branchWiseLoanDisburshment') { ?>
        <style>
            .cmpnyNm {
                text-align: center;
                font-weight: bold;
                color: #0576B9;
                font-size: 3rem;
                line-height: 1.5;
                margin-bottom: 5px;
                /* margin-left:15rem; */
            }

            .brAddrFrBr {
                font-size: 1.5rem !important;
                text-transform: capitalize;
            }

            .myFtrTbl td {
                color: #005E95;
                font-weight: 900;
            }
        </style>
        <div class="row" style="width:136vh;margin-top:-12mm;">
            <div class="col-lg-12">
                <div style="padding:10px;">
                    <div class="cmpnyNm"><?php echo config_item('company_name') ?> <br />
                        <div class="brAddrFrBr">Daily Summary Sheet Report <?php echo $this->session->userdata('branch_office') ?></div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
            </div>
            <div class="container">
                <div class="col-lg-12">
                    <!-- style="background-image:url(<?//php //echo base_url('media/images/waterMrk.png');
                                                        ?>); background-position:center; background-repeat:no-repeat; min-height:80rem; background-color:#999999;"-->
                    <table id="brReport" class="table align-middle table-striped table-nowrap mb-0">
                        <thead class="header-green">
                            <tr>

                                <th>S No.</th>
                                <th>C.Code</th>
                                <th>Center Name</th>
                                <th>Disburse</th>
                                <th>Fee</th>
                                <th>Adv</th>
                                <th>OD</th>
                                <th>Arr</th>
                                <th>CLS</th>
                                <th>Loan M</th>
                                <th>Int L.M.</th>
                                <th>collection</th>
                                <th>Total</th>

                            </tr>
                        </thead>
                        <!-- if($BwLdD->created_at == date('Y-m-d'))    -->
                        
                        <tbody>
                            <?php
                              
                             if ($getReportList) {
                                $cnt = 0;
                                $tDisbAmt = 0;
                                $tPrFeeAmt = 0;
                                $tExtraAmt = 0;
                                $tDuesRestAmt = 0;
                                $tPrevEmiAmt = 0;
                                $tLoanMwithoutInt = 0;
                                $tIntPaid = 0;
                                $tGrndT = 0;
                                $ctrN=0;
                               
                                $BwLdD=$getReportList['radhe'];
                              
                                foreach ($BwLdD as $bW) {

                                    ++$cnt;
                                    if ($bW->disBrAmt) {
                                        $disbAmt = $bW->disBrAmt;
                                    } else {
                                        $disbAmt ='<span class="sp">N/A</span>';
                                    }
                                    if ($bW->prFeeAmt) {
                                        $prFeeAmt = $bW->prFeeAmt;
                                    } else {
                                        $prFeeAmt = 'N/A';
                                    }
                                    if($bW->montlyEmi)
                                    {
                                        $loanMwithoutInt = $bW->montlyEmi;
                                    }else{
                                        $loanMwithoutInt = "N/A";
                                    }
                                    if ($bW->intrstPaid) {
                                        $intPaid =$bW->intrstPaid;
                                    } else {
                                        $intPaid = "N/A";
                                    }
                                    if($loanMwithoutInt + $intPaid)
                                    {
                                        $emi_total = $loanMwithoutInt + $intPaid;
                                    }else{
                                        $emi_total = "N/A";
                                    }

                                 
                                     // loanMwithoutInt    intPaid   emi_total
                                    // $loanMwithoutInt = $bW->montlyEmi - $bW->intrstPaid;



                                    if ($getDetails['extraAmt']) {
                                        $extraAmt = $getDetails['extraAmt'];
                                    } else {
                                        $extraAmt = '0';
                                    }
                                    if ($getDetails['prevEmiAmt']) {
                                        $prevEmiAmt = $getDetails['prevEmiAmt'];
                                    } else {
                                        $prevEmiAmt = '0';
                                    }
                                    if ($brRpt->loan_amt > 0) {
                                        if ($getDetails['montlyEmi']) {
                                            $duesRestAmt = $brRpt->loan_amt - $getDetails['montlyEmi'];
                                        } else {
                                            $duesRestAmt = 0;
                                        }
                                    } else {
                                        $duesRestAmt = '0';
                                    }
                                    if ($getDetails['montlyEmi']) {
                                        $grndT = $getDetails['montlyEmi'];
                                    } else {
                                        $grndT = 0;
                                    }
                                    $tExtraAmt += $extraAmt;
                                    $tDuesRestAmt += $duesRestAmt;
                                    $tPrevEmiAmt += $prevEmiAmt;
                                   
                                  
                                    
                                  
                                    $tGrndT += $grndT;

                                    ?>
                                    <tr>
                                        <td style="border: 1px solid black;"><strong><?php echo $cnt; ?>.</strong></td>
                                        <td style="border: 1px solid black;"><strong><?php echo $bW->cCode; ?></strong></td>
                                        <td style="border: 1px solid black;"><strong><?php echo $bW->center_name;?></strong></td>
                                        <td style="border: 1px solid black;"><?php echo $disbAmt; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $prFeeAmt; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $extraAmt; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $duesRestAmt; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $prevEmiAmt; ?></td>
                                        <td style="border: 1px solid black;">0.00</td>
                                        <td style="border: 1px solid black;"><?php echo $loanMwithoutInt; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $intPaid; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $emi_total; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $grndT; ?></td>
                                    </tr>
                                    
                                <?php } ?>
                                <tr class="myFtrTbl">
                                    <td colspan="3" style=" text-align:right;"><strong>Grand Total</strong></td>
                                    <td style="border: 1px solid black;"><?php echo $tDisbAmt; ?></td>
                                    <td style="border: 1px solid black;"><?php echo $tPrFeeAmt; ?></td>
                                    <td style="border: 1px solid black;"><?php echo $tExtraAmt; ?></td>
                                    <td style="border: 1px solid black;"><?php echo $tDuesRestAmt; ?></td>
                                    <td style="border: 1px solid black;"><?php echo $tPrevEmiAmt; ?></td>
                                    <td style="border: 1px solid black;">0.00</td>
                                    <td style="border: 1px solid black;"><?php echo $loanMwithoutInt; ?></td>
                                    <td style="border: 1px solid black;"><?php echo $intPaid; ?></td>
                                    <td style="border: 1px solid black;"><?php echo $emi_total; ?></td>
                                    <td style="border: 1px solid black;"><?php echo $tGrndT; ?></td>
                                </tr>


                            <?php } else { ?>

                                <tr>
                                    <td colspan="12" class="mtNtFnd">
                                        <div class="noDTfound">
                                            <div><i class="bx bx-error"></i> Oops there is no data found</div>
                                            <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br><br><br><br><br><br><br><br><br>
                    <p><span class="float-lg-start" style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-top:5rem;">&nbsp;&nbsp;&nbsp;&nbsp;Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-left:52rem;">&nbsp;&nbsp;&nbsp;&nbsp;B.M Signature&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
                </div>
            </div>
        </div>
    <?php } else if ($miActn == 'centerWiseLoanDisburshment') { ?>
        <style>
            .cmpnyNm {
                text-align: center;
                font-weight: bold;
                color: #0576B9;
                font-size: 3rem;
                line-height: 1.5;
                margin-bottom: 5px;
                text-transform: uppercase;
            }

            .brAddrFrBr {
                font-size: 1.5rem !important;
                text-transform: capitalize;
            }

            .myFtrTbl td {
                color: #005E95;
                font-weight: 900;
            }
        </style>
        <div class="row" style="width:400mm; margin-top:-12mm; margin-left:0mm;">
            <div class="col-lg-12">
                <div style="padding:10px;">
                    <div class="cmpnyNm"><?php echo config_item('company_name'); ?> <br />
                        <div class="brAddrFrBr">Daily Disbursement Sheet Report <?php echo $this->session->userdata('branch_office'); ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
            </div>
            <div class="container">
                <div class="col-lg-12">
                    <table id="brReport" class="table align-middle table-striped table-nowrap mb-0">
                        <thead class="header-green">
                            <tr style="border: 1px solid black;">
                                <th>S No.</th>
                                <th>Disburse Date</th>
                                <th>Client ID</th>
                                <th>Loan ID</th>
                                <th>Center Name</th>
                                <th>Client Name</th>
                                <th>Client KYC</th>
                                <th>Guardian Name</th>
                                <th>Guardian KYC</th>
                                <th>Mode</th>
                                <th>Bank IFSC</th>
                                <th>Account No.</th>
                                <th>Disburse</th>
                                <th>Profile Fee</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //echo $this->db->last_query();exit;
                            if ($getCReportList) {
                                $cCnt = 0;
                                $tProFee = 0;
                                $tCloanDisAmt = 0;
                                foreach ($getCReportList as $centr) {
                                    $cCnt++;
                                    if ($centr->processing_fee) {
                                        $processing_fee = $centr->processing_fee;
                                    } else {
                                        $processing_fee = 0;
                                    }
                                    if ($centr->disAmt) {
                                        $disAmt = $centr->disAmt;
                                    } else {
                                        $disAmt = 0;
                                    }
                                    $tProFee += $processing_fee;
                                    $tCloanDisAmt += $disAmt;
                            ?>

                                    <tr>
                                        <td style="border: 1px solid black;"><strong><?php echo $cCnt; ?>.</strong></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->disDate; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->clientID; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->loanID; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->center_name; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->clientName; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->clientKyc; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->guardian_name; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->guardianKyc; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->pay_mode; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->ifsc_code; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->account_no; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->disAmt; ?></td>
                                        <td style="border: 1px solid black;"><?php echo $centr->processing_fee; ?></td>
                                    </tr>

                                <?php  } ?>
                                <tr class="myFtrTbl">
                                    <td colspan="12" style=" text-align:right;border: 1px solid black;"><strong>Total Disbursment</strong></td>
                                    <td style="border: 1px solid black;"><?php echo $tCloanDisAmt; ?></td>
                                    <td style="border: 1px solid black;"><?php echo $tProFee; ?></td>
                                </tr>


                            <?php    } else {
                            ?>

                                <tr>
                                    <td colspan="14" class="mtNtFnd">
                                        <div class="noDTfound">
                                            <div><i class="bx bx-error"></i> Oops there is no data found</div>
                                            <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                                        </div>

                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                    <br><br><br><br><br>
                    <p><span class="float-lg-start" style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-top:5rem;">&nbsp;&nbsp;&nbsp;&nbsp;Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-left:54rem;">&nbsp;&nbsp;&nbsp;&nbsp;B.M Signature&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
                </div>
            </div>
        </div>
    <?php } elseif ($miActn == 'fieldScheduleReport') {
    ?>
        <style>
            .cmpnyNm {
                text-align: center;
                font-weight: bold;
                color: #0576B9;
                font-size: 2rem;
                line-height: 1.5;
                margin-bottom: 5px;
                text-transform: uppercase;
            }

            .brAddrFrBr {
                font-size: 1.25rem !important;
                text-transform: capitalize;
            }

            .myFtrTbl td {
                color: #005E95;
                font-weight: 900;
            }
        </style>
        <div class="row" style=" margin-top:-10mm; margin-left:0mm;">
            <div class="col-lg-12">
                <div style="padding:10px;">
                    <div class="cmpnyNm"><?php echo config_item('company_name'); ?> <br />
                        <div class="brAddrFrBr">Field Schedule Report <?php echo $this->session->userdata('branch_office'); ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6"><span class="tTyp">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span></div>
                </div>
            </div>
            <div class="container">
                <div class="col-lg-12">
                    <table id="brReport" class="table align-middle table-striped table-nowrap mb-0">
                        <thead class="header-green">
                            <tr>
                                <th>S No.</th>
                                <th>Center ID</th>
                                <th>Center Name</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Time</th>
                                <th>Staff Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //echo $this->db->last_query();exit;
                            // print_r($getReportList);

                            if ($getReportList) {
                                $cCnt = 0;
                                foreach ($getReportList as $centr) {
                                    $cCnt++;
                            ?>
                                    <tr>
                                        <td><strong><?php echo $cCnt; ?>.</strong></td>
                                        <td><?php echo $centr->centerCode; ?></td>
                                        <td><?php echo $centr->center_name; ?></td>
                                        <td><?php echo date('d-M-Y', strtotime($centr->schedule_date)); ?></td>
                                        <td><?php echo $centr->schedule_day; ?></td>
                                        <td><?php echo $centr->schedule_time; ?></td>
                                        <td><?php echo $centr->full_name; ?></td>
                                    </tr>
                                <?php  }
                            } else { ?>
                                <tr>
                                    <td colspan="7" class="mtNtFnd">
                                        <div class="noDTfound">
                                            <div><i class="bx bx-error"></i> Oops there is no data found</div>
                                            <img src="<?php echo base_url('uploads/notFound.svg'); ?>">
                                        </div>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <br><br><br><br><br>
                    <p><span class="float-lg-start" style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-top:5rem;">&nbsp;&nbsp;&nbsp;&nbsp;Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-left:30rem;">&nbsp;&nbsp;&nbsp;&nbsp;B.M Signature&nbsp;&nbsp;&nbsp;&nbsp;</span></p>


                </div>
            </div>
        </div>

    <?php } else {
        echo '<div style="text-align:center; color:#A40303; border:2px dashed grey; width:98vh;margin-top:50vh; margin-right:20px; font-size:8rem;">Data not found</div>';
    } ?>
</body>

</html>