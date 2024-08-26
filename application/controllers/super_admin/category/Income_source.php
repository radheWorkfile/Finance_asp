<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Income_source extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('super_admin/Common_model', 'common_model');
            $this->load->model('super_admin/category/Income_source_model', 'income_source');
            ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);
        }


// =================================== All Income Sources Start ==========================================  





        public function create_income_source() {
              
            $data['title'] = 'Manage All Income Sources ';
            $data['breadcrums'] = 'Manage All Income Surces';
            $data['layout'] = 'category/manage_income_source.php';
            $this->load->view('super_admin/base', $data);

          }

        public function add_income_sourse() {  
               
            $this->form_validation->set_rules('source_name', 'Enter Income Source Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if($this->form_validation->run() == TRUE) {

                $data = $this->input->post();

                $desig = array(
                    'source_name'       => $data['source_name'],
                    'description'       => $data['description'],
                    'created_at'        => date('Y-m-d'),
                );
                $this->common_model->save_data('income_sources', $desig);
                $data = array('icon' => 'success', 'text' => 'Income Sources Created Successfully');
                } else {
                $msg = array(
                    'source_name'   => form_error('source_name'),
                    'description'              => form_error('description'),
                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);

        }

        public function list_income_sourse()
        { 
            $post_data = $this->input->post();
            $record = $this->income_source->all_list_income_sourse($post_data);
            // echo "<pre>"; print_r($record );die;
            $i = $post_data['start'] + 1;
            $return['data'] = array();
            foreach ($record as $row) { 

                $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_Income_Sources(' . $row->id . ')" title="Click to View Lead Details"><i class="fas fa-eye text-success"></i></a>&emsp;

                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_Income_Sources(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

                $status = ($row->status == 1) ? '
                <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' income_sources\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
                :
                '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' income_sources\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';

                $return['data'][] = array(

                    $i++,
                    $row->source_name,
                    $row->description,
                    $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

                );
            }

            $return['recordsTotal'] = $this->income_source->count_list_income_sourse();
            $return['recordsFiltered'] = $this->income_source->filter_list_income_sourse($post_data);
            $return['draw'] = $post_data['draw'];
            echo json_encode($return);
            
        }

        public function view_Income_Sources() {
            if($this->input->is_ajax_request()) {
                $upd = $this->input->post();
                $data['income_source'] = $this->income_source->get_view_Income_Sources($upd['id']);
                $this->load->view('super_admin/category/view_Income_Sources', $data);

            }

        }

        public function update_Income_Sources() {
            if($this->input->is_ajax_request()) {
                $upd = $this->input->post();
                $data['income_source'] = $this->income_source->get_Income_Sources($upd['id']);
                $this->load->view('super_admin/category/update_Income_Sources', $data);

            }

        }

          
        public function update_Income_Sources_data() {
            $this->form_validation->set_rules('source_name', 'Source Name' , 'required');
            $this->form_validation->set_rules('description', 'Description' , 'required');

         
            if($this->form_validation->run() == TRUE) {

                $cate = $this->input->post();

                $data = array(
                    'id'                      => $cate['id'],
                    'source_name'             => $cate['source_name'],
                    'description'             => $cate['description'],
                );
                $this->common_model->update_data('income_sources', array('id' => $cate['id']), $data);
                $data = array('icon' => 'success', 'text' => 'Income Sources Updated Successfully');

            } else {

                $msg = array(

                    'source_name'   => form_error('source_name'),
                    'description'   => form_error('description'),
                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
        }

 /*======================================= Loan Product Data End ============================================*/


    }

?>