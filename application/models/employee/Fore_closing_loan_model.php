<?php

    class Fore_closing_loan_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        function getDAta($table,$data)
        {
            return $this->db->select($data)->get($table)->row_array();
        }
        // paid_amount

        public function AllData($id) 
		{
            $result=array();
			$this->db->select('mem.*,mem.member_id as mem_id,agl.*,gmpd.*,ROUND((agl.roi*agl.amount)/100,2) as intAmt,sum(gmpd.paid_amount) as PaIdAmo,(ROUND((agl.roi*agl.amount)/100,2)+sum(gmpd.paid_amount)) as frclsAmt,gmpd.paid_amount as lstRecAmo');
            $this->db->where('mem.member_id',$id['client_id']); 
            $this->db->order_by('gmpd.id','DESC');
            $this->db->join('add_group_loan as agl', 'mem.id = agl.member_id');
            $this->db->join('group_member_payment_details as gmpd', 'mem.id = gmpd.member_id');
            $result=$this->db->get('member as mem')->row_array();
			if($result)
			{
			$lastRecord=$this->db->select('paid_amount as lstRecAmo')->where('member_id',$result['member_id'])->order_by('id', 'desc')->limit(1)->get('group_member_payment_details')->row();
			        $lastRecord=$lastRecord->lstRecAmo?$lastRecord->lstRecAmo:'0';
					$result['lstRecAmoooo']=$lastRecord;
       			}
				return $result;
	   
	    }


        public function all_member_data_query($where = false)
        {
            
            $field = array(
                'm.id', 'm.loan_no', 'm.member_name', 'm.disbursed_loan', 'm.disbursed_data',
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

            $this->db->select('m.*')->from('closing_loan_data as m');
            // $this->db->where('m.branch_id', $this->session->userdata('branch_id'));
            // $this->db->join('master_group as mg', 'mg.grp_id = m.group_name', 'left');
            // $this->db->join('relationship_category as rc', 'rc.id = m.nominee_relation', 'left');


            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'asc');
            }

        }

        public function all_member_data($where = false)
        {
            $this->all_member_data_query($where);
            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function total_count($where = false)
        {
            $this->all_member_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function total_filter_count($where = false)
        {
            $this->all_member_data_query($where);
            return $this->db->get()->num_rows();
        }

        
    }

?>