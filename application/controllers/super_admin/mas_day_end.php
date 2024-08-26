<?php defined('BASEPATH') OR exit('Can we play bubu together ?');
        # working date set configuration
        $config['work_end'] = "2024-06-15";
?>
$autoload['config'] = array('system_end');

<!-- <?php echo config_item('company_name') ?> -->

  function index()
  {
    $date = $this->input->post();
    if ($date){$da = $date['date'];$date = date('Y-m-d', strtotime('+1 day', strtotime($da)));
    }else{$date = date('Y-m-d');}

    $data['radhe'] = $date;

    // $post = $data['radhe'];

    $post = date('Y-m-d', strtotime('+1 day', strtotime($da)));
    if($post)
    {
    $targetFile=APPPATH . 'config/system_end.php';
    $this->validateKey('3','    $config[\'work_end\'] = "' . $post. '";',$targetFile);
    sleep(2);
    $data=array('adClass'=>'tst_success','msg'=>array('Thank You! You have successfully change details'),'icon'=>'<i class="ti-check-box"></i>');
    }

   
  }

  private function validateKey($targetLine,$dtArray,$targetFile)
	{
		$handle = fopen($targetFile, "r");$contents = fread($handle, filesize($targetFile));fclose($handle);$arrCont = explode("\n", $contents);$arrCont[$targetLine] = $dtArray;$handle = fopen($targetFile, "w+");fwrite($handle, implode("\n", $arrCont));fclose($handle);
	}