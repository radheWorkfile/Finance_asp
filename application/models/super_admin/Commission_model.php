<?php

    class Commission_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        /* ===================================== All Creating Commission Data Query ==================================== */

        public function all_commission_data_query($where = false)
        {

            $field = array(

                'c.id','c.name', 'c.customer_id', 'a.name as agent_name', 'a.agent_id'
                
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

            if(!empty($where['agent_name'])) {

                $this->db->where('m.identifier_name', $where['agent_name']);

            }

            if(!empty($where['start_date'] && $where['end_date'])) {

                $this->db->where('m.created_at >=', $where['start_date']);
                $this->db->where('m.created_at <=', $where['end_date']);

            } elseif(!empty($where['start_date'])) {

                $this->db->where('m.created_at >=', $where['start_date']);

            } elseif(!empty($where['end_date'])) {

                $this->db->where('m.created_at <=', $where['end_date']);

            }

            $this->db->select('m.id, m.name, m.customer_id, m.aadhar_card_no, m.pan_no, m.loan_type, m.loan_amount, m.created_at, cd.status, a.id as ids, a.name as agent_name, a.agent_id, cc.commission_type, cc.commission, cc.commission_amount, cc.commission_percentage,')->from('member as m');
            $this->db->where('cc.commission_type', $where['commission_type']);

            if($where['commission_type'] == 1) {

                $this->db->group_start();
                $this->db->where('cd.status', 1);
                $this->db->or_where('cd.status', 3);
                $this->db->group_end();

            } elseif($where['commission_type'] == 2) {

                $this->db->where('cd.status', 2);

            }

            $this->db->join('agent as a', 'a.id = m.identifier_name', 'left');
            $this->db->join('commission_category as cc', 'cc.loan_type = m.loan_type', 'left');
            if (isset($where['order']) && !empty($where['order'])) {

                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);

            } else {

                $this->db->order_by('id', 'desc');

            }

        }

        public function all_commission_data($where = false)
        {
            $this->all_commission_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function total_count($where = false)
        {
            $this->all_commission_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function total_filter_count($where = false)
        {
            $this->all_commission_data_query($where);
            return $this->db->get()->num_rows();
        }

        /* ===================================== All Created Commission Data Query ==================================== */

        public function view_commission_data_query($where = false)
        {
            $field = array(
                'c.id','c.name', 'c.customer_id', 'a.name as agent_name', 'a.agent_id'
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
            
            $this->db->select('ce.*, a.name as agent_name, a.agent_id, c.name as customer_name, c.customer_id, lt.loan_type_name')->from('commission_earning as ce');
            $this->db->join('agent as a', 'a.id = ce.agent_name', 'left');
            $this->db->join('customer as c', 'c.id = ce.customer_name', 'left');
            $this->db->join('loan_type as lt', 'lt.id = ce.loan_type', 'left');
            if (isset($where['order']) && !empty($where['order'])) {

                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);

            } else {

                $this->db->order_by('id', 'desc');

            }

        }

        public function view_all_commission_data($where = false)
        {
            $this->view_commission_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function comm_total_count($where = false)
        {
            $this->view_commission_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function comm_total_filter_count($where = false)
        {
            $this->view_commission_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function insert_data($data) {

           return $this->db->insert('commission_earning', $data);
        }

        public function insert_payment_data($data) {

            return $this->db->insert('commission_payment_details', $data);
        }

        public function get_commission_data($id) {

            $this->db->select('ce.*, a.name as agent_names, a.agent_id, c.name as customer_names, c.customer_id, lt.loan_type_name');
            $this->db->where('ce.id', $id);
            $this->db->join('agent as a', 'a.id = ce.agent_name', 'left');
            $this->db->join('customer as c', 'c.id = ce.customer_name', 'left');
            $this->db->join('loan_type as lt', 'lt.id = ce.loan_type', 'left');
            $val = $this->db->get('commission_earning as ce');
            return $val->row_array();

        }

        public function get_last_id($id) {

            return $this->db->select('id,total_payble_amount, paid_amount')->where('commission_earning_id', $id)->order_by('id', 'DESC')->limit(1)->get('commission_payment_details')->row_array();

        }

        public function get_agent_data($id) {

            $cmms = implode(",", $id['rejected_commission_agent_name']);
            $this->db->select('id,name, agent_id');
            $this->db->where("FIND_IN_SET(id,'$cmms')!=", 0);
            $agent = $this->db->get('agent');
            return $agent->result_array();

        }

    }

?>