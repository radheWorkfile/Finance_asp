<?php

    class Commission_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        /* ===================================== All Commission Data Query ==================================== */

        public function all_commission_data_query($where = false)
        {
            $field = array(
                'co.id','co.commission_type', 'co.total_commission_amount', 'co.status',
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

            $this->db->select('ce.id, ce.commission_type, ce.total_commission_amount, ce.status, a.name as agent_name, a.agent_id, lt.loan_type_name, c.name as customer_name, c.customer_id')->from('commission_earning as ce');
            $this->db->where('ce.agent_name', (int)$this->session->userdata('agent_id'));
            $this->db->join('agent as a', 'a.id = ce.agent_name', 'left');
            $this->db->join('loan_type as lt', 'lt.id = ce.loan_type', 'left');
            $this->db->join('customer as c', 'c.id = ce.customer_name', 'left');
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

        public function get_commission_data($id) {

            $this->db->select('ce.*, a.name as agent_nm, a.agent_id, c.name as customer_nm, c.customer_id, lt.loan_type_name, cpd.rest_amount');
            $this->db->where('ce.id', $id);
            $this->db->join('agent as a', 'a.id = ce.agent_name', 'left');
            $this->db->join('customer as c', 'c.id = ce.customer_name', 'left');
            $this->db->join('loan_type as lt', 'lt.id = ce.loan_type', 'left');
            $this->db->join('commission_payment_details as cpd', 'cpd.commission_earning_id = ce.id', 'left');
            $cmmsn = $this->db->get('commission_earning as ce');
            return $cmmsn->row_array();

        }

    }

?>