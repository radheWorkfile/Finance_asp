<?php
    class Expense_Model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
 
    //  ************************************** Expense_Model start ******************************  

    public function all_manage_expense_query($where = false)
          {
              $field = array(
                  'id','status'
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
  
              $this->db->select('*')->from('expense_category');
              if (isset($where['order']) && !empty($where['order'])) {
                  $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
              } else {
                  $this->db->order_by('id', 'desc');
              }
          }
  
          public function all_manage_expense($where = false)
          {
              $this->all_manage_expense_query($where);
  
              if ($where['length'] != -1) {
                  $this->db->limit($where['length'], $where['start']);
              }
              return $this->db->get()->result();
          }
  
          public function count_manage_expense($where = false)
          {
              $this->all_manage_expense_query($where);
              return $this->db->get()->num_rows();
          }
  
          public function filter_manage_expense($where = false)
          {
              $this->all_manage_expense_query($where);
              return $this->db->get()->num_rows();
          }

          public function get_view_manage_expense($id) {
  
            return $this->db->select('*')->where('id', $id)->get('expense_category')->row_array();
        }

        public function get_man_exp_data($id) {

            return $this->db->select('*')->where('id', $id)->get('expense_category')->row_array();
        }
        


    //  ************************************** Expense_Model end ********************************
    
    

    //  ********************************* Miscellaneous Expense_Model end ********************************  

    public function all_miscellaneous_expense_man_query($where = false)
    {
        $field = array(
            'id','status'
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

        $this->db->select('*')->from('miscellaneous_expense');
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function all_miscellaneous_expense_man($where = false)
    {
        $this->all_miscellaneous_expense_man_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function count_miscellaneous_expense_man($where = false)
    {
        $this->all_miscellaneous_expense_man_query($where);
        return $this->db->get()->num_rows();
    }

    public function filter_miscellaneous_expense_man($where = false)
    {
        $this->all_miscellaneous_expense_man_query($where);
        return $this->db->get()->num_rows();
    }

    public function get_view_mis_expense_man($id) {
  
        return $this->db->select('*')->where('id', $id)->get('miscellaneous_expense')->row_array();
    }

    public function get_mis_expense($id) {  

        return $this->db->select('*')->where('id', $id)->get('miscellaneous_expense')->row_array();
    }
    
    //  ********************************* add expense list of accounting part ********************************  

    public function all_expense_list_mod_query($where = false)
    {
        $field = array(
            'id','status'
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

        $this->db->select('ex.*,ex_c.exp_name as exp_cate_name')->from('expense as ex')->join('expense_category as ex_c','ex_c.id=ex.exp_name','left');
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function all_expense_list_mod($where = false)
    {
        $this->all_expense_list_mod_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function count_all_expense_list($where = false)
    {
        $this->all_expense_list_mod_query($where);
        return $this->db->get()->num_rows();
    }

    public function filter_all_expense_list($where = false)
    {
        $this->all_expense_list_mod_query($where);
        return $this->db->get()->num_rows();
    }
    
       

    public function view_all_expense_mod($id) {
  
        return $this->db->select('ex.*,ex_c.exp_name as exp_name,ex.exp_name as expNameId')->from('expense as ex')->where('ex.id', $id)->join('expense_category as ex_c','ex_c.id=ex.exp_name','left')->get()->row_array();
        
    }

}

    

?>