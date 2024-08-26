<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group_loan extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('employee/Common_model', 'common_model');
        $this->load->model('employee/Group_Loan_model', 'group_loan_model');
        ($this->session->userdata('user_cate') != 3) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);

    }

    public function group_member_data()
    {

        $data['title']      = 'Add Loan';
        $data['breadcrums'] = 'Add Loan';
        $data['layout'] = 'group_loan/group_member_data.php';
        $this->load->view('employee/base', $data);

    }

    public function fetched_center_member_data()
    {

        $val = $this->input->post();
        $data['group_member']  = $this->group_loan_model->get_center_member_data($val['group_id']);
        $data['group_details'] = $this->group_loan_model->get_group_details($val['group_id']);
        $data['fld_schdl']     = $this->group_loan_model->get_schedule_data($val['group_id']);
        $this->load->view('employee/group_loan/fetched_group_member_data', $data);

    }

    public function add_group_loan()
    {

        $data['title']      = 'Add Group Loan';
        $data['breadcrums'] = 'Add Group Loan';
        $val = $this->uri->segment(4);
        $data['product'] = $this->group_loan_model->all_group_loan_product();
        $data['member'] = $this->group_loan_model->get_member_data($val);
        // print_r($data['member']);die;
        $data['layout'] = 'group_loan/add_group_loan.php';
        $this->load->view('employee/base', $data);

    }

    public function get_group_loan_product_data()
    {

        if ($this->input->is_ajax_request()) {

            $values = $this->input->post('id');
            $data = $this->group_loan_model->get_group_loan_product_data($values);
            echo json_encode($data);

        }

    }

    public function add_group_loan_data()
    {

        $this->form_validation->set_rules('loan_product',     'Loan Product',       'required');
        $this->form_validation->set_rules('loan_start_date',  'Payment Start Date', 'required');
        $this->form_validation->set_rules('tenure',           'Tenure',             'required');
        $this->form_validation->set_rules('tenure_type',      'Tenure Type',        'required');
        $this->form_validation->set_rules('amount',           'Amount',             'required');
        $this->form_validation->set_rules('roi',              'Rate of Interest',   'required');

        if ($this->form_validation->run()) {

            $loan = $this->input->post();
            $receipt_no = rand(pow(10, 6 - 1), pow(8, 3) - 1);
            $loan_no = rand(pow(8, 4 - 1), pow(7, 4) - 1);
            $ln = array(

                'branch_id'                   => $this->session->userdata('branch_id'),
                'center_id'                   => $loan['center_id'],
                'group_id'                    => $loan['group_id'],
                'member_id'                   => $loan['member_id'],
                'receipt_no'                  => $receipt_no,
                'loan_no'                     => $loan_no,
                'loan_product'                => $loan['loan_product'],
                'loan_start_date'             => $loan['loan_start_date'],
                'tenure'                      => $loan['tenure'],
                'tenure_type'                 => $loan['tenure_type'],
                'amount'                      => $loan['amount'],
                'interest_type'               => $loan['interest_type'],
                'roi'                         => $loan['roi'],
                'processing_fee'              => $loan['processing_fee'],
                'purpose'                     => $loan['purpose'],
                'referesh_disbursment_status' => 1,
                'week'                        => date('W'),
                'created_by_user_type_id'     => $this->session->userdata('user_id'),
                'created_at'                  => date('Y-m-d'),
                
            );
            $this->common_model->save_data('add_group_loan', $ln);
            $loan_id = $this->group_loan_model->get_last_id($loan['member_id']);

            $memb = array(

                'referesh_disbursment_status' => 1,

            );
            $this->common_model->update_data('member', array('id' => $loan['member_id']), $memb);

            /* ============== Fixed EMI ============= */

            $amt         = $loan['amount'];
            $tenure      = $loan['tenure'];
            $tenure_type = $loan['tenure_type'];
            $roi_amt     = $loan['roi'];
            $roi_type    = $loan['interest_type'];
            $start_dates  = $loan['loan_start_date'];
            $start_date  = $loan['schedule_date'];
            $strt_dt     = date("d", strtotime($start_date));
            $str_dt      = date("Y-m-d", strtotime($start_date));
            $strt_date   = date("Y-m-d", strtotime($start_date . '+1 day'));
            $start_week  = date("Y-m-d", strtotime($start_date . '+7 day'));
            $start_month = date("Y-m-d", strtotime($start_date . '+1 month'));
            $start_year  = date("Y-m-d", strtotime($start_date.  '+1 year'));
            $s           = 15;
            $p           = 7;

            // get a schudle date of day
            $schedule_day = date('l', strtotime($start_date));

            // Create a new DateTime object
            $date = new DateTime($start_dates);

            // Modify the date it contains
            $next_day = $date->modify('next '.$schedule_day);

            // get 1st emi date
            $final_date = $date->format('Y-m-d');
            $Payment_start_dates = $final_date;
            
            if ($roi_type == 1) {

                if ($tenure_type == 1 || $tenure_type == 2) {
        
                    $intrst_amt_multiple = $amt * $roi_amt / 100;
                    $intrst_amt          = $intrst_amt_multiple / $tenure;

                }
        
            } else if ($roi_type == 2) {

                $intrst_amt_multiple = $roi_amt;
                $intrst_amt        = $roi_amt / $tenure;

            }
            $prin_amt = $amt / $tenure;
            $principal_amt = $amt;
            $emi_amt = $intrst_amt + $prin_amt;
            
            $i = 0;
            $str = '';
            $principal_amt = $principal_amt;
            $principal_interest = $principal_amt + $intrst_amt_multiple;
            $principal_interest_amt = $principal_interest - $emi_amt;
            $primary = $prin_amt;
            $last_principal_amt = 0;
            $lastPrimary = 0;
            
            $p = 1;
            $bi = 14;
            for ($i = 1; $i <= $tenure; $i++) {

                if($i == 1) {
                   
                    $Payment_start_date = $Payment_start_dates;
                    
                }

                if ($i > 1) {

                    $principal_amt = $principal_amt - $primary;
                    $principal_interest_amt = $principal_interest_amt - $emi_amt;
                    if ($start_month > 12) {
                        
                        $start_year++;
                        
                    }

                    $rept_dt = 14 * $i - 14;
                    $Payment_start_date = date("Y-m-d", strtotime($Payment_start_dates . $rept_dt . 'day'));
                    
                }
                
                $balance_amt = $principal_amt - $primary;
                if ($i == $tenure) {
                    
                    $balance_amt = $balance_amt < 0 ? $balance_amt : 0;
                    $balance_amt = $balance_amt > 0 ? $balance_amt : 0;
                    $primary = $principal_amt;
                    
                }
                
                $emi = array(
                    
                    'branch_id'               => $this->session->userdata('branch_id'),
                    'center_id'               => $loan['center_id'],
                    'group_id'                => $loan['group_id'],
                    'member_id'               => $loan['member_id'],
                    'group_loan_id'           => $loan_id['id'],
                    'loan_no'                 => $loan_no,
                    'receipt_no'              => $receipt_no,
                    'payment_date'            => $Payment_start_date,
                    'principal_amt'           => $principal_amt,
                    'principal_interest_amt'  => $principal_interest_amt,
                    'monthly_emi'             => $emi_amt,
                    'interest_paid'           => $intrst_amt,
                    'principal_paid'          => round($primary),
                    'balance'                 => round($balance_amt),
                    'week'                    => date('W'),
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => date('Y-m-d'),
                    
                );
                $this->common_model->save_data('group_loan_payment_details', $emi);
                $data = array('text' => 'Group Loan Details Added Successfully', 'icon' => 'success');
        
            }     
                                                                   
        } else {

            $msg = array(

                'loan_product'    => form_error('loan_product'),
                'loan_start_date' => form_error('loan_start_date'),
                'tenure'          => form_error('tenure'),
                'tenure_type'     => form_error('tenure_type'),
                'amount'          => form_error('amount'),
                'roi'             => form_error('roi'),

            );
            $data = array('text' => $msg, 'icon' => 'error');
        }
        echo json_encode($data);

    }

    /* =========================================== All Group Member Loan Details ====================================== */
    
    public function loan_disbursment_data()
    {
        
        $data['title']      = 'Manage Loan Disbursment Details';
        $data['breadcrums'] = 'Manage Loan Disbursment Details';
        $data['layout']     = 'group_loan/loan_disbursment_data.php';
        $this->load->view('employee/base', $data);
        
    }

    public function fetched_loan_disbursment_data()
    {

        $val = $this->input->post();
        $data['group_member'] = $this->group_loan_model->get_group_loan_details($val['group_id']);
        $data['group_details'] = $this->group_loan_model->get_group_details($val['group_id']);
        $this->load->view('employee/group_loan/fetched_loan_disbursment_data', $data);

    }

    public function view_group_loan_details() {

        if($this->input->is_ajax_request()) {

            $view = $this->input->post();
            $data['vw_group_loan'] = $this->group_loan_model->get_group_loan_data($view['id']);
            $this->load->view('employee/group_loan/view_group_loan_details', $data);

        }

    }

    public function update_group_loan_details() {

        if($this->input->is_ajax_request()) {

            $upd = $this->input->post();
            $data['product'] = $this->group_loan_model->all_group_loan_product();
            $data['upd_group_loan'] = $this->group_loan_model->get_group_loan_data($upd['id']);
            $this->load->view('employee/group_loan/update_group_loan_details', $data);

        }

    }

    public function update_group_loan_data() {

        $this->form_validation->set_rules('loan_product', 'Loan Product', 'required');
        $this->form_validation->set_rules('loan_start_date', 'Payment Start Date', 'required');
        $this->form_validation->set_rules('tenure', 'Tenure', 'required');
        $this->form_validation->set_rules('tenure_type', 'Tenure Type', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('roi', 'Rate of Interest', 'required');

        if($this->form_validation->run() == TRUE) {

            $loan = $this->input->post();
            
            $updt = array(
                
                'id'                 => $loan['loan_id'],
                'loan_product'       => $loan['loan_product'],
                'amount'             => $loan['amount'],
                'tenure'             => $loan['tenure'],
                'tenure_type'        => $loan['tenure_type'],
                'roi'                => $loan['roi'],
                'interest_type'      => $loan['interest_type'],
                'loan_start_date'    => $loan['loan_start_date'],
                'processing_fee'     => $loan['processing_fee'],
                'disbursment_status' => $loan['disbursment_status'],
                
            );
            $this->common_model->update_data('add_group_loan', array('id' => $loan['loan_id']), $updt);
            
            $disburse = array(
                
                'disbursment_status' => $loan['disbursment_status'],
                
            );
            $this->common_model->update_data('member', array('id' => $loan['mem_id']), $disburse);
            if($this->input->post('disbursment_status') == 1) {

                $data = array('text' => 'please Approve Disbursment Status', 'icon' => 'error');
                
            } else if($this->input->post('disbursment_status') == 2) {
                
                $data = array('text' => 'Group Loan Details Updated Successfully', 'icon' => 'success');

            }

        } else {

            $msg = array(

                'loan_product'       => form_error('loan_product'),
                'amount'             => form_error('amount'),
                'tenure'             => form_error('tenure'),
                'tenure_type'        => form_error('tenure_type'),
                'rate_of_interest'   => form_error('rate_of_interest'),
                'interest_type'      => form_error('interest_type'),
                'loan_start_date'    => form_error('loan_start_date'),
            );
            $data = array('text' => $msg, 'icon' => 'error');

        }
        echo json_encode($data);

    }

    public function view_group_loan_emi_details() {

        $data['title']      = 'Manage EMI Details';
        $data['breadcrums'] = 'Manage EMI Details';
        $data['layout']     = 'group_loan/view_group_loan_emi_details.php';
        $this->load->view('employee/base', $data);

    }

    public function all_group_loan_emi_data()
    {

        $post_data = $this->input->post();
        $record = $this->group_loan_model->all_group_loan_emi_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            if($row->payment_status == 1) {

                $pay = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".pay_emi_modal" style="margin-left:-5px; padding: 3px; width: 85px;" onclick="pay_group_loan_emi(' . $row->id . ')" title="Click to Paid EMI Details" class="btn btn-primary">Pay Now</a>&emsp;';

            } else if($row->payment_status == 2) {

                $pay = '<b class="text-success">Paid <i class="fa fa-check"></i></b>&emsp;'; 

            }

            $return['data'][] = array(

                $i++,
                $row->payment_date,
                $row->principal_amt,
                $row->monthly_emi,
                $row->interest_paid,
                $row->principal_paid,
                $row->balance,
                $pay,

            );

        }

        $return['recordsTotal'] = $this->group_loan_model->group_emi_total_count();
        $return['recordsFiltered'] = $this->group_loan_model->group_emi_total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function pay_group_loan_emi() {

        if($this->input->is_ajax_request()) {
            
            $val = $this->input->post();
            $data['emi_data'] = $this->group_loan_model->get_group_loan_emi_data($val['id']);
            $data['last_rest_amount'] = $this->db->select('id,rest_amount')->where('emi_id', $val['id'])->order_by('id', 'DESC')->limit(1)->get('group_member_payment_details')->row_array();
            $this->load->view('employee/group_loan/pay_group_loan_emi', $data);

        }

    }

    public function add_pay_group_loan_emi_data() {
        
        $this->form_validation->set_rules('paid_amount','Paid Amount','required');
        $this->form_validation->set_rules('rest_amount','Rest Amount','required');
        $this->form_validation->set_rules('mop','Mode Of Payment','required');
        $this->form_validation->set_rules('pay_date','Payment Date','required');
        
        if($this->input->post('mop') == 1 || $this->input->post('mop') == 2) {

            $this->form_validation->set_rules('acc_no', 'Account No.', 'required');

        }

        if($this->input->post('mop') == 3) {

            $this->form_validation->set_rules('cash_received_by', 'Cash Received By', 'required');

        }

        if($this->form_validation->run() == TRUE) {

            $pay = $this->input->post();
            
            $config['upload_path']          = './uploads/emi_recipet/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('recipet')) {
                
                $msg = array('error' => $this->upload->display_errors());
                $data = array('text' => $msg, 'icon' => "error");
                
            } else {
                
                $img_data = $this->upload->data();
                $img = ('uploads/emi_recipet/' . $img_data['raw_name'] . $img_data['file_ext']);
                
            }
            
            $amou = array (
                
                'branch_id'               => $this->session->userdata('branch_id'),
                'emi_id'                  => $pay['emi_id'],
                'member_id'               => $pay['member_id'],
                'group_loan_id'           => $pay['group_loan_id'],
                'total_payble_amount'     => $pay['total_payble_amount'],
                'emi_date'                => $pay['emi_date'],
                'paid_amount'             => $pay['paid_amount'],
                'rest_amount'             => $pay['rest_amount'],
                'mop'                     => $pay['mop'],
                'acc_no'                  => $pay['acc_no'],
                'cash_received_by'        => $pay['cash_received_by'],
                'pay_date'                => $pay['pay_date'],
                'penelty_amount'          => $pay['penelty_amount'],
                'pay_remarks'             => $pay['pay_remarks'],
                'recipet'                 => empty($img) ? '' : $img,
                'week'                    => date('W'),
                'created_at'              => date('Y-m-d'),
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'status'                  => 2
                
            );

            $this->common_model->save_data('group_member_payment_details', $amou);

            $last_id = $this->db->select('id,rest_amount')->where('emi_id', $pay['emi_id'])->order_by('id', 'DESC')->limit(1)->get('group_member_payment_details')->row_array();

            if($last_id['rest_amount'] == 0) {

                $comm = array(
    
                    'id'             => $pay['emi_id'],
                    'payment_status' => 2,
                    'paid_amount'    => $pay['paid_amount'],
                    'pay_date'       => $pay['pay_date'],
                    'week'           => date('W'),

                );
                $this->common_model->update_data('group_loan_payment_details', array('id' => $pay['emi_id']), $comm);

                $comm = array(
    
                    'id'             => $pay['group_loan_id'],
                    'payment_status' => 2,
                    'pay_date'       => $pay['pay_date'],

                );
                $this->common_model->update_data('add_group_loan', array('id' => $pay['group_loan_id']), $comm);

            }
            $data=array('text' => 'Group Loan Payment Added Successfully', 'icon' => 'success');

        } else {

            $msg=array(

                'paid_amount'      => form_error('paid_amount'),
                'rest_amount'      => form_error('rest_amount'),
                'mop'              => form_error('mop'),
                'acc_no'           => form_error('acc_no'),
                'cash_received_by' => form_error('cash_received_by'),
                'pay_date'         => form_error('pay_date'),

            );
            $data=array('text' => $msg, 'icon' => 'error');

        }
        echo json_encode($data);

    }

    /* ============================= All Group Loan Paid EMI Details =============================== */

    public function manage_group_loan_paid_emi()
    {

        $data['title']      = 'Manage All Paid EMI Details';
        $data['breadcrums'] = 'Manage All Paid EMI Details';
        $data['center']  = $this->common_model->all_data('master_center', 'id, center_name');
        $data['layout']     = 'group_loan/manage_group_loan_paid_emi_details.php';
        $this->load->view('employee/base', $data);

    }

    public function all_group_loan_paid_emi_data()
    {
        $post_data = $this->input->post();
        $record = $this->group_loan_model->all_group_loan_paid_emi_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_paid_emi_model" style="margin-left:-5px;" onclick="view_group_loan_paid_emi(' . $row->id . ')" title="Click to View Paid EMI Details"><i class="fas fa-eye text-warning"></i></a>&emsp;

            <a href="javascript:void(0);" style="margin-left:-5px;" onclick="grp_loan_paid_emi_print_bill(' . $row->id . ')" title="Click to Print Paid EMI Bill Details"><i class="fas fa-print text-primary"></i></a>&emsp;

            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".refresh_paid_emi_model" style="margin-left:-5px;" onclick="refresh_paid_emi(' . $row->id . ')" title="Click to View Paid EMI Details"><i class="fas fa-retweet text-success""></i></a>&emsp;';

            if($row->rest_amount)
            {
                $restAmount =   '₹ '. $row->rest_amount;
            }else{
                $restAmount =  '<span style="font-weight:600;color:#bd1818;">N/A</span>';
            }

            $return['data'][] = array(

                $i++,
                $row->group_name,
                $row->first_name. " " . $row->mid_name . " " . $row->last_name . "(". $row->member_id . ")",
                '₹ '. $row->total_payble_amount,
                $row->emi_date,
                '₹ '. $row->paid_amount,
                $restAmount,
                $view,

            );

        }

        $return['recordsTotal'] = $this->group_loan_model->group_emi_paid_total_count();
        $return['recordsFiltered'] = $this->group_loan_model->group_emi_paid_total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function view_group_loan_paid_emis() {

        if($this->input->is_ajax_request()) {

            $vw = $this->input->post();
            $data['vw_paid_emi'] = $this->group_loan_model->get_group_loan_paid_emi_data($vw['id']);
            $this->load->view('employee/group_loan/view_group_loan_paid_emi', $data);

        }
        
    }
    
    public function group_loan_paid_emi_print_bill() {
        if($this->input->is_ajax_request()) {
            $val=$this->input->post();
            $data['priemi'] = $this->group_loan_model->get_group_loan_paid_emi_bill_print_data($val['id']);
            //echo "<pre>"; print_r($data['priemi']);die;
            $this->load->view('employee/group_loan/group_loan_paid_emi_print_bill', $data);
        }
    }

    public function manage_refresh_disburse_loan()
    {

        $data['title']      = 'All Disburse Loan Details';
        $data['breadcrums'] = 'All Disburse Loan Details';
        $data['center']  = $this->common_model->all_data('master_center', 'id, center_name');
        $data['layout']     = 'group_loan/manage_refresh_disburse_loan.php';
        $this->load->view('employee/base', $data);

    }

    public function all_refresh_disburse_loan_data()
    {

        $post_data = $this->input->post();
        $record = $this->group_loan_model->all_refresh_disburse_loan_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            if($row->referesh_disbursment_status == 1) {

                $refresh = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".refresh_disburse_loan_model" style="margin-left:-5px;" onclick="refresh_disburse_loan(' . $row->id . ')" title="Click to View Paid EMI Details"><i class="fas fa-retweet text-success " style="font-size: 22px;"></i></a>&emsp;';

            } else if($row->referesh_disbursment_status == 2) {

                $refresh = '<b class="text-success">Done <i class="fa fa-check"></i></b>&emsp;';

            }

            $return['data'][] = array(

                $i++,
                $row->center_name,
                $row->first_name. " " . $row->mid_name . " " . $row->last_name . "(". $row->member_id . ")",
                '₹ '. $row->amount,
                $row->loan_start_date,
                // '₹ '. $row->rest_amount,
                $refresh,

            );

        }

        $return['recordsTotal'] = $this->group_loan_model->refresh_disburse_loan_total_count();
        $return['recordsFiltered'] = $this->group_loan_model->refresh_disburse_loan_total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function refresh_disbursmnet_data() {

        if($this->input->is_ajax_request()) {

            $val=$this->input->post();
            $data['refresh'] = $this->group_loan_model->get_refresh_disburse_data($val['id']);
            $this->load->view('employee/group_loan/refresh_disburshment', $data);

        }

    }

    public function update_refresh_disburse_data() {

        $val = $this->input->post();
        
        $mem = array(
            
            'disbursment_status'           => 1,
            'referesh_disbursment_status'  => 2,
            
        );
        $this->common_model->update_data('member', array('id' => $val['member_id']), $mem);
        $this->group_loan_model->delete_grp_loan($val['loan_id']);
        $this->group_loan_model->delete_grp_loan_emis($val['loan_id']);
        $this->group_loan_model->delete_grp_loan_payments($val['loan_id']);
        $data = array('text' => 'Refreshed Successfully', 'icon' => 'success');
        echo json_encode($data);

    }

    public function refresh_paid_emi_data() {

        if($this->input->is_ajax_request()) {

            $val=$this->input->post();
            $data['refresh'] = $this->group_loan_model->get_refresh_paid_emi_data($val['id']);
            $this->load->view('employee/group_loan/refresh_paid_emi', $data);

        }

    }

    public function update_refresh_paid_emi_data() {

        if($this->input->is_ajax_request()) {

            $paid = $this->input->post();
            $this->group_loan_model->delete_data($paid['id']);
        
            $refresh = array(
                
                'payment_status' => 1,
                
            );
            $this->common_model->update_data('group_loan_payment_details', array('id' => $paid['emi_id']), $refresh);
            
            $refresh_sta = array(
                
                'payment_status' => 1,

            );
            $this->common_model->update_data('add_group_loan', array('id' => $paid['loan_id']), $refresh_sta);
            $data = array('text' => 'Refreshed Successfully', 'icon' => 'success');
            echo json_encode($data);

        }

    }

}

?>