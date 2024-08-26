<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loan_detials extends CI_Controller
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
        $data['title'] = 'Client Details';
        $data['breadcrumb'] = 'Client Details';
        $value = $this->Common_model->get_data('users',array('id'=>$this->session->userdata('user_id')),'id,member_id');
        $data['user_data'] = $this->Common_model->get_data('member',array('member_id'=>$value['member_id']),'*');
        $data['layout'] = 'user_details.php';
        $this->load->view('customer/base',$data);
    }

    public function loan_info()
    {
        $data['title'] = 'Client Loan Information';
        $data['breadcrumb'] = 'Client Loan Information';
        $data['layout'] = 'cus_loan_info.php';
        $this->load->view('customer/base',$data); 
    }

    public function client_loan()
    {
            $data = $this->input->post();
            $data['loan_det'] = $this->Common_model->all_data_con('group_loan_payment_details',array('member_id'=>$this->session->userdata('user_id')),'*');
            $this->load->view('customer/fetch_client_data',$data); 
    }
}
