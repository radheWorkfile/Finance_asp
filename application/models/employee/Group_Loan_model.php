<?php

    class Group_Loan_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function get_center_member_data($id) {
           
            $this->db->select('mem.member_id, mem.first_name, mem.mid_name, mem.last_name, mem.mobile_no, mem.email, mem.id as mem_id, mem.referesh_disbursment_status, mem.disbursment_status');
            $this->db->where("FIND_IN_SET('$id', mem.group_name) !=", 0);
            $this->db->join('master_group as mg', 'mem.group_name = mg.grp_id','left');
            $this->db->join('add_group_loan as agl', 'agl.member_id = mem.id', 'left');
            return $this->db->get('member as mem')->result_array();

        }

        public function get_schedule_data($id) {

            $this->db->select('mfs.schCode');
            $this->db->where('mg.grp_id', $id);
            $this->db->join('master_center as mc', 'mc.id = mg.center_id', 'left');
            $this->db->join('master_field_schedule as mfs', 'mfs.center_id = mc.id', 'left');
            return $this->db->get('master_group as mg')->row_array();

        }

        public function get_group_details($id) {

            $this->db->select('mg.name as group_name, mc.center_name');
            $this->db->where('mg.grp_id', $id);
            $this->db->join('master_center as mc', 'mc.id = mg.center_id', 'left');
            $grp = $this->db->get('master_group as mg');
            return $grp->row_array();

        }

        public function get_group_loan_details($id) {

            $this->db->select('m.member_id, m.first_name, m.mid_name, m.last_name, m.aadhar_card_no, m.mobile_no, agl.id, agl.amount, agl.disbursment_status, agl.status, mc.center_name, mg.name as group_name');
            $this->db->where("FIND_IN_SET('$id', agl.group_id) !=", 0);
            $this->db->join('member as m', 'm.id = agl.member_id', 'left');
            $this->db->join('master_center as mc', 'mc.id = agl.center_id', 'left');
            $this->db->join('master_group as mg', 'mg.id = agl.group_id', 'left');
            $loan = $this->db->get('add_group_loan as agl');
            return $loan->result_array(); 

        }

        public function get_member_data($id) {

            return $this->db->select('m.id, m.first_name, m.mid_name, m.last_name, m.member_id, m.center_name as cntr_id, m.group_name as grp_id, m.mobile_no, m.email, mc.center_name, mg.name as group_name, mfs.schedule_date')->where('m.id', $id)->join('master_center as mc', 'mc.id = m.center_name', 'left')->join('master_group as mg', 'mg.grp_id = m.group_name', 'left')->join('master_field_schedule as mfs', 'm.center_name = mfs.center_id', 'left')->get('member as m')->row_array();

        }

        public function all_group_loan_product() {

            return $this->db->select('id, loan_product_name')->where('status', 1)->get('loan_product')->result_array();

        }

        public function get_group_loan_product_data($id) {

            return $this->db->select('amount, tenure, interest_percentage, interest_amount, interest_type, processing_fee')->where('id', $id)->get('loan_product')->row_array();

        }

        public function get_last_id($id) {

            return $this->db->select('id')->where('member_id', $id)->order_by('id', 'DESC')->limit(1)->get('add_group_loan')->row_array();

        }

        /* ===================================== All Group Loan Data Query ==================================== */

        public function all_group_loan_data_query($where = false)
        {
            
            $field = array(
                'm.member_id', 'm.full_name', 'agl.id', 'agl.amount', 'agl.status'
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

            $this->db->select('m.member_id, m.full_name, m.aadhar_card_no, agl.id, agl.amount, agl.status, mc.center_name')->from('add_group_loan as agl');
            $this->db->where('agl.branch_id', $this->session->userdata('branch_id'));
            $this->db->join('member as m', 'm.id = agl.member_id', 'left');
            $this->db->join('master_center as mc', 'mc.id = agl.center_id', 'left');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function all_group_loan_data($where = false)
        {

            $this->all_group_loan_data_query($where);

            if ($where['length'] != -1) {

                $this->db->limit($where['length'], $where['start']);

            }
            return $this->db->get()->result();

        }

        public function group_loan_total_count($where = false)
        {

            $this->all_group_loan_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function group_loan_total_filter_count($where = false)
        {

            $this->all_group_loan_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function get_group_loan_data($id) {

            $this->db->select('agl.*, m.first_name, m.mid_name, m.last_name, m.member_id, m.id as mem_id, m.mobile_no, m.email, lp.loan_product_name');
            $this->db->where('agl.id', $id);
            $this->db->join('member as m', 'm.id = agl.member_id', 'left');
            $this->db->join('loan_product as lp', 'lp.id = agl.loan_product', 'left');
            $val = $this->db->get('add_group_loan as agl');
            return $val->row_array();

        }

        public function get_last_loan_id($id) {
            
            return $this->db->select('id,loan_id')->where(array('loan_id'=>$id,'status'=>1))->order_by('id', 'ASC')->limit(1)->get('emi_details')->row_array();
            
        }

        /* ===================================== All Group Loan Emi Data Query ==================================== */

        public function all_group_loan_emi_data_query($where = false)
        {

            $field = array(
                '*'
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

            $this->db->select('*')->from('group_loan_payment_details');
            $this->db->where('group_loan_id', $where['uri']);
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'asc');
            }

        }

        public function all_group_loan_emi_data($where = false)
        {

            $this->all_group_loan_emi_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
            
        }

        public function group_emi_total_count($where = false)
        {
            $this->all_group_loan_emi_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function group_emi_total_filter_count($where = false)
        {
            $this->all_group_loan_emi_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function get_group_loan_emi_data($id) 
        {

            $this->db->select('id, payment_date, monthly_emi, group_loan_id, member_id');
            $this->db->where('id', $id);
            $emi = $this->db->get('group_loan_payment_details');
            return $emi->row_array();

        }

        /* ========================= All Group Loan Paid Emi Data Query ========================== */

        public function all_group_loan_paid_emi_data_query($where = false)
        {
 
            $field = array(
                'gmpd.id', 'gmpd.total_payble_amount', 'gmpd.emi_date', 'gmpd.paid_amount', 'gmpd.rest_amount', 'm.first_name', 'm.mid_name', 'm.last_name', 'm.member_id', 'm.center_name', 'mg.name as group_name'
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

            $center_name = $where['center'];

            if (!empty($where['center'])) {

                $this->db->where("FIND_IN_SET('$center_name',m.center_name)!=", 0);
                
            }

            $this->db->select('gmpd.id,gmpd.member_id as gmpd_mem_id, gmpd.total_payble_amount, gmpd.emi_date, gmpd.paid_amount, gmpd.rest_amount, m.first_name, m.mid_name, m.last_name, m.member_id, m.center_name, mg.name as group_name')->from('group_member_payment_details as gmpd');
            $this->db->where('gmpd.branch_id', $this->session->userdata('branch_id'));
            $this->db->join('member as m', 'm.id = gmpd.member_id', 'left');
            $this->db->join('master_group as mg', 'mg.grp_id = m.group_name', 'left');


            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'asc');
            }
 
        }
 
        public function all_group_loan_paid_emi_data($where = false)
        {

            $this->all_group_loan_paid_emi_data_query($where);
            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
            
        }
 
        public function group_emi_paid_total_count($where = false)
        {

            $this->all_group_loan_paid_emi_data_query($where);
            return $this->db->get()->num_rows();

        }
 
        public function group_emi_paid_total_filter_count($where = false)
        {

            $this->all_group_loan_paid_emi_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function get_group_loan_paid_emi_data($id) {

            $this->db->select('gmpd.*, m.first_name, m.mid_name, m.last_name, m.member_id, mc.center_name, mv.name');
            $this->db->where('gmpd.id', $id);
            $this->db->join('member as m', 'm.id = gmpd.member_id', 'left');
            $this->db->join('master_center as mc', 'mc.id = m.center_name', 'left');
            $this->db->join('master_village as mv', 'mv.id = mc.vll_id', 'left');
            $paid = $this->db->get('group_member_payment_details as gmpd');
            return $paid->row_array();

        }

        public function get_group_loan_paid_emi_bill_print_data($id) { 

            $this->db->select('gmpd.*,mb.branch_name as branchName,m.first_name, m.mid_name, m.last_name, m.member_id,agl.receipt_no,agl.loan_no, agl.amount,agl.tenure,agl.tenure_type, lp.loan_product_name');
            $this->db->where('gmpd.id', $id);
            $this->db->join('member as m', 'm.id = gmpd.member_id', 'left');
            $this->db->join('add_group_loan as agl', 'agl.id = gmpd.group_loan_id', 'left');
            $this->db->join('loan_product as lp', 'lp.id = agl.loan_product', 'left');
            $this->db->join('master_branch as mb', 'mb.id = gmpd.branch_id', 'left');
            $paid = $this->db->get('group_member_payment_details as gmpd');
            return $paid->row_array();

        }

        public function all_refresh_disburse_loan_data_query($where = false) {

            $field = array(

                'agl.id', 'agl.loan_start_date', 'agl.amount', 'agl.referesh_disbursment_status', 'm.first_name', 'm.mid_name', 'm.last_name', 'm.member_id', 'mc.center_name'

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

                $this->db->where("FIND_IN_SET('$scenter_name',agl.center_id)!=", 0);

            }

            $this->db->select('agl.id, agl.loan_start_date, agl.amount, agl.referesh_disbursment_status, m.first_name, m.mid_name, m.last_name, m.member_id, mc.center_name')->from('add_group_loan as agl');
            $this->db->where(array('agl.branch_id' => $this->session->userdata('branch_id'), 'agl.referesh_disbursment_status' => 1));
            $this->db->join('member as m', 'm.id = agl.member_id', 'left');
            $this->db->join('master_center as mc', 'mc.id = agl.center_id', 'left');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'asc');
            }

        }

        public function all_refresh_disburse_loan_data($where = false)
        {

            $this->all_refresh_disburse_loan_data_query($where);
            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
            
        }
 
        public function refresh_disburse_loan_total_count($where = false)
        {

            $this->all_refresh_disburse_loan_data_query($where);
            return $this->db->get()->num_rows();

        }
 
        public function refresh_disburse_loan_total_filter_count($where = false)
        {

            $this->all_refresh_disburse_loan_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function get_refresh_disburse_data($id) {

            $this->db->select('agl.id, agl.member_id, m.first_name, m.mid_name, m.last_name');
            $this->db->where('agl.id', $id);
            $this->db->join('member as m', 'm.id = agl.member_id', 'left');
            $ref = $this->db->get('add_group_loan as agl');
            return $ref->row_array();

        }

        public function delete_grp_loan($val)
        {

            if($val) {
                $this->db->where('id',$val);
                $del = $this->db->delete('add_group_loan');
                if($del){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }

        public function delete_grp_loan_emis($val){

            if($val) {
                $this->db->where('group_loan_id',$val);
                $del = $this->db->delete('group_loan_payment_details');
                if($del){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

        }

        public function delete_grp_loan_payments($val) {

            if($val) {
                $this->db->where('group_loan_id',$val);
                $del = $this->db->delete('group_member_payment_details');
                if($del){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            
        }

        public function get_refresh_paid_emi_data($id) {

            $this->db->select('gmpd.id, gmpd.emi_id, gmpd.group_loan_id, m.first_name, m.mid_name, m.last_name');
            $this->db->where('gmpd.id', $id);
            $this->db->join('member as m', 'm.id = gmpd.member_id', 'left');
            $ref = $this->db->get('group_member_payment_details as gmpd');
            return $ref->row_array();

        }

        public function get_disburse_status($id) {

            $this->db->select('agl.id, agl.disbursment_status, agl.member_id, m.first_name, m.mid_name, m.last_name');
            $this->db->where('agl.id', $id);
            $this->db->join('member as m', 'm.id = agl.member_id', 'left');
            $ref = $this->db->get('add_group_loan as agl');
            return $ref->row_array();

        }

        public function delete_data($val) {

            if($val) {
                $this->db->where('id',$val);
                $del = $this->db->delete('group_member_payment_details');
                if($del) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }

        }

    }
    
?>