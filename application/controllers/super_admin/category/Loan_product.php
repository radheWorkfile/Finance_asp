<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Loan_product extends CI_Controller
    {

        public function __construct()
        {

            parent::__construct();
            $this->load->model('super_admin/Common_model', 'common_model');
            $this->load->model('super_admin/category/Loan_Product_model', 'loan_product_model');
            ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);

        }

        public function create_loan_product() {

            $data['title'] = 'Manage All Loan Product';
            $data['breadcrums'] = 'Manage All Loan Product';
            $data['layout'] = 'category/manage_loan_product.php';
            $this->load->view('super_admin/base', $data);

        }

        public function add_loan_product_data() {

            $this->form_validation->set_rules('loan_product_name', 'Loan Product Name', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required');
            $this->form_validation->set_rules('tenure', 'tenure', 'required');
            $this->form_validation->set_rules('interest_type', 'Interest Type', 'required');
            $this->form_validation->set_rules('processing_fee', 'Processing Fee', 'required');

            if($this->input->post('interest_type') == 1) {

                $this->form_validation->set_rules('interest_percentage', 'Interest Percentage', 'required');
            } else if($this->input->post('interest_type') == 2) {

                $this->form_validation->set_rules('interest_amount', 'Interest Amount', 'required');
            }

            if($this->form_validation->run() == TRUE) {

                $data = $this->input->post();

                $desig = array(

                    'loan_product_name'       => $data['loan_product_name'],
                    'amount'                  => $data['amount'],
                    'tenure'                  => $data['tenure'],
                    'interest_type'           => $data['interest_type'],
                    'interest_percentage'     => $data['interest_percentage'],
                    'interest_amount'         => $data['interest_amount'],
                    'processing_fee'          => $data['processing_fee'],
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => config_item('work_end'),

                );
                $this->common_model->save_data('loan_product', $desig);
                $data = array('icon' => 'success', 'text' => 'Loan Product Created Successfully');
                
            } else {

                $msg = array(

                    'loan_product_name'   => form_error('loan_product_name'),
                    'amount'              => form_error('amount'),
                    'tenure'              => form_error('tenure'),
                    'interest_type'       => form_error('interest_type'),
                    'interest_percentage' => form_error('interest_percentage'),
                    'interest_amount'     => form_error('interest_amount'),
                    'processing_fee'      => form_error('processing_fee'),

                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);

        }

        /*======================================= Loan Product Data ============================================*/
        public function loan_product_data()
        {

            $post_data = $this->input->post();
            $record = $this->loan_product_model->all_loan_product_data($post_data);
            $i = $post_data['start'] + 1;

            $return['data'] = array();
            foreach ($record as $row) {

                $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_loan_product(' . $row->id . ')" title="Click to View Lead Details"><i class="fas fa-eye text-success"></i></a>&emsp;

                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_loan_product(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

                $status = ($row->status == 1) ? '
                <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' loan_product\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
                :
                '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' loan_product\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';

                $return['data'][] = array(

                    $i++,
                    $row->loan_product_name,
                    $row->amount,
                    $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

                );
            }

            $return['recordsTotal'] = $this->loan_product_model->total_count();
            $return['recordsFiltered'] = $this->loan_product_model->total_filter_count($post_data);
            $return['draw'] = $post_data['draw'];
            echo json_encode($return);
            
        }

        public function view_loan_product_data() {

            if($this->input->is_ajax_request()) {

                $upd = $this->input->post();
                $data['category'] = $this->loan_product_model->get_loan_product_data($upd['id']);
                $this->load->view('super_admin/category/view_loan_product', $data);

            }

        }

        public function update_loan_product() {

            if($this->input->is_ajax_request()) {

                $upd = $this->input->post();
                $data['loan'] = $this->loan_product_model->get_loan_product_data($upd['id']);
                $this->load->view('super_admin/category/update_loan_product', $data);

            }

        }
 
        public function update_loan_product_data() {

            $this->form_validation->set_rules('loan_product_name', 'Loan Product Name' , 'required');
            $this->form_validation->set_rules('amount', 'Amount' , 'required');
            $this->form_validation->set_rules('tenure', 'Tenure' , 'required');
            $this->form_validation->set_rules('interest_type', 'Interest Type' , 'required');
            $this->form_validation->set_rules('processing_fee', 'Processing Fee' , 'required');

            if($this->input->post('interest_type') == 1) {

                $this->form_validation->set_rules('interest_percentage', 'Interest Percentage' , 'required');
            }

            if($this->input->post('interest_type') == 2) {

                $this->form_validation->set_rules('interest_amount', 'Interest Amount' , 'required');
            }

            if($this->form_validation->run() == TRUE) {

                $cate = $this->input->post();

                $real = array(

                    'id'                      => $cate['id'],
                    'loan_product_name'       => $cate['loan_product_name'],
                    'amount'                  => $cate['amount'],
                    'tenure'                  => $cate['tenure'],
                    'processing_fee'          => $cate['processing_fee'],
                    'interest_type'           => $cate['interest_type'],
                    'interest_percentage'     => $cate['interest_percentage'],
                    'interest_amount'         => $cate['interest_amount'],

                );
                $this->common_model->update_data('loan_product', array('id' => $cate['id']), $real);
                $data = array('icon' => 'success', 'text' => 'Loan Product Updated Successfully');

            } else {

                $msg = array(

                    'loan_product_name'   => form_error('loan_product_name'),
                    'amount'              => form_error('amount'),
                    'tenure'              => form_error('tenure'),
                    'processing_fee'      => form_error('processing_fee'),
                    'interest_type'       => form_error('interest_type'),
                    'interest_percentage' => form_error('interest_percentage'),
                    'interest_amount'     => form_error('interest_amount'),
                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
        }

    }

?>