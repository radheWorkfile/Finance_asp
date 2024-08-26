<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loan extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('super_admin/Common_model', 'common_model');
        $this->load->model('super_admin/Loan_model', 'loan_model');
        ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);

    }

    public function add_loan()
    {

        $data['title'] = 'Add Loan';
        $data['breadcrums'] = 'Add Loan';
        $data['layout'] = 'loan/add_loan.php';
        $this->load->view('super_admin/base', $data);

    }

    public function fetched_loan_data()
    {

        $val = $this->input->post();
        $data['product'] = $this->loan_model->all_loan_product();
        $data['member'] = $this->loan_model->get_member_data($val['member_id']);
        $this->load->view('super_admin/loan/fetched_loan_data', $data);

    }

    public function get_loan_product_data()
    {
        if ($this->input->is_ajax_request()) {

            $values = $this->input->post('id');
            $data = $this->loan_model->get_loan_product_data($values);
            echo json_encode($data);

        }
    }

    public function add_loan_data()
    {

        $this->form_validation->set_rules('loan_product', 'Loan Product', 'required');
        $this->form_validation->set_rules('loan_start_date', 'Payment Start Date', 'required');
        $this->form_validation->set_rules('tenure', 'Tenure', 'required');
        $this->form_validation->set_rules('tenure_type', 'Tenure Type', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('roi', 'Rate of Interest', 'required');
        $this->form_validation->set_rules('loan_type', 'Loan Type', 'required');

        if ($this->form_validation->run()) {

            $loan = $this->input->post();
            $receipt_no = rand(pow(10, 6 - 1), pow(8, 3) - 1);
            $loan_no = rand(pow(8, 4 - 1), pow(7, 4) - 1);
            $ln = array(

                'member_id'               => $loan['member_id'],
                'receipt_no'              => $receipt_no,
                'loan_no'                 => $loan_no,
                'loan_product'            => $loan['loan_product'],
                'loan_start_date'         => $loan['loan_start_date'],
                'tenure'                  => $loan['tenure'],
                'tenure_type'             => $loan['tenure_type'],
                'amount'                  => $loan['amount'],
                'interest_type'           => $loan['interest_type'],
                'rate_of_interest'        => $loan['roi'],
                'loan_type'               => $loan['loan_type'],
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'created_at'              => date('Y-m-d'),
                
            );
            $this->common_model->save_data('loan_details', $ln);
            
            $loan_id = $this->loan_model->get_last_id($loan['member_id']);

            /* ============== Fixed EMI ============= */
            if ($loan['loan_type'] == 1) {

                $amt         = $loan['amount'];
                $tenure      = $loan['tenure'];
                $tenure_type = $loan['tenure_type'];
                $roi_amt     = $loan['roi'];
                $roi_type    = $loan['interest_type'];
                $start_date  = $loan['loan_start_date'];
                $strt_dt     = date("d", strtotime($start_date));
                $str_dt      = date("Y-m-d", strtotime($start_date));
                $strt_date   = date("Y-m-d", strtotime($start_date . '+1 day'));
                $start_week  = date("Y-m-d", strtotime($start_date . '+7 day'));
                $start_month = date("Y-m-d", strtotime($start_date . '+1 month'));
                $start_year  = date("Y-m-d", strtotime($start_date. '+1 year'));
                $s           = 1;
                $p           = 7;

                if ($tenure_type == 1) {

                    $Payment_start_date = date("Y-m-d", strtotime($start_date . $s . 'day'));
                } else if ($tenure_type == 2) {
            
                    $Payment_start_date = date("Y-m-d", strtotime($start_date . $p . 'day'));
                } else if ($tenure_type == 3) {
            
                    $Payment_start_date = date("Y-m-d", strtotime($start_date . $s . 'month'));
                }
                
                if ($roi_type == 1) {
                    
                    if ($tenure_type == 1) {
                        
                        $intrst_amt_multiple = $amt * $roi_amt / 100;
                        $intrst_amt = $intrst_amt_multiple / 30;
                    } else if ($tenure_type == 2) {
                        
                        $intrst_amt_multiple = $amt * $roi_amt / 100;
                        $intrst_amt = $intrst_amt_multiple / 7;
                    } else if ($tenure_type == 3) {
                        
                        $intrst_amt_multiple = $amt * $roi_amt / 100;
                        $intrst_amt = $intrst_amt_multiple / 12;
                    }
            
                } else if ($roi_type == 2) {
            
                    $intrst_amt = $roi_amt;
                }

                $prin_amt = $amt / $tenure;
                $principal_amt = $amt;
                $emi_amt = $intrst_amt + $prin_amt;
                $i = 0;
                $str = '';
                $principal_amt = $principal_amt;
                $primary = $prin_amt;
                $last_principal_amt = 0;
                $lastPrimary = 0;

                for ($i = 1; $i <= $tenure; $i++) {
                    
                    if ($i > 1) {
                        
                        $principal_amt = $principal_amt - $primary;
                        if ($start_month > 12) {
                            
                            $start_year++;
                            
                        }
                        
                        if ($tenure_type == 1) {
                            
                            $Payment_start_date = date("Y-m-d", strtotime($strt_date . $i . 'day'));
                            
                        } else if ($tenure_type == 2) {
                            
                            $Payment_start_date = date("Y-m-d", strtotime($strt_date . $i . 'week'));
                        } else if ($tenure_type == 3) {
                            
                            $Payment_start_date = date("Y-m-d", strtotime($strt_date . $i . 'month'));
                        }
            
                    }

                    $balance_amt = $principal_amt - $primary;
                    if ($i == $tenure) {
            
                        $balance_amt = $balance_amt < 0 ? $balance_amt : 0;
                        $balance_amt = $balance_amt > 0 ? $balance_amt : 0;
                        $primary = $principal_amt;

                    }
            
                    $emi = array(
                        
                        'loan_id'                 => $loan_id['id'],
                        'member_id'               => $loan['member_id'],
                        'receipt_no'              => $receipt_no,
                        'loan_no'                 => $loan_no,
                        'payment_date'            => $Payment_start_date,
                        'principal_amt'           => round($principal_amt),
                        'monthly_emi'             => round($emi_amt),
                        'interest_paid'           => round($intrst_amt),
                        'principal_paid'          => round($primary),
                        'balance'                 => round($balance_amt),
                        'loan_type'               => $loan['loan_type'],
                        'created_by_user_type_id' => $this->session->userdata('user_id'),
                        'created_at'              => date('Y-m-d'),
                        
                    );
                    $this->common_model->save_data('emi_details', $emi);
            
                }
                    
            }

            /* ============== Reducing EMI =============*/

            if ($loan['loan_type'] == 2) {

                $amt         = $loan['amount'];
                $tenure      = $loan['tenure'];
                $tenure_type = $loan['tenure_type'];
                $roi_amt     = $loan['roi'];
                $roi_type    = $loan['interest_type'];
                $start_date  = $loan['loan_start_date'];
                $strt_dt     = date("d", strtotime($start_date));
                $str_dt      = date("Y-m-d", strtotime($start_date));
                $strt_date   = date("Y-m-d", strtotime($start_date . '+1 day'));
                $start_week  = date("Y-m-d", strtotime($start_date . '+7 day'));
                $start_month = date("Y-m-d", strtotime($start_date . '+1 month'));
                $start_year  = date("Y-m-d", strtotime($start_date. '+1 year'));
                $s           = 1;
                $p           = 7;

                if ($tenure_type == 1) {

                    $Payment_start_date = date("Y-m-d", strtotime($start_date . $s . 'day'));
                } else if ($tenure_type == 2) {
            
                    $Payment_start_date = date("Y-m-d", strtotime($start_date . $p . 'day'));
                } else if ($tenure_type == 3) {
                    
                    $Payment_start_date = date("Y-m-d", strtotime($start_date . $s . 'month'));
                }

                if ($tenure_type == 1) {

                    $effe_intrst_amt = $roi_amt / (100 * 30);
                } else if ($tenure_type == 2) {
            
                    $effe_intrst_amt = $roi_amt / (100 * 7);
                } else if ($tenure_type == 3) {
            
                    $effe_intrst_amt = $roi_amt / (100 * 12);
                }

                $emi_amt = (($amt * $effe_intrst_amt) * pow(1 + $effe_intrst_amt, $tenure)) / (pow(1 + $effe_intrst_amt, $tenure) - 1);

                $intrest_paid = ($amt * $effe_intrst_amt);
                $prin_amt = ($emi_amt - $intrest_paid);
                $principal_amt = $amt;
                $balance = $principal_amt - $prin_amt;
                $i = 0;
                $str = '';
                $principal_amt = $principal_amt;
                $primary = $prin_amt;
                $last_principal_amt = 0;
                $lastPrimary = 0;
                $counter = 1;

                for ($i = 0; $i < $tenure; $i++) {
            
                    if ($i > 0) {
            
                        $principal_amt = $principal_amt - $primary;
                        $intrest_paid = $principal_amt * $effe_intrst_amt;
                        $primary = $emi_amt - $intrest_paid;
                        $balance = $principal_amt - $primary;
            
                        if ($start_month > 12) {
            
                            $start_year++;
            
                        }
            
                        if ($tenure_type == 1) {
                            
                            $Payment_start_date = date("Y-m-d", strtotime($strt_date . $i . 'day'));
                            
                        } else if ($tenure_type == 2) {
                            
                            $Payment_start_date = date("Y-m-d", strtotime($strt_date . $i . 'week'));
                        } else if ($tenure_type == 3) {
                            
                            $Payment_start_date = date("Y-m-d", strtotime($strt_date . $i . 'month'));
                        }
            
                        if ($i == $tenure - 1) {
            
                            $emi_amt = $principal_amt + $intrest_paid;
                            $primary = $principal_amt;
                            $balance = $balance < 0 ? $balance : 0;
                            $balance = $balance > 0 ? $balance : 0;
            
                        }
            
                    }

                    $emi = array(
                        
                        'loan_id'                 => $loan_id['id'],
                        'member_id'               => $loan['member_id'],
                        'receipt_no'              => $receipt_no,
                        'loan_no'                 => $loan_no,
                        'payment_date'            => $Payment_start_date,
                        'principal_amt'           => round($principal_amt),
                        'monthly_emi'             => round($emi_amt),
                        'interest_paid'           => round($intrest_paid),
                        'principal_paid'          => round($primary),
                        'balance'                 => round($balance),
                        'loan_type'               => $loan['loan_type'],
                        'created_by_user_type_id' => $this->session->userdata('user_id'),
                        'created_at'              => date('Y-m-d'),
                        
                    );
                    $this->common_model->save_data('emi_details', $emi);
                }
            }
            
            $data = array('text' => 'Loan & EMI Details Added Successfully', 'icon' => 'success');
        } else {
            $msg = array(

                'loan_product'    => form_error('loan_product'),
                'loan_start_date' => form_error('loan_start_date'),
                'tenure'          => form_error('tenure'),
                'tenure_type'     => form_error('tenure_type'),
                'amount'          => form_error('amount'),
                'roi'             => form_error('roi'),
                'loan_type'        => form_error('loan_type'),

            );
            $data = array('text' => $msg, 'icon' => 'error');
        }
        echo json_encode($data);
    }

    /* =========================================== All Member Loan Details ====================================== */

    public function manage_loan()
    {

        $data['title']      = 'Manage Loan Details';
        $data['breadcrums'] = 'Manage Loan Details';
        $data['layout']     = 'loan/manage_loan.php';
        $this->load->view('super_admin/base', $data);

    }

    public function all_loan_data()
    {

        $post_data = $this->input->post();
        $record = $this->loan_model->all_loan_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_loan_details(' . $row->id . ')" title="Click to View Loan Details"><i class="fas fa-eye text-success"></i></a>&emsp;

            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_model" onclick="update_loan_details(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

            $status = ($row->status == 1) ? '
            <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' member\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>'
            :
            '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' member\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>';

            $pay = '<a href="view_emi_details/'.$row->id.'" title="Click to View Lead Details"><i class="fas fa-money-bill text-success"></i></a>&emsp;';

            if($row->loan_type == 1) {
                $loan_type = "Fixed";
            } elseif($row->loan_type == 2) {
                $loan_type = "Reducing";
            }

            $return['data'][] = array(

                $i++,
                $row->member_id,
                $row->full_name,
                $row->amount,
                $loan_type,
                $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;" . $pay,

            );
        }

        $return['recordsTotal'] = $this->loan_model->loan_total_count();
        $return['recordsFiltered'] = $this->loan_model->loan_total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function view_loan_details() {

        if($this->input->is_ajax_request()) {

            $view = $this->input->post();
            $data['vw_loan'] = $this->loan_model->get_loan_data($view['id']);
            $this->load->view('super_admin/loan/view_loan_details', $data);

        }

    }

    public function update_loan_details() {

        if($this->input->is_ajax_request()) {

            $upd = $this->input->post();
            $data['product'] = $this->loan_model->all_loan_product();
            $data['upd_loan'] = $this->loan_model->get_loan_data($upd['id']);
            $this->load->view('super_admin/loan/update_loan_details', $data);

        }

    }

    public function update_loan_data() {

        $this->form_validation->set_rules('loan_product', 'Loan Product', 'required');
        $this->form_validation->set_rules('loan_start_date', 'Payment Start Date', 'required');
        $this->form_validation->set_rules('tenure', 'Tenure', 'required');
        $this->form_validation->set_rules('tenure_type', 'Tenure Type', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
        $this->form_validation->set_rules('roi', 'Rate of Interest', 'required');
        $this->form_validation->set_rules('loan_type', 'Loan Type', 'required');

        if($this->form_validation->run() == TRUE) {

            $loan = $this->input->post();

            $updt = array(

                'id'               => $loan['id'],
                'loan_product'     => $loan['loan_product'],
                'amount'           => $loan['amount'],
                'tenure'           => $loan['tenure'],
                'tenure_type'      => $loan['tenure_type'],
                'rate_of_interest' => $loan['roi'],
                'interest_type'    => $loan['interest_type'],
                'loan_type'        => $loan['loan_type'],
                'loan_start_date'  => $loan['loan_start_date'],

            );
            $this->common_model->update_data('loan_details', array('id' => $loan['id']), $updt);
            $data = array('text' => 'Loan Details Updated Successfully', 'icon' => 'success');

        } else {

            $msg = array(

                'loan_product'     => form_error('loan_product'),
                'amount'           => form_error('amount'),
                'tenure'           => form_error('tenure'),
                'tenure_type'      => form_error('tenure_type'),
                'rate_of_interest' => form_error('rate_of_interest'),
                'interest_type'    => form_error('interest_type'),
                'loan_type'        => form_error('loan_type'),
                'loan_start_date'  => form_error('loan_start_date'),

            );
            $data = array('text' => $msg, 'icon' => 'error');

        }
        echo json_encode($data);
    }

    public function view_emi_details() {

        $data['title']      = 'Manage EMI Details';
        $data['breadcrums'] = 'Manage EMI Details';
        $data['layout']     = 'loan/view_emi_details.php';
        $this->load->view('super_admin/base', $data);

    }

    public function all_emi_data()
    {

        $post_data = $this->input->post();
        $record = $this->loan_model->all_emi_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            if($row->payment_status == 1) {

                $pay = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".pay_emi_modal" style="margin-left:-5px; padding: 3px; width: 85px;" onclick="pay_emi(' . $row->id . ')" title="Click to Paid EMI Details" class="btn btn-primary">Pay Now</a>&emsp;';

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

        $return['recordsTotal'] = $this->loan_model->emi_total_count();
        $return['recordsFiltered'] = $this->loan_model->emi_total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function pay_emi_data() {

        if($this->input->is_ajax_request()) {
            
            $val = $this->input->post();
            $data['emi_data'] = $this->loan_model->get_emi_data($val['id']);
            $data['last_rest_amount'] = $this->db->select('id,rest_amount')->where('emi_id', $val['id'])->order_by('id', 'DESC')->limit(1)->get('loan_paymemnt_details')->row_array();
            $this->load->view('super_admin/loan/pay_emi', $data);

        }

    }

    public function add_pay_emi_data() {
        
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

                'emi_id'                  => $pay['emi_id'],
                'member_id'               => $pay['member_id'],
                'loan_id'                 => $pay['loan_id'],
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
                'created_at'              => date('Y-m-d'),
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'status'                  => 2
                
            );
            $this->common_model->save_data('loan_paymemnt_details', $amou);

            $last_id = $this->db->select('id,rest_amount')->where('emi_id', $pay['emi_id'])->order_by('id', 'DESC')->limit(1)->get('loan_paymemnt_details')->row_array();

            if($last_id['rest_amount'] == 0) {

                $comm = array(
    
                    'id'             => $pay['emi_id'],
                    'payment_status' => 2,
                );
                $this->common_model->update_data('emi_details', array('id' => $pay['emi_id']), $comm);

                $comm = array(
    
                    'id'             => $pay['loan_id'],
                    'payment_status' => 2,
                );
                $this->common_model->update_data('loan_details', array('id' => $pay['loan_id']), $comm);
            }
            $data=array('text' => 'Loan Payment Adeded Successfully', 'icon' => 'success');

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

    /* =========================================== All Paid EMI Details ====================================== */

    public function manage_paid_emi()
    {

        $data['title']      = 'Manage All Paid EMI Details';
        $data['breadcrums'] = 'Manage All Paid EMI Details';
        $data['layout']     = 'loan/manage_paid_emi_details.php';
        $this->load->view('super_admin/base', $data);

    }

    public function all_paid_emi_data()
    {

        $post_data = $this->input->post();
        $record = $this->loan_model->all_paid_emi_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_paid_emi_model" style="margin-left:-5px;" onclick="view_paid_emi(' . $row->id . ')" title="Click to View Paid EMI Details"><i class="fas fa-eye text-warning"></i></a>&emsp;

            <a href="javascript:void(0);" style="margin-left:-5px;" onclick="paid_emi_print_bill(' . $row->id . ')" title="Click to Print Paid EMI Bill Details"><i class="fas fa-print text-primary"></i></a>&emsp;';

            $return['data'][] = array(

                $i++,
                '₹ '. $row->total_payble_amount,
                $row->emi_date,
                '₹ '. $row->paid_amount,
                '₹ '. $row->rest_amount,
                $view,

            );

        }

        $return['recordsTotal'] = $this->loan_model->emi_paid_total_count();
        $return['recordsFiltered'] = $this->loan_model->emi_paid_total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function view_paid_emi() {

        if($this->input->is_ajax_request()) {

            $vw = $this->input->post();
            $data['vw_paid_emi'] = $this->loan_model->get_paid_emi_data($vw['id']);
            $this->load->view('super_admin/loan/view_paid_emi', $data);
        }
    }

    public function paid_emi_print_bill() {

        if($this->input->is_ajax_request()) {

            $val=$this->input->post();
            $data['priemi'] = $this->loan_model->get_paid_emi_bill_print_data($val['id']);
            // $data['bill'] = $this->Super_Admin_Payment_model->get_project_details($val['user_id']);
            $this->load->view('super_admin/loan/paid_emi_print_bill', $data);

        }

    }

}

?>