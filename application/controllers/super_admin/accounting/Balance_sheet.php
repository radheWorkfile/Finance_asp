<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Balance_sheet extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('super_admin/Common_model', 'common_model');
        $this->load->model('super_admin/accounting/Income_model', 'income_model');
        $this->load->model('super_admin/accounting/Report_balance_sheet', 'balance_sheet');
        $this->load->helper(array('form', 'url'));
        ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);
    }


    public function index()
    {

        $data['title'] = 'Balance Sheet';
        $data['breadcrums'] = 'Balance Sheet';
        $yesterday = date("Y-m-d", strtotime("-1 day"));

        $data['income_amo'] = $this->common_model->all_data_con('income as inc', array('created_at' => date("Y-m-d")), 'sum(inc.amount) as income_amo');

        $data['expense_amo'] = $this->common_model->all_data_con('expense as ex', array('expense_data' => date("Y-m-d")), 'sum(ex.amount) as expense_amo');

        $data['total_amo'] = $this->common_model->all_data('balance_sheet as bs', 'bs.id,bs.created_at,,bs.total_amount,');
        
        $data['layout'] = 'accounting/balance_sheet/add_balance_sheet.php';
        $this->load->view('super_admin/base', $data);
    }

    public function add_balance_sheet()
    {
        $data = $this->input->post();
        $balance_sheet = array(

            'total_amount'            => $data['total_amo'] + $data['total_curr_ass'],
            'income_amo'               => $data['income_amo'],
            'expense_amo'              => $data['expense_amo'],
            'current_assets'           => $data['curr_assets'],
            'total_current_assets'     => $data['total_curr_ass'],
            'submited_date'            => date('Y-m-d'),
            'created_at'               => date('Y-m-d'),

        );
        if ($this->common_model->update_data('balance_sheet', array('id' => 1), $balance_sheet)) {
            $data = $this->common_model->save_data('transaction_history', $balance_sheet);
            $data = array('icon' => 'success', 'text' => 'Balance Sheet Added Successfully');
        }
        echo json_encode($data);
    }


    public function balance_report()
    {
        $post = $this->input->post();
        $data['title'] = 'Balance Report';
        $data['breadcrums'] = 'Balance Report';
        $data['income_source'] = $this->income_model->all_income($post);
        $data['expense'] = $this->income_model->all_expense($post);
        $data['total_inc'] = $this->income_model->total_inc($post);
        $data['total_exp'] = $this->income_model->total_exp($post);
        $data['layout'] = 'accounting/balance_sheet/report_bal_sheet.php';
        $this->load->view('super_admin/base', $data);
    }

 
}
