<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Commission extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('super_admin/Common_model', 'common_model');
        $this->load->model('super_admin/Commission_model', 'commission_model');
        $this->load->helper(array('form', 'url'));
        ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);

    }

    public function add_commission()
    {

        $data['title']        = 'Create Commission';
        $data['breadcrums']   = 'Create Commission';
        $data['agent']        = $this->common_model->all_data('agent', 'id, name, agent_id');
        $data['loan_product'] = $this->common_model->all_data('loan_product', 'id, loan_product_name');
        $data['layout']       = 'commission/add_commission.php';
        $this->load->view('super_admin/base', $data);

    }

    public function commission_data() {

        if($this->input->is_ajax_request()) {

            $loan_id = $this->input->post('loan_id');
            $id = $this->input->post('id');
            $data = $this->common_model->get_data('commission_category', array('loan_type' => $loan_id, 'commission_type' => $id), '*');
            echo json_encode($data);

        }

    }

    public function customer_data() {

        if($this->input->is_ajax_request()) {

            $inp = $this->input->post();
            $data = $this->common_model->get_data('customer', array('id' => $inp['id']), 'id, loan_amount');
            echo json_encode($data);

        }

    }

    public function manage_commission() {

        $data['title'] = 'Manage All Commission';
        $data['breadcrums'] = 'MAnage All Commission';
        $data['layout']     = 'commission/manage_commission.php';
        $this->load->view('super_admin/base', $data);
        
    }
    
    /* ======================================= Creating Commission Data ============================================ */
    
    public function all_commission_data()
    {
        
        $post_data = $this->input->post();
        $record = $this->commission_model->all_commission_data($post_data);

        foreach($record as $recrd) {

            $total_commission_amount = $recrd->loan_amount * $recrd->commission_percentage / 100;

            $customer = $this->common_model->get_data('commission_earning', array('aadhar_card_no' => $recrd->aadhar_card_no, 'loan_type' => $recrd->loan_type, 'commission_type' => $recrd->commission_type),  'customer_name, aadhar_card_no, loan_type');
            
            $cmsn = [
                
                'agent_name'              => empty($recrd->ids) ? ' ' : $recrd->ids,
                'customer_name'           => $recrd->id,
                'aadhar_card_no'          => $recrd->aadhar_card_no,
                'loan_type'               => $recrd->loan_type,
                'commission_type'         => $recrd->commission_type,
                'commission'              => empty($recrd->commission) ? 0 : $recrd->commission,
                'commission_amount'       => $recrd->commission_amount,
                'commission_percentage'   => empty($recrd->commission_percentage) ? 0 : $recrd->commission_percentage,
                'loan_amount'             => $recrd->loan_amount,
                'total_commission_amount' => $total_commission_amount,
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'created_at'              => date('Y-m-d'),
                
            ];

            $age_id =  $recrd->ids;
            if(!empty($customer)) {
                   
            } else {

                // if(!empty($post_data['rejected_commission_agent_name'])) {
                //     foreach($agent as $ag) {
                //         $i = 1;
                //         if($ag['id'] != $age_id) {
        
                //             if($i == 1) {

                //                 $this->commission_model->insert_data($cmsn);break;
                                
                //             }

                //         } else {
                            
                //         }
                //         $i++;

                //     }

                // } else {

                    $this->commission_model->insert_data($cmsn);

                // }

            }
                
        }
        $data = array('icon' => 'success', 'text' => 'Commission Earning Created Successfully');
        echo json_encode($data);
        
    }

    /* ======================================= Created All Commission Data ============================================ */
    
    public function view_commission_data()
    {
        
        $post_data = $this->input->post();
        $record = $this->commission_model->view_all_commission_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_commission_data(' . $row->id . ')" title="Click to View Commission Details"><i class="fas fa-eye text-success"></i></a>&emsp;';

            if ($row->payment_status == 2) { 
                $payment = '<b class="text-success">
                &nbsp;&nbsp;&nbsp;&nbsp; Paid <i class="fa fa-check"></i></b>';
            } else { 
                $payment = '<a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target=".update_payment_data" onclick="update_payment_data(' . $row->id . ')" title="Click to Create payment" style="padding-top: 2px; padding-bottom: 4px;">
                Pay Now</a>';
            }

            if($row->commission_type == 1) {

                $cmsn_type = "On File";
            }elseif($row->commission_type == 2) {

                $cmsn_type = "On Approve";
            }

            if($row->commission == 1) {

                $cmsn = "In Percentage";
            } elseif($row->commission == 2) {

                $cmsn = " In Amount";
            } else {
                $cmsn = "";
            }

            $return['data'][] = array(

                $i++,
                $row->customer_name . "(" . $row->customer_id . ")",
                $row->agent_name . "(" . $row->agent_id . ")",
                $row->loan_type_name,
                $cmsn_type,
                $view . $payment,

            );

        }

        $return['recordsTotal'] = $this->commission_model->comm_total_count();
        $return['recordsFiltered'] = $this->commission_model->comm_total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function view_commission()
    {

        if ($this->input->is_ajax_request()) {

            $view = $this->input->post();
            $data['view_commission'] = $this->commission_model->get_commission_data($view['id']);
            $this->load->view('super_admin/commission/view_commission', $data);

        }

    }

    public function update_commission()
    {

        if ($this->input->is_ajax_request()) {

            $upd = $this->input->post();
            $data['upd_commission'] = $this->commission_model->get_commission_data($upd['id']);
            $data['rest_amt']    = $this->common_model->get_data('commission_payment_details', array('commission_earning_id' => $upd['id']), 'id, rest_amount');
            $this->load->view('super_admin/commission/update_commission', $data);

        }

    }

    public function update_commission_payment_data() {
       
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
            
            $config['upload_path']          = './uploads/recipet/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('recipet')) {

                $msg = array('error' => $this->upload->display_errors());
                $data = array('text' => $msg, 'icon' => "error");

            } else {

                $img_data = $this->upload->data();
                $img = ('uploads/recipet/' . $img_data['raw_name'] . $img_data['file_ext']);
                
            }
            
            $amou = array (

                'commission_earning_id'   => $pay['commission_earning_id'],
                'agent_id'                => $pay['agent_id'],
                'total_payble_amount'     => $pay['total_payble_amount'],
                'paid_amount'             => $pay['paid_amount'],
                'rest_amount'             => $pay['rest_amount'],
                'mop'                     => $pay['mop'],
                'acc_no'                  => $pay['acc_no'],
                'cash_received_by'        => $pay['cash_received_by'],
                'pay_date'                => $pay['pay_date'],
                'pay_remarks'             => $pay['pay_remarks'],
                'recipet'                 => empty($img) ? '' : $img,
                'created_at'            => date('Y-m-d'),
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'status'                  => 2
                
            );
            $this->common_model->save_data('commission_payment_details', $amou);

            $last_id = $this->db->select('id,rest_amount')->where('commission_earning_id', $pay['commission_earning_id'])->order_by('id', 'DESC')->limit(1)->get('commission_payment_details')->row_array();

            if($last_id['rest_amount'] == 0) {

                $comm = array(
    
                    'id'             => $pay['commission_earning_id'],
                    'payment_status' => 2,
                );
                $this->common_model->update_data('commission_earning', array('id' => $pay['commission_earning_id']), $comm);
            }
            $data=array('text' => 'Commission Payment Created Successfully', 'icon' => 'success');

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

}