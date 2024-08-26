




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>&nbsp;</title>
    <link href="<?php echo base_url('media/css/bootstrap.min.css'); ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <style>
        *{
            color-adjust: exact;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .sp{
            color:green;
            font-weight:800;
        }

        #miLnDetailsShow {
            border: 1px solid black;  
            line-height: 0;
        }
        .spa_te{padding-left:1rem;color:#ff6000;}

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
            text-align: center;
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
        .border-manage{border:0.1rem solid #b2b2b2;}
    </style>

</head>

<body>
  
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div style="padding: 10px;">
                <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br />
                    <div class="brAddr">Weekly Cash Submission Report | <?php echo $this->session->userdata('branch_office') ?></div>
                </div>
            </div>
         
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <span class="tTyp" style="margin-left:0.8rem;">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span>
                </div>
                
            </div>
            <div class="card-body">

            <table id="odtable" class="table align-middle table-striped table-nowrap mb-0">
                        <thead class="header-green">
                            <tr>
                            <th>Sl. No.</th>
                            <th>Center ID</th>
                            <th>Center Name</th>
                            <th>Client ID</th>
                            <th>Loan ID</th>
                            <th>Client Name</th>
                            <th>OD Date</th>
                            <th>OD Amount</th>
                            <th>During</th>
                            <th>Rec Date</th>
                            <th>Rec Amount</th>
                            <th>OD Balanced</th>
                            </tr>
                        </thead>
                        
                        <tbody class="border-manage">
                         <?php foreach($od_report as $od => $odRep) {  ?>
                               <tr class="border-manage">
                                <td class="border-manage"><?php echo $od ++; ?></td>
                                <td class="border-manage"><?php echo $odRep->center_id; ?></td>
                                <td class="border-manage"><?php echo $odRep->center_name; ?></td>
                                <td class="border-manage"><?php echo $odRep->member_id; ?></td>
                                <td class="border-manage"><?php echo $odRep->center_id; ?></td>
                                <td class="border-manage"><?php echo $odRep->first_name; ?></td>
                                <td class="border-manage"><?php echo $odRep->pay_date; ?></td>
                                <td class="border-manage"><?php echo $odRep->paid_amount; ?></td>
                                <td class="border-manage"><?php echo $odRep->week; ?></td>
                                <td class="border-manage"><?php echo $odRep->emi_date; ?></td>
                                <td class="border-manage"><?php echo $odRep->rest_amount; ?></td>
                                <td class="border-manage"><?php echo $odRep->rest_amount; ?></td>
                           </tr>
                       <?php } ?>
                   </tbody>
                    </table>
                    <br><br><br><br><br>
                    <p><span class="float-lg-start" style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-top:5rem;">&nbsp;&nbsp;&nbsp;&nbsp;Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-left:40rem;">&nbsp;&nbsp;&nbsp;&nbsp;B.M Signature&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
         

                
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

</body>

</html>