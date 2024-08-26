<style>
    .table {
        border: 2px solid black;
        border-collapse: collapse;
    }

    .td {
        border: 1px solid black;
        text-align: center;
        padding: 5px;
    }

    .th {
        border: 1px solid black;
        padding: 5px;
        font-size: 12px;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
    }

    .tds {
        padding: 8px;
        font-size: 17px;
        font-family: Arial, Helvetica, sans-serif;
    }

    .hs {

        text-align: center;
        font-family: serif;
        font-weight: 600;

    }

    .head {

        font-weight: 600;
        font-family: monospace;

    }

    .name {

        text-align: center;
        font-family: serif;
        font-weight: 600;

    }

    .back {

        background-image: linear-gradient(rgba(255, 255, 255, .7), rgba(255, 255, 255, .7)), url('<?php echo base_url('media/images/logo-dark.png') ?>');
        background-size: 500px;
        background-repeat: no-repeat;
        background-position: 100px 320px;

    }
</style>
<div class="card-body back">
    <h1 class="name">
        <?php echo $this->session->userdata('company_name') ?>
        </h4>
        <h4 class="name">
            <?php echo $this->session->userdata('company_address') ?>
        </h4>
        <h2 class="name">EMI Bill
    </h1>

    <table>
        <tr>
            <td class="tds"><span class="head">Client NAME</span> <span style="font-size:16px;">:
                    <?php echo $priemi['first_name'] ." " . $priemi['mid_name'] . " ". $prirmi['last_name'] ."(" . $priemi['member_id'] . ")" ?>
                </span></td>
            <td class="tds"><span class="head">Client ID</span> :
                <?php echo $priemi['member_id'] ?>
            </td>
        </tr>
        <tr>
            <td class="tds"><span class="head">BRANCH</span> :
                <?php echo $this->session->userdata('company_name') ?>
            </td>
            <td class="tds"><span class="head">RECEIPT DATE</span> :
                <?php echo date('m-d-Y') ?>
            </td>
        </tr>
        <tr>
            <td class="tds"><span class="head">RECEIPT NO.</span> :
                <?php echo $priemi['receipt_no'] ?>
            </td>
            <td class="tds"><span class="head">LOAN NUMBER</span> :
                <?php echo $priemi['loan_no'] ?>
            </td>
        </tr>
        <tr>
            <td class="tds"><span class="head">LOAN PRODUCT</span> :
                <?php echo $priemi['loan_product_name'] ?>
            </td>
            <td class="tds"><span class="head">LOAN Amount</span> :
                <?php echo $priemi['amount'] ?>
            </td>
        </tr>
        <tr>
            <td class="tds"><span class="head">LOAN TENURE</span> :
                <?php echo $priemi['tenure'] ?>
            </td>
            <td class="tds"><span class="head">FREQUENCY</span> :
                <?php if ($priemi['tenure_type'] == 1) {
                    echo "Weekly";
                } elseif ($priemi['tenure_type'] == 2) {
                    echo "Bi-Weekly";
                } ?>
            </td>
        </tr>
        <tr>
            <td class="tds"><span class="head">PAYMENT DATE</span> :
                <?php echo $priemi['emi_date'] ?>
            </td>
            <td class="tds"><span class="head">EMI DATE</span> :
                <?php echo $priemi['pay_date'] ?>
            </td>
        </tr>
    </table><br><br>
    <table class="table" style="width:100%;">
        <tr>
            <th class="th">EMI Amount</th>
            <th class="th">PAID AMOUNT</th>
            <th class="th">PENALTY CHRGS</th>
            <th class="th">TOTAL</th>
            <th class="th">REST AMOUNT</th>
        </tr>
        <tr>
            <td class="td">
                <?php echo $priemi['total_payble_amount'] ?>
            </td>
            <td class="td">
                <?php echo $priemi['paid_amount'] ?>
            </td>
            <td class="td">
                <?php if (!empty($priemi['penelty_amount'])) {
                    echo $priemi['penelty_amount'];
                } else {
                    echo "0.00";
                } ?>
            </td>
            <td class="td">
                <?php if (!empty($priemi['penelty_amount'])) {
                    echo ($priemi['paid_amount'] + $priemi['penelty_amount']);
                } else {
                    echo $priemi['paid_amount'];
                } ?>
            </td>
            <td class="td">
                <?php echo $priemi['rest_amount'] ?>
            </td>
        </tr>
    </table><br><br>

    <table class="table" style="width:100%;">
        <tr>
            <th class="th">RUPEES IN FIGURE</th>
            <th class="th">RUPEES IN WORDS</th>
        </tr>
        <tr>
            <?php $this->load->model('employee/Common_model', 'common_model'); ?>
            <td class="td">
                <?php if (!empty($priemi['penelty_amount'])) {
                    echo $priemi['penelty_amount'] + $priemi['paid_amount'];
                } else {
                    echo $priemi['paid_amount'];
                } ?>
            </td>
            <td class="td">
                <?php
                if (!empty($priemi['penelty_amount'])) {
                    $val = $priemi['penelty_amount'] + $priemi['paid_amount'];
                } else {
                    $val = $priemi['paid_amount'];
                }
                $rupee = $this->common_model->getIndianCurrency($val);
                echo $rupee;
                ?>
            </td>
        </tr>
    </table>

    <div class="row" style="margin-top:140px;">
        <p><span style="margin-left:30px; font-weight:600;">CASH RECEIVED</span> <span
                style="margin-left:300px; font-weight:600;">AUTHORIZED SIGNATURE</span></p>
    </div>
</div>