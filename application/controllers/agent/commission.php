<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commission extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('agent/Common_model', 'common_model');
        $this->load->model('agent/Commission_model', 'commission_model');
        $this->load->helper(array('form', 'url'));
        ($this->session->userdata('user_cate') != 2) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);

    }

    public function manage_commission() {

        $data['title']      = 'Manage All Commission';
        $data['breadcrums'] = 'Manage All Commission';
        $data['layout']     = 'commission/manage_commission.php';
        $this->load->view('agent/base', $data);
        
    }

    /* ======================================= All Commission Data ============================================ */

    public function all_commission_data()
    {

        $post_data = $this->input->post();
        $record = $this->commission_model->all_commission_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_commission(' . $row->id . ')" title="Click to View Lead Details"><i class="fas fa-eye text-success"></i></a>';

            if($row->commission_type == 1) {
                $cmsn_type = "On File"; 
            } else if($row->commission_type == 2) {
                $cmsn_type = "On Approved";
            }

            $return['data'][] = array(

                $i++,
                $row->agent_name . "(" . $row->agent_id . ")",
                $row->customer_name . "(" . $row->customer_id . ")",
                $row->loan_type_name,
                $cmsn_type,
                "₹ ".$row->total_commission_amount,
                $view,

            );
        }

        $return['recordsTotal'] = $this->commission_model->total_count();
        $return['recordsFiltered'] = $this->commission_model->total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function view_commission_data() {

        if($this->input->is_ajax_request()) { 

            $view = $this->input->post();
            $data['vw_commission'] = $this->commission_model->get_commission_data($view['id']);
            $data['rest_amt'] = $this->db->select('id,rest_amount')->where('commission_earning_id', $view['id'])->order_by('id', 'DESC')->limit(1)->get('commission_payment_details')->row_array();
            $this->load->view('agent/commission/view_commission', $data);

        }

    }

    public function update_commission() {

        if($this->input->is_ajax_request()) {

            $upd = $this->input->post();
            
            $data['agent']      = $this->common_model->all_data('agent', 'id, agent_id, name');
            $data['customer']   = $this->common_model->all_data('customer', 'id, customer_id, name');
            $data['loan_type']  = $this->common_model->all_data('loan_type', 'id, loan_type_name');
            $data['upd_commission'] = $this->commission_model->get_commission_data($upd['id']);
            $this->load->view('agent/commission/update_commission', $data);

        }

    }

    public function update_commission_data() {

        $this->form_validation->set_rules('agent_name', 'Agent Name', 'required');
        $this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
        $this->form_validation->set_rules('loan_type', 'Loan Type', 'required');
        $this->form_validation->set_rules('commission_type', 'Commission Type', 'required');

        if($this->form_validation->run()) {

            $upd = $this->input->post();

            $mem = array(

                'id'                      => $upd['id'],
                'agent_name'              => $upd['agent_name'],
                'customer_name'           => $upd['customer_name'],
                'loan_type'               => $upd['loan_type'],
                'commission_type'         => $upd['commission_type'],
                'commission'              => $upd['commission'],
                'commission_amount'       => $upd['commission_amount'],
                'commission_percentage'   => $upd['commission_percentage'],
                'loan_amount'             => $upd['loan_amount'],
                'total_commission_amount' => $upd['total_commission_amount'],
        
            );
            $this->common_model->update_data('commission', array('id' => $upd['id']), $mem);
            $data = array('icon' => 'success', 'text' => 'Commission Data Updated Successfully');

        } else {

            $msg = array(

                'agent_name'      => form_error('agent_name'),
                'customer_name'   => form_error('customer_name'),
                'loan_type'       => form_error('loan_type'),
                'commission_type' => form_error('commission_type'),
            );
            $data = array('icon' => 'error', 'text' => $msg);

        }
        echo json_encode($data);

    }

}
