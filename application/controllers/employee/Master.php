<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{
	public function __construct()
	{
		date_default_timezone_set('Asia/Kolkata');
		parent::__construct();
		$this->load->model('employee/Common_model', 'common');
		$this->load->model('employee/master_model', 'master');
		($this->session->userdata('user_cate') != 3) ? redirect(base_url(), 'refresh') : '';
		error_reporting(0);
		$this->logId = $this->session->userdata('user_id');
		$this->user_cate = $this->session->userdata('user_cate');
	}

	public function village($dt = NULL)
	{
		if ($dt == 'viewList') {
			$post_data = $this->input->post();
			$record = $this->master->village_data($post_data);
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			foreach ($record as $row) {
				if ($row->status == '1') {
					$stsOn = 'Active';
					$addCls = 'bg-olive';
					$btnIcon = 'bx-lock-open-alt';
				} else {
					$stsOn = 'Deactive';
					$addCls = 'bg-orange';
					$btnIcon = 'bx-lock-alt ';
				}
				$statusBtn = '<div class="actv-btn ' . $addCls . ' getStatusAction" onclick="mStatus(' . $row->id . ')" id="ms' . $row->id . '"> <i class="bx  ' . $btnIcon . '" ></i> ' . $stsOn . '</div>';
				$getUid = urlencode(base64_encode($row->id));
				$getUsername = urlencode(base64_encode($row->name));
				$viewClick = "'" . $row->id . "','employee/master/village/viewDetails','view'";
				$editClick = "'" . $row->id . "','employee/master/village/viewDetails','edit'";
				$actionBtn = '<a href="javascript:void(0)" onclick="manageVillage(' . $viewClick . ')" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
					<a href="javascript:void(0)" onclick="manageVillage(' . $editClick . ')" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="Edit"><i class="mdi mdi-square-edit-outline me-1"></i></a>';

				$return['data'][] = array('<strong>' . $i++ . '.</strong>', "<strong>" . $row->vlg_code . "</strong>", $row->district_name, $row->name, $row->distance . ' <strong>(in km.)</strong>', $statusBtn, $actionBtn);
			}
			$return['recordsTotal'] = $this->master->village_count();
			$return['recordsFiltered'] = $this->master->village_filter_count($post_data);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
		} else if ($dt == 'cStatus') {
			$getParamtr = $this->input->post('getParamtr');
			$conArr = array('id' => $getParamtr);
			$record = $this->common->get_data('master_village', $conArr, 'status');
			if ($record['status'] == '1') {
				$newSts = '0';
			} else {
				$newSts = '1';
			}
			$updateArr = array('status' => $newSts);
			sleep(1);
			$updateR = $this->common->update_data('master_village', $conArr, $updateArr);
			if ($updateR) {
				echo $newSts;
			} else {
				echo '3';
			}
		} else if ($dt == 'viewDetails') {
			$post = $this->input->post();
			$conArr = array('id' => $post['id']);
			$getVillage = $this->common->get_data('master_village', $conArr, '*');
			$data = array('miData' => $getVillage);
			echo json_encode($data);
		} else if ($dt == 'editDetails') {
			$post = $this->input->post();
			$this->form_validation->set_rules('district', 'District Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('vill_cate', 'Village category/type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('village_name', 'Village Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('distance', 'Distance', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('openingDate', 'Opening date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('staffID', 'Employee Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('noCentr', 'No. of Center', 'trim|required|numeric|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$conArr = array('id' => $post['target']);
				$updtArr = array(
					'district_id' => $post['district'],
					'name' => $post['village_name'],
					'village_category' => $post['vill_cate'],
					'distance' => $post['distance'],
					'open_date' => $post['openingDate'],
					'no_center' => $post['noCentr'],
					'modified_id' => $this->logId,
					'staff_id' => $post['staffID'],
					'modified_date' => date('Y-m-d')
				);
				$updateR = $this->common->update_data('master_village', $conArr, $updtArr);
				if ($updateR) {
					$data = array('icon' => 'success', 'text' => 'Thank You! you have successfully update');
				} else {
					$data = array('icon' => 'error', 'text' => array('Oops it seems somthing went wrong please reload site.'));
				}
			} else {
				$msg = array(
					'district' => form_error('district'),
					'vill_cate' => form_error('vill_cate'),
					'village_name' => form_error('village_name'),
					'distance' => form_error('distance'),
					'openingDate' => form_error('openingDate'),
					'staffID' => form_error('staffID'),
					'noCentr' => form_error('noCentr')
				);
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		} else if ($dt == 'addNew') {
			sleep(1);
			$this->form_validation->set_rules('district', 'District Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('vill_cate', 'Village category/type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('village_name', 'Village Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('distance', 'Distance', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('openingDate', 'Opening date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('staffID', 'Employee Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('noCentr', 'No. of Center', 'trim|required|numeric|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post();
				$createArr = array(
					'branch_id' => $this->session->userdata('branch_id'),
					'district_id' => $post['district'],
					'vlg_code' => $post['vCode'],
					'name' => $post['village_name'],
					'village_category' => $post['vill_cate'],
					'distance' => $post['distance'],
					'open_date' => $post['openingDate'],
					'no_center' => $post['noCentr'],
					'created_id' => $this->logId,
					'staff_id' => $post['staffID'],
					'create_date' => config_item('work_end')
				);
				$success = $this->common->save_data('master_village', $createArr);
				if ($success) {
					$data = array('icon' => 'success', 'text' => 'Thank You! you have successfully create');
				} else {
					$data = array('icon' => 'error', 'text' => array('Oops it seems somthing went wrong please reload site.'));
				}
			} else {
				$msg = array(
					'district' => form_error('district'),
					'vill_cate' => form_error('vill_cate'),
					'village_name' => form_error('village_name'),
					'distance' => form_error('distance'),
					'openingDate' => form_error('openingDate'),
					'staffID' => form_error('staffID'),
					'noCentr' => form_error('noCentr')
				);
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		} else {
			$data['vCodeAuto'] = 'V' . rand(10, 100000);
			$data['title'] = 'Village Manage';
			$data['bredcrums'] = 'Village Manage';
			$data['layout'] = 'master/manage_village.php';
			$data['getDistrict'] = $this->common->all_data_con('district', array('status' => '1',), 'id,district_name');
			$data['getEmployee'] = $this->common->all_data_con('staff', array('status' => '1', 'branch_id' => $this->session->userdata('branch_id')), 'id,staff_id,full_name');
			$data['target'] = 'employee/master/village/viewList';
			$this->load->view('employee/base', $data);
		}
	}

	public function center($dt = NULL)
	{

		if ($dt == 'viewList') {
			$post_data = $this->input->post();
			$record = $this->master->center_data($post_data);
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			foreach ($record as $row) {
				if ($row->status == '1') {
					$stsOn = 'Active';
					$addCls = 'bg-olive';
					$btnIcon = 'bx-lock-open-alt';
				} else {
					$stsOn = 'Deactive';
					$addCls = 'bg-orange';
					$btnIcon = 'bx-lock-alt ';
				}
				$statusBtn = '<div class="actv-btn ' . $addCls . ' getStatusAction" onclick="mStatus(' . $row->id . ')" id="ms' . $row->id . '"> <i class="bx  ' . $btnIcon . '" ></i> ' . $stsOn . '</div>';
				$getUid = urlencode(base64_encode($row->id));
				$getUsername = urlencode(base64_encode($row->name));
				$viewClick = "'" . $row->id . "','employee/master/center/viewDetails','view'";
				$editClick = "'" . $row->id . "','employee/master/center/viewDetails','edit'";
				$actionBtn = '<a href="javascript:void(0)" onclick="manageCenter(' . $viewClick . ')" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
					<a href="javascript:void(0)" onclick="manageCenter(' . $editClick . ')" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="Edit"><i class="mdi mdi-square-edit-outline me-1"></i></a>';

				$return['data'][] = array(
					'<strong>' . $i++ . '.</strong>',
					'<strong>' . $row->center_id . '</strong>',
					$row->center_name,
					$row->village_name,
					$row->district_name,
					$statusBtn,
					$actionBtn
				);
			}
			$return['recordsTotal'] = $this->master->center_count();
			$return['recordsFiltered'] = $this->master->center_filter_count($post_data);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
		} else if ($dt == 'cStatus') {
			$getParamtr = $this->input->post('getParamtr');
			$conArr = array('id' => $getParamtr);
			$record = $this->common->get_data('master_center', $conArr, 'status');
			if ($record['status'] == '1') {
				$newSts = '0';
			} else {
				$newSts = '1';
			}
			$updateArr = array('status' => $newSts);
			sleep(1);
			$updateR = $this->common->update_data('master_center', $conArr, $updateArr);
			if ($updateR) {
				echo $newSts;
			} else {
				echo '3';
			}
		} else if ($dt == 'viewDetails') {
			$post = $this->input->post();
			$conArr = array('id' => $post['id']);
			$getVillage = $this->common->get_data('master_center', $conArr, '*');
			$data = array('miData' => $getVillage);
			echo json_encode($data);
		} else if ($dt == 'editDetails') {
			$post = $this->input->post();
			$this->form_validation->set_rules('villageID', 'Village Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('center_name', 'Center name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('openingDate', 'Opening date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('staffID', 'Employee Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('distance', 'Distance', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('noGroup', 'No. of Group', 'trim|required|numeric|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$conArr = array('id' => $post['target']);
				$updtArr = array(
					'vll_id' => $post['villageID'],
					'center_name' => $post['center_name'],
					'open_date' => $post['openingDate'],
					'staff_id' => $post['staffID'],
					'distance' => $post['distance'],
					'no_of_grp' => $post['noGroup'],
					'modified_id' => $this->logId,
					'modified_date' => date('Y-m-d')
				);
				$updateR = $this->common->update_data('master_center', $conArr, $updtArr);
				if ($updateR) {
					$data = array('icon' => 'success', 'text' => 'Thank You! you have successfully update');
				} else {
					$data = array('icon' => 'error', 'text' => array('Oops it seems somthing went wrong please reload site.'));
				}
			} else {
				$msg = array(
					'villageID' => form_error('villageID'),
					'center_name' => form_error('center_name'),
					'openingDate' => form_error('openingDate'),
					'staffID' => form_error('staffID'),
					'distance' => form_error('distance'),
					'noGroup' => form_error('noGroup')
				);
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		} else if ($dt == 'addNew') {
			sleep(1);
			$this->form_validation->set_rules('villageID', 'Village Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('center_name', 'Center name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('openingDate', 'Opening date', 'trim|required|xss_clean');
			$this->form_validation->set_rules('staffID', 'Employee Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('distance', 'Distance', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('noGroup', 'No. of Group', 'trim|required|numeric|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post();
				$getTotalCenter = $this->common->get_data('master_center', array('vll_id' => $post['villageID']), 'count(*) as noC');
				$getAllottedCenter = $this->common->get_data('master_village', array('id' => $post['villageID']), 'no_center');
				if ($getTotalCenter['noC'] < $getAllottedCenter['no_center']) {
					$createArr = array(
						'branch_id' => $this->session->userdata('branch_id'),
						'center_id' => $post['centerCode'],
						'vll_id' => $post['villageID'],
						'center_name' => $post['center_name'],
						'open_date' => $post['openingDate'],
						'staff_id' => $post['staffID'],
						'distance' => $post['distance'],
						'no_of_grp' => $post['noGroup'],
						'created_id' => $this->logId,
						'create_date' => config_item('work_end')
					);
					$success = $this->common->save_data('master_center', $createArr);
					if ($success) {
						$getRcNum = $this->master->getLastRecord('master_group', 'id');
						if ($getRcNum) {
							$newGrpNum = $getRcNum->id;
						} else {
							$newGrpNum = 0;
						}

						for ($x = 0; $x < $post['noGroup']; ++$x) {

							$grpNu = 11111 + $newGrpNum + $x;
							$newGrpArr = array('branch_id' => $this->session->userdata('branch_id'), 'grp_id' => 'G' . $grpNu, 'center_id' => $success, 'name' => 'Group' . ($newGrpNum + $x + 1), 'created_by' => $this->logId, 'create_date' => config_item('work_end'));
							print_r($newGrpArr);
							die;
							$this->common->save_data('master_group', $newGrpArr);
						}


						$data = array('icon' => 'success', 'text' => 'Thank You! you have successfully create');
					} else {
						$data = array('icon' => 'error', 'text' => array('Oops it seems somthing went wrong please reload site.'));
					}
				} else {
					$data = array('icon' => 'error', 'text' => array('You have reached  set limit of center.'));
				}
			} else {
				$msg = array(
					'villageID' => form_error('villageID'),
					'center_name' => form_error('center_name'),
					'openingDate' => form_error('openingDate'),
					'staffID' => form_error('staffID'),
					'distance' => form_error('distance'),
					'noGroup' => form_error('noGroup')
				);
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		} else {
			$data['vCodeAuto'] = 'C' . rand(10, 100000);
			$data['title'] = 'Center Manage';
			$data['bredcrums'] = 'Center Manage';
			$data['layout'] = 'master/manage_center.php';
			$data['getVillage'] = $this->common->all_data_con('master_village', array('status' => '1', 'branch_id' => $this->session->userdata('branch_id')), 'id,name,vlg_code');
			$data['getEmployee'] = $this->common->all_data_con('staff', array('status' => '1', 'branch_id' => $this->session->userdata('branch_id')), 'id,staff_id,full_name');
			$data['target'] = 'employee/master/center/viewList';
			$this->load->view('employee/base', $data);
		}
	}

	public function branch($dt = NULL)
	{
		if ($dt == 'viewList') {
			$post_data = $this->input->post();
			$record = $this->master->branch_data($post_data);
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			foreach ($record as $row) {
				if ($row->status == '1') {
					$stsOn = 'Active';
					$addCls = 'bg-olive';
					$btnIcon = 'bx-lock-open-alt';
				} else {
					$stsOn = 'Deactive';
					$addCls = 'bg-orange';
					$btnIcon = 'bx-lock-alt ';
				}
				$statusBtn = '<div class="actv-btn ' . $addCls . ' getStatusAction" onclick="mStatus(' . $row->id . ')" id="ms' . $row->id . '"> <i class="bx  ' . $btnIcon . '" ></i> ' . $stsOn . '</div>';
				$getUid = urlencode(base64_encode($row->id));
				$getUsername = urlencode(base64_encode($row->name));
				$viewClick = "'" . $row->id . "','employee/master/branch/viewDetails','view'";
				$editClick = "'" . $row->id . "','employee/master/branch/viewDetails','edit'";

				if ($this->user_cate == '1') {
					$actionBtn = '<a href="javascript:void(0)" onclick="manageBranch(' . $viewClick . ')" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
					<a href="javascript:void(0)" onclick="manageBranch(' . $editClick . ')" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="Edit"><i class="mdi mdi-square-edit-outline me-1"></i></a>';
				} else {
					$actionBtn = ' <a href="javascript:void(0)" class="btn btn-outline-dark btn-sm waves-effect btn-padd" target="_blank" title="partner login"><i class="bx bx-log-in-circle"></i> </a>';
				}
				$return['data'][] = array(
					'<strong>' . $i++ . '.</strong>',
					'<strong>' . $row->br_id . '.</strong>',
					$row->branch_name,
					date('d-M-Y', strtotime($row->opening_date)),
					$statusBtn,
					$actionBtn
				);
			}
			$return['recordsTotal'] = $this->master->branch_count();
			$return['recordsFiltered'] = $this->master->branch_filter_count($post_data);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
		} else if ($dt == 'addNew') {
			sleep(1);
			$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email Id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('off_addr', 'Branch address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('district', 'District', 'trim|required|xss_clean');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('openingDate', 'Opening date', 'trim|required|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post();
				$createArr = array(
					'br_id' => $post['branchCode'],
					'branch_name' => $post['branch_name'],
					'mobile_nu' => $post['mobile'],
					'email_id' => $post['email'],
					'address' => $post['off_addr'],
					'state_id' => $post['state'],
					'district' => $post['district'],
					'zipcode' => $post['zipcode'],
					'opening_date' => $post['openingDate'],
					'created_id' => $this->logId,
					'create_date' => config_item('work_end')
				);
				$success = $this->common->save_data('master_branch', $createArr);
				if ($success) {
					$data = array('icon' => 'success', 'text' => 'Thank You! you have successfully create');
				} else {
					$data = array('icon' => 'error', 'text' => array('Oops it seems somthing went wrong please reload site.'));
				}
			} else {
				$msg = array(
					'branch_name' => form_error('branch_name'),
					'mobile' => form_error('mobile'),
					'email' => form_error('email'),
					'off_addr' => form_error('off_addr'),
					'state' => form_error('state'),
					'district' => form_error('district'),
					'zipcode' => form_error('zipcode'),
					'openingDate' => form_error('openingDate')
				);
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		} else if ($dt == 'viewDetails') {
			$post = $this->input->post();
			$conArr = array('id' => $post['id']);
			$getBranch = $this->common->get_data('master_branch', $conArr, '*');
			$getDistrict = $this->master->getDataList('states_cities', 'parent_id', $getBranch['state_id']);
			$selDistrict = '<option value=" ">--- Select One ---</option>';
			if ($getDistrict) {
				foreach ($getDistrict as $list) {

					$selDistrict .= '<option value="' . $list->id . '" >' . $list->state_cities . '</option>';
				}
			}
			$data = array('miData' => $getBranch, 'dist' => $selDistrict);
			echo json_encode($data);
		} else if ($dt == 'editDetails') {
			sleep(1);
			$post = $this->input->post();
			$this->form_validation->set_rules('branch_name', 'Branch Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email Id', 'trim|required|xss_clean');
			$this->form_validation->set_rules('off_addr', 'Branch address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
			$this->form_validation->set_rules('district', 'District', 'trim|required|xss_clean');
			$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|xss_clean');
			$this->form_validation->set_rules('openingDate', 'Opening date', 'trim|required|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$conArr = array('id' => $post['target']);
				$updtArr = array(
					'branch_name' => $post['branch_name'],
					'mobile_nu' => $post['mobile'],
					'email_id' => $post['email'],
					'address' => $post['off_addr'],
					'state_id' => $post['state'],
					'district' => $post['district'],
					'zipcode' => $post['zipcode'],

					'opening_date' => $post['openingDate'],
					'modified_by' => $this->logId,
					'modified_date' => date('Y-m-d')
				);
				$updateR = $this->common->update_data('master_branch', $conArr, $updtArr);
				if ($updateR) {
					$data = array('icon' => 'success', 'text' => 'Thank You! you have successfully update');
				} else {
					$data = array('icon' => 'error', 'text' => array('Oops it seems somthing went wrong please reload site.'));
				}
			} else {
				$msg = array(
					'branch_name' => form_error('branch_name'),
					'mobile' => form_error('mobile'),
					'email' => form_error('email'),
					'off_addr' => form_error('off_addr'),
					'state' => form_error('state'),
					'district' => form_error('district'),
					'zipcode' => form_error('zipcode'),
					'openingDate' => form_error('openingDate')
				);
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		} else if ($dt == 'cStatus') {
			$getParamtr = $this->input->post('getParamtr');
			$conArr = array('id' => $getParamtr);
			$record = $this->common->get_data('master_branch', $conArr, 'status');
			if ($record['status'] == '1') {
				$newSts = '0';
			} else {
				$newSts = '1';
			}
			$updateArr = array('status' => $newSts);
			sleep(1);
			$updateR = $this->common->update_data('master_branch', $conArr, $updateArr);
			if ($updateR) {
				echo $newSts;
			} else {
				echo '3';
			}
		} else {
			$data['vCodeAuto'] = 'B' . rand(10, 100000);
			$data['title'] = 'Branch Manage';
			$data['bredcrums'] = 'Branch Manage';
			$data['layout'] = 'master/manage_branch.php';
			$data['getState'] = $this->common->all_data_con('states_cities', array('parent_id' => '729'), 'id,parent_id,state_cities');
			$data['target'] = 'employee/master/branch/viewList';
			$this->load->view('employee/base', $data);
		}
	}

	public function cityList()
	{
		$id = $this->input->post('id');
		$getCity = $this->master->getDataList('states_cities', 'parent_id', $id);
		sleep(1);
		echo '<option value=" ">--- Select One ---</option>';
		if ($getCity) {
			foreach ($getCity as $list) {
				echo '<option value="' . $list->id . '">' . $list->state_cities . '</option>';
			}
		}
	}

	public function group($dt = NULL)
	{

		if ($dt == 'viewList') {

			$post_data = $this->input->post();
			$record = $this->master->group_data($post_data);

			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			foreach ($record as $row) {
				if ($row->status == '1') {
					$stsOn = 'Active';
					$addCls = 'bg-olive';
					$btnIcon = 'bx-lock-open-alt';
				} else {
					$stsOn = 'Deactive';
					$addCls = 'bg-orange';
					$btnIcon = 'bx-lock-alt ';
				}
				$statusBtn = '<div class="actv-btn ' . $addCls . ' getStatusAction" onclick="mStatus(' . $row->id . ')" id="ms' . $row->id . '"> <i class="bx  ' . $btnIcon . '" ></i> ' . $stsOn . '</div>';
				$getUid = urlencode(base64_encode($row->id));
				$getUsername = urlencode(base64_encode($row->name));
				$viewClick = "'" . $row->id . "','employee/master/group/viewDetails','view'";
				$editClick = "'" . $row->id . "','employee/master/group/viewDetails','edit'";
				$actionBtn = '<a href="javascript:void(0)" onclick="manageGroup(' . $viewClick . ')" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a>
				<a href="javascript:void(0)" onclick="manageGroup(' . $editClick . ')" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="Edit"><i class="mdi mdi-square-edit-outline me-1"></i></a>';

				$return['data'][] = array(

					'<strong>' . $i++ . '.</strong>',
					'<strong>' . $row->grp_id . '</strong>',
					$row->center_name,
					$row->name,
					'<strong>' . date('d-M-Y', strtotime($row->create_date)) . '</strong>',
					$statusBtn,
					$actionBtn

				);
			}
			$return['recordsTotal'] = $this->master->group_count();
			$return['recordsFiltered'] = $this->master->group_filter_count($post_data);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
		} else if ($dt == 'cStatus') {
			$getParamtr = $this->input->post('getParamtr');
			$conArr = array('id' => $getParamtr);
			$record = $this->common->get_data('master_group', $conArr, 'status');
			if ($record['status'] == '1') {
				$newSts = '0';
			} else {
				$newSts = '1';
			}
			$updateArr = array('status' => $newSts);
			sleep(1);
			$updateR = $this->common->update_data('master_group', $conArr, $updateArr);
			if ($updateR) {
				echo $newSts;
			} else {
				echo '3';
			}
		} else if ($dt == 'editDetails') {
			$post = $this->input->post();
			$this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('centerID', 'Center name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('staffID', 'Employee Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('openingDate', 'Opening date', 'trim|required|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$conArr = array('id' => $post['target']);
				$updtArr = array(
					'name' => $post['group_name'],
					'create_date' => $post['openingDate'],
					'staff_id' => $post['staffID'],
					'center_id' => $post['centerID'],
					'modified_by' => $this->logId,
					'modified_date' => date('Y-m-d')
				);
				$updateR = $this->common->update_data('master_group', $conArr, $updtArr);
				//echo $this->db->last_query();die; 
				if ($updateR) {
					$data = array('icon' => 'success', 'text' => 'Thank You! you have successfully update');
				} else {
					$data = array('icon' => 'error', 'text' => array('Oops it seems somthing went wrong please reload site.'));
				}
			} else {
				$msg = array(
					'villageID' => form_error('villageID'),
					'center_name' => form_error('center_name'),
					'openingDate' => form_error('openingDate'),
					'staffID' => form_error('staffID'),
					'distance' => form_error('distance'),
					'noGroup' => form_error('noGroup')
				);
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		} else if ($dt == 'viewDetails') {
			$post = $this->input->post();
			$conArr = array('id' => $post['id']);
			$getGroup = $this->common->get_data('master_group', $conArr, '*');
			$arrGroup = array(
				'id' => $getGroup['id'],
				'grp_id' => $getGroup['grp_id'],
				'center_id' => $getGroup['center_id'],
				'staff_id' => $getGroup['staff_id'],
				'name' => $getGroup['name'],
				'create_date' => date('Y-m-d', strtotime($getGroup['create_date']))
			);

			$data = array('miData' => $arrGroup);
			echo json_encode($data);
		} else {
			$data['title'] = 'Group Manage';
			$data['bredcrums'] = 'Group Manage';
			$data['layout'] = 'master/manage_group.php';
			$data['getCenter'] = $this->common->all_data_con('master_center', array('status' => '1', 'branch_id' => $this->session->userdata('branch_id')), 'id,center_name,center_id');
			$data['getEmployee'] = $this->common->all_data_con('staff', array('status' => '1', 'branch_id' => $this->session->userdata('branch_id')), 'id,staff_id,full_name');
			$data['target'] = 'employee/master/group/viewList';
			$this->load->view('employee/base', $data);
		}
	}

	public function field_schedule($dt = NULL)
	{
		if ($dt == 'viewList') {
			$post_data = $this->input->post();
			$record = $this->master->fSchedule_data($post_data);
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			foreach ($record as $row) {
				if ($row->status == '1') {
					$stsOn = 'Active';
					$addCls = 'bg-olive';
					$btnIcon = 'bx-lock-open-alt';
				} else {
					$stsOn = 'Deactive';
					$addCls = 'bg-orange';
					$btnIcon = 'bx-lock-alt ';
				}
				$statusBtn = '<div class="actv-btn ' . $addCls . ' getStatusAction" onclick="mStatus(' . $row->id . ')" id="ms' . $row->id . '"> <i class="bx  ' . $btnIcon . '" ></i> ' . $stsOn . '</div>';
				$getUid = urlencode(base64_encode($row->id));
				$getUsername = urlencode(base64_encode($row->name));
				$viewClick = "'" . $row->id . "','employee/master/field_schedule/viewDetails','view'";
				$editClick = "'" . $row->id . "','employee/master/field_schedule/viewDetails','edit'";
				$actionBtn = '<a href="javascript:void(0)" onclick="manageFieldSchedule(' . $viewClick . ')" class="btn btn-outline-primary btn-sm waves-effect btn-padd" title="View"><i class="mdi mdi-eye"></i></a><a href="javascript:void(0)" onclick="manageFieldSchedule(' . $editClick . ')" class="btn btn-outline-warning btn-sm waves-effect btn-padd" title="Edit"><i class="mdi mdi-square-edit-outline me-1"></i></a>';

				$return['data'][] = array(

					'<strong>' . $i++ . '.</strong>',
					"<strong>" . $row->schCode . "</strong>",
					$row->center_name,
					$row->full_name,
					$row->schedule_day,
					"<strong>" . str_replace('', '  :  ', $row->schedule_time) . "</strong>",
					$statusBtn,
					$actionBtn

				);
			}
			$return['recordsTotal'] = $this->master->fSchedule_count();
			$return['recordsFiltered'] = $this->master->fSchedule_filter_count($post_data);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
		} else if ($dt == 'cStatus') {
			$getParamtr = $this->input->post('getParamtr');
			$conArr = array('id' => $getParamtr);
			$record = $this->common->get_data('master_field_schedule', $conArr, 'status');
			if ($record['status'] == '1') {
				$newSts = '0';
			} else {
				$newSts = '1';
			}
			$updateArr = array('status' => $newSts);
			sleep(1);
			$updateR = $this->common->update_data('master_field_schedule', $conArr, $updateArr);
			if ($updateR) {
				echo $newSts;
			} else {
				echo '3';
			}
		} else if ($dt == 'viewDetails') {
			$post = $this->input->post();
			$conArr = array('id' => $post['id']);
			$getFieldSchedule = $this->common->get_data('master_field_schedule', $conArr, '*');
			$data = array('miData' => $getFieldSchedule);
			echo json_encode($data);
		} else if ($dt == 'editDetails') {
			$post = $this->input->post();
			$this->form_validation->set_rules('centerName', 'Center name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('staffID', 'Staff name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fSchDate', 'Field schedule date', 'trim|required|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$conArr = array('id' => $post['target']);
				$updtArr = array(
					'schCode' => $post['vCode'],
					'staff_id' => $post['staffID'],
					'center_id' => $post['centerName'],
					'schedule_date' => $post['fSchDate'],
					'schedule_time' => $post['scheduleTime'],
					'schedule_day' => $post['dayName'],
					'modified_by' => $this->logId,
					'modified_date' => date('Y-m-d')
				);
				$updateR = $this->common->update_data('master_field_schedule', $conArr, $updtArr);
				if ($updateR) {
					$data = array('icon' => 'success', 'text' => 'Thank You! you have successfully update');
				} else {
					$data = array('icon' => 'error', 'text' => array('Oops it seems somthing went wrong please reload site.'));
				}
			} else {
				$msg = array('centerName' => form_error('centerName'), 'staffID' => form_error('staffID'), 'fSchDate' => form_error('fSchDate'));
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		} else if ($dt == 'addNew') {
			sleep(1);
			$this->form_validation->set_rules('centerName', 'Center name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('staffID', 'Staff name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('fSchDate', 'Field schedule date', 'trim|required|xss_clean');
			///$this->form_validation->set_rules('dayName', 'Day name', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('scheduleTime', 'Schedule time', 'trim|required|xss_clean');
			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post();
				$createArr = array(
					'branch_id'     => $this->session->userdata('branch_id'),
					'schCode'       => $post['vCode'],
					'staff_id'      => $post['staffID'],
					'center_id'     => $post['centerName'],
					'schedule_date' => $post['fSchDate'],
					'schedule_time' => $post['scheduleTime'],
					'schedule_day'  => $post['dayName'],
					'created_by'    => $this->logId,
					'created_date'  => date('Y-m-d')
				);
				$success = $this->common->save_data('master_field_schedule', $createArr);
				if ($success) {
					$data = array('icon' => 'success', 'text' => 'Thank You! you have successfully create');
				} else {
					$data = array('icon' => 'error', 'text' => array('Oops it seems somthing went wrong please reload site.'));
				}
			} else {
				$msg = array('centerName' => form_error('centerName'), 'staffID' => form_error('staffID'), 'fSchDate' => form_error('fSchDate'));
				$data = array('icon' => 'error', 'text' => $msg);
			}
			echo json_encode($data);
		} else {

			$data['vCodeAuto'] = 'FS' . rand(10, 100000);
			$data['title'] = 'Field Schedule Manage';
			$data['bredcrums'] = 'Field Schedule Manage';
			$data['layout'] = 'master/manage_field_schedule.php';
			$data['getMsCenter'] = $this->common->all_data_con('master_center', array('status' => '1', 'branch_id' => $this->session->userdata('branch_id')), 'id, branch_id, center_id,center_name');
			$data['getEmployee'] = $this->common->all_data_con('staff', array('status' => '1', 'branch_id' => $this->session->userdata('branch_id')), 'id,staff_id,full_name');
			$data['target'] = 'employee/master/field_schedule/viewList';
			$this->load->view('employee/base', $data);
		}
	}
}
