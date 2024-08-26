<?php

    class Master_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }
        
/*===================================== Vilage Data Query ==================================== */

        public function village_query($where = false)
        {
            $field = array(
                'vMstr.name'
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

            $this->db->select('vMstr.*,district_name')->from('master_village as vMstr')->join('district as d', 'd.id=vMstr.district_id', 'left');
            
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function village_data($where = false)
        {
            $this->village_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function village_count($where = false)
        {
            $this->village_query($where);
            return $this->db->get()->num_rows();
        }

        public function village_filter_count($where = false)
        {
            $this->village_query($where);
            return $this->db->get()->num_rows();
        }

        /* ===================================== All Group Member Data Query ==================================== */
		
		public function center_query($where = false)
        {
            $field = array(
                'd.district_name'
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

            $this->db->select('vMstr.*,vm.name as village_name,district_name')->from('master_center as vMstr')->join('master_village as vm', 'vm.id=vMstr.vll_id', 'left')->join('district as d', 'd.id=vm.district_id', 'left');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function center_data($where = false)
        {
            $this->center_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function center_count($where = false)
        {
            $this->center_query($where);
            return $this->db->get()->num_rows();
        }

        public function center_filter_count($where = false)
        {
            $this->center_query($where);
            return $this->db->get()->num_rows();
        }
  /* ===================================== Branch Data Query ==================================== */
		
		public function branch_query($where = false)
        {
            $field=array('id','br_id','branch_name','address','status');
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

            $this->db->select('*')->from('master_branch');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function branch_data($where = false)
        {
            $this->branch_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function branch_count($where = false)
        {
            $this->branch_query($where);
            return $this->db->get()->num_rows();
        }

        public function branch_filter_count($where = false)
        {
            $this->branch_query($where);
            return $this->db->get()->num_rows();
        }
   public function getDataList($tblName, $cond, $id)
    {
        $this->db->from($tblName);
        $this->db->where($cond, $id);
        $result = $this->db->get();
        return $result->result();
    }
   public function getLastRecord($tblName,$sel)
   {
        $this->db->select($sel)->from($tblName);
		$this->db->order_by('id', 'desc')->limit(1);
        $result = $this->db->get();
        return $result->row();
    }	
/*________________________________________________________*/
	public function group_query($where = false)
        {
            $field=array('id','grp_id','name','status');
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
            $this->db->select('*')->from('master_group');
            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function group_data($where = false)
        {
            $this->group_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function group_count($where = false)
        {
            $this->group_query($where);
            return $this->db->get()->num_rows();
        }

        public function group_filter_count($where = false)
        {
            $this->group_query($where);
            return $this->db->get()->num_rows();
        }
/*__________________________________________________________*/
/*__________________________________________________________*/
###################################Field Schedule Start############################################
public function fSchedule_query($where = false)
{
    $field = array('msf.id','schCode','staff_id','center_id','schedule_date','msf.status');
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
    $this->db->select('msf.*,s.full_name,s.staff_id as stfCode,msc.center_name,msc.center_id as centerCode')->from('master_field_schedule as msf')->where('msf.branch_id', 0)->join('staff as s', 's.id=msf.staff_id', 'left')->join('master_center as msc', 'msc.id=msf.center_id', 'left');
    
    if (!(empty($where['strtDt']) && empty($where['endDt']))) 
    {
                $this->db->where('msf.schedule_date >=', $where['strtDt'])->where('msf.schedule_date <=', $where['endDt']);
        }
    
    
    if (isset($where['order']) && !empty($where['order'])) {
        $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
    } else {
        $this->db->order_by('id', 'desc');
    }
}

public function fSchedule_data($where = false)
{
    $this->fSchedule_query($where);

    if ($where['length'] != -1) {
        $this->db->limit($where['length'], $where['start']);
    }
    return $this->db->get()->result();
}

public function fSchedule_count($where = false)
{
    $this->fSchedule_query($where);
    return $this->db->get()->num_rows();
}

public function fSchedule_filter_count($where = false)
{
    $this->fSchedule_query($where);
    return $this->db->get()->num_rows();
}

function get_data_1($table,$data,$sel)
{
    return $this->db->select($sel)->where($data)->get($table)->row_array();
}

function all_data_con($table,$val,$sel)
    {
        return $this->db->select($sel)->where($val)->get($table)->result_array();
    }

###################################Field Schedule End############################################

    }

?>