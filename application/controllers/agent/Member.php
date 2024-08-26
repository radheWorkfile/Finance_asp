<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('agent/Common_model', 'common_model');
        $this->load->model('agent/Member_model', 'member_model');
        ($this->session->userdata('user_cate') != 2) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);
    }

    public function add_member()
    {
        $data['title'] = 'Add Member';
        $data['breadcrums'] = 'Add Member';
        $data['document']   = $this->member_model->all_document();
        $data['layout'] = 'member/add_member.php';
        $this->load->view('agent/base', $data);
    }

    public function get_sub_documnet_data() {

        $sub = $this->input->post();
        $data = $this->member_model->get_sub_document($sub['id']);
        echo json_encode($data);

    }

    public function add_member_data() {

        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('aadhar_card_no', 'Aadhar Card No.', 'required');

        if($this->form_validation->run() ==  TRUE) { 

            $inp = $this->input->post();
            $docu = $this->common_model->all_data_con('sub_document', array('document_name' => $inp['document_type']), 'id, sub_document_name, input_name');

            $doc_array = array();
            $config['upload_path']          = './uploads/member_document/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;
            
            $this->load->library('upload', $config);
            foreach($docu as $doc){
                if (!$this->upload->do_upload($doc['input_name'])) {
                    
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                } else {
                    
                    $img_data = $this->upload->data();
                    $docume = 'uploads/member_document/' . $img_data['raw_name'] . $img_data['file_ext'];

                    $doc_array[$doc['input_name']] = $docume;
                    
                }

            }

            $documents = json_encode($doc_array);

            $member_id = rand(pow(10, 6-1), pow(10, 6)-1);

            $member = array(

                'member_id'               => $member_id,
                'full_name'               => $inp['full_name'],
                'guardian_name'           => $inp['guardian_name'],
                'dob'                     => $inp['dob'],
                'address'                 => $inp['address'],
                'mobile_no'               => $inp['mobile_no'],
                'email'                   => $inp['email'],
                'aadhar_card_no'          => $inp['aadhar_card_no'],
                'pan_no'                  => $inp['pan_no'],
                'password'                => $inp['password'],
                'account_no'              => $inp['account_no'],
                'ifsc_code'               => $inp['ifsc_code'],
                'branch_name'             => $inp['branch_name'],
                'document_type'           => $inp['document_type'],
                'bank_name'               => $inp['bank_name'],
                'documents'               => $documents,
                'created_by_user_type_id' => $this->session->userdata('user_id'),
                'created_at'              => date('Y-m-d'),

            );
            $this->common_model->save_data('member', $member);

            $use = array(

                'member_id'          => $member_id,
                'department_type'    => 4,
                'name'               => $inp['full_name'],
                'mobile'             => $inp['mobile_no'],
                'email'              => $inp['email'],
                'address'            => $inp['address'],
                'password'           => md5($inp['passowrd']),
                'show_ps'            => $inp['password'],
                'created_by_user_id' => $this->session->userdata('user_id'),
                'created_at'         => date('Y-m-d'),

            );
            $this->common_model->save_data('users', $use);
            $data = array('icon' => 'success', 'text' => 'New Member Added Successfully');

        } else {

            $msg = array(

                'full_name'      => form_error('full_name'),
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
    
    /*======================================= All Member Data ============================================*/

    public function manage_member() {

        $data['title'] = 'Manage All Member';
        $data['breadcrums'] = 'MAnage All Member';
        $data['layout']     = 'member/manage_member.php';
        $this->load->view('agent/base', $data);
        
    }

    public function member_data()
    {

        $post_data = $this->input->post();
        $record = $this->member_model->all_member_data($post_data);
        $i = $post_data['start'] + 1;

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_member(' . $row->id . ')" title="Click to View Lead Details"><i class="fas fa-eye text-success"></i></a>&emsp;

            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_member(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

            $status = ($row->status == 1) ? '
            <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' member\',\'agent/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
            :
            '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' member\',\'agent/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>';

            $return['data'][] = array(

                $i++,
                $row->full_name . "(" . $row->member_id . ")",
                $row->mobile_no,
                $row->email,
                $row->address,
                $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

            );
        }

        $return['recordsTotal'] = $this->member_model->total_count();
        $return['recordsFiltered'] = $this->member_model->total_filter_count($post_data);
        $return['draw'] = $post_data['draw'];
        echo json_encode($return);
        
    }

    public function view_member_data() {

        if($this->input->is_ajax_request()) { 

            $view = $this->input->post();
            $data['member'] = $this->member_model->get_member_data($view['id']);
            $this->load->view('agent/member/view_member', $data);

        }

    }

    public function update_members() {

        if($this->input->is_ajax_request()) {

            $upd = $this->input->post();
            $data['document']   = $this->member_model->all_document();
            $data['upd_memb'] = $this->member_model->get_member_data($upd['id']);
            $this->load->view('agent/member/update_member', $data);

        }

    }

    public function update_member_data() {

        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('aadhar_card_no', 'Aadhar Card No.', 'required');

        if($this->form_validation->run()) {

            $upd = $this->input->post();

            $docu = $this->common_model->all_data_con('sub_document', array('document_name' => $upd['document_type']), 'id, sub_document_name, input_name');

            $doc_array = array();
            $config['upload_path']          = './uploads/member_document/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';
            $config['max_size']             = 2048;
            
            $this->load->library('upload', $config);
            foreach($docu as $doc){

                if (!$this->upload->do_upload($doc['input_name'])) {
                    
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                } else {
                    
                    $img_data = $this->upload->data();
                    $docume = 'uploads/member_document/' . $img_data['raw_name'] . $img_data['file_ext'];

                    $doc_array[$doc['input_name']] = $docume;
                    
                }

            }
            $documents = json_encode($doc_array);

            $value = $this->common_model->get_data('member', array('id' => $upd['id']), 'id, documents');

            $mem = array(

                'id'                      => $upd['id'],
                'full_name'               => $upd['full_name'],
                'guardian_name'           => $upd['guardian_name'],
                'dob'                     => $upd['dob'],
                'address'                 => $upd['address'],
                'mobile_no'               => $upd['mobile_no'],
                'email'                   => $upd['email'],
                'aadhar_card_no'          => $upd['aadhar_card_no'],
                'pan_no'                  => $upd['pan_no'],
                'password'                => $upd['password'],
                'account_no'              => $upd['account_no'],
                'ifsc_code'               => $upd['ifsc_code'],
                'branch_name'             => $upd['branch_name'],
                'document_type'           => $upd['document_type'],
                'bank_name'               => $upd['bank_name'],
                'documents'               => ($documents == []) ? $value['documents'] : $documents,
        
            );
            $this->common_model->update_data('member', array('id' => $upd['id']), $mem);

            $use = array(

                'name'               => $upd['full_name'],
                'mobile'             => $upd['mobile_no'],
                'email'              => $upd['email'],
                'address'            => $upd['address'],
                'password'           => md5($upd['passowrd']),
                'show_ps'            => $upd['password'],
                'created_by_user_id' => $this->session->userdata('user_id'),
                'created_at'         => date('Y-m-d'),

            );
            $this->common_model->update_data('users', array('member_id' => $upd['member_id']), $use);
            $data = array('icon' => 'success', 'text' => 'Member Data Updated Successfully');

        } else {

            $msg = array(

                'full_name' => form_error('full_name'),
                'dob'       => form_error('dob'),
                'address'   => form_error('address'),
                'mobile_no' => form_error('mobile_no'),
                'email'     => form_error('email'),
                'aadhar_card_no' => form_error('aadhar_card_no'),

            );
            $data = array('icon' => 'error', 'text' => $msg);

        }
        echo json_encode($data);

    }

    public function add_group() {

        if($this->input->is_ajax_request()) {

            $add = $this->input->post();
            $data['group'] = $this->common_model->all_data('groups', 'id, group_name');
            $data['member_data'] = $this->common_model->get_data('member', array('id' => $add['id']), 'id, group_name');
            $this->load->view('agent/member/add_group', $data);

        }

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
