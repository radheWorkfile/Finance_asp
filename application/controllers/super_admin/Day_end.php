<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Day_end extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('super_admin/common_model', 'Common_model');
    $this->load->model('employee/Common_model', 'common_model');
    $this->load->model('employee/Transaction_model', 'transaction_model');
    $this->load->model('super_admin/dashboard_model', 'Dashboard_model');
    ($this->session->userdata('user_cate') != 1) ? redirect(base_url(), 'refresh') : '';
    error_reporting(0);
  }


  function index()
  {
    $data['center']  = $this->Common_model->all_data('master_center', 'id, center_name');
    $data['dayEndData'] = $this->Dashboard_model->day_end_data();
    $data['layout'] = 'day_end/day_end.php';
    $this->load->view('super_admin/base', $data,'refresh');
  }


  function day_end()
  {
    $date = $this->input->post();  
    if ($date) {
      $da = $date['date'];
      $date = date('Y-m-d', strtotime('+1 day', strtotime($da)));
    } else if(date('Y-m-d') < config_item('work_end')) {
      $date = config_item('work_end');
    }else{
      $date=date('Y-m-d');
    }

    $data['current_date'] = '<span style="color:#a5efaa;">&nbsp;' . ('Date - ' . ' ' . date('D-m-y') . '</span>');
    $data['pos_title'] = 'Posting';
    $data['breadcrumb'] = 'Day_end';
    $data['radhe'] = $date;
    $post = $data['radhe'];
    if ($post) {
      $targetFile = APPPATH . 'config/system_end.php';
      $this->validateKey('3', '  $config[\'work_end\'] = "' . $post . '";', $targetFile);
      sleep(2);
      $data = array('adClass' => 'tst_success', 'msg' => array('Thank You! You have successfully change details'), 'icon' => '<i class="ti-check-box"></i>');
    }
    $data['center']  = $this->Common_model->all_data('master_center', 'id, center_name');
    $data['dayEndData'] = $this->Dashboard_model->day_end_data();
    $data['layout'] = 'day_end/day_end.php';
    redirect("super_admin/Day_end",'refresh');
  }

  private function validateKey($targetLine, $dtArray, $targetFile)
  {
    $handle = fopen($targetFile, "r");
    $contents = fread($handle, filesize($targetFile));
    fclose($handle);
    $arrCont = explode("\n", $contents);
    $arrCont[$targetLine] = $dtArray;
    $handle = fopen($targetFile, "w+");
    fwrite($handle, implode("\n", $arrCont));
    fclose($handle);
  }

  public function recovery_posting_conformation()
  {

    $input = $this->input->post();
    $data['all_data'] = $this->transaction_model->get_datas($input['id']);
    $data['layout'] = 'day_end/day_end.php';
    $this->load->view('super_admin/day_end/recovery_conformation', $data);
  }


  public function manage_day_end()
  {
    $post_data = $this->input->post();
    $record = $this->Dashboard_model->manage_day_end_data($post_data);
    $i = $post_data['start'] + 1;
    $return['data'] = array();
    foreach ($record as $row) {


      $view = '<a href="javascript:void(0);"data-bs-toggle="modal" data-bs-target=".recovery_posting_model" style="margin-left:10px;" onclick="update_recovery_conformation(' . $row->id . ')" title="Click for posting"><i class="fas fa-check text-danger text-success"></i></a>&emsp;

        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".remove_od_model" style="margin-left:10px;" onclick="remove_od(' . $row->id . ')" title="Click for od.."><i class="fas fa-plane text-success"></i></a>&emsp;';

      $return['data'][] = array(
        $i++,
        $row->loan_no,
        $row->first_name . " " . $row->mid_name . " " . $row->last_name . "(" . $row->member_id . ")",
        $row->nominee_name,
        $row->nominee_name,
        $row->monthly_emi,
        $view,
      );
    }

    $return['recordsTotal'] = $this->Dashboard_model->manage_day_end_data_total_count();
    $return['recordsFiltered'] = $this->Dashboard_model->manage_day_end_data_total_filter_count($post_data);
    $return['draw'] = $post_data['draw'];
    echo json_encode($return);
  }

  public function recovery_od_conformation()
  {
    $input = $this->input->post();
    $data['od_data'] = $this->transaction_model->get_od_datas($input['id']);
    $this->load->view('super_admin/day_end/od_recovery_conformation', $data);
  }

  public function update_recovery_posting_data()
  {

    $post = $this->input->post();
    $posting = array(

      'branch_id'               => $this->session->userdata('branch_id'),
      'emi_id'                  => $post['emi_id'],
      'member_id'               => $post['member_id'],
      'group_loan_id'           => $post['group_loan_id'],
      'total_payble_amount'     => $post['total_payble_amount'],
      'emi_date'                => $post['emi_date'],
      'paid_amount'             => $post['paid_amount'],
      'pay_date'                => date('Y-m-d'),
      'week'                    => date('W'),
      'created_by_user_type_id' => $this->session->userdata('user_id'),
      'created_at'              => date('Y-m-d'),
      'status'                  => 2,

    );
    $this->common_model->save_data('group_member_payment_details', $posting);

    $status = array('payment_status' => 2);
    $this->common_model->update_data('group_loan_payment_details', array('id' => $post['emi_id']), $status);

    $loan_status = array('payment_status' => 2);
    $this->common_model->update_data('add_group_loan', array('id' => $post['group_loan_id']), $loan_status);

    $data = array('icon' => 'success', 'text' => 'Posting Recovered Successfully!');
    echo json_encode($data);
  }

  public function remove_od()
  {

    $input = $this->input->post();
    $data['od_data'] = $this->transaction_model->get_od_data($input['id']);
    $this->load->view('employee/transaction/remove_od', $data);
  }

  public function remove_od_data()
  {

    $this->form_validation->set_rules('paid_amount', 'Paid Amount', 'required');
    $this->form_validation->set_rules('pay_date', 'Payment Date', 'required');

    if ($this->form_validation->run() == TRUE) {

      $remove = $this->input->post();

      $od = array(

        'branch_id'           => $this->session->userdata('branch_id'),
        'emi_id'              => $remove['emi_id'],
        'member_id'           => $remove['member_id'],
        'group_loan_id'       => $remove['group_loan_id'],
        'total_payble_amount' => $remove['total_payble_amount'],
        'emi_date'            => $remove['emi_date'],
        'paid_amount'         => $remove['paid_amount'],
        'rest_amount'         => $remove['rest_amount'],
        'pay_date'            => $remove['pay_date'],
        'pay_remarks'         => $remove['pay_remarks'],
        'week'                => date('W'),
        'is_od'               => 2,

      );
      $this->common_model->save_data('group_member_payment_details', $od);

      $sta = array(

        'is_od' => 2,

      );
      $this->common_model->update_data('group_loan_payment_details', array('id' => $remove['emi_id']), $sta);
      $data = array('icon' => 'success', 'text' => 'Successfully Removed In OD');
    } else {

      $msg = array(

        'paid_amount' => form_error('paid_amount'),
        'pay_date'    => form_error('pay_date'),
      );
      $data = array('icon' => 'error', 'text' => $msg);
    }
    echo json_encode($data);
  }
}
