<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agent extends CI_Controller
{
    
    public function __construct()
    {

        parent::__construct();
        $this->load->model('super_admin/Common_model', 'common_model');
        $this->load->model('super_admin/Agent_model', 'agent_model');
        $this->load->helper(array('form', 'url'));
        ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);

    }

    public function add_agent()
    {

        $data['title'] = 'Add Agent';
        $data['breadcrums'] = 'Add Agent';
        $data['layout'] = 'agent/add_agent.php';
        $this->load->view('super_admin/base', $data);

        
    }

    public function add_agent_data() {

        $this->form_validation->set_rules('name', 'Full Name', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('aadhar_card_no', 'Aadhar Card No.', 'required');
        $this->form_validation->set_rules('pan_no', 'Pan No.', 'required');
        
        if($this->form_validation->run() ==  TRUE) {
            
            $inp = $this->input->post();
            $agent_id = rand(pow(10, 6-1), pow(10, 6)-1);
            
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

            $member = array(

                'agent_id'                => $agent_id,
                'name'                    => $inp['name'],
                'dob'                     => $inp['dob'],
                'address'                 => $inp['address'],
                'mobile_no'               => $inp['mobile_no'],
                'email'                   => $inp['email'],
                'aadhar_card_no'          => $inp['aadhar_card_no'],
                'aadhar_image'            => empty($ad_img) ? '' : $ad_img,
                'pan_no'                  => $inp['pan_no'],
                'pan_image'               => empty($pan_img) ? '' : $pan_img,
                'password'                => $inp['password'],
                'account_no'              => $inp['account_no'],
                'ifsc_code'               => $inp['ifsc_code'],
                'branch_name'             => $inp['branch_name'],
                'bank_name'               => $inp['bank_name'],
                'nominee_name'            => $inp['nominee_name'],
                'nominee_number'          => $inp['nominee_number'],
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'created_at'              => config_item('work_end'),
                
            );
            $this->common_model->save_data('agent', $member);
            
            $user = array(
                
                'agent_id'                => $agent_id,
                'department_type'         => 2,
                'name'                    => $inp['name'],
                'mobile'                  => $inp['mobile_no'],
                'email'                   => $inp['email'],
                'address'                 => $inp['address'],
                'password'                => md5($inp['password']),
                'show_ps'                 => $inp['password'],
                'created_by_user_id' => $this->session->userdata('user_id'),
                'created_at'              => date('Y-m-d'),
                
            );
            $this->common_model->save_data('users', $user);
            $data = array('icon' => 'success', 'text' => 'New Agent Added Successfully');

        } else {

            $msg = array(

                'name'           => form_error('name'),
                'dob'            => form_error('dob'),
                'address'        => form_error('address'),
                'mobile_no'      => form_error('mobile_no'),
                'email'          => form_error('email'),
                'aadhar_card_no' => form_error('aadhar_card_no'),

            );
            $data = array('icon' => 'error', 'text' => $msg);

        }
        echo json_encode($data);

    }

    public function manage_agent() {

        $data['title'] = 'Manage All Agent';
        $data['breadcrums'] = 'MAnage All Agent';
        $data['layout']     = 'agent/manage_agent.php';
        $this->load->view('super_admin/base', $data);
        
    }

    /*======================================= All Agent Data ============================================*/
    public function agent_data()
    {

        $post_data = $this->input->post();
        $record = $this->agent_model->all_agent_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_agent(' . $row->id . ')" title="Click to View Lead Details"><i class="fas fa-eye text-success"></i></a>&emsp;

            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_agent(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

            $status = ($row->status == 1) ? '
            <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' agent\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
            :
            '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' agent\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>';

            $return['data'][] = array(

                $i++,
                $row->name . "(" . $row->agent_id . ")",
                $row->mobile_no,
                $row->email,
                $row->address,
                $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

            );
        }

        $return['recordsTotal'] = $this->agent_model->total_count();
        $return['recordsFiltered'] = $this->agent_model->total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function view_agent_data() {

        if($this->input->is_ajax_request()) { 

            $view = $this->input->post();
            $data['agent'] = $this->agent_model->get_agent_data($view['id']);
            $this->load->view('super_admin/agent/view_agent', $data);

        }

    }

    public function update_agent() {

        if($this->input->is_ajax_request()) {

            $upd = $this->input->post();
            $data['upd_agent'] = $this->agent_model->get_agent_data($upd['id']);
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
