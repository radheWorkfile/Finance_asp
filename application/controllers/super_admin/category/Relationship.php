<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Relationship extends CI_Controller
    {

        public function __construct()
        {

            parent::__construct();
            $this->load->model('super_admin/Common_model', 'common_model');
            $this->load->model('super_admin/category/Relationship_Category_model', 'relation_model');
            ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);

        }

        public function create_relationship() {

            $data['title'] = 'Manage Relationship Category';
            $data['breadcrums'] = 'Manage Relationship Category';
            $data['layout'] = 'category/manage_relationship_category.php';
            $this->load->view('super_admin/base', $data);

        }

        public function add_relationship_category_data() {

            $this->form_validation->set_rules('category_name', 'Category Name' , 'required');

            if($this->form_validation->run() == TRUE) {

                $cate = $this->input->post();

                $real = array(

                    'category_name'           => $cate['category_name'],
                    'description'             => $cate['description'],
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => config_item('work_end'),
                );
                $this->common_model->save_data('relationship_category', $real);
                $data = array('icon' => 'success', 'text' => 'Relationship Category Added Successfully');

            } else {

                $msg = array(

                    'category_name' => form_error('category_name'),
                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);

        }

        /*========================================= relationship Category Data ================================================*/
        public function relationship_category_data()
        {

            $post_data = $this->input->post();
            $record = $this->relation_model->all_relationship_category_data($post_data);
            $i = $post_data['start'] + 1;

            $return['data'] = array();
            foreach ($record as $row) {

                $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_relationship_category(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

                $status = ($row->status == 1) ? '
                <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' relationship_category\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
                :
                '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' relationship_category\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';

                $return['data'][] = array(

                    $i++,
                    $row->category_name,
                    $row->description,
                    $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

                );
            }

            $return['recordsTotal'] = $this->relation_model->total_count();
            $return['recordsFiltered'] = $this->relation_model->total_filter_count($post_data);
            $return['draw'] = $post_data['draw'];
            echo json_encode($return);
            
        }

        public function update_relationship_category() {

            if($this->input->is_ajax_request()) {

                $upd = $this->input->post();
                $data['category'] = $this->relation_model->get_relation_category_data($upd['id']);
                $this->load->view('super_admin/category/update_relationship_category', $data);
            }

        }

        public function update_realtionship_category_data() {

            $this->form_validation->set_rules('category_name', 'Category Name' , 'required');

            if($this->form_validation->run() == TRUE) {

                $cate = $this->input->post();

                $real = array(

                    'id'                      => $cate['id'],
                    'category_name'           => $cate['category_name'],
                    'description'             => $cate['description'],
                );
                $this->common_model->update_data('relationship_category', array('id' => $cate['id']), $real);
                $data = array('icon' => 'success', 'text' => 'Relationship Category Added Successfully');

            } else {

                $msg = array(

                    'category_name' => form_error('category_name'),
                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
        }

    }

?>