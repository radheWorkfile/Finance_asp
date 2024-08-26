<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Commission_Category extends CI_Controller
    {

        public function __construct()
        {

            parent::__construct();
            $this->load->model('super_admin/Common_model', 'common_model');
            $this->load->model('super_admin/category/Commission_Category_model', 'commission_category_model');
            ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);

        }

        public function create_commission_category() {

            $data['title']        = 'Manage All Commission Category';
            $data['breadcrums']   = 'Manage All Commission Category';
            $data['loan_product'] = $this->common_model->all_data('loan_product', 'id, loan_product_name');
            $data['layout']       = 'category/manage_commission_category.php';
            $this->load->view('super_admin/base', $data);

        }

        public function add_commission_category_data() {

            $this->form_validation->set_rules('loan_product', 'Loan Product', 'required');
            $this->form_validation->set_rules('commission_percentage', 'Commission Category', 'required');

            if($this->form_validation->run() == TRUE) {

                $data = $this->input->post();

                $commission = array(

                    'loan_product'            => $data['loan_product'],
                    'commission_percentage'   => $data['commission_percentage'],
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => config_item('work_end'),

                );
                $this->common_model->save_data('commission_category', $commission);
                $data = array('icon' => 'success', 'text' => 'Commission Category Created Successfully');
                
            } else {

                $msg = array(

                    'loan_product'          => form_error('loan_product'),
                    'commission_percentage' => form_error('commission_percentage'),
                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);

        }

        /*======================================= Commission Category Data ============================================*/

        public function commission_category_data()
        {

            $post_data = $this->input->post();
            $record = $this->commission_category_model->all_commission_category_data($post_data);
            $i = $post_data['start'] + 1;

            $return['data'] = array();
            foreach ($record as $row) {

                $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_commission_category(' . $row->id . ')" title="Click to Update Commission Category Details"><i class="fas fa-edit"></i></a>';

                $status = ($row->status == 1) ? '
                <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' loan_product\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
                :
                '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' loan_product\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';

                $return['data'][] = array(

                    $i++,
                    $row->loan_product_name,
                    $row->commission_percentage. "%",
                    $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

                );
            }

            $return['recordsTotal'] = $this->commission_category_model->total_count();
            $return['recordsFiltered'] = $this->commission_category_model->total_filter_count($post_data);
            $return['draw'] = $post_data['draw'];
            echo json_encode($return);
            
        }

        public function update_commission_category() {

            if($this->input->is_ajax_request()) {

                $upd = $this->input->post();
                $data['loan_product'] = $this->common_model->all_data('loan_product', 'id, loan_product_name');
                $data['commission_cate'] = $this->commission_category_model->get_commission_category_data($upd['id']);
                $this->load->view('super_admin/category/update_commission_category', $data);

            }

        }

        public function update_commission_category_data() {

            $this->form_validation->set_rules('loan_product', 'Loan Product' , 'required');
            $this->form_validation->set_rules('commission_percentage', 'Commission Category' , 'required');

            if($this->form_validation->run() == TRUE) {

                $cate = $this->input->post();

                $commission = array(

                    'id'                    => $cate['commission_id'],
                    'loan_product'          => $cate['loan_product'],
                    'commission_percentage' => $cate['commission_percentage'],

                );
                $this->common_model->update_data('commission_category', array('id' => $cate['commission_id']), $commission);
                $data = array('icon' => 'success', 'text' => 'Commission Category Data Updated Successfully');

            } else {

                $msg = array(

                    'loan_product'          => form_error('loan_product'),
                    'commission_percentage' => form_error('commission_percentage'),

                );
                $data = array('icon' => 'error', 'text' => $msg);

            }
            echo json_encode($data);

        }

    }

?>