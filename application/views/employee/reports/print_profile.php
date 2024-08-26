

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
        .border-manage{border:0.2rem solid black;}
    </style>

</head>

<body>
  
<div class="row">
    <div class="row">
        <div class="col-lg-12">
            <div style="padding: 10px;">
                <div class="cmpnyHedng"><?php echo config_item('company_name') ?> <br />
                    <div class="brAddr">Profile Report | <?php echo $this->session->userdata('branch_office') ?></div>
                </div>
            </div>
         
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="row">
                <div class="col-lg-6">
                    <span class="tTyp" style="margin-left:0.8rem;">Week: </span>:<span id="staffName" class="srcText"><?php echo date('W'); ?></span>
                </div>
                <div class="col-lg-6 ">  
                        <span class="srcText float-end" id="brnacDetddd">&nbsp;</span>&nbsp;
                        <span class="tTyp float-end">Center Name : &nbsp;</span>
                        <span class="srcText"><?php echo $print_data['center_name'];?></span>
                </div>
            </div>
            <div class="card-body">

            <table id="brReport" class="table align-middle table-striped table-nowrap mb-0">
                        <thead class="header-green">
                            <tr>
                            <th>Sl. No.</th>
                            <th>Customer Code</th>
                            <th>Group Code</th>
                            <th>Center Name</th>
                            <th>Customer Name</th>
                            <th>Voter No.</th>
                            <th>Guranter Name</th>
                            <th>Guaranter Voter No.</th>
                            <th>Relation</th>
                            <th>Religion</th>
                            <th>Date of Joining</th>
                            <th>status</th>
                            </tr>
                        </thead>
                        
                        <tbody class="border-manage">
                       <?php foreach($profile_details as $pro => $profile) {  ?>
                               <tr class="border-manage">
                               <td class="border-manage"><?php echo $pro +1; ?></td>
                               <td class="border-manage"><?php echo $profile->member_id; ?></td>
                               <td class="border-manage"><?php echo $profile->grp_id; ?></td>
                               <td class="border-manage"><?php echo $profile->center_name; ?></td>
                               <td class="border-manage"><?php echo $profile->first_name. " ". $profile->mid_name . " ". $profile->last_name; ?></td>
                               <td class="border-manage"><?php echo $profile->voter_card_no; ?></td>
                               <td class="border-manage"><?php echo $profile->nominee_name; ?></td>
                               <td class="border-manage"><?php echo $profile->nominee_voter; ?></td>
                               <td class="border-manage"><?php echo $profile->relation_name; ?></td>
                               <td class="border-manage"><?php if($profile->religion == 1) { echo "Hinduism"; }elseif($profile->religion == 2) { echo "Islam";}elseif($profile->religion == 3) { echo "Christianity";}elseif($profile->religion == 4) { echo "Sikhism";}elseif($profile->religion == 5) { echo "Others";} ?></td>
                               <td class="border-manage"><?php echo $profile->doj; ?></td>
                               <td class="border-manage"><?php if($profile->disbursment_status == 1) {
                                       echo "In-active";
                                   } else {
                                       echo "Active";
                                   } ?>
                               </td>
                           </tr>
                       <?php } ?>
                   </tbody>
                    </table>
                <br><br><br><br><br>
                <p><span></span><span></span></p>


                <p><span class="float-left" style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-top:5rem;">&nbsp;&nbsp;&nbsp;&nbsp;Staff Signature&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="border-bottom:1px solid black;padding-bottom:0.5rem;margin-left:33rem;">&nbsp;&nbsp;&nbsp;&nbsp;B.M Signature&nbsp;&nbsp;&nbsp;&nbsp;</span></p>

         

                
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

</body>

</html>