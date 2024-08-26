<?php

    class Commission_Category_model extends CI_Model
    {

        public function __construct()
        {

            parent::__construct();

        }

        /* ===================================== All Commission Category Data Query ==================================== */

        public function all_commission_category_data_query($where = false)
        {

            $field = array(

                'cc.id','cc.loan_product', 'cc.commission_percentage', 'cc.status', 'lp.loan_product_name'

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

            $this->db->select('cc.*, lp.loan_product_name')->from('commission_category as cc');
            $this->db->join('loan_product as lp', 'lp.id = cc.loan_product', 'left');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {

                $this->db->order_by('id', 'desc');

            }

        }

        public function all_commission_category_data($where = false)
        {

            $this->all_commission_category_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();

        }

        public function total_count($where = false)
        {

            $this->all_commission_category_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function total_filter_count($where = false)
        {

            $this->all_commission_category_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function get_commission_category_data($id) {

            $this->db->select('cc.*, lp.loan_product_name');
            $this->db->where('cc.id', $id);
            $this->db->join('loan_product as lp', 'lp.id = cc.loan_product', 'left');
            $commission = $this->db->get('commission_category as cc');
            return $commission->row_array();

        }

    }

?>