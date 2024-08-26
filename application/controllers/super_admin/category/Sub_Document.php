<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Sub_Document extends CI_Controller
    {

        public function __construct()
        {

            parent::__construct();
            $this->load->model('super_admin/Common_model', 'common_model');
            $this->load->model('super_admin/category/Sub_Document_model', 'sub_document_model');
            ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);

        }

        public function create_sub_document() {

            $data['title']      = 'Manage All SubDocument';
            $data['breadcrums'] = 'Manage All SubDocument';
            $data['layout']     = 'category/manage_sub_document.php';
            $data['docu']       = $this->sub_document_model->get_all_document();
            $this->load->view('super_admin/base', $data);

        }

        public function add_sub_document_data() {

            $this->form_validation->set_rules('document_name', 'Document Name', 'required');
            $this->form_validation->set_rules('sub_document_name', 'SubDocument Name', 'required');

            if($this->form_validation->run() == TRUE) {

                $inp = $this->input->post();
                $inp_nm = strtolower($inp['sub_document_name']);
                $input_name  = str_replace(" ","_", $inp_nm);

                $sub = array(

                    'document_name'           => $inp['document_name'],
                    'sub_document_name'       => $inp['sub_document_name'],
                    'input_name'              => $input_name,
                    'description'             => $inp['description'],
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => config_item('work_end'),

                );
                $this->common_model->save_data('sub_document', $sub);
                $data = array('icon' => 'success', 'text' => 'SubDocument Created Successfully');

            } else {

                $msg = array(

                    'document_name' => form_error('document_name'),
                    'sub_document_name' => form_error('sub_document_name'),

                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);

        }

        /*======================================= Sub Document Data ============================================*/
        public function sub_document_data()
        {

           $post_data = $this->input->post();
           $record = $this->sub_document_model->all_sub_document_data($post_data);
           $i = $post_data['start'] + 1;

           $return['data'] = array();
            foreach ($record as $row) {

                $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_sub_document(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

                $status = ($row->status == 1) ? '
                <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' sub_document\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
                :
                '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' sub_document\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';

                $return['data'][] = array(

                    $i++,
                    $row->docu_nm,
                    $row->sub_document_name,
                    $row->description,
                    $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

                );
                
            }

           $return['recordsTotal'] = $this->sub_document_model->total_count();
           $return['recordsFiltered'] = $this->sub_document_model->total_filter_count($post_data);
           $return['draw'] = $post_data['draw'];
           echo json_encode($return);
           
        }

        public function update_sub_document() {

            if($this->input->is_ajax_request()) {

                $val = $this->input->post();
                $data['docu']       = $this->sub_document_model->get_all_document();
                $data['sub'] = $this->sub_document_model->get_sub_document_data($val['id']);
                $this->load->view('super_admin/category/update_sub_document', $data);

            }

        }

        public function update_sub_document_data() {

            $this->form_validation->set_rules('document_name', 'Document Name', 'required');
            $this->form_validation->set_rules('sub_document_name', 'SubDocument Name', 'required');

            if($this->form_validation->run() == TRUE) {

                $upd = $this->input->post();

                $sub = array(

                    'id'                => $upd['id'],
                    'document_name'     => $upd['document_name'],
                    'sub_document_name' => $upd['sub_document_name'],
                    'description'       => $upd['description'],

                );
                $this->common_model->update_data('sub_document', array('id' => $upd['id']), $sub);
                $data = array('icon' => 'success', 'text' => 'SubDocument data updated successfully');

            } else {

                $msg = array(
                    
                    'document_name'     => form_error('document_name'),
                    'sub_document_name' => form_error('sub_document_name'),
                );
                $data = array('icon' => 'error', 'text' => $msg);

            }
            echo json_encode($data);

        }

    }
?>