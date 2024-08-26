<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('super_admin/common_model', 'Common_model');
        ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
        error_reporting(0);
    }

    public function basic_setting()
    {
        $data['title'] = 'Basic Setting';
        $data['breadcrums'] = 'Basic Setting';
        $data['layout'] = 'setting/basic.php';
        $this->load->view('super_admin/base', $data);
    }

    //Basic Data Update
    public function basic_data()
    {

        if ($this->input->is_ajax_request()) {
            
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email ID', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $post = $this->input->post();
                $file = '<?php defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

                    # Basic Setting Details
                    $config[\'company_name\'] = "' . $post['company_name'] . '";
                    $config[\'mobile_number\'] = "' . $post['mobile'] . '";
                    $config[\'email\'] = "' . $post['email'] . '";
                    $config[\'address\'] = "' . $post['address'] . '";
                    $config[\'logo_dark\'] = "' . config_item('logo_dark') . '";
                    $config[\'logo_sm\'] = "' . config_item('logo_sm') . '";
                    $config[\'logo_light\'] = "' . config_item('logo_light') . '";
                    $config[\'logo_sm_light\'] = "' . config_item('logo_sm_light') . '";

                ?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Data Updated Successfully');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg = array(
                    'company_name' => form_error('company_name'),
                    'mobile' => form_error('mobile'),
                    'email' => form_error('email'),
                    'address' => form_error('address'),
                );

                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
        }
    }

    // Dark Logo Data
    public function dark_logo_data()
    {
        if ($this->input->is_ajax_request()) {
            // echo $_FILES['dark_favicon']['name'];die;
            if (trim($_FILES['dark_logo']['name'] !== "")) {
                $filename = "logo-dark";
                $config['upload_path'] = './media/images/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('logo_dark'));
                if (!$this->upload->do_upload('dark_logo')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);
                    die;
                } else {
                    $doc_data = $this->upload->data();
                    $dark_logo = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Dark Logo Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

                    # Basic Setting Details
                    $config[\'company_name\'] = "' . config_item('company_name') . '";
                    $config[\'mobile_number\'] = "' . config_item('mobile_number') . '";
                    $config[\'email\'] = "' . config_item('email') . '";
                    $config[\'address\'] = "' . config_item('address') . '";
                    $config[\'logo_dark\'] = "' . $dark_logo . '";
                    $config[\'logo_sm\'] = "' . config_item('logo_sm') . '";
                    $config[\'logo_light\'] = "' . config_item('logo_light') . '";
                    $config[\'logo_sm_light\'] = "' . config_item('logo_sm_light') . '";
                ?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Dark Logo Updated Successfully !');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg = array('Please Select File To Upload');
                $data = array('icon' => 'error', 'text' => $msg);
            }



            echo json_encode($data);
        }
    }



    // Dark Favicon Data
    public function dark_favicon_data()
    {
        if ($this->input->is_ajax_request()) {
            // echo $_FILES['dark_favicon']['name'];die;
            if (trim($_FILES['dark_favicon']['name'] !== "")) {
                $filename = "logo-sm";
                $config['upload_path'] = './media/images/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('logo_sm'));
                if (!$this->upload->do_upload('dark_favicon')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);
                    die;
                } else {
                    $doc_data = $this->upload->data();
                    $dark_fav = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Dark Favicon Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');

                    # Basic Setting Details
                    $config[\'company_name\'] = "' . config_item('company_name') . '";
                    $config[\'mobile_number\'] = "' . config_item('mobile_number') . '";
                    $config[\'email\'] = "' . config_item('email') . '";
                    $config[\'address\'] = "' . config_item('address') . '";
                    $config[\'logo_dark\'] = "' . config_item('logo_dark') . '";
                    $config[\'logo_sm\'] = "' . $dark_fav . '";
                    $config[\'logo_light\'] = "' . config_item('logo_light') . '";
                    $config[\'logo_sm_light\'] = "' . config_item('logo_sm_light') . '";
                ?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Dark Favicon Updated Successfully !');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg = array('Please Select File To Upload');
                $data = array('icon' => 'error', 'text' => $msg);
            }



            echo json_encode($data);
        }
    }


    // Light Logo Data
    public function light_logo_data()
    {
        if ($this->input->is_ajax_request()) {
            // echo $_FILES['dark_favicon']['name'];die;
            if (trim($_FILES['light_logo']['name'] !== "")) {
                $filename = "logo-light";
                $config['upload_path'] = './media/images/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('logo_light'));
                if (!$this->upload->do_upload('light_logo')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);
                    die;
                } else {
                    $doc_data = $this->upload->data();
                    $light_logo = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Light Logo Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');
    
                    # Basic Setting Details
                    $config[\'company_name\'] = "' . config_item('company_name') . '";
                    $config[\'mobile_number\'] = "' . config_item('mobile_number') . '";
                    $config[\'email\'] = "' . config_item('email') . '";
                    $config[\'address\'] = "' . config_item('address') . '";
                    $config[\'logo_dark\'] = "' . config_item('logo_dark') . '";
                    $config[\'logo_sm\'] = "' . config_item('logo_sm') . '";
                    $config[\'logo_light\'] = "' . $light_logo . '";
                    $config[\'logo_sm_light\'] = "' . config_item('logo_sm_light') . '";
                ?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Light Logo Updated Successfully !');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg = array('Please Select File To Upload');
                $data = array('icon' => 'error', 'text' => $msg);
            }



            echo json_encode($data);
        }
    }


    // Light Favicon Data
    public function light_favicon_data()
    {
        if ($this->input->is_ajax_request()) {
            // echo $_FILES['dark_favicon']['name'];die;
            if (trim($_FILES['light_favicon']['name'] !== "")) {
                $filename = "logo-sm-light";
                $config['upload_path'] = './media/images/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048;
                $config['file_name'] = $filename;

                $this->load->library('upload', $config);

                unlink('media/images/' . config_item('logo_sm_light'));
                if (!$this->upload->do_upload('light_favicon')) {
                    $msg = array('error' => $this->upload->display_errors());
                    $data = array('text' => $msg, 'icon' => "error");
                    echo json_encode($data);
                    die;
                } else {
                    $doc_data = $this->upload->data();
                    $light_favicon = $doc_data['raw_name'] . $doc_data['file_ext'];
                    //print_r($val);die;
                    $data = array('text' => "Light Logo Updated Successfully !", 'icon' => "success");
                }
                $file = '<?php defined(\'BASEPATH\') OR exit(\'Can we play bubu together ?\');
    
                # Basic Setting Details
                $config[\'company_name\'] = "' . config_item('company_name') . '";
                $config[\'mobile_number\'] = "' . config_item('mobile_number') . '";
                $config[\'email\'] = "' . config_item('email') . '";
                $config[\'address\'] = "' . config_item('address') . '";
                $config[\'logo_dark\'] = "' . config_item('logo_dark') . '";
                $config[\'logo_sm\'] = "' . config_item('logo_sm') . '";
                $config[\'logo_light\'] = "' . config_item('logo_light') . '";
                $config[\'logo_sm_light\'] = "' . $light_favicon . '";
                ?>';
                if (file_put_contents(APPPATH . 'config/global.php', $file)) {
                    $data = array('icon' => 'success', 'text' => 'Light Favicon Updated Successfully !');
                } else {
                    $msgs = array('Some Error Occur Please Re-Update');
                    $data = array('icon' => 'error', 'text' => $msgs);
                }
            } else {
                $msg = array('Please Select File To Upload');
                $data = array('icon' => 'error', 'text' => $msg);
            }

            echo json_encode($data);
        }
    }
}
