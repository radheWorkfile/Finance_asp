<?php
class Common_model extends CI_Model
{
    public function __construct()
    {

        parent::__construct();

    }

    function save_data($table, $val)
    {

        return $this->db->insert($table, $val);
        
    }

    function all_data($table,$sel)
    {
        return $this-> db->select($sel)->order_by('id', 'DESC')->get($table)->result_array();
    }

    function all_data_con($table,$val,$sel)
    {
        return $this->db->select($sel)->where($val)->get($table)->result_array();
    }

    function all_data_con_or($table,$val,$or,$sel)
    {
        return $this->db->select($sel)->where($val)->or_where($or)->get($table)->result_array();
    }

    function get_data($table,$data,$sel)
    {
        return $this->db->select($sel)->where($data)->get($table)->row_array();
    }

    function get_last($table, $sel)
    {
        return $this->db->select($sel)->order_by('id', 'DESC')->get($table)->row_array();
    }

    function update_data($table,$con,$data)
    {
        $this->db->where($con);
        return $this->db->update($table, $data);
    }

    function del_data($val)
    {

        if ($val) {
            $this->db->where('id', $val['id']);
            $query = $this->db->delete($val['table']);
            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    function chageStatus($value)
    {

        $this->db->where('id', $value['id'])->update($value['table'], array('status' => $value['status']));

    }



    public function count_all($table, $where = "1=1")
    {

        $this->db->from($table);
        $this->db->where($where);

        return $this->db->count_all_results();

    }

    public function sum_all($sum, $table, $where = "1=1")
    {

        $this->db->select_sum($sum);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row_array();

    }
    
    function getIndianCurrency(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
        );
        $digits = array('', 'Hundred', 'Thousand', 'lakh', 'Crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }
	
	
	
	
	
	
	
}
