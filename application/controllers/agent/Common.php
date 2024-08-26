<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('agent/common_model', 'Common_model');
        ($this->session->userdata('user_cate') != 2) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);
    }

    function chageStatus()
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            $this->Common_model->chageStatus($data);
            echo ($data['status'] == 1) ? "
            <a style='color:green' href='javascript:void()'onClick='return changeStatus(\"" . $data['id'] . "\",\"0\",\"" . $data['table'] . "\",\"" . $data['loader'] . "\")'title='click to block user'><b><i class='fa fa-check'></i> </b></a>" : "
            <a style='color:red'   href='javascript:void()'onClick='return changeStatus(\"" . $data['id'] . "\",\"1\",\"" . $data['table'] . "\",\"" . $data['loader'] . "\")'title='click to active user'><b><i class='fa fa-times'></i></b></a>";
        }
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['breadcrums'] = 'Profile';
        $usr = $this->Common_model->get_data('users', array('id' => $this->session->userdata('user_id')), 'id,name,email,password,mobile,address,photo,department_type, show_ps');
        $data['users'] = $usr;
        $data['department'] = $this->Common_model->get_data('department', array('id' => $usr['department_type']), 'id,name');
        $data['layout'] = 'common/profile.php';
        $this->load->view('agent/base', $data);
    }

    public function update_profile()
    {
        $value = $this->input->post();
        $user_chk = $this->Common_model->get_data('users', array('id' => $value['id'], 'email' => $value['email'], 'mobile' => $value['number'],), 'id');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        if (empty($user_chk)) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|is_unique[users.email]');
            $this->form_validation->set_rules('number', 'Mobile Number', 'trim|required|xss_clean|is_unique[users.mobile]');
        }
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $val = array(
                'name'        => $value['name'],
                'email'       => $value['email'],
                'password'    => empty($value['password']) ? $value['oldpassword'] : md5($value['password']),
                'show_ps'     => empty($value['password']) ? $value['oldshow_ps'] : $value['password'],
                'mobile'      => $value['number'],
                'address'     => $value['address'],
            );
            $this->Common_model->update_data('users', array('id' => $value['id']), $val);
            $data = array('text' => "User Updated Successfully !", 'icon' => "success");
        } else {
            $msg = array(
                'name'      => form_error('name'),
                'email'     => form_error('email'),
                'number'    => form_error('number'),
                'address'   => form_error('address')
            );
            $data = array('text' => $msg, 'icon' => 'error');
        }
        echo json_encode($data);
    }
}
