<?php

    class Income_model extends CI_Model
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function all_designation() {

            return $this->db->select('id, designation_name')->where('status', 1)-> get('designation_category')->result_array();
        }

        /* ===================================== All Income Data Query ==================================== */

        public function all_income_data_query($where = false)
        {
            $field = array(
                'id', 'source', 'amount', 'income_date', 'status'
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

            $this->db->select('id,cash_received_by,amount,income_date,status')->from('income');


            if (isset($where['order']) && !empty($where['order'])) {
                $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
            } else {
                $this->db->order_by('id', 'desc');
            }
        }

        public function all_income_data($where = false)
        {
            $this->all_income_data_query($where);

            if ($where['length'] != -1) {
                $this->db->limit($where['length'], $where['start']);
            }
            return $this->db->get()->result();
        }

        public function total_count($where = false)
        {
            $this->all_income_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function total_filter_count($where = false)
        {
            $this->all_income_data_query($where);
            return $this->db->get()->num_rows();
        }

        public function get_income_data($id) {

            $this->db->select('*');
            $this->db->where('id', $id);
            $age = $this->db->get('income');
            return $age->row_array();
            
        }

        public function all_income2() 
        {
            $this->db->select('inc.*,inc_so.source_name');
            $this->db->join('income_sources as inc_so','inc_so.id=inc.source','left');
            return $this->db->get('income as inc')->result_array();
           
        }

        public function all_income($where = false) 
        {
            $this->db->select('inc.*, inc_so.source_name');
            
            if (!empty($where['strtDt']) && !empty($where['endDt'])) {
                $this->db->where('inc.income_date >=', $where['strtDt']);
                $this->db->where('inc.income_date <=', $where['endDt']);
            }
            else if (!empty($where['dmy']) && $where['dmy'] == date('Y-m-d')) {
                $this->db->where('DATE(inc.income_date)', $where['dmy']);
            }
            else if (!empty($where['dmy']) && $where['dmy'] == date('Y-m')) {
                $this->db->where('DATE_FORMAT(inc.income_date, "%Y-%m") =', $where['dmy']);
            }
            else if (!empty($where['dmy']) && $where['dmy'] == date('Y')) {
                $this->db->where('YEAR(inc.income_date)', $where['dmy']);
            }
        
            $this->db->join('income_sources as inc_so', 'inc_so.id = inc.source', 'left');
            
            return $this->db->get('income as inc')->result_array();
        }

        public function all_expense_2() 
        {
             $this->db->select('exp.*,ex_cat.exp_name')->join('expense_category as ex_cat','ex_cat.id=exp.exp_name','left')->get('expense as exp')->result_array();
        }

        public function all_expense($where = false) 
        {
             $this->db->select('exp.*,ex_cat.exp_name');

             if(!empty($where['strtDt']) || !empty($where['endDt'])) {
                $this->db->where('exp.expense_data >=', $where['strtDt']);
                $this->db->where('exp.expense_data <=', $where['endDt']);
                }else if (!empty($where['dmy']) && $where['dmy'] == date('Y-m-d')) {
                    $this->db->where('DATE(exp.expense_data)', $where['dmy']);
                }
                else if (!empty($where['dmy']) && $where['dmy'] == date('Y-m')) {
                    $this->db->where('DATE_FORMAT(exp.expense_data, "%Y-%m") =', $where['dmy']);
                }
                else if (!empty($where['dmy']) && $where['dmy'] == date('Y')) {
                    $this->db->where('YEAR(exp.expense_data)', $where['dmy']);
                }

             $this->db->join('expense_category as ex_cat','ex_cat.id=exp.exp_name','left');
             return $this->db->get('expense as exp')->result_array();
        }

        public function total_inc($where = false)
        {
             $this->db->select('sum(amount) as total_inc');

             if(!empty($where['strtDt']) || !empty($where['endDt'])) {
                $this->db->where('income_date >=', $where['strtDt']);
                $this->db->where('income_date <=', $where['endDt']);
                }else if (!empty($where['dmy']) && $where['dmy'] == date('Y-m-d')) {
                    $this->db->where('DATE(income_date)', $where['dmy']);
                }
                else if (!empty($where['dmy']) && $where['dmy'] == date('Y-m')) {
                    $this->db->where('DATE_FORMAT(income_date, "%Y-%m") =', $where['dmy']);
                }
                else if (!empty($where['dmy']) && $where['dmy'] == date('Y')) {
                    $this->db->where('YEAR(income_date)', $where['dmy']);
                }

             return $this->db->get('income')->result_array();
        }
        public function total_exp($where = false)
        {
             $this->db->select('sum(amount) as total_exp');

             if(!empty($where['strtDt']) || !empty($where['endDt'])) {
                $this->db->where('expense_data >=', $where['strtDt']);
                $this->db->where('expense_data <=', $where['endDt']);
                }else if (!empty($where['dmy']) && $where['dmy'] == date('Y-m-d')) {
                    $this->db->where('DATE(expense_data)', $where['dmy']);
                }
                else if (!empty($where['dmy']) && $where['dmy'] == date('Y-m')) {
                    $this->db->where('DATE_FORMAT(expense_data, "%Y-%m") =', $where['dmy']);
                }
                else if (!empty($where['dmy']) && $where['dmy'] == date('Y')) {
                    $this->db->where('YEAR(expense_data)', $where['dmy']);
                }

             return $this->db->get('expense')->result_array();
        }


       


    }

?>