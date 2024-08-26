<?php

    class Group_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        /* ===================================== All Group Data Query ==================================== */

        public function all_group_data_query($where = false)
        {
            $field = array(
                'id', 'group_name', 'village_name', 'mobile_no', 'status'
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

            $this->db->select('id, group_name, village_name, mobile_no, status')->from('group');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function all_group_data($where = false)
        {
            $this->all_group_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function total_count($where = false)
        {
            $this->all_group_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function total_filter_count($where = false)
        {
            $this->all_group_data_query($where);
            return $this->db->get()->num_rows();
        }

        /* ===================================== All Group Member Data Query ==================================== */

        public function all_group_member_data_query($where = false)
        {
        
            $val = $where['id'];
            $field = array(
                'id', 'full_name', 'mobile_no', 'email', 'member_id', 'status'
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

            $this->db->select('id, full_name, member_id, mobile_no, email, status')->from('member');
            $this->db->where("FIND_IN_SET('$val',group_name)!=", 0);
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function all_group_member_data($where = false)
        {

            $this->all_group_member_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();

        }

        public function member_total_count($where = false)
        {

            $this->all_group_member_data_query($where);
            return $this->db->get()->num_rows();

        }

        public function member_total_filter_count($where = false)
        {

            $this->all_group_member_data_query($where);
            return $this->db->get()->num_rows();

        }

    }

?>