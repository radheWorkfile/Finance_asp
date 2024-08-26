<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Income extends CI_Controller
{
    
    public function __construct()
    {

        parent::__construct();
        $this->load->model('super_admin/Common_model', 'common_model');
        $this->load->model('super_admin/accounting/Income_model', 'income_model');
        $this->load->helper(array('form', 'url'));
        ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);

    }

    public function manage_income()  
{
    $data['title'] = 'Manage Income';
    $data['breadcrums'] = 'Manage Income';
    $data['layout'] = 'accounting/income/manage_income.php';
    $this->load->view('super_admin/base',$data);
}



    public function add_income()
    {
        // echo "<pre>"; print_r($this->session->userdata());die;
        $data['title'] = 'Add Income';
        $data['breadcrums'] = 'Add Income';   
        $data['all_sources'] = $this->common_model->all_data('income_sources','source_name,id');

        $data['principal_paid'] = $this->common_model->all_data_con('group_member_payment_details as gmpd',array('pay_date'=>date("Y-m-d")),'sum(gmpd.paid_amount - gmpd.interest_amount) as totalAmo');

        $data['intPaid'] = $this->common_model->all_data_con('group_member_payment_details as gmpd',array('pay_date'=>date("Y-m-d")),'sum(gmpd.interest_amount) as intPaid');

        $data['proFee'] = $this->common_model->all_data_con('add_group_loan as agl',array('created_at'=>date("Y-m-d")),'sum(agl.processing_fee) as proFee');

        $data['layout'] = 'accounting/income/add_income.php';
        $this->load->view('super_admin/base', $data);

        
    }

    public function add_income_data() {

        $inp = $this->input->post();

        $this->form_validation->set_rules('source',                  'Source',                  'required');
        $this->form_validation->set_rules('mop',                     'Mode of Payment',         'required');
        if($inp['mop'] == 1) {

            $this->form_validation->set_rules('cash_received_by',    'Cash Received by',        'required');
        } elseif($inp['mop'] == 2 || $inp['mop'] == 3) {

            $this->form_validation->set_rules('Received_acc_no',     'Received Account No.',    'required');
        }
        $this->form_validation->set_rules('amount',                  'Amount',                  'required');
        $this->form_validation->set_rules('income_date',             'Income Date',             'required');
        
        if($this->form_validation->run() ==  TRUE) {
            
            // $agent_id = rand(pow(10, 6-1), pow(10, 6)-1);
            
            $config['upload_path']          = './uploads/income_proof/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = config_item('image_size');
            
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('proof_image')) {
                
                $msg = array('error' => $this->upload->display_errors());
                $data = array('text' => $msg, 'icon' => "error");
            } else {
                
                $img_data = $this->upload->data();
                $pf_img = $img_data['raw_name'] . $img_data['file_ext'];
            }

            $income = array(

                'source'                  => $inp['source'],
                'mop'                     => $inp['mop'],
                'cash_received_by'        => $inp['cash_received_by'],
                'Received_acc_no'         => $inp['Received_acc_no'],
                'amount'                  => $inp['amount'],
                'income_date'             => $inp['income_date'],
                'varification_proof_type' => $inp['varification_proof_type'],
                'proof_image'             => empty($pf_img) ? '' : $pf_img,
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'created_at'              => date('Y-m-d'),
                
            );
            $this->common_model->save_data('income', $income);
            $data = array('icon' => 'success', 'text' => 'New Income Added Successfully');

        } else {

            $msg = array(

                'source'                  => form_error('source'),
                'mop'                     => form_error('mop'),
                'cash_received_by'        => form_error('cash_received_by'),
                'Received_acc_no'         => form_error('Received_acc_no'),
                'amount'                  => form_error('amount'),
                'income_date'             => form_error('income_date'),

            );
            $data = array('icon' => 'error', 'text' => $msg);

        }
        echo json_encode($data);
    }

    public function manage_incomes() {

        $data['title']      = 'Manage All Incomes';
        $data['breadcrums'] = 'MAnage All Incomes';
        $data['layout']     = 'accounting/income/manage_income.php';
        $this->load->view('super_admin/base', $data);
        
    }



    /*======================================= All Income Data ============================================*/

    public function income_data()
    {
        $post_data = $this->input->post();
        $record = $this->income_model->all_income_data($post_data);
        $i = $post_data['start'] + 1;
        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_income" style="margin-left:15px;" onclick="view_income(' . $row->id . ')" title="Click to View Income Details"><i class="fas fa-eye text-success"></i></a>&emsp;

            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_income_details(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

            $status = ($row->status == 1) ? '
            <a style="color:green; margin-left:15px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' income\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
            :
            '<a style="color:red; margin-left:15px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' income\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>';

            if($row->cash_received_by){
                $cash_received_by = $row->cash_received_by;
            } else{
               $cash_received_by = "<span>N/A</span>";
            }

            $return['data'][] = array(        

                $i++,
                $cash_received_by,
                $row->amount,
                $row->income_date,
                $view. "&emsp; <span id='".$row->id ."'>".$status . "</span>&emsp;",

            );
        }

        $return['recordsTotal'] = $this->income_model->total_count();
        $return['recordsFiltered'] = $this->income_model->total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function view_income_data() {
        if($this->input->is_ajax_request()) { 
            $view = $this->input->post();
            $data['income'] = $this->income_model->get_income_data($view['id']);
            $this->load->view('super_admin/accounting/income/view_income', $data);
            }
          }

    public function up_income_det()
    {
        if($this->input->is_ajax_request()) { 
            $view = $this->input->post();
            $data['income_data'] = $this->income_model->get_income_data($view['id']);
            $this->load->view('super_admin/accounting/income/update_income_det',$data);
        }
    }

    

    public function update_agent() {
        if($this->input->is_ajax_request()) {
            $upd = $this->input->post();
            $data['upd_agent'] = $this->income_model->get_agent_data($upd['id']);
            $this->load->view('super_admin/agent/update_agent', $data);
        }
    }

    public function update_agent_data() {

        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('aadhar_card_no', 'Aadhar Card No.', 'required');
        $this->form_validation->set_rules('pan_no', 'Pan No.', 'required');

        if($this->form_validation->run()) {

            $upd = $this->input->post();

            $config['upload_path']          = './uploads/agent_document/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = config_item('image_size');
            
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('aadhar_image')) {
                
                $msg = array('error' => $this->upload->display_errors());
                $data = array('text' => $msg, 'icon' => "error");
                
            } else {
                
                $img_data = $this->upload->data();
                $ad_img = base_url('uploads/agent_document/' . $img_data['raw_name'] . $img_data['file_ext']);
                
            }
            
            if (!$this->upload->do_upload('pan_image')) {
                $msg = array('error' => $this->upload->display_errors());
                $data = array('text' => $msg, 'icon' => "error");
            } else {
                $img_data = $this->upload->data();
                $pan_img = base_url('uploads/agent_document/' . $img_data['raw_name'] . $img_data['file_ext']);
                
            }

            $mem = array(

                'id'                 => $upd['id'],
                'name'               => $upd['name'],
                'dob'                => $upd['dob'],
                'address'            => $upd['address'],
                'mobile_no'          => $upd['mobile_no'],
                'email'              => $upd['email'],
                'aadhar_card_no'     => $upd['aadhar_card_no'],
                'aadhar_image'       => empty($ad_img) ? $upd['aadhar_img_upd'] : $ad_img,
                'pan_no'             => $upd['pan_no'],
                'pan_image'          => empty($pan_img) ? $upd['pan_img_upd'] : $pan_img,
                'password'           => $upd['password'],
                'account_no'         => $upd['account_no'],
                'ifsc_code'          => $upd['ifsc_code'],
                'branch_name'        => $upd['branch_name'],
                'bank_name'          => $upd['bank_name'],
                'nominee_name'       => $upd['nominee_name'],
                'nominee_number'     => $upd['nominee_number'],
        
            );
            $this->common_model->update_data('agent', array('id' => $upd['id']), $mem);
            
            $use = array(
                
                'agent_id'                => $upd['agent_id'],
                'department_type'         => 2,
                'name'                    => $upd['name'],
                'mobile'                  => $upd['mobile_no'],
                'email'                   => $upd['email'],
                'address'                 => $upd['address'],
                'password'                => md5($upd['password']),
                'show_ps'                 => $upd['password'],
                'created_by_user_id' => $this->session->userdata('user_id'),
                'created_at'              => config_item('work_end'),
                
            );
            $this->common_model->update_data('users', array('agent_id' => $upd['agent_id']), $use);
            $data = array('icon' => 'success', 'text' => 'Member Data Updated Successfully');

        } else {

            $msg = array(

                'name'           => form_error('name'),
                'dob'            => form_error('dob'),
                'address'        => form_error('address'),
                'mobile_no'      => form_error('mobile_no'),
                'email'          => form_error('email'),
                'aadhar_card_no' => form_error('aadhar_card_no'),
                'pan_no'         => form_error('pan_no'),
            );
            $data = array('icon' => 'error', 'text' => $msg);

        }
        echo json_encode($data);

    }
    public function update_group_data() {

        $this->form_validation->set_rules('group_name[]', 'Group Name', 'required');

        if($this->form_validation->run() == TRUE) {

            $upd = $this->input->post();
            $grp = implode(",", $upd['group_name']);

            $upd_grp = array(

                'id' => $upd['id'],
                'group_name' => $grp,

            );
            $this->common_model->update_data('member', array('id' => $upd['id']), $upd_grp);
            $data = array('icon' => 'success', 'text' => 'Successfully Added In Group');

        } else {

            $msg = array(

                'group_name[]' => form_error('group_name'),

            );
            $data = array('icon' => 'error', 'text' => $msg);

        }
        echo json_encode($data);

    }

}


