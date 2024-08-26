<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('super_admin/common_model','Common_model');
        $this->load->model('super_admin/dashboard_model', 'Dashboard_model');
        ($this->session->userdata('user_cate') != 4) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);
    }
    function index()
    {
        $data['unPaidAmo'] = $this->Common_model->all_data_con('group_loan_payment_details',array('member_id'=>$this->session->userdata('user_id'),'status'=>1),'sum(monthly_emi) as emisec');
        $data['paidAmo'] = $this->Common_model->all_data_con('group_loan_payment_details',array('member_id'=>$this->session->userdata('user_id'),'status'=>2),'sum(monthly_emi) as emisec');
        $data['title'] = 'Dashboard';
        $data['breadcrumb'] = 'Dashboard';
        $this->load->view('customer/base',$data);
    }
}
