<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('super_admin/common_model', 'Common_model');
        $this->load->model('super_admin/user_model', 'User_model');
        ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);
    }

    function index()
    {
        $data['title'] = 'Dashboard';
        $data['breadcrums'] = 'Dashboard';
        $this->load->view('super_admin/dashboard', $data);
    }

    function manage_user()
    {
        $data['title'] = 'Manage User';
        $data['breadcrums'] = 'Manage User';
        $data['users'] = $this->User_model->all_data();
        $this->load->view('super_admin/user/manage_user', $data);
    }


    function view_user()
    {
        if ($this->input->is_ajax_request()) {
            $value = $this->input->post();
            $data['users'] = $this->User_model->get_data($value['id']);
            $this->load->view('super_admin/user/view', $data);
        }
    }

    public function add_user()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $value = $this->input->post();
            $chk = $this->Common_model->get_data('users', array('email' => $value['email']), 'id');

            if (count($chk) === 0) {
                $val = array(
                    'name'                      => $value['name'],
                    'email'                     => $value['email'],
                    'mobile'                    => $value['mobile'],
                    'show_ps'                   => $value['password'],
                    'password'                  => md5($value['password']),
                    // 'department_type'           => $value['department'],
                    'created_by_user_id'        => $this->session->userdata('user_id'),
                    'created_at'                => date('Y-m-d')
                );
                // print_r($val);die;
                $this->Common_model->save_data('users', $val);
                $data = array('text' => "User Added Successfully !", 'icon' => "success");
            } else {
                $msg = array('&#128561; !Opps Email Id Already Exists &#128561;');
                $data = array('text' => $msg, 'icon' => 'error');
            }
        } else {
            $msg = array(
                'name'          => form_error('name'),
                'email'         => form_error('email'),
                'mobile'        => form_error('mobile'),
                'password'      => form_error('password'),
            );
            $data = array('text' => $msg, 'icon' => 'error');
        }
        echo json_encode($data);
    }

    function edit_user()
    {
        if ($this->input->is_ajax_request()) {
            $value = $this->input->post();
            $data['user'] = $this->User_model->get_data($value['id']);
            $this->load->view('super_admin/user/edit_user', $data);
        }
    }

    public function update_user()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mail', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $value = $this->input->post();
            $chk = $this->Common_model->get_data('users', array('email' => $value['mail']), 'id');
            $last = $this->Common_model->get_last('users', 'user_id');

            if (count($chk) === 0) {
                $val = array(
                    'name'      => $value['name'],
                    'email'     => $value['mail'],
                    'mobile'    => $value['mobile'],
                    'show_ps'   => empty($value['password']) ? $value['spassword'] : $value['password'],
                    'password'  => empty($value['password']) ? $value['old_password'] : md5($value['password']),
                );
                // print_r($val);die;
                $this->Common_model->update_data('users',array('id' => $value['id']), $val);
                $data = array('text' => "User Updated Successfully !", 'icon' => "success");
            } else {
                $msg = array('&#128561; !Opps Email Id Already Exists &#128561;');
                $data = array('text' => $msg, 'icon' => 'error');
            }
        } else {
            $msg = array(
                'name'      => form_error('name'),
                'mail'      => form_error('mail'),
                'mobile'    => form_error('mobile'),
            );
            $data = array('text' => $msg, 'icon' => 'error');
        }
        echo json_encode($data);
    }
}
