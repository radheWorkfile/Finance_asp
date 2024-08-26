<?php
class Dashboard_model  extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function manage_day_end_data_query($where = false) 
    {
        $field = array(
            'm.first_name', 'm.mid_name', 'm.last_name', 'm.member_id', 'm.nominee_name',
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

        $this->db->select('glpd.id,glpd.payment_status,glpd.is_od,glpd.loan_no,glpd.created_at,glpd.monthly_emi, m.first_name, m.mid_name, m.last_name, m.member_id, m.nominee_name, agl.tenure,')->from('group_loan_payment_details as glpd');
        $this->db->where(array('glpd.payment_status' =>1,'glpd.is_od'=>1,'glpd.payment_date <=' => date('Y-m-d')));
        $this->db->join('member as m', 'm.id = glpd.member_id', 'left');
        $this->db->join('add_group_loan as agl', 'glpd.group_loan_id = agl.id', 'left');
        $this->db->join('group_member_payment_details as gmpd', 'gmpd.group_loan_id = glpd.group_loan_id', 'left');


        

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'asc');
        }
    }

    public function manage_day_end_data($where = false)
    {

        $this->manage_day_end_data_query($where);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }
    public function manage_day_end_data_total_count()
    {
        $this->manage_day_end_data_query($where = false);
        return $this->db->get()->num_rows();
    }

    public function manage_day_end_data_total_filter_count($where = false)
    {
        $this->manage_day_end_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function day_end_data()
    {
        return $this->db->select('glpd.id, glpd.loan_no, glpd.monthly_emi, m.first_name, m.mid_name, m.last_name, m.member_id, m.nominee_name, agl.tenure,')->from('group_loan_payment_details as glpd')->where(array('glpd.payment_status' => 1, 'glpd.is_od' => 1, 'glpd.created_at <=' => date('Y-m-d')))->join('member as m', 'm.id = glpd.member_id', 'left')->join('add_group_loan as agl', 'glpd.group_loan_id = agl.id', 'left')->join('group_member_payment_details as gmpd', 'gmpd.group_loan_id = glpd.group_loan_id', 'left')->get()->result_array();
    }
}

