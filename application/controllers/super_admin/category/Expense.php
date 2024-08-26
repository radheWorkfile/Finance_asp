<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Expense extends CI_Controller
    {

        public function __construct()
        {

            parent::__construct();
            $this->load->model('super_admin/Common_model', 'common_model');
            $this->load->model('super_admin/category/Expense_Model', 'expense_model');
            ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
            error_reporting(0);

        }


// =================================== expense_category section Start ==========================================   
        public function expense_category() {

            $data['title'] = 'Manage Expense Category ';
            $data['breadcrums'] = 'Manage Expense Category';
            $data['layout'] = 'category/manage_expense_category.php';
            $this->load->view('super_admin/base', $data);

        }  

        public function manage_expense()
        { 
            $post_data = $this->input->post();
            $record = $this->expense_model->all_manage_expense($post_data);
            $i = $post_data['start'] + 1;
            $return['data'] = array();
            foreach ($record as $row) { 

                $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_manage_expense(' . $row->id . ')" title="Click to View Lead Details"><i class="fas fa-eye text-success"></i></a>&emsp;

                <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_manage_expense(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

                $status = ($row->status == 1) ? '
                <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' expense\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
                :
                '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' expense\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';

                $return['data'][] = array(

                    $i++,
                    $row->exp_name,
                    $row->exp_description,
                    $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

                );
            }

            $return['recordsTotal'] = $this->expense_model->count_manage_expense();
            $return['recordsFiltered'] = $this->expense_model->filter_manage_expense($post_data);
            $return['draw'] = $post_data['draw'];
            echo json_encode($return);
            
        }

        public function create_expense() 
        {
            $this->form_validation->set_rules('expense_name', 'Enter Expense Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if($this->form_validation->run() == TRUE) {

                $data = $this->input->post();

                $desig = array(
                    'exp_name'       => $data['expense_name'],
                    'exp_description'       => $data['description'],
                    'created_at'        => date('Y-m-d'),
                );
                $this->common_model->save_data('expense_category', $desig);
                $data = array('icon' => 'success', 'text' => 'Expense Category Created Successfully');
                } else {
                $msg = array(
                    'expense_name'   => form_error('expense_name'),
                    'description'    => form_error('description'),
                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);

        }

        public function view_manage_expense() {
            if($this->input->is_ajax_request()) {
                $upd = $this->input->post();
                $data['man_exp'] = $this->expense_model->get_view_manage_expense($upd['id']);
                $this->load->view('super_admin/category/view_expense', $data);

            }

        }

       
    public function update_expense() {
       if($this->input->is_ajax_request()) {
        $upd = $this->input->post();
        $data['man_exp'] = $this->expense_model->get_man_exp_data($upd['id']);
        $this->load->view('super_admin/category/update_expense', $data);
             }
       }
 
        public function expense_updata() {

            $this->form_validation->set_rules('expense_name', 'Enter Expense Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if($this->form_validation->run() == TRUE) {

                $value = $this->input->post();

                $data = array(

                    'id'                  => $value['id'],
                    'exp_name'            => $value['expense_name'],
                    'exp_description'     => $value['description'],
                );
                $this->common_model->update_data('expense_category', array('id' => $value['id']), $data);
                $data = array('icon' => 'success', 'text' => 'Expense Updated Successfully');

            } else {

                $msg = array(

                    'expense_name'   => form_error('expense_name'),
                    'description'              => form_error('description'),
                );
                $data = array('icon' => 'error', 'text' => $msg);
            }
            echo json_encode($data);
        }
// =================================== expense_category section end ==========================================


// ========================== Miscellaneous expense_category section start ===================================  

public function mis_expense_category() {

    $data['title'] = 'Manage Miscellaneous Expense Category';
    $data['breadcrums'] = 'Manage Miscellaneous Expense Category';
    $data['layout'] = 'category/manage_mis_expense.php';
    $this->load->view('super_admin/base', $data);

}


public function miscellaneous_expense_man()
{ 
    $post_data = $this->input->post();
    $record = $this->expense_model->all_miscellaneous_expense_man($post_data);
    $i = $post_data['start'] + 1;
    $return['data'] = array();
    foreach ($record as $row) { 

        $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_mis_expense(' . $row->id . ')" title="Click to View Lead Details"><i class="fas fa-eye text-success"></i></a>&emsp;

        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_mis_expense(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

        $status = ($row->status == 1) ? '
        <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' miscellaneous_expense\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
        :
        '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' miscellaneous_expense\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';

        $return['data'][] = array(

            $i++,
            $row->mis_exp_name,
            $row->mis_exp_description,
            $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

        );
    }

    $return['recordsTotal'] = $this->expense_model->count_miscellaneous_expense_man();
    $return['recordsFiltered'] = $this->expense_model->filter_miscellaneous_expense_man($post_data);
    $return['draw'] = $post_data['draw'];
    echo json_encode($return);
    
}   

public function create_mis_expense() 
{
    $this->form_validation->set_rules('mis_exp_name', 'Miscellaneous Expense Name', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');

    if($this->form_validation->run() == TRUE) {

        $data = $this->input->post();

        $desig = array(
            'mis_exp_name'       => $data['mis_exp_name'],
            'mis_exp_description'       => $data['description'],
            'created_at'        => date('Y-m-d'),
        );
        $this->common_model->save_data('miscellaneous_expense', $desig);
        $data = array('icon' => 'success', 'text' => 'Expense Category Created Successfully');
        } else {
        $msg = array(
            'mis_exp_name'   => form_error('mis_exp_name'),
            'description'    => form_error('description'),
        );
        $data = array('icon' => 'error', 'text' => $msg);
    }
    echo json_encode($data);

}

public function view_mis_expense() {
    if($this->input->is_ajax_request()) {
        $upd = $this->input->post();
        $data['mis_exp'] = $this->expense_model->get_view_mis_expense_man($upd['id']);
        $this->load->view('super_admin/category/view_mis_expense', $data);
    }
}


public function update_mis_expense() {
    if($this->input->is_ajax_request()) {
     $upd = $this->input->post();
     $data['mis_expense'] = $this->expense_model->get_mis_expense($upd['id']);
     $this->load->view('super_admin/category/update_mis_expense', $data);
          }
    }

     public function mis_expense_update() {

         $this->form_validation->set_rules('mis_expense_name', 'Miscellaneous Expense Name', 'required');
         $this->form_validation->set_rules('description', 'Description', 'required');

         if($this->form_validation->run() == TRUE) {

             $value = $this->input->post();

             $data = array(

                 'id'                  => $value['id'],
                 'mis_exp_name'            => $value['mis_expense_name'],
                 'mis_exp_description'     => $value['description'],
             );
             $this->common_model->update_data('miscellaneous_expense', array('id' => $value['id']), $data);
             $data = array('icon' => 'success', 'text' => 'Updated Successfully');

         } else {

             $msg = array(

                 'mis_expense_name'   => form_error('mis_expense_name'),
                 'description'              => form_error('description'),
             );
             $data = array('icon' => 'error', 'text' => $msg);
         }
         echo json_encode($data);
     }


// =========================== Miscellaneous expense_category section end ====================================   

public function add_expense()
{
   $data['title'] = 'Expense Category';
   $data['breadcrums'] = 'Manage Expense Category';
   $data['all_expense'] = $this->common_model->all_data('expense_category','*');
   $data['mis_expense'] = $this->common_model->all_data('miscellaneous_expense','*');
   $data['currDsibAmo'] = $this->common_model->all_data_con('add_group_loan as agl',array('loan_start_date'=>date("Y-m-d")),'sum(agl.amount) as currDsibAmo');
//    print_r($data['currDsibAmo']);die;
   $data['layout'] = 'category/add_expense.php';
   $this->load->view('super_admin/base',$data);
}

public function expense_details()
{
    

    $config['upload_path']          = './uploads/expense_proof/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
       $this->load->library('upload', $config);
       if (!$this->upload->do_upload('proof_image')) {
           echo $this->upload->display_errors();
       } else {              
           $img_data = $this->upload->data();
         
           $image =  $img_data['file_name'];
       }
       $data = $this->input->post();

    //    print_r($data);die;


   
    $this->form_validation->set_rules('expense_name', 'Select Expense Name', 'required');

    $this->form_validation->set_rules('mop', 'Mode of Payment', 'required');

    if($data['mop'] == 1)
    {
        $this->form_validation->set_rules('cash_received_by', 'Cash Received By', 'required');
    }else if($data['mop'] == 2 ||  $data['mop'] == 3)
    {
        $this->form_validation->set_rules('Received_acc_no', 'Account Number', 'required');
    }

    $this->form_validation->set_rules('amount', 'Amount', 'required');
    
    $this->form_validation->set_rules('varification_proof_type', 'Varification Proof', 'required');

    if($data['varification_proof_type'] == 1 && $data['varification_proof_type'] == 2 && $data['varification_proof_type'] == 3 )
    {
      $this->form_validation->set_rules('proof_image', 'Varification Proof', 'required');
    }
    // mop   cash_received_by  Received_acc_no  amount  expense_data   varification_proof_type  proof
  
    if($this->form_validation->run() == TRUE) {

                  $datata = array(
                     'exp_name'                => $data['expense_name'],
                     'mop'                     => $data['mop'],
                     'cash_received_by'        => $data['cash_received_by'],
                     'varification_proof_type'        => $data['varification_proof_type'],
                     'Received_acc_no'         => $data['Received_acc_no'],
                     'amount'                  => $data['amount'],
                     'expense_data'            => $data['expense_data'],
                     'created_at'              => date('Y-m-d'),
                     'proof'                   => $image
                  );
                  $this->common_model->save_data('expense', $datata);
                 $data = array('icon' => 'success', 'text' => 'Added Successfully');
            
        } else {
        $msg = array(
            'expense_name'            => form_error('expense_name'),
            'cash_received_by'        => form_error('cash_received_by'),
            'Received_acc_no'         => form_error('Received_acc_no'),
            'mop'                     => form_error('mop'),
            'amount'                  => form_error('amount'),
            'varification_proof_type' => form_error('varification_proof_type'),
            'proof_image'             => form_error('proof_image'),
        );
        $data = array('icon' => 'error', 'text' => $msg);
    }
    echo json_encode($data);
}

public function man_expense()
{
    $data['title'] = 'Manage Expense';
    $data['breadcrums'] = 'Manage Expense';
    $data['layout'] = 'category/manage_expense.php';
    $this->load->view('super_admin/base',$data);
}

public function all_expense_list()
{
    $post_data = $this->input->post();
    $record = $this->expense_model->all_expense_list_mod($post_data);
    $i = $post_data['start'] + 1;
    $return['data'] = array();
    foreach ($record as $row) { 

        $view = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".view_model" style="margin-left:-5px;" onclick="view_all_expense(' . $row->id . ')" title="Click to View Lead Details"><i class="fas fa-eye text-success"></i></a>&emsp;

        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".update_category" onclick="update_expense_details(' . $row->id . ')" title="Click to Update Lead Details"><i class="fas fa-edit"></i></a>';

        $status = ($row->status == 1) ? '
        <a style="color:green; margin-left:-5px;" href="javascript:void()" onClick="return changeStatus(\'' . $row->id . '\',\'0\',\' expense\',\'super_admin/common/chageStatus\')" title="Click to Di-Active Employee"><b><i class="fa fa-check"></i> </b></a>&emsp;'
        :
        '<a style="color:red; margin-left:-5px;"  href="javascript:void()"  onClick="return changeStatus(\'' . $row->id . '\',\'1\',\' expense\',\'super_admin/common/chageStatus\')" title="Click to Active Employee"><b><i class="fa fa-times"></i> </b></a>&emsp;';
          
        if( $row->amount)
        {
            $amount = number_format(floatval($row->amount), 2);
        }else{
            $amount = '<span>N/A</span>';
        }
        
         
        $return['data'][] = array(

            $i++,
            $row->exp_cate_name,
            $amount,          
            $row->expense_data,
            $view . "&emsp; <span id='".$row->id ."'>". $status . "</span>&emsp;",

        );
    }

    $return['recordsTotal'] = $this->expense_model->count_all_expense_list();
    $return['recordsFiltered'] = $this->expense_model->filter_all_expense_list($post_data);
    $return['draw'] = $post_data['draw'];
    echo json_encode($return);
    
}

public function view_all_expense()
{
    if($this->input->is_ajax_request()) {
        $upd = $this->input->post();
        $data['all_exp'] = $this->expense_model->view_all_expense_mod($upd['id']);
        $this->load->view('super_admin/category/view_all_expense', $data);
    }
}

public function upd_expense_details()
{
    if($this->input->is_ajax_request()) {
        $upd = $this->input->post();
        $data['expense'] = $this->common_model->all_data('expense_category','*');
        $data['up_mis_exp'] = $this->expense_model->view_all_expense_mod($upd['id']);
        $this->load->view('super_admin/category/update_all_expense', $data);
      }
}

public function updata_exp_del()
{
    $config['upload_path']          = './uploads/expense_proof/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
       $this->load->library('upload', $config);
       if (!$this->upload->do_upload('proof')) {
           echo $this->upload->display_errors();
       } else {              
           $img_data = $this->upload->data();
         
           $image =  $img_data['file_name'];
       }
   
       $data = $this->input->post();

                  $datata = array(
                     'id'                      => $data['id'],
                     'exp_name'                => $data['exp_name'],
                     'mop'                     => $data['mop'],
                     'cash_received_by'        => $data['cash_received_by'],
                     'varification_proof_type' => $data['varification_proof_type'],
                     'Received_acc_no'         => $data['Received_acc_no'],
                     'amount'                  => $data['amount'],
                     'expense_data'            => $data['expense_data'],
                     'created_at'              => date('Y-m-d'),
                     'proof'                   => $image
                  );
                  $this->common_model->update_data('expense', array('id' => $datata['id']), $data);
                  $data = array('icon' => 'success', 'text' => 'Added Successfully');
                  echo json_encode($data);
    }
   
    }

?>