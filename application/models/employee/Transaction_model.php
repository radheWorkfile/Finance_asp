<?php

class Transaction_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function all_recovery_posting_data_query($where = false)
    {

        $field = array(

            'glpd.id', 'glpd.loan_no', 'glpd.monthly_emi', 'm.first_name', 'm.mid_name', 'm.last_name', 'm.member_id', 'm.nominee_name',

        );
        $i = 0;
        foreach ($field as $item) {

            if (!empty($where['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $where['search']['value']);
                } else {
                    $this->db->or_like($item, $where['search']['value']);
                }
                if (count($field) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        $scenter_name = $where['center'];

        if (!empty($where['center'])) {

            $this->db->where("FIND_IN_SET('$scenter_name',glpd.center_id)!=", 0);
        } 
        
        $this->db->select('glpd.id,glpd.payment_status,glpd.payment_date,glpd.is_od,mc.center_name,glpd.loan_no, glpd.monthly_emi, m.first_name, m.mid_name, m.last_name, m.member_id, m.nominee_name, agl.tenure,')->from('group_loan_payment_details as glpd');
        $this->db->where(array('glpd.branch_id' => $this->session->userdata('branch_id'),'glpd.payment_date' => date('Y-m-d'), 'glpd.payment_status' =>1, 'glpd.is_od' => 1,'glpd.is_adv'=>1));
        $this->db->join('member as m', 'm.id = glpd.member_id', 'left');
        $this->db->join('master_center as mc', 'mc.id = glpd.center_id', 'left');
        $this->db->join('add_group_loan as agl', 'glpd.group_loan_id = agl.id', 'left');

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'asc');
        }
        
    }

    public function all_recovery_posting_data($where = false)
    {

        $this->all_recovery_posting_data_query($where);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function recovery_posting_loan_total_count($where = false)
    {

        $this->all_recovery_posting_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function recovery_posting_loan_total_filter_count($where = false)
    {

        $this->all_recovery_posting_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function get_tenure() 
    {

        $this->db->select('agl.tenure');
        // $this->db->where('glpd.id', $id);
        $this->db->join('add_group_loan as agl', 'agl.id = glpd.group_loan_id' . 'left');
        $val = $this->db->get('group_loan_payment_details as glpd');
        return $val->result_array();
    }

    public function get_datas($id)
    {
        $this->db->select('glpd.id, glpd.loan_no, glpd.monthly_emi, glpd.interest_paid, glpd.group_loan_id, glpd.payment_date, m.member_id, m.first_name, m.mid_name, m.last_name, m.nominee_name, m.id as mem_id,gmpd.adv_amount');
        $this->db->where('glpd.id', $id);
        $this->db->join('member as m', 'm.id = glpd.member_id', 'left');
        $this->db->join('group_member_payment_details as gmpd', 'gmpd.member_id = glpd.member_id', 'left');
        $this->db->order_by('id', 'DESC');
        $get = $this->db->get('group_loan_payment_details as glpd');
        return $get->row_array();
    }
  

    public function get_od_data($id)
    {

        $this->db->select('glpd.id, glpd.payment_date, glpd.monthly_emi, glpd.member_id, glpd.group_loan_id');
        $this->db->where('glpd.id', $id);
        $od = $this->db->get('group_loan_payment_details as glpd');
        return $od->row_array();
    }
    public function adv_amount($id)  
    {
        $this->db->select('glpd.id,glpd.member_id,gmpd.adv_amount');
        $this->db->where(array('glpd.id'=>$id));
        $this->db->join('group_member_payment_details as gmpd','gmpd.member_id=glpd.member_id','left');
        $this->db->order_by('id', 'DESC');
        $od = $this->db->get('group_loan_payment_details as glpd');
        return $od->row_array();
    }
    

    /** ==================================== OD Posting ====================================== */

    public function all_od_posting_data_query($where = false)
    {

        $field = array(

            'gmpd.id', 'gmpd.loan_no', 'gmpd.monthly_emi', 'm.first_name', 'm.mid_name', 'm.last_name', 'm.member_id', 'm.nominee_name',

        );
        $i = 0;
        foreach ($field as $item) {

            if (!empty($where['search']['value'])) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $where['search']['value']);
                } else {
                    $this->db->or_like($item, $where['search']['value']);
                }
                if (count($field) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        $scenter_name = $where['center'];
        if (!empty($where['center'])) {

            $this->db->where("FIND_IN_SET('$scenter_name',glpd.center_id)!=", 0);
        }

        $this->db->select('gmpd.id, gmpd.paid_amount, gmpd.rest_amount, m.first_name, m.mid_name, m.last_name, m.member_id, m.nominee_name, agl.tenure, agl.loan_start_date, agl.loan_no')->from('group_member_payment_details as gmpd');
        $this->db->where(array('gmpd.branch_id' => $this->session->userdata('branch_id'), 'gmpd.status' => 1, 'gmpd.is_od' => 2));
        $this->db->join('member as m', 'm.id = gmpd.member_id', 'left');
        $this->db->join('add_group_loan as agl', 'gmpd.group_loan_id = agl.id', 'left');
        $this->db->join('group_loan_payment_details as glpd', 'glpd.id = gmpd.emi_id', 'left');




        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'asc');
        }
    }

    public function all_od_posting_data($where = false)
    {

        $this->all_od_posting_data_query($where);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function od_posting_loan_total_count($where = false)
    {

        $this->all_od_posting_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function od_posting_loan_total_filter_count($where = false)
    {

        $this->all_od_posting_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function get_od_datas($id)
    {

        $this->db->select('gmpd.id,gmpd.emi_id, gmpd.group_loan_id, gmpd.paid_amount, gmpd.rest_amount, m.first_name, m.mid_name, m.last_name, m.nominee_name, agl.loan_no');
        $this->db->where('gmpd.id', $id);
        $this->db->join('member as m', 'm.id = gmpd.member_id', 'left');
        $this->db->join('add_group_loan as agl', 'agl.id = gmpd.group_loan_id', 'left');
        $get = $this->db->get('group_member_payment_details as gmpd');
        return $get->row_array();
    }

    public function get_ad_datas($id)   
    {

        $this->db->select('gmpd.id,gmpd.adv_amount,glpd.monthly_emi,gmpd.emi_id, gmpd.group_loan_id, gmpd.paid_amount, gmpd.rest_amount, m.first_name, m.mid_name, m.last_name, m.nominee_name, agl.loan_no');
        $this->db->where('gmpd.id', $id);
        $this->db->join('member as m', 'm.id = gmpd.member_id', 'left');
        $this->db->join('add_group_loan as agl', 'agl.id = gmpd.group_loan_id', 'left');
        $this->db->join('group_loan_payment_details as glpd', 'glpd.member_id = gmpd.member_id', 'left');
        $get = $this->db->get('group_member_payment_details as gmpd');
        return $get->row_array();
    }
    /** ==================================== @mi Singh Start 12.04.2024====================================== */
    public function manage_recover_details($id)
    {
        $getResult = $this->db->select('glpd.id as emi_id, m.member_id,glpd.loan_no as group_loan_id, glpd.monthly_emi as payabl_amt, glpd.payment_date as emi_date, glpd.monthly_emi as paid_amount')->from('group_loan_payment_details as glpd')->where(array('glpd.branch_id' => $this->session->userdata('branch_id'), 'glpd.payment_date' => date('Y-m-d'), 'glpd.payment_status' => 1, 'glpd.is_od' => 1))->where("FIND_IN_SET('" . $id . "',glpd.center_id)!=", 0)->join('member as m', 'm.id = glpd.member_id', 'left')->join('add_group_loan as agl', 'glpd.group_loan_id = agl.id', 'left');
        $get = $this->db->get();
        return $get->return_array();
        if ($getResult) {
            // $isExistDetails=array();
            foreach ($getResult as $mList) {
                $posting = array(
                    'branch_id'               => $this->session->userdata('branch_id'),
                    'emi_id'                  => $mList['emi_id'],
                    'member_id'               => $mList['member_id'],
                    'group_loan_id'           => $mList['group_loan_id'],
                    'total_payble_amount'     => $mList['total_payble_amount'],
                    'emi_date'                => $mList['emi_date'],
                    'paid_amount'             => $mList['paid_amount'],
                    'pay_date'                => date('Y-m-d'),
                    'week'                    => date('W'),
                    'created_by_user_type_id' => $this->session->userdata('user_id'),
                    'created_at'              => date('Y-m-d'),
                    'status'                  => 2
                );
                //  print_r($posting);		echo '<br>';

                $this->db->insert('group_member_payment_details', $posting);

                /*  $status = array('payment_status' => 2);
                          
                   $this->db->update('group_loan_payment_details', $status)->where(array('id' => $mList['emi_id']),$status);
        
                    $loan_status = array('payment_status' => 2);
                   $this->db->update('add_group_loan', $loan_status)->where(array('id' => $mList['group_loan_id']), $loan_status);*/
            }
        }
    }


    public function all_group_data($id)
    {
        $this->db->select('mg.grp_id, mg.name as group_name');
        $this->db->where('mg.center_id', $id);
        $val22 = $this->db->get('master_group as mg')->result_array();
        if ($val22) {
            $isExistDetails = array();
            foreach ($val22 as $v) {
                $count = $this->db->select('id', 'group_name')->where(array('group_name' => $v['grp_id']))->get('member')->num_rows();
                if ($count <= 5) {
                    $val1 = array('grp_id' => $v['grp_id'], 'group_name' => $v['group_name'], 'member No' => $count);
                    array_push($isExistDetails, $val1);
                }
            }
        }

        return $isExistDetails;
    }

    public function save_posting_data_mod($id)  
    {
        return $this->db->select('glpd.*,m.member_id, m.first_name, m.mid_name, m.last_name, m.nominee_name, m.id as mem_id')->where(array('glpd.center_id' => $id, 'glpd.is_od' => 1, 'glpd.payment_date' => date('Y-m-d')))->join('member as m', 'm.id = glpd.member_id', 'left')->get('group_loan_payment_details as glpd')->result_array();


        // $this->db->select('glpd.id, glpd.loan_no, glpd.monthly_emi, glpd.group_loan_id, glpd.payment_date, m.member_id, m.first_name, m.mid_name, m.last_name, m.nominee_name, m.id as mem_id');
        // $this->db->where('glpd.id', $id);
        // $this->db->join('member as m', 'm.id = glpd.member_id', 'left');
        // $get = $this->db->get('group_loan_payment_details as glpd');
        // return $get->row_array();
        // emi_id




        
    }
    public function udpate_posting_data_mod($id)
    {
        return $this->db->select('*')->where('id',$id)->get('group_loan_payment_details')->row_array();

    }

    function saveDAta($data)
    {
        return $this->db->insert('group_member_payment_details', $data);
    }
    function update_data($table,$con,$data)
    {
        $this->db->where($con);
        return $this->db->update($table, $data);
    }
    // 'master_center', 'id, center_name'
    public function all_center_name() 
    {
        return $this->db->select('glpd.payment_date,mc.id, mc.center_name,glpd.member_id')->from('group_loan_payment_details as glpd')->where(array('glpd.payment_date'=>date('Y-m-d'),'mc.branch_id'=>$this->session->userdata('branch_id'),'glpd.payment_status'=>1,'glpd.is_adv'=>1,'glpd.is_od'=>1))->join('master_center as mc','mc.id=glpd.center_id','left')->group_by('mc.center_name')->get()->result_array();
    }

// ------------------------------------ posting save data sec end --------------------------------------  

//------------------------------------ Advance Posting data sec start -----------------------------------
public function all_ad_posting_data_query($where = false)
{
    $field = array(
        'gmpd.id', 'gmpd.loan_no', 'gmpd.monthly_emi', 'm.first_name', 'm.mid_name', 'm.last_name', 'm.member_id', 'm.nominee_name',
    );
    $i = 0;
    foreach ($field as $item) {
        if (!empty($where['search']['value'])) {
            if ($i === 0) {
                $this->db->group_start();
                $this->db->like($item, $where['search']['value']);
            } else {
                $this->db->or_like($item, $where['search']['value']);
            }
            if (count($field) - 1 == $i) {
                $this->db->group_end();
            }
        }
        $i++;
    }

    $scenter_name = $where['center'];
    if (!empty($where['center'])) {

        $this->db->where("FIND_IN_SET('$scenter_name',glpd.center_id)!=", 0);
    }

    $this->db->select('gmpd.id,gmpd.adv_amount,gmpd.paid_amount, gmpd.rest_amount, m.first_name, m.mid_name, m.last_name, m.member_id, m.nominee_name, agl.tenure, agl.loan_start_date, agl.loan_no')->from('group_member_payment_details as gmpd');
    $this->db->where(array('gmpd.branch_id' => $this->session->userdata('branch_id'), 'gmpd.status' => 1, 'gmpd.is_adv' => 2));
    $this->db->join('member as m', 'm.id = gmpd.member_id', 'left');
    $this->db->join('add_group_loan as agl', 'gmpd.group_loan_id = agl.id', 'left');
    $this->db->join('group_loan_payment_details as glpd', 'glpd.id = gmpd.emi_id', 'left');

    if (isset($where['order']) && !empty($where['order'])) {
        $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
    } else {
        $this->db->order_by('id', 'asc');
    }
}
public function all_ad_posting_data($where = false)
{
    $this->all_ad_posting_data_query($where);
    if ($where['length'] != -1) {
        $this->db->limit($where['length'], $where['start']);
    }
    return $this->db->get()->result();
}

public function count_ad_posting($where = false)       
{
    $this->all_ad_posting_data_query($where);
    return $this->db->get()->num_rows();
}

public function filter_ad_posting($where = false)
{
    $this->all_ad_posting_data_query($where);
    return $this->db->get()->num_rows();
}
//------------------------------------ Advance Posting data sec end -------------------------------------

}
