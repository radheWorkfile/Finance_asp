<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Document extends CI_Controller
    {

        public function __construct()
        {

            parent::__construct();
            $this->load->model('super_admin/Common_model', 'common_model');
            $this->load->model('super_admin/category/Document_model', 'document_model');
            ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);

        }

        public function create_document() {

            $data['title'] = 'Manage All Document';
            $data['breadcrums'] = 'Manage All Document';
            $data['layout']     = 'category/manage_document.php';
            $this->load->view('super_admin/base', $data);

        }

        public function add_document_data() {

            $this->form_validation->set_rules('document_name', 'Document Name', 'required');

            if($this->form_validation->run()) {

                $add = $this->input->post();

                $docu = array(

                    'document_name'           => $add['document_name'],
                    'description'             => $add['description'],
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => config_item('work_end'),

                );
                $this->common_model->save_data('document', $docu);
                $data = array('icon' => 'success', 'text' => 'Documnet Created Successfully');

            } else {

                $msg = array(

                    'document_name' => form_error('document_name'),

                );
                $data = array('icon' => 'error', 'text' => $msg);

            }
            echo json_encode($data);

        }

       /*======================================= Document Data ============================================*/
        public function document_data()
        {

           $post_data = $this->input->post();
           $record = $this->document_model->all_document_data($post_data);
           $i = $post_data['start'] + 1;

           $return['data'] = array();
            foreach ($record as $row) {

                $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_document(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

                $status = ($row->status == 1) ? '
                <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' document\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
                :
                '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' document\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';

                $return['data'][] = array(

                    $i++,
                    $row->document_name,
                    $row->description,
                    $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

                );
                
            }

           $return['recordsTotal'] = $this->document_model->total_count();
           $return['recordsFiltered'] = $this->document_model->total_filter_count($post_data);
           $return['draw'] = $post_data['draw'];
           echo json_encode($return);
           
        }

        public function update_document() {

            if($this->input->is_ajax_request()) {

                $val = $this->input->post();
                $data['doc'] = $this->document_model->get_document($val['id']);
                $this->load->view('super_admin/category/update_document', $data);

            }
        }

        public function update_document_data() {

            $this->form_validation->set_rules('document_name', 'Document Name', 'required');

            if($this->form_validation->run() == TRUE) {

                $val = $this->input->post();
                $updt = array(

                    'id'            => $val['id'],
                    'document_name' => $val['document_name'],
                    'description'   => $val['description'],

                );
                $this->common_model->update_data('document', array('id' => $val['id']), $updt);
                $data = array('icon' => 'success', 'text' => 'Document Updated Successfully');

            } else {

                $msg = array(

                    'document_name' => form_error('document_name'),
                );
                $data = array('icon' => 'error', 'text' => $msg);

            }
            echo json_encode($data);

        }

    }
?>