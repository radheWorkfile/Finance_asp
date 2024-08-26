<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Staff extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('super_admin/Common_model', 'common_model');
            $this->load->model('super_admin/Staff_model', 'staff_model');
            ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);
        }

        public function add_staff() {

            $data['title']       = 'Add Staff';
            $data['breadcrums']  = 'Add Staff';
            $data['designation'] = $this->staff_model->all_designation();
			$data['getBranch']=$this->common_model->all_data_con('master_branch',array('status'=>'1'),'id,br_id,branch_name');
            $data['layout']      = 'staff/add_staff.php';
            $this->load->view('super_admin/base', $data);

        }

        public function add_staff_data() {

            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
            $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('branch', 'Branch', 'required');
			$this->form_validation->set_rules('designation', 'Designation', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('aadhar_card_no', 'Aadhar Card No.', 'required');
            $this->form_validation->set_rules('pan_no', 'Pan No.', 'required');
           
           

            if($this->form_validation->run() == TRUE) {

                $add = $this->input->post();
                
                $staff_id = rand(pow(10, 6-1), pow(10, 6)-1);
                
                $config['upload_path']          = './uploads/staff_document/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('aadhaar_img')) {
                    
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    
                } else {
                    
                    $img_data = $this->upload->data();
                    $aadhr_img = 'uploads/staff_document/' . $img_data['raw_name'] . $img_data['file_ext'];
                    
                }
                
                if (!$this->upload->do_upload('pan_img')) {
                    
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    
                } else {
                    
                    $img_data = $this->upload->data();
                    $pan_imag = 'uploads/staff_document/' . $img_data['raw_name'] . $img_data['file_ext'];
                    
                }
                
                $staff = array(

                    'staff_id'                => $staff_id,
					'branch_id'               => $add['branch'],
                    'full_name'               => $add['full_name'],
                    'guardian_name'           => $add['guardian_name'],
                    'dob'                     => $add['dob'],
                    'address'                 => $add['address'],
                    'mobile_no'               => $add['mobile_no'],
                    'email'                   => $add['email'],
                    'designation'             => $add['designation'],
                    'aadhar_card_no'          => $add['aadhar_card_no'],
                    'aadhar_image'            => empty($aadhr_img) ? '' : $aadhr_img,
                    'pan_no'                  => $add['pan_no'],
                    'pan_image'               => empty($pan_imag) ? '' : $pan_imag,
                    'password'                => $add['password'],
                    'account_no'              => $add['account_no'],
                    'ifsc_code'               => $add['ifsc_code'],
                    'branch_name'             => $add['branch_name'],
                    'bank_name'               => $add['bank_name'],
                    'week'                    => date('W'),
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => config_item('work_end'),
                    
                );
                $this->common_model->save_data('staff', $staff);
                
                $use = array(
                    
                    'staff_id'                => $staff_id,
                    'department_type'         => 3,
                    'name'                    => $add['full_name'],
                    'mobile'                  => $add['mobile_no'],
                    'email'                   => $add['email'],
                    'address'                 => $add['address'],
                    'password'                => md5($add['password']),
                    'show_ps'                 => $add['password'],
                    'created_by_user_type_id'      => $this->session->userdata('user_id'),
                    'created_at'              => config_item('work_end'),
                    
                );
                $this->common_model->save_data('users', $use);
                $data = array('icon' => 'success', 'text' => 'New Staff Added Successfully');

            } else {

                $msg = array(

                    'full_name'      => form_error('full_name'),
                    'dob'            => form_error('dob'),
                    'mobile_no'      => form_error('mobile_no'),
                    'address'        => form_error('address'),
					'branch'         => form_error('branch'),
                    'designation'    => form_error('designation'),
                    'email'          => form_error('email'),
                    'aadhar_card_no' => form_error('aadhar_card_no'),
					'password'       => form_error('password'),
                    'pan_no'         => form_error('pan_no'),
                );
                $data = array('icon' => 'error', 'text' => $msg);

            }
            echo json_encode($data);

        }
        
        /*======================================= All Staff Data ============================================*/
        
        public function manage_staff() {

            $data['title']      = "Manage All Staff";
            $data['breadcrums'] = "Manage All Staff";
            $data['layout']     = 'staff/manage_staff.php';
            $this->load->view('super_admin/base', $data);

        }

        public function staff_data()
        {

            $post_data = $this->input->post();
            $record = $this->staff_model->all_staff_data($post_data); 
            $i = $post_data['start'] + 1;

            $return['data'] = array();
            foreach ($record as $row) {

                $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_staff(' . $row->id . ')" title="Click to View Staff Details"><i class="fas fa-eye text-success"></i></a>&emsp;

                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_staff(' . $row->id . ')" title="Click to Update Staff Details"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".assign_model" style="margin-left:-5px;" onclick="assign_staff(' . $row->id . ')" title="Click to View Staff Details"><i class="fas fa-check text-success"></i></a>';

                $return['data'][] = array(

                    $i++,
                    $row->full_name,
                    $row->mobile_no,
                    $row->email,
                    $row->address,
                    $row->branch_name,
                    $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

                );
            }

            $return['recordsTotal'] = $this->staff_model->total_count();
            $return['recordsFiltered'] = $this->staff_model->total_filter_count($post_data);
            $return['draw'] = $post_data['draw'];
            echo json_encode($return);
            
        }

        public function view_staff() {

            if($this->input->is_ajax_request()) {

                $view = $this->input->post();
                $data['view_staff'] = $this->staff_model->get_staff_data($view['id']);
                $this->load->view('super_admin/staff/view_staff', $data);

            }

        }

        public function update_staff() {

            if($this->input->is_ajax_request()) {

                $upd = $this->input->post();
                $data['designation'] = $this->staff_model->all_designation();
                $data['upd_staff'] = $this->staff_model->get_staff_data($upd['id']);
				$data['getBranch']=$this->common_model->all_data_con('master_branch',array('status'=>'1'),'id,br_id,branch_name');
                $this->load->view('super_admin/staff/update_staff', $data);

            }
        }

        public function update_staff_data() {

            $this->form_validation->set_rules('full_name', 'Full Name', 'required');
            $this->form_validation->set_rules('dob', 'Date of Birth', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('aadhar_card_no', 'Aadhar Card No.', 'required');
            $this->form_validation->set_rules('pan_no', 'Pan No.', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('designation', 'Designation', 'required');
            $this->form_validation->set_rules('branch', 'Branch', 'required');
			if($this->form_validation->run() == TRUE) {

                $upd = $this->input->post();

                $config['upload_path']          = './uploads/staff_document/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                
                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('aadhaar_img')) {
                    
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    
                } else {
                    
                    $img_data = $this->upload->data();
                    $aadhr_img = 'uploads/staff_document/' . $img_data['raw_name'] . $img_data['file_ext'];
                    
                }
                
                if (!$this->upload->do_upload('pan_img')) {
                    
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    
                } else {
                    
                    $img_data = $this->upload->data();
                    $pan_imag = 'uploads/staff_document/' . $img_data['raw_name'] . $img_data['file_ext'];
                    
                }

                $staff = array(

                    'branch_id'               => $upd['branch'],
                    'full_name'               => $upd['full_name'],
                    'guardian_name'           => $upd['guardian_name'],
                    'dob'                     => $upd['dob'],
                    'address'                 => $upd['address'],
                    'mobile_no'               => $upd['mobile_no'],
                    'email'                   => $upd['email'],
                    'aadhar_card_no'          => $upd['aadhar_card_no'],
                    'aadhar_image'            => empty($aadhr_img) ? $upd['aadhar_img_upd'] : $aadhr_img,
                    'pan_no'                  => $upd['pan_no'],
                    'pan_image'               => empty($pan_imag) ? $upd['pan_img_upd'] : $pan_imag,
                    'designation'             => $upd['designation'],
                    'password'                => $upd['password'],
                    'account_no'              => $upd['account_no'],
                    'ifsc_code'               => $upd['ifsc_code'],
                    'branch_name'             => $upd['branch_name'],
                    'bank_name'               => $upd['bank_name'],

                );
                $this->common_model->update_data('staff', array('id' => $upd['id']), $staff);

                $user = array(
                    
                    'name'                    => $upd['full_name'],
                    'mobile'                  => $upd['mobile_no'],
                    'email'                   => $upd['email'],
                    'address'                 => $upd['address'],
                    'password'                => md5($upd['password']),
                    'show_ps'                 => $upd['password'],
                    
                );
                $this->common_model->update_data('users', array('staff_id' => $upd['staff_id']), $user);
                $data = array('icon' => 'success', 'text' => 'Staff Data Updated Successfully');

            } else {

                $msg = array(

                    'full_name'      => form_error('full_name'),
                    'dob'            => form_error('dob'),
                    'address'        => form_error('address'),
                    'mobile_no'      => form_error('mobile_no'),
                    'email'          => form_error('email'),
                    'aadhar_card_no' => form_error('aadhar_card_no'),
                    'pan_no'         => form_error('pan_no'),
                    'password'       => form_error('password'),
					'designation'    => form_error('designation'),
					'branch'    => form_error('branch')

                );
                $data = array('icon' => 'error', 'text' => $msg);

            }
            echo json_encode($data);

        }


    public function assig_to_other()
    {
        if($this->input->is_ajax_request()) {
            $data = $this->input->post();
            $data['get_data'] = $this->common_model->get_data('staff',array('id'=>$data['id']),'id,full_name,guardian_name,status');
            $data['value'] = $this->common_model->all_data('staff','*');
            $this->load->view('super_admin/staff/assign_to_other',$data);
         }
    }
    public function udpate_staff()
    {
        $data = $this->input->post();
        $data['cen_data'] = $this->common_model->all_data(' master_center','*');
        $datata = array(
            'staff_id'  => $data['staff_id'],
        );
        if($this->common_model->update_data('master_center',array('staff_id'=>$data['pre_stf_id']),$datata))
        {
            $value = array(
                'status'    =>2
         );
        $this->common_model->update_data('staff',array('id'=>$data['pre_stf_id']),$value);
        }
       
        
    }

    }
?>
