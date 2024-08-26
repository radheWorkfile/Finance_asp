<?php
class Reports_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getClientWise($id)  
    {

        $this->db->select('m.id,m.member_id,CONCAT(m.first_name," ", m.mid_name," ", m.last_name) AS full_name,nominee_name,msc.center_name,msc.center_id,loan_start_date as lnDisDate,agl.amount as loanAmt,purpose')->from('member as m')->join('master_center as msc', 'msc.id=m.center_name', 'left')->join('add_group_loan as agl', 'agl.member_id=m.id', 'left')->where('m.member_id', $id);
        $result = $this->db->get();
        return $result->row();
    }

    public function clientEmi($id)
    {

        return $this->db->select('id,payment_date,monthly_emi,principal_amt, principal_interest_amt, payment_status')->from('group_loan_payment_details')->where('member_id', $id)->get()->result();
    }

    public function getRecvdAmtByClient($memID, $emiID)
    {

        return $this->db->select('emi_date,sum(paid_amount) as recvAmt')->from('group_member_payment_details')->where('emi_id', $emiID)->where('member_id', $memID)->group_by('emi_id')->get()->row();
    }

    public function centerWiseByLoanReport($centID, $grpID,$strtDt)  //  $strtDt,$endDt
    {
       
        // print_r($centID." ".$grpID." ".$strtDt." ".$endDt);die;

       $this->db->select('agl.id,agl.group_id,agl.week,msc.center_id,glpd.payment_date,msc.center_name,grp_id,mg.name as grpName,m.member_id,CONCAT(m.first_name," ", m.mid_name," ", m.last_name) AS full_name,m.nominee_name,agl.amount,tenure,roi,agl.loan_start_date as disDate')->from('add_group_loan as agl');
       $this->db->join('member as m', 'm.id=agl.member_id', 'left');
       $this->db->join('master_center as msc', 'msc.id=agl.center_id', 'left');
       $this->db->join('master_group as mg', 'mg.grp_id=agl.group_id', 'left');
       $this->db->join('group_loan_payment_details as glpd', 'glpd.group_loan_id=agl.id', 'left');
       $this->db->where('agl.center_id', $centID);
       $this->db->where('glpd.payment_date',$strtDt);
       $this->db->where('agl.group_id', $grpID);
       return $this->db->get()->result();
    //    $this->db->join('group_loan_payment_details as glpd','glpd.group_loan_id=agl.id');

    }

    public function centerStaff($id)
    {
        return $this->db->select('msc.id,msc.center_id,msc.center_name,s.staff_id,s.full_name,mfs.schedule_date,mfs.schedule_time')->from('master_center as msc')->join('staff as s', 's.id=msc.staff_id', 'left')->join('master_field_schedule as mfs','mfs.center_id=msc.id')->where('msc.id', $id)->get()->row();
    }

   
    public function test_2($strDate)
    {
        return $this->db->select('mc.id,glpd.center_id,glpd.payment_date,mc.center_name')->from('group_loan_payment_details as glpd')->join('master_center as mc','mc.id=glpd.center_id','left')->where(array('glpd.payment_date'=>$strDate))->group_by('glpd.center_id')->get()->result_array();
    }

    public function centerWiseGroup($id)
    {
        return $this->db->select('agl.id,group_id,mg.name as groupName')->from('add_group_loan as agl')->join('master_group as mg', 'mg.grp_id=agl.group_id', 'left')->where('agl.center_id', $id)->group_by('agl.group_id')->get()->result();
    }


   

    /*****************************************************************************************/
    public function branchLoanDisburshment_query($where = false, $brID)
    {

        $field = array('agl.id', 'cCode', 'center_name', 'agl.created_at');
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

        $this->db->select('agl.id,sum(agl.amount) as disBrAmt,sum(processing_fee) as prFee,agl.created_at,agl.center_id as cnID,msc.center_id as cCode,msc.center_name,SUM(amount+amount*roi/100) as loan_amt')->from('add_group_loan as agl')->join('master_center as msc', 'msc.id=agl.center_id', 'left')->where('agl.branch_id', $brID)->group_by('agl.center_id');

        if (!empty($where['strtDt']) && !empty($where['endDt'])) {
			$this->db->where('agl.loan_start_date >=', $where['strtDt']);
			$this->db->where('agl.loan_start_date <=', $where['endDt']);
		} elseif (!empty($where['strtDt'])) {
			$this->db->where('agl.loan_start_date >=', $where['strtDt']);
		} elseif (!empty($where['endDt'])) {
			$this->db->where('agl.loan_start_date <=', $where['endDt']);
		}

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function branchLoanDisburshment_data($where = false, $brID)
    {

        $this->branchLoanDisburshment_query($where, $brID);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function branchLoanDisburshment_count($brID)
    {
        $this->branchLoanDisburshment_query($where = false, $brID);
        return $this->db->get()->num_rows();
    }

    public function branchLoanDisburshment_filter_count($where = false, $brID)
    {
        $this->branchLoanDisburshment_query($where, $brID);
        return $this->db->get()->num_rows();
    }

    public function getLoanDetailsToAll($result)  
    {

        return $this->db->select('sum(gmpd.adv_amount) as adv_amo,glpd.is_adv,sum(gmpd.paid_amount) as monEmi, sum(gmpd.od_amount) as od_amt,sum(gmpd.interest_amount) as intAmo, glpd.created_at')->join('group_member_payment_details as gmpd', 'gmpd.emi_id=glpd.id', 'left')->where(array('glpd.center_id'=>$result))->get('group_loan_payment_details as glpd')->row_array();
        
    }

    public function printBrReport($brID,$where)
    {
        
        $this->db->select('agl.id,agl.member_id,sum(agl.processing_fee) prFeeAmt,agl.created_at,sum(agl.amount) disBrAmt,agl.center_id as cnID,msc.center_id as cCode,msc.center_name,SUM(amount+amount*roi/100) as loan_amt')->from('add_group_loan as agl')->join('master_center as msc', 'msc.id=agl.center_id', 'left')->where(array('agl.branch_id'=>$brID))->group_by('agl.center_id');

        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('agl.created_at  >=', $where['strtDt'])->where('agl.created_at <=', $where['endDt']);
        } 

        $result = $this->db->get()->result();

        $this->db->select('glpd.id,glpd.created_at,glpd.center_id,sum(monthly_emi) as montlyEmi,sum(glpd.interest_paid) as intrstPaid,glpd.payment_date,sum(paid_amount) as adv_amo,is_adv')->from('group_loan_payment_details as glpd')->group_by('center_id');
        foreach($result as $rs){

            $this->db->or_where('glpd.center_id',$rs->cnID);
        }
       
        // $this->db->where('glpd.payment_status', '2');
        $result_1 = $this->db->get()->result_array();

        foreach($result as $i=>$r)
        {
            foreach($result_1 as $r1)
              {
                if($r->cnID==$r1['center_id'])
                {
                 $result[$i]->montlyEmi=$r1['montlyEmi'];
                 $result[$i]->intrstPaid=$r1['intrstPaid'];
                //  $result[$i]->intrstPaid='israel';
                }

              }
        }

        $final_result['radhe'] = $result;
        return $final_result;
     
    
    }

    public function printCenterWiseDisbursment($brID, $where = false)
    {

        $this->db->select('agl.id, agl.center_id as cnID, msc.center_id as cCode,agl.loan_start_date as disDate,m.member_id as clientID,agl.loan_no as loanID, msc.center_name,CONCAT(m.first_name," ", m.mid_name," ", m.last_name) AS clientName,aadhar_card_no as clientKyc,m.nominee_name as guardian_name,nominee_aadhaar as guardianKyc,"By Cash" as "pay_mode",m.ifsc_code,m.account_no,agl.amount as disAmt,agl.processing_fee')->from('add_group_loan as agl')->join('master_center as msc', 'msc.id=agl.center_id', 'left')->join('member as m', 'm.id=agl.member_id', 'left')->where(array('agl.branch_id' => $brID, 'agl.disbursment_status' => 2));
        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('loan_start_date  >=', $where['strtDt']);
            $this->db->where('loan_start_date <=', $where['endDt']);
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function printFieldSchedule($brID, $where = false)
    {

        $this->db->select('msf.*,s.full_name,s.staff_id as stfCode,msc.center_name,msc.center_id as centerCode')->from('master_field_schedule as msf')->where('msf.branch_id', $this->session->userdata('branch_id'))->join('staff as s', 's.id=msf.staff_id', 'left')->join('master_center as msc', 'msc.id=msf.center_id', 'left');
        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('msf.schedule_date >=', $where['strtDt'])->where('msf.schedule_date <=', $where['endDt']);
        }
        $result = $this->db->get();
        return $result->result();
    }

    public function centerLoanDisburshment($where = false, $brID)
    {
        $field = array('agl.id', 'cCode', 'center_name');
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

        $this->db->select('agl.id, agl.center_id as cnID, msc.center_id as cCode,agl.loan_start_date as disDate,m.member_id as clientID,agl.loan_no as loanID, msc.center_name,CONCAT(m.first_name," ", m.mid_name," ", m.last_name) AS clientName,aadhar_card_no as clientKyc,m.nominee_name,nominee_aadhaar as guardianKyc,"By Cash" as "pay_mode",m.ifsc_code,m.account_no,agl.amount as disAmt,agl.processing_fee')->from('add_group_loan as agl')->join('master_center as msc', 'msc.id=agl.center_id', 'left')->join('member as m', 'm.id=agl.member_id', 'left')->where(array('agl.branch_id' => $brID, 'agl.disbursment_status' => 2));
        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('loan_start_date  >=', $where['strtDt']);
            $this->db->where('loan_start_date <=', $where['endDt']);
        }

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'desc');
        }
    }

    public function centerLoanDisburshment_list($where = false, $brID)
    {
        $this->centerLoanDisburshment($where, $brID);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function centerLoanDisburshment_count($brID)
    {
        $this->centerLoanDisburshment($where = false, $brID);
        return $this->db->get()->num_rows();
    }

    public function centerLoanDisburshment_filter_count($where = false, $brID)
    {
        $this->centerLoanDisburshment($where, $brID);
        return $this->db->get()->num_rows();
    }


    /** =================================== Profile Report ========================== */

    public function all_profile_data_query($where = false)
    {
        $field = array(
            'm.id', 'm.member_id', 'm.first_name', 'm.mid_name', 'm.last_name', 'm.nominee_name', 'm.religion', 'm.doj', 'm.member_id', 'm.status', 'm.disbursment_status', 'm.voter_card_no, m.nominee_voter', 'm.voter_card_no, m.nominee_voter', 'mg.grp_id', 'mc.center_name',
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

        $this->db->select('m.id, m.member_id, m.first_name, m.mid_name, m.last_name, m.nominee_name, m.religion, m.doj, m.member_id, m.status, m.disbursment_status, mg.grp_id, m.voter_card_no, m.nominee_voter, rc.category_name as relation_name, mc.center_name')->from('member as m');
        $s_name = $where['center_name'];
        if (!empty($where['center_name'])) {
            $this->db->where("FIND_IN_SET('$s_name',m.center_name)!=", 0);
        }

        $this->db->where('m.branch_id', $this->session->userdata('branch_id'));
        $this->db->join('master_group as mg', 'mg.grp_id = m.group_name', 'left');
        $this->db->join('master_center as mc', 'mc.id = m.center_name', 'left');
        $this->db->join('relationship_category as rc', 'rc.id = m.nominee_relation', 'left');
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('m.id', 'desc');
        }
    }

    public function all_profile_data($where = false)
    {
        $this->all_profile_data_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function total_count($where = false)
    {
        $this->all_profile_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function total_filter_count($where = false)
    {
        $this->all_profile_data_query($where);
        return $this->db->get()->num_rows();
    }

    /** =================================== Cash Submission Report ========================== */

    public function all_cash_submission_data_query($where = false)
    {

        $field = array(
            'glpd.id', 'mc.center_id', 'mc.center_name',
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

        $this->db->select('glpd.id, sum(paid_amount) as emi, count(member_id) as mem_id, mc.center_id, mc.center_name, ')->from('group_loan_payment_details as glpd');
        $s_name = $where['center_name'];
        if (!empty($where['center_name'])) {
            $this->db->where("FIND_IN_SET('$s_name',glpd.center_id)!=", 0);
        }

        $this->db->where(array('glpd.branch_id' => $this->session->userdata('branch_id'), 'glpd.week' => date('W'), 'glpd.payment_status' => 2));
        $this->db->join('master_center as mc', 'mc.id = glpd.center_id', 'left');
        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('glpd.id', 'desc');
        }
    }

    public function all_cash_submission_data($where = false)
    {
        $this->all_cash_submission_data_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function cash_total_count($where = false)
    {
        $this->all_cash_submission_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function cash_total_filter_count($where = false)
    {
        $this->all_cash_submission_data_query($where);
        return $this->db->get()->num_rows();
    }

    /** ============================== OD Payment Report================================ **/


    public function all_od_payment_report_query($where = false)
    {

        $field = array(
            'gmpd.id',
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


        // $this->db->select('gmpd.id,glpd.loan_no,gmpd.pay_date,gmpd.is_od,gmpd.paid_amount,mc.center_id,mc.center_name,m.member_id,m.first_name,gmpd.week,gmpd.emi_date,');

        $this->db->select('gmpd.id,gmpd.pay_date,gmpd.paid_amount,gmpd.week,gmpd.emi_date,mc.center_id,mc.center_name,m.member_id,m.first_name,gmpd.rest_amount,agl.loan_no');
        $this->db->from('group_member_payment_details as gmpd');
        $this->db->where(array('is_od' => 2));
        $this->db->limit(10);
        $this->db->join('master_center as mc', 'gmpd.branch_id = mc.branch_id', 'left');
        $this->db->join('member as m', 'gmpd.branch_id = m.branch_id', 'left');
        $this->db->join('add_group_loan as agl', 'agl.id = gmpd.group_loan_id', 'left');

        // $this->db->join('group_loan_payment_details as glpd','gmpd.branch_id = glpd.branch_id','left');



    }

    public function all_od_payment_report($where = false)
    {

        $this->all_od_payment_report_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function od_total_count($where = false)
    {

        $this->all_od_payment_report_query($where);
        return $this->db->get()->num_rows();
    }

    public function od_total_filter_count($where = false)
    {

        $this->all_od_payment_report_query($where);
        return $this->db->get()->num_rows();
    }
    // ------------------------------------------- Post Wise Report Section start -------------------------- 


    public function all_posting_rep_data_query($where = false)
    {

        $field = array('gmpd.id', 'gmpd.pay_date', 'mc.center_id', 'member_id');
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

        $this->db->select('gmpd.id,gmpd.pay_date,gmpd.is_od,gmpd.paid_amount,mc.center_id,mc.center_name,m.member_id,m.first_name');
        $this->db->where(array('is_od' => 1, 'is_od' => 2));
        $this->db->from('group_member_payment_details as gmpd');
        $this->db->limit(50);
        $this->db->join('master_center as mc', 'gmpd.branch_id = mc.branch_id', 'left');
        $this->db->join('member as m', 'gmpd.branch_id = m.branch_id', 'left');

        // -----------------------  search part start ------------------------ 

        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('gmpd.pay_date >=', $where['strtDt'])->where('gmpd.pay_date <=', $where['endDt']);
        }

        // -----------------------  search part end ------------------------ 

        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'asc');
        }
    }

    public function all_posting_rep_data($where = false)
    {

        $this->all_posting_rep_data_query($where);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function post_wise_total_count($where = false)
    {

        $this->all_posting_rep_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function post_wise_total_filter_count($where = false)
    {

        $this->all_posting_rep_data_query($where);
        return $this->db->get()->num_rows();
    }

    /** =================================== Voucher Report ====================================== */

    public function all_voucher_loan_data()
    {

        $this->db->select('count(gmpd.id) as total_client, sum(glpd.principal_paid) as loan_amount, sum(glpd.interest_paid) as loan_interest_amount');
        $this->db->where(array('gmpd.branch_id' => $this->session->userdata('branch_id'), 'gmpd.status' => 2, 'gmpd.week' => date('W'), 'gmpd.is_od' => 1));
        $this->db->join('group_loan_payment_details as glpd', 'glpd.id = gmpd.emi_id', 'left');
        $voucher = $this->db->get('group_member_payment_details as gmpd');
        return $voucher->row_array();
    }

    public function all_voucher_od_data()
    {

        $this->db->select('count(gmpd.id) as total_od_client, sum(glpd.principal_paid) as od_amount, sum(glpd.interest_paid) as od_interest_amount');
        $this->db->where(array('gmpd.branch_id' => $this->session->userdata('branch_id'), 'gmpd.status' => 2, 'gmpd.week' => date('W'), 'gmpd.is_od' => 2));
        $this->db->join('group_loan_payment_details as glpd', 'glpd.id = gmpd.emi_id', 'left');
        $voucher = $this->db->get('group_member_payment_details as gmpd');
        return $voucher->row_array();
    }

    //  ------------------------------------------- Advance Report Section Start -------------------------- 

    public function all_advance_report_data_query($where = false)
    {
        $field = array('gmpd.id');
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

        // $this->db->select('mc.id,mc.center_id,mc.center_name,mc.staff_id,st.full_name,st.id as st_id')->from('master_center as mc')->join('staff as st', 'mc.branch_id = st.branch_id');

        $data = $this->db->select('mc.id,mc.center_id,mc.center_name,mc.staff_id,st.full_name,st.id as st_id,gmpd.week')->from('master_center as mc')->where('gmpd.week', date('w'))->join('staff as st', 'mc.branch_id = st.branch_id')->join('member as  mem', 'st.id=mem.staff_id')->join('group_member_payment_details as gmpd', 'mem.id=gmpd.member_id');


        // -----------------------  search part start ------------------------ 

        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('gmpd.pay_date >=', $where['strtDt'])->where('gmpd.pay_date <=', $where['endDt']);
        }

        //  -----------------------  search part end ------------------------ 


        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'asc');
        }
    }

    public function all_advance_report_manage($where = false)
    {

        $this->all_advance_report_data_query($where);

        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function advance_report_total_count($where = false)
    {

        $this->all_advance_report_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function advance_report_total_filter_count($where = false)
    {

        $this->all_advance_report_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function print_advance_report_model()
    {
        // $record = $this->db->select('mc.id,mc.center_id,mc.center_name,mc.staff_id,st.full_name,st.id as st_id')->join('staff as st', 'mc.branch_id = st.branch_id')->get('master_center as mc')->result();

        $record = $this->db->select('mc.id,mc.center_id,mc.center_name,mc.staff_id,st.full_name,st.id as st_id')->where('gmpd.week', date('w'))->join('staff as st', 'mc.branch_id = st.branch_id')->join('member as  mem', 'st.id=mem.staff_id')->join('group_member_payment_details as gmpd', 'mem.id=gmpd.member_id')->get('master_center as mc')->result();


        //    return $record;die;
        // $getAllData = array();
        $b = array();

        foreach ($record as $i => $row) {
            $count = $this->db->select('*')->where('staff_id', $row->st_id)->get('member')->num_rows();

            if ($count > 0) {

                $client_id = $this->db->select('id')->where('staff_id', $row->st_id)->get('member')->result();

                $this->db->select('sum(paid_amount) as total');
                $this->db->group_start();
                foreach ($client_id as $c_id) {
                    $this->db->or_where('member_id', $c_id->id);
                }
                $this->db->group_end();
                $recoAmount = $this->db->get('group_member_payment_details')->row();

                $b[$i]['center_id'] = $row->center_id;
                $b[$i]['center_name'] = $row->center_name;
                $b[$i]['full_name'] = $row->full_name;
                $b[$i]['member_count'] = $count;
                $b[$i]['paid_amount'] = ($recoAmount->total) ? ($recoAmount->total) : 0;
            }
        }

        return $b;
    }

    // ------------------------------------------- Advance Report Section Model -------------------------- 

    // ------------------------------------------- Due Collection Section Start --------------------------

    public function all_due_collection_data_query($where = false)
    {
        $field = array('gmpd.id');
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


        // $data = $this->db->select('mc.id,mc.center_id,mc.center_name,mc.staff_id,st.full_name,st.id as st_id')->from('master_center as mc')->join('staff as st', 'mc.branch_id = st.branch_id');

        $data = $this->db->select('mc.id,mc.center_id,mc.center_name,mc.staff_id,st.full_name,st.id as st_id,gmpd.week')->from('master_center as mc')->where('gmpd.week', date('w'))->join('staff as st', 'mc.branch_id = st.branch_id')->join('member as  mem', 'st.id=mem.staff_id')->join('group_member_payment_details as gmpd', 'mem.id=gmpd.member_id');


        // -----------------------  search part start ------------------------ 

        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('gmpd.pay_date >=', $where['strtDt'])->where('gmpd.pay_date <=', $where['endDt']);
        }

        //  -----------------------  search part end ------------------------ 


        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'asc');
        }
    }

    public function all_due_collection_report($where = false)
    {
        $this->all_due_collection_data_query($where);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function due_collection_total_count($where = false)
    {
        $this->all_due_collection_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function due_collection_total_filter_count($where = false)
    {
        $this->all_due_collection_data_query($where);
        return $this->db->get()->num_rows();
    }

    // ---------------------- Print Section Start of Due Collection Report -------------------------  


    public function due_collection_report()
    {
        $record = $this->db->select('mc.id,mc.center_id,mc.center_name,mc.staff_id,st.full_name,st.id as st_id')->where('gmpd.week', date('w'))->join('staff as st', 'mc.branch_id = st.branch_id')->join('member as  mem', 'st.id=mem.staff_id')->join('group_member_payment_details as gmpd', 'mem.id=gmpd.member_id')->get('master_center as mc')->result();

        // $data = $this->db->select('mc.id,mc.center_id,mc.center_name,mc.staff_id,st.full_name,st.id as st_id,gmpd.week')->from('master_center as mc')->where('gmpd.week',date('w'))->join('staff as st', 'mc.branch_id = st.branch_id')->join('member as  mem','st.id=mem.staff_id')->join('group_member_payment_details as gmpd','mem.id=gmpd.member_id');

        // return $record;die;
        // $getAllData = array();
        $b = array();

        foreach ($record as $i => $row) {
            $count = $this->db->select('*')->where('staff_id', $row->st_id)->get('member')->num_rows();

            if ($count > 0) {

                $client_id = $this->db->select('id')->where('staff_id', $row->st_id)->get('member')->result();

                $this->db->select('sum(paid_amount) as total');
                $this->db->group_start();
                foreach ($client_id as $c_id) {
                    $this->db->or_where('member_id', $c_id->id);
                }
                $this->db->group_end();
                $recoAmount = $this->db->get('group_member_payment_details')->row();

                $this->db->select('sum(paid_amount) as dues_total');
                $this->db->group_start();
                foreach ($client_id as $c_id) {
                    $this->db->or_where(array('member_id' => $c_id->id, 'is_od' => 2, 'status' => 2));
                }
                $this->db->group_end();
                $duesAmount = $this->db->get('group_member_payment_details')->row();
                // echo $this->db->last_query();die;

                $this->db->select('sum(paid_amount) as rec_Posting_amo');
                $this->db->group_start();
                foreach ($client_id as $c_id) {
                    $this->db->or_where(array('member_id' => $c_id->id, 'is_od' => 1, 'status' => 2));
                }
                $this->db->group_end();
                $RecPost = $this->db->get('group_member_payment_details')->row();

                $this->db->select('sum(paid_amount) as due_posting');
                $this->db->group_start();
                foreach ($client_id as $c_id) {
                    $this->db->or_where(array('member_id' => $c_id->id, 'is_od' => 2, 'status' => 1));
                }
                $this->db->group_end();
                $duePost = $this->db->get('group_member_payment_details')->row();


                $b[$i]['center_id'] = $row->center_id;
                $b[$i]['center_name'] = $row->center_name;
                $b[$i]['full_name'] = $row->full_name;
                $b[$i]['member_count'] = $count;
                $b[$i]['paid_amount'] = ($recoAmount->total) ? ($recoAmount->total) : 0;
                $b[$i]['dues_total'] =  ($duesAmount->dues_total) ? ($duesAmount->dues_total) : 0;
                $b[$i]['sum_reco'] = ($recoAmount->total +  $duesAmount->dues_total) ? ($recoAmount->total +  $duesAmount->dues_total) : 0;
                $b[$i]['rec_Posting_amo'] =  ($RecPost->rec_Posting_amo) ? ($RecPost->rec_Posting_amo) : 0;
                $b[$i]['due_posting'] = ($duePost->due_posting) ? ($duePost->due_posting) : 0;
                $b[$i]['sum_rec_posting'] = (($RecPost->rec_Posting_amo) + ($duePost->due_posting)) ? (($RecPost->rec_Posting_amo) + ($duePost->due_posting)) : 0;
                $b[$i]['rec_Dues'] = (($recoAmount->total) - ($RecPost->rec_Posting_amo)) ? (($recoAmount->total) - ($RecPost->rec_Posting_amo)) : 0;
            }
        }
        //    echo "<pre>"; print_r($b);die;
        return $b;
    }
    // ---------------------- Print Section End of Due Collection Report -------------------------  

    // --------------------------- Due Collection Section End ----------------------------

    // -------------------------------------- Fore close Report sec Start ----------------------------

    public function all_fore_close_rep_data_query($where = false)
    {
        $field = array('gmpd.id');
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


        $this->db->select('mc.center_id,mc.center_name,cld.id,mem.member_id,mem.first_name,mem.mid_name,mem.last_name,mem.dob,mem.guardian_name,cld.loan_no,cld.disbursed_loan,cld.disbursed_data,cld.loan_close_date as pre_close_date,cld.recovered_amount,cld.lst_rec_amount,cld.remark')->from('closing_loan_data as cld')->join('member as mem', 'cld.member_id=mem.member_id')->join('master_center as mc', 'cld.center_id=mc.id');

        // -----------------------  search part start ------------------------ 

        if (!(empty($where['strtDt']) && empty($where['endDt']))) {
            $this->db->where('gmpd.pay_date >=', $where['strtDt'])->where('gmpd.pay_date <=', $where['endDt']);
        }

        //  -----------------------  search part end ------------------------ 


        if (isset($where['order']) && !empty($where['order'])) {
            $this->db->order_by($field[$where['order']['0']['column']], $where['order']['0']['dir']);
        } else {
            $this->db->order_by('id', 'asc');
        }
    }

    public function all_fore_close_rep_mod($where = false)
    {
        $this->all_fore_close_rep_data_query($where);
        if ($where['length'] != -1) {
            $this->db->limit($where['length'], $where['start']);
        }
        return $this->db->get()->result();
    }

    public function fore_close_rep_total_count($where = false)
    {
        $this->all_fore_close_rep_data_query($where);
        return $this->db->get()->num_rows();
    }

    public function fore_close_rep_total_filter_count($where = false)
    {
        $this->all_fore_close_rep_data_query($where);
        return $this->db->get()->num_rows();
    }
    // -------------------------------------- Fore close Report sec End ----------------------------\

    public function showData_mod($data)
    {
        return $this->db->select('center_name')->where('id', $data['id'])->get('master_center')->row_array();
    }
    public function print_branchName($data)
    {
        return $this->db->select('center_name')->where('id', $data)->get('master_center')->row_array();
    }
}
