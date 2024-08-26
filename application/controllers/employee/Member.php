<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('employee/Common_model', 'common_model');
        $this->load->model('employee/Member_model', 'member_model');
        ($this->session->userdata('user_cate') != 3) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);

    }

    public function add_member()
    {

        $staff=$this->db->select('staff_id')->where('id',$this->session->userdata('user_id'))->get('users')->row();
        $staff_id=$this->db->select('id')->where('staff_id',$staff->staff_id)->get('staff')->row();
        $staff_id=$staff_id->id;
        $data['staff_id']   = $staff_id;
        $data['title']      = 'Add Client';
        $data['breadcrums'] = 'Add Client';
        $data['center']     = $this->common_model->all_data_con_or('master_center', array('branch_id' => $this->session->userdata('branch_id')),array('branch_id' => 0), 'id, center_name');
        $data['document']   = $this->member_model->all_document();
        $data['relation']   = $this->common_model->all_data('relationship_category', 'id, category_name');
        $data['layout'] = 'member/add_member.php';
        $this->load->view('employee/base', $data);

    }

    public function get_group_data()
    {

        if ($this->input->is_ajax_request()) {

            $val = $this->input->post();
            $data = $this->member_model->all_group_data($val['id']);
            echo json_encode($data);

        }

    }

    public function get_sub_documnet_data() {

        $sub = $this->input->post();
        $data = $this->member_model->get_sub_document($sub['id']);
        echo json_encode($data);

    }
        
    public function add_member_data() {

        $this->form_validation->set_rules('first_name',       'First Name',                 'required');
        $this->form_validation->set_rules('last_name',        'Last Name',                  'required');
        $this->form_validation->set_rules('religion',         'Relogion',                   'required');
        $this->form_validation->set_rules('dob',              'Date of Birth',              'required');
        $this->form_validation->set_rules('doj',              'Date of Joining',            'required');
        $this->form_validation->set_rules('state',            'State',                      'required');
        $this->form_validation->set_rules('district',         'District',                   'required');
        $this->form_validation->set_rules('village',          'Village',                    'required');
        $this->form_validation->set_rules('p_office',         'post Office',                'required');
        $this->form_validation->set_rules('p_station',        'Police Station',             'required');
        $this->form_validation->set_rules('pin_code',         'Pin Code',                   'required');
        $this->form_validation->set_rules('aadhar_card_no',   'Aadhaar Card No.',           'required');
        $this->form_validation->set_rules('voter_card_no',    'Voter Card No.',             'required');
        $this->form_validation->set_rules('password',         'Password',                   'required');
        $this->form_validation->set_rules('nominee_relation', 'Relation',                   'required');
        $this->form_validation->set_rules('nominee_name',     'Guarantor Name',             'required');
        $this->form_validation->set_rules('nominee_aadhaar',  'Guarantor Aadhaar Card No.', 'required');
        $this->form_validation->set_rules('nominee_voter',    'Guarantor Voter Card No.',   'required');
        $this->form_validation->set_rules('account_no',       'Account No',                 'required');
        $this->form_validation->set_rules('ifsc_code',        'IFSC Code',                  'required');
        $this->form_validation->set_rules('branch_name',      'Branch Name',                'required');
        $this->form_validation->set_rules('bank_name',        'Bank Name',                  'required');
        $this->form_validation->set_rules('center_name',      'Center Name',                'required');
        $this->form_validation->set_rules('group_name',       'Group Name',                 'required');

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
            $last_member_id = $this->member_model->get_last_id();
            
            if(empty($last_member_id['member_id'])) {
                
                $member_id = '100000';
                
            } else {
                
                $member_id = $last_member_id['member_id'] + 1;
                
            }
            
            $aadhaar = $this->input->post('aadhar_card_no');
            $valu = array('aadhar_card_no' => $aadhaar, 'table' => 'member');
            $mls = $this->member_model->check_aadhar_no($valu);
            if ($mls == FALSE) {

                $member = array(

                    'branch_id'               => $this->session->userdata('branch_id'),
                    'member_id'               => $member_id,
                    'first_name'              => $inp['first_name'],
                    'mid_name'                => $inp['mid_name'],
                    'last_name'               => $inp['last_name'],
                    'dob'                     => $inp['dob'],
                    'religion'                => $inp['religion'],
                    'doj'                     => $inp['doj'],
                    'state'                   => $inp['state'],
                    'district'                => $inp['district'],
                    'village'                 => $inp['village'],
                    'p_office'                => $inp['p_office'],
                    'p_station'               => $inp['p_station'],
                    'pin_code'                => $inp['pin_code'],
                    'staff_id'               => $inp['staff_id'],
                    'mobile_no'               => $inp['mobile'],
                    'email'                   => $inp['email'],
                    'aadhar_card_no'          => $inp['aadhar_card_no'],
                    'voter_card_no'           => $inp['voter_card_no'],
                    'pan_no'                  => $inp['pan_no'],
                    'password'                => $inp['password'],
                    'nominee_relation'        => $inp['nominee_relation'],
                    'nominee_name'            => $inp['nominee_name'],
                    // 'nominee_mobile'          => $inp['nominee_mobile'],
                    // 'nominee_email'           => $inp['nominee_email'],
                    'nominee_aadhaar'         => $inp['nominee_aadhaar'],
                    'nominee_voter'           => $inp['nominee_voter'],
                    'nominee_address'         => $inp['nominee_address'],
                    'account_no'              => $inp['account_no'],
                    'ifsc_code'               => $inp['ifsc_code'],
                    'branch_name'             => $inp['branch_name'],
                    'bank_name'               => $inp['bank_name'],
                    'document_type'           => $inp['document_type'],
                    'documents'               => $documents,
                    'center_name'             => $inp['center_name'],
                    'group_name'              => $inp['group_name'],
                    'week'                    => date('W'),
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => date('Y-m-d'),

                );
                $this->common_model->save_data('member', $member);

                $use = array(

                    'member_id'          => $member_id,
                    'department_type'    => 4,
                    'name'               => $inp['first_name'],
                    'mobile'             => $inp['mobile_no'],
                    'email'              => $inp['email'],
                    'address'            => $inp['village'],
                    'password'           => md5($inp['passowrd']),
                    'show_ps'            => $inp['password'],
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'         => date('Y-m-d'),

                );
                $this->common_model->save_data('users', $use);
                $data = array('icon' => 'success', 'text' => 'New Member Added Successfully');

            } else {
                $msg = array('Opps ! Aadhaar No. is Already Exists !');
                $data = array('text' => $msg, 'icon' => 'error');
            }

        } else {

            $msg = array(
                
                'first_name'       => form_error('first_name'),
                'last_name'        => form_error('last_name'),
                'religion'         => form_error('religion'),
                'dob'              => form_error('dob'),
                'doj'              => form_error('doj'),
                'state'            => form_error('state'),
                'district'         => form_error('district'),
                'village'          => form_error('village'),
                'p_office'         => form_error('p_office'),
                'p_station'        => form_error('p_station'),
                'pin_code'         => form_error('pin_code'),
                'aadhar_card_no'   => form_error('aadhar_card_no'),
                'voter_card_no'    => form_error('voter_card_no'),
                'password'         => form_error('password'),
                'nominee_relation' => form_error('nominee_relation'),
                'nominee_name'     => form_error('nominee_name'),
                'nominee_aadhaar'  => form_error('nominee_aadhaar'),
                'nominee_voter'    => form_error('nominee_voter'),
                'account_no'       => form_error('account_no'),
                'ifsc_code'        => form_error('ifsc_code'),
                'branch_name'      => form_error('branch_name'),
                'bank_name'        => form_error('bank_name'),
                'center_name'      => form_error('center_name'),
                'group_name'       => form_error('group_name'),
            );
            $data = array('icon' => 'error', 'text' => $msg);

        }
        echo json_encode($data);

    }
    
    /* ======================================= All Member Data ===================================== */

    public function manage_member() 
    {

        $data['title'] = 'Manage All Member';
        $data['breadcrums'] = 'Manage All Member';
        $data['layout']     = 'member/manage_member.php';
        $this->load->view('employee/base', $data);
        
    }

    public function member_data()
    {

        $post_data = $this->input->post();
        $record = $this->member_model->all_member_data($post_data);
        $i = $post_data['start'] + 1;

        //  <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_member(' . $row->id . ')" title="Click to Update Client Details"><i class="fas fa-edit"></i></a>';

        $return['data'] = array();
        foreach ($record as $row) {

            $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_member(' . $row->id . ')" title="Click to View Client Details"><i class="fas fa-eye text-success"></i></a>';
            $status = ($row->status == 1) ? '
            <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' member\',\'employee/common/chageStatus\')" title="Click to Di-Active Client"><b><i class="fa fa-check"></i> </b></a>&emsp;'
            :
            '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' member\',\'employee/common/chageStatus\')" title="Click to Active Client"><b><i class="fa fa-times"></i> </b></a>';

            if($row->religion == 1) {
                $relgn = "Hinduism";
            } else if($row->religion == 2) {
                $relgn = "Islam";
            } else if($row->religion == 3) {
                $relgn = "Christianity";
            } else if($row->religion == 4) {
                $relgn = "Sikhism";
            } else if($row->religion == 5) {
                $relgn = "Others";
            } else {
                $relgn = "<span style='color:#820909;font-weight:600;'>N/A</span>";
            }

            if($row->doj)
            {
                $data_of_joining = $row->doj;
            }else{
                $data_of_joining = "<span style='color:#820909;font-weight:600;'>N/A</span>";
            }

            if($row->disbursment_status == 1) {

                $active = '<a href="javascript:void(0);" class="text-danger"><b>In-active</b> <i class="fa fa-times text-danger"></i></a>';

            } else {

                $active = '<a href="javascript:void(0);" class="text-success"><b>Active</b> <i class="fa fa-check text-success"></i></a>';

            }
            
            $return['data'][] = array(

                $i++,
                $row->member_id,
                $row->grp_id,
                $row->first_name ." ". $row->mid_name ." ". $row->last_name,
                $row->nominee_name,
                $row->relation_name,
                $relgn,
                $data_of_joining,
                $active,
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
            $this->load->view('employee/member/view_member', $data);

        }

    }

    public function update_members() {

        if($this->input->is_ajax_request()) {

            $upd = $this->input->post();
            $data['document']   = $this->member_model->all_document();
            $data['relation']   = $this->common_model->all_data('relationship_category', 'id, category_name');
            $data['center']      = $this->common_model->all_data_con('master_center', array('branch_id' => $this->session->userdata('branch_id')), 'id, center_name');
            $data['group']       = $this->common_model->all_data('master_group', 'grp_id, name');
            $data['upd_memb'] = $this->member_model->get_member_data($upd['id']);
            $this->load->view('employee/member/update_member', $data);

        }

    }

    public function update_member_data() {

        $this->form_validation->set_rules('first_name',     'First Name',      'required');
        $this->form_validation->set_rules('last_name',      'Last Name',       'required');
        $this->form_validation->set_rules('dob',            'Date of Birth',   'required');
        $this->form_validation->set_rules('aadhar_card_no', 'Aadhar Card No.', 'required');
        $this->form_validation->set_rules('center_name',    'Center Name',     'required');
        $this->form_validation->set_rules('group_name',     'Group Name',      'required');
        $this->form_validation->set_rules('nominee_name',     'Guarantor Name', 'required');
        $this->form_validation->set_rules('nominee_aadhaar',  'Guarantor Aadhaar Name', 'required');
        $this->form_validation->set_rules('bank_name',     'Bank Name',       'required');
        $this->form_validation->set_rules('account_no',     'Account No',       'required');
        $this->form_validation->set_rules('ifsc_code',     'IFSC Code',       'required');


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
            // $aadhaar = $this->common_model->all_data('');

                $mem = array(
                    
                    'id'                      => $upd['id'],
                    'first_name'              => $upd['first_name'],
                    'mid_name'                => $upd['mid_name'],
                    'last_name'               => $upd['last_name'],
                    'dob'                     => $upd['dob'],
                    'religion'                => $upd['religion'],
                    'doj'                     => $upd['doj'],
                    'state'                   => $upd['state'],
                    'district'                => $upd['district'],
                    'village'                 => $upd['village'],
                    'p_office'                => $upd['p_office'],
                    'p_station'               => $upd['p_station'],
                    'pin_code'                => $upd['pin_code'],
                    'mobile_no'               => $upd['mobile'],
                    'email'                   => $upd['email'],
                    'aadhar_card_no'          => $upd['aadhar_card_no'],
                    'voter_card_no'           => $upd['voter_card_no'],
                    'pan_no'                  => $upd['pan_no'],
                    'password'                => $upd['password'],
                    'nominee_relation'        => $upd['nominee_relation'],
                    'nominee_name'            => $upd['nominee_name'],
                    // 'nominee_mobile'          => $upd['nominee_mobile'],
                    // 'nominee_email'           => $upd['nominee_email'],
                    'nominee_aadhaar'         => $upd['nominee_aadhaar'],
                    'nominee_voter'           => $upd['nominee_voter'],
                    'nominee_address'         => $upd['nominee_address'],
                    'account_no'              => $upd['account_no'],
                    'ifsc_code'               => $upd['ifsc_code'],
                    'branch_name'             => $upd['branch_name'],
                    'bank_name'               => $upd['bank_name'],
                    'document_type'           => $upd['document_type'],
                    'documents'               => (empty($documents)) ? $value['documents'] : $documents,
                    'center_name'             => $upd['center_name'],
                    'group_name'              => $upd['group_name'],
                    
                );
                $this->common_model->update_data('member', array('id' => $upd['id']), $mem);

                $use = array(

                    'name'               => $upd['first_name'],
                    'mobile'             => $upd['mobile_no'],
                    'email'              => $upd['email'],
                    'address'            => $upd['village'],
                    'password'           => md5($upd['passowrd']),
                    'show_ps'            => $upd['password'],

                );
                $this->common_model->update_data('users', array('member_id' => $upd['member_id']), $use);
                $data = array('icon' => 'success', 'text' => 'Member Data Updated Successfully');
            

        } else {

            $msg = array(

                'first_name'       => form_error('first_name'),
                'last_name'        => form_error('last_name'),
                'dob'              => form_error('dob'),
                'aadhar_card_no'   => form_error('aadhar_card_no'),
                'center_name'      => form_error('center_name'),
                'group_name'       => form_error('group_name'),
                'nominee_name'     => form_error('nominee_name'),
                'nominee_aadhaar'  => form_error('nominee_aadhaar'),
                'bank_name'        => form_error('bank_name'),
                'account_no'       => form_error('account_no'),
                'ifsc_code'        => form_error('ifsc_code'),
                
            );
            $data = array('icon' => 'error', 'text' => $msg);

        }
        echo json_encode($data);

    }

    public function add_center() {

        if($this->input->is_ajax_request()) {

            $add                 = $this->input->post();
            $data['member_data'] = $this->common_model->get_data('member', array('id' => $add['id']), 'id, center_name, group_name');
            $this->load->view('employee/member/add_center', $data);

        }

    }

    public function update_center_data() {

        $this->form_validation->set_rules('center_name', 'Center Name', 'required');
        $this->form_validation->set_rules('group_name', 'Center Name', 'required');

        if($this->form_validation->run() == TRUE) {

            $upd = $this->input->post();

            $upd_cntr = array(

                'id'          => $upd['id'],
                'center_name' => $upd['center_name'],
                'group_name'  => $upd['group_name'],

            );
            $this->common_model->update_data('member', array('id' => $upd['id']), $upd_cntr);
            $data = array('icon' => 'success', 'text' => 'Successfully Added In Group');

        } else {

            $msg = array(

                'center_name' => form_error('center_name'),
                'group_name'  => form_error('group_name'),

            );
            $data = array('icon' => 'error', 'text' => $msg);

        }
        echo json_encode($data);

    }

}
