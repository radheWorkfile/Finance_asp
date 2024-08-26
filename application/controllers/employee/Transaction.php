<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employee/Common_model', 'common_model');
        $this->load->model('employee/Transaction_model', 'transaction_model');
        ($this->session->userdata('user_cate') != 3) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);
    }

    /* =================================== Posting Section =================================== */

    public function recovery_posting()
    {
        $data['title']      = 'Recovery Posting';
        $data['breadcrums'] = 'Recovery Posting';
        $data['center']  = $this->transaction_model->all_center_name();
        $data['layout']     = 'transaction/manage_recovery_posting.php'; 
        $this->load->view('employee/base', $data);
    }

    public function all_recovery_posting_data()
    {

        $post_data = $this->input->post();  
        $record = $this->transaction_model->all_recovery_posting_data($post_data);
        $i = $post_data['start'] + 1;
        $return['data'] = array();
        foreach ($record as $row) {  

         $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".recovery_posting_model" style="margin-left:-5px;" onclick="update_recovery_conformation(' . $row->id . ')" title="Click to Save Recovery"><i class="fas fa-check text-success"></i></a>&emsp;
    
        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".remove_od_model" style="margin-left:-5px;" onclick="remove_od(' . $row->id . ')" title="Click to OD Recovery"><i class="fas fa-plane text-danger""></i></a>&emsp;

         <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".adv_pay_model" style="margin-left:-5px;" onclick="adv_payment(' . $row->id . ')" title="Click to AD Recovery"><i class="fas fa-solid fa-wallet text-info"></i></i></a>&emsp;';

          if($post_data['center'] != "")  
          {
                $return['data'][] = array(
                    $i++,
                    $row->loan_no,
                    // $row->center_name,
                    $row->first_name." ".$row->mid_name." ".$row->last_name,
                    $row->nominee_name,
                    $row->monthly_emi,
                    $view,
    
                );
         }

        }

        $return['recordsTotal'] = $this->transaction_model->recovery_posting_loan_total_count();
        $return['recordsFiltered'] = $this->transaction_model->recovery_posting_loan_total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
    }

    


    /* ================================ OD Section ==================================== */

    public function remove_od()  
    {
        $input = $this->input->post();
        $data['od_data'] = $this->transaction_model->get_od_data($input['id']);
        $this->load->view('employee/transaction/remove_od', $data);
    }

    public function manage_adv_payment()  
    {
        $input = $this->input->post();
        $data['adv_pay_data'] = $this->transaction_model->get_od_data($input['id']);
        $this->load->view('employee/transaction/adv_payment',$data);
    }
    // $adv_amo['adv_amount'];

    public function adv_payment_updata()
    {
        $data = $this->input->post();
        $this->form_validation->set_rules('paid_amount', 'Paid Amount', 'required');
        $this->form_validation->set_rules('pay_date', 'Payment Date', 'required');
        if ($this->form_validation->run() == TRUE) {  
            $value = $this->input->post();
            $adv_rep = array(
                'branch_id'           => $this->session->userdata('branch_id'),
                'emi_id'              => $value['emi_id'],
                'member_id'           => $value['member_id'],
                'group_loan_id'       => $value['group_loan_id'],
                'total_payble_amount' => $value['total_payble_amount'],
                'emi_date'            => $value['emi_date'],
                'paid_amount'         => $value['paid_amount'],
                'adv_amount'          => $value['adv_amount'],
                'pay_date'            => $value['pay_date'],
                'pay_remarks'         => $value['pay_remarks'],
                'week'                => date('W'),
                'is_adv'               => 2,
            );
            $this->common_model->save_data('group_member_payment_details', $adv_rep);
            $sta = array(
                'paid_amount'    => $value['paid_amount'],
                'is_adv'         => 2,
                'payment_status' => 2
            );
            $this->common_model->update_data('group_loan_payment_details', array('id' => $value['emi_id']),$sta);
            $data = array('icon' => 'success', 'text' => 'Advance Amount Added Successfully');
        } else {

            $msg = array(
                'paid_amount' => form_error('paid_amount'),
                'pay_date'    => form_error('pay_date'),
            );
            $data = array('icon' => 'error', 'text' => $msg);
        }
        echo json_encode($data);
    }

    public function remove_od_data()
    {
        $this->form_validation->set_rules('paid_amount', 'Paid Amount', 'required');
        $this->form_validation->set_rules('pay_date', 'Payment Date', 'required');
        if ($this->form_validation->run() == TRUE) {

            $remove = $this->input->post();

            $od = array(

                'branch_id'           => $this->session->userdata('branch_id'),
                'emi_id'              => $remove['emi_id'],
                'member_id'           => $remove['member_id'],
                'group_loan_id'       => $remove['group_loan_id'],
                'total_payble_amount' => $remove['total_payble_amount'],
                'emi_date'            => $remove['emi_date'],
                'paid_amount'         => $remove['paid_amount'],
                'rest_amount'         => $remove['rest_amount'],
                'pay_date'            => $remove['pay_date'],
                'pay_remarks'         => $remove['pay_remarks'],
                'week'                => date('W'),
                'is_od'               => 2,

            );
            $this->common_model->save_data('group_member_payment_details', $od);

            $sta = array(

                'is_od' => 2,

            );
            $this->common_model->update_data('group_loan_payment_details', array('id' => $remove['emi_id']), $sta);
            $data = array('icon' => 'success', 'text' => 'Successfully Removed In OD');
        } else {

            $msg = array(

                'paid_amount' => form_error('paid_amount'),
                'pay_date'    => form_error('pay_date'),
            );
            $data = array('icon' => 'error', 'text' => $msg);
        }
        echo json_encode($data);
    }

    public function manage_od_posting()
    {
        $data['title']      = 'OD Posting';
        $data['breadcrums'] = 'OD Posting';
        $data['center']  = $this->common_model->all_data('master_center', 'id, center_name');
        $data['layout']     = 'transaction/manage_od_posting.php';
        $this->load->view('employee/base', $data);
    }


    public function all_od_posting_data()
    {
        $post_data = $this->input->post();
        $record = $this->transaction_model->all_od_posting_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".recovery_od_model" style="margin-left:-5px;" onclick="update_od_recovery_conformation(' . $row->id . ')" title="Click to Save Recovery"><i class="fas fa-check text-success"></i></a>&emsp;';

            $return['data'][] = array(

                $i++,
                $row->loan_no,
                $row->first_name . " " . $row->mid_name . " " . $row->last_name . "(" . $row->member_id . ")",
                $row->nominee_name,
                $row->loan_start_date,
                $row->rest_amount,
                $view,

            );
        }

        $return['recordsTotal'] = $this->transaction_model->od_posting_loan_total_count();
        $return['recordsFiltered'] = $this->transaction_model->od_posting_loan_total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
    }
// ================================================== rk@Cfr ================================================ 

    public function manage_ad_posting()
    {
        $data['title']      = 'AD Posting';
        $data['breadcrums'] = 'AD Posting';
        $data['center']  = $this->common_model->all_data('master_center', 'id, center_name');
        $data['layout']     = 'transaction/manage_ad_posting.php';
        $this->load->view('employee/base', $data);
    }
  

    public function all_ad_posting_data()
    {
        $post_data = $this->input->post();
        $record = $this->transaction_model->all_ad_posting_data($post_data);
        $i = $post_data['start'] + 1;
        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".recovery_od_model" style="margin-left:-5px;" onclick="update_ad_recovery_conformation(' . $row->id . ')" title="Click to Save Recovery"><i class="fas fa-eye text-success"></i></a>&emsp;';

            if($row->adv_amount)
            {
                $advAmo = ₹." ".number_format($row->adv_amount,2);
            }else{
                $advAmo = "<span style='text-align:center;coloe:red;font-weight:600;'>N/A</span>";
            }

            $return['data'][] = array(

                $i++,
                $row->loan_no,
                $row->first_name . " " . $row->mid_name . " " . $row->last_name . "(" . $row->member_id . ")",
                $row->nominee_name,
                $row->loan_start_date,
                $advAmo,
                $view,

            );
        }           

        $return['recordsTotal'] = $this->transaction_model->count_ad_posting();
        $return['recordsFiltered'] = $this->transaction_model->filter_ad_posting($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
    }

    public function recovery_ad_conformation()
    {
        $input = $this->input->post();
        $data['ad_data'] = $this->transaction_model->get_ad_datas($input['id']);
        $this->load->view('employee/transaction/ad_recovery_conformation',$data);
    }

    public function recovery_od_conformation()
    {
        $input = $this->input->post();
        $data['od_data'] = $this->transaction_model->get_od_datas($input['id']);
        $this->load->view('employee/transaction/ad_recovery_conformation', $data);
    }

    public function update_recovery_od_data()
    {

        $post = $this->input->post();

        $od = array(

            'paid_amount'             => $post['paid_amount'] + $post['rest_amount'],
            'rest_amount'             => 0,
            'pay_date'                => date('Y-m-d'),
            'week'                    => date('W'),
            'created_by_user_type_id' => $this->session->userdata('user_id'),
            'created_at'              => date('Y-m-d'),
            'status'                  => 2,

        );
        $this->common_model->update_data('group_member_payment_details', array('id' => $post['id']), $od);

        $status = array(

            'payment_status' => 2,

        );
        $this->common_model->update_data('group_loan_payment_details', array('id' => $post['emi_id']), $status);

        $loan_status = array(

            'payment_status' => 2,

        );
        $this->common_model->update_data('add_group_loan', array('id' => $post['group_loan_id']), $loan_status);

        $data = array('icon' => 'success', 'text' => 'Posting Recovered Successfully!');
        echo json_encode($data);
    }

    // ---------------------------------- save posting data Section start -------------------------------
    public function save_posting_data()
    {
        $data = $this->input->post();
        $data = $this->transaction_model->save_posting_data_mod($data['id']);
        foreach ($data as $d) {
            $posting = array(
               
            'branch_id'               => $d['branch_id'],
            'emi_id'                  => $d['id'],
            'member_id'               => $d['mem_id'],
            'group_loan_id'           => $d['group_loan_id'],
            'total_payble_amount'     => $d['monthly_emi'],
            'emi_date'                => $d['payment_date'],
            'paid_amount'             => $d['monthly_emi'],
            'pay_date'                => date('Y-m-d'),
            'week'                    => date('W'),
            'created_by_user_type_id' => $this->session->userdata('user_id'),
            'created_at'              => date('Y-m-d'),
            'status'                  => 2,
            );
            $this->common_model->save_data('group_member_payment_details', $posting);
            $status = array('payment_status' => 2);
            $this->common_model->update_data('group_loan_payment_details', array('id' => $d['id']), $status);
    
            $loan_status = array('payment_status' => 2);
            $this->common_model->update_data('add_group_loan', array('id' => $d['id']), $loan_status);
            
            $data = array('icon' => 'success', 'text' => 'Posting Successfully!');
                     
           }
        }

       

        public function update_recovery_ad_data()
        {
            $post = $this->input->post();
            $remAdvAmo = $post['adv_amount']-$post['monthly_emi'];
            $paid_amount = $post['adv_amount']-$remAdvAmo;
            if($post['adv_amount'] > $paid_amount)
            {
                $ad = array(
                    'paid_amount'             => $paid_amount,
                    'adv_amount'              => $remAdvAmo,
                    'pay_date'                => date('Y-m-d'),
                    'week'                    => date('W'),
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => date('Y-m-d'),
                    'status'                  => 2,
                );
                $this->common_model->update_data('group_member_payment_details', array('id' => $post['id']), $ad);
                $status = array(
                    'payment_status' => 2,
                );
                $this->common_model->update_data('group_loan_payment_details', array('id' => $post['emi_id']), $status);
                $loan_status = array(
                    'payment_status' => 2,
                );
                $this->common_model->update_data('add_group_loan', array('id' => $post['group_loan_id']), $loan_status);
                $data = array('icon' => 'success', 'text' => 'Posting Recovered Successfully!');
            }else{
                $this->session->set_flashdata('common', '<div class="alert alert-success">Not Update ');
                redirect('Transaction/recovery_ad_conformation');
            }
           
            echo json_encode($data);
        }

        public function recovery_posting_conformation()
    {
        $input = $this->input->post();
        $data['all_data'] = $this->transaction_model->get_datas($input['id']);
        $this->load->view('employee/transaction/recovery_conformation', $data);
    }  

    public function update_recovery_posting_data()
    {
        
        $post = $this->input->post();
        $remAdvAmo = $post['advance_amo']-$post['paid_amount'];
        $paid_amount = $post['advance_amo']-$remAdvAmo;
        if($post['advance_amo'] >= $post['paid_amount'])
        {
            $posting = array(

                'branch_id'               => $this->session->userdata('branch_id'),
                'emi_id'                  => $post['emi_id'],
                'member_id'               => $post['member_id'],
                'group_loan_id'           => $post['group_loan_id'],
                'total_payble_amount'     => $post['total_payble_amount'],
                'emi_date'                => $post['emi_date'],
                'paid_amount'             => $paid_amount,
                'adv_amount'              => $remAdvAmo,
                'interest_amount'         => $post['interest_amount'],
                'pay_date'                => date('Y-m-d'),
                'week'                    => date('W'),
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'created_at'              => date('Y-m-d'),
                'status'                  => 2,
            );
            $this->common_model->save_data('group_member_payment_details', $posting);
    
            $status = array('payment_status' => 2);
            $this->common_model->update_data('group_loan_payment_details', array('id' => $post['emi_id']), $status);
    
            $loan_status = array('payment_status' => 2);
            $this->common_model->update_data('add_group_loan', array('id' => $post['group_loan_id']), $loan_status);
    
            $data = array('icon' => 'success', 'text' => 'Posting Recovered Successfully!');
        }else{
            $posting = array(

                'branch_id'               => $this->session->userdata('branch_id'),
                'emi_id'                  => $post['emi_id'],
                'member_id'               => $post['member_id'],
                'group_loan_id'           => $post['group_loan_id'],
                'total_payble_amount'     => $post['total_payble_amount'],
                'emi_date'                => $post['emi_date'],
                'paid_amount'             => $post['paid_amount'],
                'adv_amount'              => $post['advance_amo'],
                'interest_amount'         => $post['interest_amount'],
                'pay_date'                => date('Y-m-d'),
                'week'                    => date('W'),
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'created_at'              => date('Y-m-d'),
                'status'                  => 2,
            );
            $this->common_model->save_data('group_member_payment_details', $posting);
            $status = array('payment_status' => 2);
            $this->common_model->update_data('group_loan_payment_details', array('id' => $post['emi_id']), $status);
            $loan_status = array('payment_status' => 2);
            $this->common_model->update_data('add_group_loan', array('id' => $post['group_loan_id']), $loan_status);
            $data = array('icon' => 'success', 'text' => 'Posting Recovered Successfully!');
        }
        
        echo json_encode($data);
    }



    }


