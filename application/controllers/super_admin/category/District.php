<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class District extends CI_Controller
    {

        public function __construct()
        {

            parent::__construct();
            $this->load->model('super_admin/Common_model', 'common_model');
            $this->load->model('super_admin/category/District_model', 'district_model');
            ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);

        }

        public function create_District() {

            $data['title'] = 'Manage District';
            $data['breadcrums'] = 'Manage District';
            $data['layout'] = 'category/manage_district.php';
            $this->load->view('super_admin/base', $data);

        }

        public function add_district_data() {

            $this->form_validation->set_rules('district_name', 'District Name' , 'required');

            if($this->form_validation->run() == TRUE) {

                $cate = $this->input->post();

                $real = array(

                    'district_name'           => $cate['district_name'],
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => config_item('work_end'),
                );
                $this->common_model->save_data('district', $real);
                $data = array('icon' => 'success', 'text' => 'New District Created Successfully');

            } else {

                $msg = array(

                    'district_name' => form_error('district_name'),

                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);

        }

        /*========================================= relationship Category Data ==============================================*/

        public function district_data()
        {

            $post_data = $this->input->post();
            $record = $this->district_model->all_district_data($post_data);
            $i = $post_data['start'] + 1;

            $return['data'] = array();
            foreach ($record as $row) {

                $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_district(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

                $status = ($row->status == 1) ? '
                <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' district\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
                :
                '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' district\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';

                $return['data'][] = array(

                    $i++,
                    $row->district_name,
                    $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

                );
            }

            $return['recordsTotal'] = $this->district_model->total_count();
            $return['recordsFiltered'] = $this->district_model->total_filter_count($post_data);
            $return['draw'] = $post_data['draw'];
            echo json_encode($return);
            
        }

        public function update_district() {

            if($this->input->is_ajax_request()) {

                $upd = $this->input->post();
                $data['district'] = $this->district_model->get_district_data($upd['id']);
                $this->load->view('super_admin/category/update_district', $data);
            }

        }

        public function update_district_data() {

            $this->form_validation->set_rules('district_name', 'Category Name' , 'required');

            if($this->form_validation->run() == TRUE) {

                $cate = $this->input->post();
                print_r($cate);die;

                $real = array(

                    'id'                      => $cate['id'],
                    'district_name'           => $cate['district_name'],

                );
                $this->common_model->update_data('district', array('id' => $cate['id']), $real);
                $data = array('icon' => 'success', 'text' => 'District Updated Added Successfully');

            } else {

                $msg = array(

                    'district_name' => form_error('district_name'),

                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
        }

    }

?>