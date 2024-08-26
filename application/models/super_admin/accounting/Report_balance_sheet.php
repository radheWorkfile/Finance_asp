<?php
class Report_balance_sheet extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function all_balance_sheet_report_query($where = false) {
        $field = array('id' );
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

        $this->db->select('traHi.id')->from('transaction_history as traHi');
       

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'asc');
        }
    }

    public function manage_balance_sheet($where = false)
    {
        $this->all_balance_sheet_report_query($where);
        if ($where['length'] != -1) { $this->db->limit($where['length'], $where['start']);
        } return $this->db->get()->result();
    }
    public function count_balance_sheet($where = false)
    {$this->all_balance_sheet_report_query($where); return $this->db->get()->num_rows();}
    public function filter_balance_sheet($where = false)
    {
       $this->all_balance_sheet_report_query($where);return $this->db->get()->num_rows();
    }
    
}
