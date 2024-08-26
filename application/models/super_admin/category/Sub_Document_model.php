<?php
    class Sub_Document_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function get_all_document() {

            return $this->db->select('*')->where('status', 1)->get('document')->result_array();

        }

        /* ===================================== All Sub Document Data Query ==================================== */

        public function all_sub_document_data_query($where = false)
        {
            $field = array(
                'sd.id','sd.document_name', 'sd.sub_document_name', 'sd.description', 'sd.status', 'd.document_name'
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

            $this->db->select('sd.*, d.document_name as docu_nm')->from('sub_document as sd');
            $this->db->join('document as d', 'd.id = sd.document_name', 'left');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('sd.id', 'desc');
            }
        }

        public function all_sub_document_data($where = false)
        {
            $this->all_sub_document_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function total_count($where = false)
        {
            $this->all_sub_document_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function total_filter_count($where = false)
        {
            $this->all_sub_document_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function get_sub_document_data($id) {

            return $this->db->select('*')->where('id', $id)->get('sub_document as sd')->row_array();
        }

    }
?>