<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fore_closing_loan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('employee/Common_model', 'common_model');
        $this->load->model('employee/Fore_closing_loan_model', 'fore_closing');
        $this->load->model('employee/group_loan_model', 'fore_closing');
        ($this->session->userdata('user_cate') != 3) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);
    }

    public function create_fore_closing()
    {
        $data['title']      = 'Create Fore Close Loan';
        $data['breadcrums'] = 'Create Fore Close Loan';
        $data['member_id'] = $this->common_model->get_last('member', '*');
        // $data['staff']      = $this->common_model->all_data('staff', 'id, staff_id, full_name');
        $data['staff']      = $this->common_model->all_data_con('staff',array('branch_id' => $this->session->userdata('branch_id')),'id,staff_id,full_name');
        $data['layout']     = 'fore_closing/create_fore_closing.php';
        $this->load->view('employee/base', $data);
    }

    public function create_fore_closing1()
    {
        $value = $this->input->post();
        $data = $this->fore_closing->AllData($value);

        if ($data) {
            $data = array('text' => $data, "icon" => 'success');
        } else {
            $data = array('text' => "Data not Found", "icon" => 'error');
        }
        echo json_encode($data);
    }


    public function save_closeIng_data()
    {
        $this->form_validation->set_rules('loan_no', 'Enter Loan No.', 'required');
        if ($this->form_validation->run() ==  true) {

            $input = $this->input->post();
            
            $close = array(
                'branch_id'         => $this->session->userdata('branch_id'),
                'loan_no'           => $input['loan_no'],
                'loan_close_date'   => $input['loan_close_date'],
                'member_id'         => $input['member_id'],
                'center_id'         => $input['center_id'],
                'group_id'          => $input['group_id'],
                'receipt_no'        => $input['receipt_no'],
                'member_name'       => $input['member_name'],
                'disbursed_loan'    => $input['disbursed_loan'],
                'recovered_amount'  => $input['recovered_amount'],
                'interest_amount'   => $input['interest_amount'],
                'penalty_charge'    => $input['penalty_charge'],
                'foreclose_amount'  => $input['foreclose_amount'],
                'disbursed_data'    => $input['disbursed_data'],
                'lst_rec_amount'    => $input['lst_rec_amount'],
                'mop' => $input['mop'],
                'collector' => $input['collector'],
                'remark' => $input['remark'],
            );
            if ($this->common_model->save_data('closing_loan_data', $close)) {
                $sta = array(
                    'status' => 2,
                );
                $value =  $this->common_model->update_data('add_group_loan', array('member_id' => $input['member_id']), $sta);
                if ($value) {
                    $stat = array(
                        'status' => 2,
                    );
                    $data =  $this->common_model->update_data('group_loan_payment_details', array('member_id' => $input['member_id']), $stat);
                    $data = array('text' => 'Added Successfully', 'icon' => 'success');
                } else {
                    $data = array('text' => 'Sorry to interrupt', 'icon' => 'error');
                }
            } else {
                $data = array('text' => 'Something1 went wrong', 'icon' => 'error');
            }
        } else {
            $data = array(
                'loan_no'    => form_error('loan_no'),
            );
            $data = array('text' => $data, 'icon' => 'error');
        }
        echo json_encode($data);
    }

    public function manage_close_loan()
    {
        $data['title']      = 'Manage Close Loan';
        $data['breadcrums'] = 'Manage Close Loan';
        $data['target'] = 'employee/Fore_closing_loan/fore_close_data';
        $data['layout']     = 'fore_closing/manage_close_loan.php';
        $this->load->view('employee/base', $data);
    }

    public function fore_close_data()
    {

        $post_data = $this->input->post();
        $record = $this->fore_closing->all_member_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-left:-15px;" onclick="view_data(' . $row->id . ')" title="Click to View Client Details"><i class="fas fa-eye" style="color:#008288;border:1px dotted #008288;padding:0.2rem 0.5rem;border-radius:0.2rem;"></i></a>&emsp;';

            $status = ($row->status == 1) ? '
            <a style="color:green; " href="javascript:void()" onClick="return changeLoanStatus(\'' . $row->id . '\',\'0\',\' closing_loan_data\',\'employee/Fore_closing_loan/changeStatus\')" title="Click to Di-Active Client"><b><i class="fa fa-check"></i> </b></a>&emsp;'
            :
            '<a style="color:red;margin-right:1.2rem;"  href="javascript:void()"  onClick="return changeLoanStatus(\'' . $row->id . '\',\'1\',\' closing_loan_data\',\'employee/Fore_closing_loan/changeStatus\')" title="Click to Active Client"><b><i class="fa fa-times"></i> </b></a>';

            $return['data'][] = array(
                $i++,
                $row->member_name,
                $row->loan_no,
                $row->interest_amount, 
                $row->foreclose_amount,
                // $row->first_name ." ". $row->mid_name ." ". $row->last_name,
                "<span id='" . $row->id . "'>" . $status . "</span>&emsp;" . $view,

            );
        }

        $return['recordsTotal'] = $this->fore_closing->total_count();
        $return['recordsFiltered'] = $this->fore_closing->total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
    }

    public function view_data()
    {
        $data = $this->input->post();
        $data['Mem_details'] = $this->common_model->get_data('closing_loan_data', array('id' => $data['id']), '*');
        $this->load->view('employee/fore_closing/view_foce_close_loan', $data);
    }


    function changeStatus()
    {
        if ($this->input->is_ajax_request()) {

            $data = $this->input->post();
            $this->common_model->chageStatus($data);
            echo ($data['status'] == 1) ? "
        <a style='color:green' href='javascript:void()'onClick='return changeStatus(\"" . $data['id'] . "\",\"0\",\"" . $data['table'] . "\",\"" . $data['loader'] . "\")'title='click to block user'><b><i class='fa fa-check'></i> </b></a>" : "
        <a style='color:red'   href='javascript:void()'onClick='return changeStatus(\"" . $data['id'] . "\",\"1\",\"" . $data['table'] . "\",\"" . $data['loader'] . "\")'title='click to active user'><b><i class='fa fa-times'></i></b></a>";
        }
    }
}
