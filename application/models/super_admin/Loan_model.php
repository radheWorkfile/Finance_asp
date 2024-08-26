<?php

    class Loan_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function get_member_data($id) {

            return $this->db->select('*')->where('member_id', $id)->get('member')->row_array();

        }

        public function all_loan_product() {

            return $this->db->select('id, loan_product_name')->where('status', 1)->get('loan_product')->result_array();

        }

        public function get_loan_product_data($id) {

            return $this->db->select('amount, interest_percentage, interest_amount, interest_type')->where('id', $id)->get('loan_product')->row_array();

        }

        public function get_last_id($id) {

            return $this->db->select('id')->where('member_id', $id)->order_by('id', 'DESC')->limit(1)->get('loan_details')->row_array();

        }

        /* ===================================== All Loan Data Query ==================================== */

        public function all_loan_data_query($where = false)
        {
            $field = array(
                'm.member_id', 'm.full_name', 'ld.id', 'ld.amount', 'ld.loan_type', 'ld.status'
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

            $this->db->select('m.member_id, m.full_name, ld.id, ld.amount, ld.loan_type, ld.status')->from('loan_details as ld');
            $this->db->join('member as m', 'm.id = ld.member_id', 'left');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function all_loan_data($where = false)
        {
            $this->all_loan_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function loan_total_count($where = false)
        {
            $this->all_loan_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function loan_total_filter_count($where = false)
        {
            $this->all_loan_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function get_loan_data($id) {

            $this->db->select('ld.*, m.full_name, m.member_id, m.mobile_no, m.email, lp.loan_product_name');
            $this->db->where('ld.id', $id);
            $this->db->join('member as m', 'm.id = ld.member_id', 'left');
            $this->db->join('loan_product as lp', 'lp.id = ld.loan_product', 'left');
            $val = $this->db->get('loan_details as ld');
            return $val->row_array();

        }

        public function get_last_loan_id($id) {
            
            return $this->db->select('id,loan_id')->where(array('loan_id'=>$id,'status'=>1))->order_by('id', 'ASC')->limit(1)->get('emi_details')->row_array();
            
        }

        /* ===================================== All Emi Data Query ==================================== */

        public function all_emi_data_query($where = false)
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

            $this->db->select('*')->from('emi_details');
            $this->db->where('loan_id', $where['uri']);
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'asc');
            }

        }

        public function all_emi_data($where = false)
        {

            $this->all_emi_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
            
        }

        public function emi_total_count($where = false)
        {
            $this->all_emi_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function emi_total_filter_count($where = false)
        {
            $this->all_emi_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function get_emi_data($id) 
        {

            $this->db->select('id, payment_date, monthly_emi, loan_id, member_id');
            $this->db->where('id', $id);
            $emi = $this->db->get('emi_details');
            return $emi->row_array();

        }

         /* ===================================== All Paid Emi Data Query ==================================== */

         public function all_paid_emi_data_query($where = false)
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

            $this->db->select('*')->from('loan_paymemnt_details');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'asc');
            }
 
        }
 
        public function all_paid_emi_data($where = false)
        {

            $this->all_paid_emi_data_query($where);
            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
            
        }
 
        public function emi_paid_total_count($where = false)
        {

            $this->all_paid_emi_data_query($where);
            return $this->db->get()->num_rows();

        }
 
        public function emi_paid_total_filter_count($where = false)
        {

            $this->all_paid_emi_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function get_paid_emi_data($id) {

            $this->db->select('*');
            $this->db->where('lpd.id', $id);
            $paid = $this->db->get('loan_paymemnt_details as lpd');
            return $paid->row_array();

        }

        public function get_paid_emi_bill_print_data($id) {

            $this->db->select('lpd.*, m.full_name, m.member_id, ld.receipt_no, ld.loan_no, ld.amount, ld.tenure, ld.tenure_type, lp.loan_product_name');
            $this->db->where('lpd.id', $id);
            $this->db->join('member as m', 'm.id = lpd.member_id', 'left');
            $this->db->join('loan_details as ld', 'ld.id = lpd.loan_id', 'left');
            $this->db->join('loan_product as lp', 'lp.id = ld.loan_product', 'left');
            $paid = $this->db->get('loan_paymemnt_details as lpd');
            return $paid->row_array();

        }

    }
?>