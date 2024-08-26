<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{

	public function __construct() 
	{

		parent::__construct();
		$this->load->model(array('employee/Common_model' => 'common', 'employee/Reports_model' => 'reports', 'employee/master_model' => 'master'));
		($this->session->userdata('user_cate') != 3) ? redirect(base_url(), 'refresh') : '';
		$this->brID = $this->session->userdata('branch_id');
		error_reporting(0);

	}

	public function centerWiseLoan()
	{

		$post = $this->input->post();
		if ($post) {
			//sleep(2);
			if ($post['miActn'] == 'miReports') {
				$getStaffOnCenter = array();
				if ($post['miCode'] != NULL) {
					$getStaffOnCenter = $this->reports->centerStaff($post['miCode']);
					$getLoadDetails = NULL;
					$getCenterWiseGroup = $this->reports->centerWiseGroup($post['miCode']);

					if ($getCenterWiseGroup) {
						$cnt = 0;
						$centWiseAmt = 0;
						$centWiseRcvrdAmt = 0;
						$centWiseEmiTtlAmt = 0;
						$centWiseOsDueAmt = 0;
						$centDueTotlTamt = 0;
						foreach ($getCenterWiseGroup as $grpR) {
							$getCenterReport = $this->reports->centerWiseByLoanReport($post['miCode'],$grpR->group_id,$post['strtDt']);  
							$getLoadDetails .= '<tr><th colspan="13"><div class="miGrA">' . $grpR->group_id . ' (' . $grpR->groupName . ').</div></th></tr>';

							if ($getCenterReport) {
								$sanctionAmt = 0;
								$recvrdAmt = 0;
								$emiTotalAmt = 0;
								$osDueTamt = 0;
								$dueTotlTamt = 0;
								foreach ($getCenterReport as $grpChild) {
									++$cnt;
									
						            /*  echo $this->db->last_query();
							 		  echo "<pre>"; print_r($grpChild);
							          die;*/
									
									if ($grpChild->disDate) {
										$disDate = date('d-M-Y', strtotime($grpChild->disDate));
									} else {
										$disDate = '<span>N/A</span>';
									}
									if ($grpChild->week) {
										$dis_week = $grpChild->week;
									} else {
										$dis_week =  '<span>N/A</span>';
									}

									if ($grpChild->nominee_name) {
										$guardian = $grpChild->nominee_name;
									} else {
										$guardian = '<span>N/A</span>';
									}
									$sanctionAmt += $grpChild->amount;
									$centWiseAmt += $grpChild->amount;
									$whereConGetDw = array('group_loan_id' => $grpChild->id, 'payment_status' => '2');

									$getDw = $this->common->get_data('group_loan_payment_details', array('group_loan_id' => $grpChild->id, 'payment_status' => '1'), 'count(id) as dw,count(member_id)');

									$getttDw = $this->common->get_data('group_loan_payment_details', array('group_loan_id' => $grpChild->id, 'payment_status' => '1'), 'count(id) as dw,monthly_emi');

									$getPartialDue = $this->common->get_data('group_member_payment_details', array('group_loan_id' => $grpChild->id, 'status' => '2'), 'sum(rest_amount) as dueTotal');

									$getRcvr = $this->common->get_data('group_loan_payment_details', array('group_loan_id' => $grpChild->id, 'payment_status' => '2'), 'sum(paid_amount) as amt');

									// --------r@kr--------- count monthly emi acc to payment status -------------

									$mon_emi = $this->common->all_data_con('group_loan_payment_details', array('group_loan_id' => $grpChild->id, 'payment_status' => 2), 'monthly_emi');
									if ($mon_emi) {
										$emi_weekly = count($mon_emi);
									} else {
										$emi_weekly = '<span>N/A</span>';
									}

									// ----------------- count monthly emi acc to payment status -------------

									// ----------------- count monthly emi acc to payment status -------------

									if ($getRcvr) {
										if ($getRcvr['amt'] != 0) {
											$recovery = $getRcvr['amt'];
										} else {
											$recovery = 0;
										}
									} else {
										$recovery = 0;
									}
									// 	$restDw = $grpChild->tenure - $down;
									$restDw = $dis_week;
									// $recvrdAmt += $recovery;

									$centWiseRcvrdAmt += $recovery;
									$emiTotalAmt += $getDw['monthly_emi'];
									$centWiseEmiTtlAmt += $getDw['monthly_emi'];
									$osDue = ($grpChild->tenure * $getttDw['monthly_emi']) - $recovery;
									$centWiseOsDueAmt += $osDue;
									$osDueTamt += $osDue;
									$dueTotlTamt += $getPartialDue['dueTotal'];

									$centDueTotlTamt += $getPartialDue['dueTotal'];

									$getLoadDetails .= '<tr><th>' . $cnt . '.</th><td>' . $grpChild->member_id . '</td><td>' . $grpChild->full_name . '</td><td>' . $guardian . '</td>
									<td>' . $disDate . '</td><td>' . $restDw . '</td><td>' . $emi_weekly . '</td><td>' . $grpChild->amount . '</td>
									<td>' . $recovery . '</td><td>' . $osDue . '</td><td>' . $getttDw['monthly_emi'] . '</td><td>' . $getPartialDue['dueTotal'] . '</td>
									<td><div></div></td></tr>';
								}

								$getLoadDetails .= '<tr><td colspan="3"></td><td colspan="4"><div style="font-weight:900;text-align:right;border-bottom:0px;">Group-Total</div></td>
								<td class="tfntBld">' . $sanctionAmt . '</td><td class="tfntBld">' . $recvrdAmt . '</td><td class="tfntBld">' . $osDueTamt . '</td>
								<td class="tfntBld">' . $emiTotalAmt . '</td><td class="tfntBld">' . $dueTotlTamt . '</td><td><div></div></td></tr>';
							}
						}
						$getLoadDetails .= '<tr><td colspan="3"></td><td colspan="4"><div style="font-weight:900;text-align:right;border-bottom:0px;">Center-Total</div></td>
						<td class="tfntBld">' . $centWiseAmt . '</td><td class="tfntBld">' . $centWiseRcvrdAmt . '</td><td class="tfntBld">' . $centWiseOsDueAmt . '</td>
						<td class="tfntBld">' . $centWiseEmiTtlAmt . '</td><td class="tfntBld">' . $centDueTotlTamt . '</td><td><div></div></td></tr>
						
						<tr><td colspan="11"><div style="font-weight:900;text-align:right;">Date & Time</div></td>
						<td class="tfntBld">' .date('d-M-Y').''.'</td><td><div></div></td></tr>
						';
						
					}
					
					$getStaffOnCenter->cWiseReportLn = 'centerReportLn';
					$getStaffOnCenter->loanDtl = $getLoadDetails;
					/*	$getStaffOnCenter->staff = $getStaffOnCenter;
					array_push($getClient->staff = $getStaffOnCenter, $getClient->cWiseReportLn = 'centerReportLn', $getClient->loanDtl = $getLoadDetails);*/
					//	print_r($getStaffOnCenter);exit;
					$data = $getStaffOnCenter;
					//print_r($getStaffOnCenter);exit;
					
				} else {
					$data = array('icon' => 'error', 'text' => array('Please input valid groud id.'));
				}
				echo json_encode($data);
			} else if ($post['miActn'] == 'miPrintReports') {     // $post['strtDt'],$post['endDt']
				$getStaffOnCenter = NULL;
				$getLoadDetails = NULL;
				$getStaffOnCenter = $this->reports->centerStaff($post['miCode']);
				$getCenterWiseGroup = $this->reports->centerWiseGroup($post['miCode']);
				$data['getCenterWiseGroup'] = $getCenterWiseGroup;
				$data['getStaffOnCenter'] = $getStaffOnCenter;
				$data['miCode']=$post['miCode'];
				$data['strtDt']=$post['strtDt'];
				$data['endDt']=$post['endDt'];   
				$data['miActn'] = 'centerWiseLoanReport';
				$this->load->view('employee/reports/print_details', $data);
			}
		} else {

			$data['title']       = 'Center Wise Loan';
			$data['txtWithIcon'] = '<i class="bx bx-group fntClr"></i> Center ID (Whom to issue)';
			// $data['member']      = $this->common->all_data_con('master_center', array('status' => 1), 'center_id as member_id, center_name as field_name, status');
			$data['member']      = $this->common->test_1();
			
			$data['uriActn']     = base_url('employee/reports/centerWiseLoan');
			$data['miActn']      = 'centerWiseLoanReport';
			$data['breadcrums']  = 'Center Wise Loan';
			$data['layout']      = 'reports/loan_details.php';
			$this->load->view('employee/base', $data);
		}
	}

	public function test_collectioin()
	{
		$data = $this->input->post();
		$data['fdsfsd'] =  $this->reports->test_2($data['str_data']);
		$data = $data['fdsfsd'];
		echo json_encode($data);
	}

	public function clientWiseLoan()
	{
		$post = $this->input->post();
		if ($post) {
			sleep(2);
			if ($post['miActn'] == 'miReports') {
				if ($post['miCode'] != NULL) {
					$getClient = array();
					$getClient = $this->reports->getClientWise($post['miCode']);
					if ($getClient) {
						$getClientEmi = $this->reports->clientEmi($getClient->id);
					} else {
						$getClientEmi = NULL;
					}
					$getLoadDetails = NULL;
					if ($getClientEmi) {
						$ctn = 0;
						foreach ($getClientEmi as $listD) {
							++$ctn;
							$getEmiDet = $this->reports->getRecvdAmtByClient($getClient->id, $listD->id);
							if ($getEmiDet) {
								if ($getEmiDet->emi_date) {
									$recvDate = date('d-M-Y', strtotime($getEmiDet->emi_date));
								} else {
									$recvDate = '<span>N/A</span>';
								}
								if ($getEmiDet->recvAmt) {
									$recvAmt = $getEmiDet->recvAmt;
								} else {
									$recvAmt = '<span>N/A</span>';
								}
							} else {
								$recvDate = '<span>N/A</span>';
								$recvAmt = '<span>N/A</span>';
							}
							if ($listD->payment_status == '2') {
								$paySts = '<label>Paid</label>';
							} else {
								if ($getEmiDet) {
									if ($listD->monthly_emi > $getEmiDet->recvAmt) {
										$paySts = '<span class="partiallyPaid">Part Paid</span>';
									} else {
										$paySts = '<span>Unpaid</span>';
									}
								} else {
									$paySts = '<span>Unpaid</span>';
								}
							}
							$getLoadDetails .= '<tr><th>' . $ctn . '.</th><td>' .  date('W', strtotime($listD->payment_date)) . '</td><td>' . date('d-M-Y', strtotime($listD->payment_date)) . '</td><td>' . $listD->monthly_emi . '</td>
							<td>' . $listD->principal_interest_amt . '</td><td>' . $recvDate . '</td><td>' . $recvAmt . '</td><td>' . $paySts . '</td><td><div></div></td>
							<td><div></div></td><td><div></div></td></tr>';
						}
					} else {
						$getLoadDetails = '<tr><td colspan="11"><div class="noDTfound"><div><i class="bx bx-error"></i> Oops there is no data found</div>
						<img src="' . base_url('uploads/notFound.svg') . '"></div> </td></tr>';
					}
					$getClient->loanDtl = $getLoadDetails;
					$getClient->cWiseReportLn = 'cWiseReportLn';
					//	print_r($getClient);exit;
					//	array_push($getClient->loanDtl = $getLoadDetails, $getClient->cWiseReportLn = 'cWiseReportLn');
					$data = $getClient;
				} else {
					$data = array('icon' => 'error', 'text' => array('Please input valid client id.'));
				}
				echo json_encode($data);
			} else if ($post['miActn'] == 'miPrintReports') {
				$getClient = $this->reports->getClientWise($post['miCode']);
				if ($getClient) {
					$getClientEmi = $this->reports->clientEmi($getClient->id);
				} else {
					$getClientEmi = NULL;
				}
				$getLoadDetails = NULL;
				$data['getClient'] = $getClient;
				$data['miActn'] = 'clientWiseLoanReport';
				$data['getClientEmi'] = $getClientEmi;
				$this->load->view('employee/reports/print_details', $data);
			}
		} else {
			$data['txtWithIcon'] = '<i class="bx bxs-user fntClr"></i> Client ID (Whom to issue)';
			$data['member'] = $this->common->all_data('member', 'member_id, CONCAT(first_name," ",mid_name," ", last_name) AS field_name');
			$data['uriActn'] = base_url('employee/reports/clientWiseLoan');
			$data['miActn'] = 'clientWiseLoanReport';
			$data['title'] = 'Client wise loan';
			$data['breadcrums'] = '';
			$data['layout'] = 'reports/loan_details.php';
			$this->load->view('employee/base', $data);
		}
	}

	public function centerWiseLoanDisburshment($tGet = NULL)
	{

		if ($tGet == 'veiwList') {

			$post_data = $this->input->post();
			$record = $this->reports->centerLoanDisburshment_list($post_data, $this->brID);
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			
			foreach ($record as $row) {
				$return['data'][] = array(
					'<strong>' . $i++ . '.</strong>',
					'<strong>' . $row->disDate . '</strong>',
					$row->clientID,
					$row->loanID,
					$row->center_name,
					$row->clientName,
					$row->clientKyc,
					$row->nominee_name,
					$row->guardianKyc,
					$row->pay_mode,
					'<span>' . ($row->disAmt ? $row->disAmt : '0') . '</span>',
					'<span>' . ($row->processing_fee ? $row->processing_fee : '0') . '</span>',
					$row->account_no?$row->account_no:'<span style="color:#bf1919;font-weight:600;">N/A</span>',
					$row->ifsc_code?$row->ifsc_code:'<span style="color:#bf1919;font-weight:600;">N/A</span>',
				);
			}
			$return['recordsTotal'] = $this->reports->centerLoanDisburshment_count($this->brID);
			$return['recordsFiltered'] = $this->reports->centerLoanDisburshment_filter_count($post_data, $this->brID);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
		} else if ($tGet == 'download') {
			//sleep(2);
			$post = $this->input->post();
			$getCReportList = $this->reports->printCenterWiseDisbursment($this->brID, $post);
			//echo $this->db->last_query();exit;
			$data['getCReportList'] = $getCReportList;
			$data['miActn'] = 'centerWiseLoanDisburshment';
			$this->load->view('employee/reports/print_details', $data);
		} else {

			$post = $this->input->post();
			$getCReportList = $this->reports->printCenterWiseDisbursment($this->brID, $post);
			$data['getCReportList'] = $getCReportList;
			$data['target'] = base_url('employee/reports/centerWiseLoanDisburshment/veiwList');
			$data['uriActn'] = base_url('employee/reports/centerWiseLoanDisburshment/download');
			$data['title'] = 'Center wise loan disbursment';
			$data['miActn'] = 'centerWiseLoanDisReport';
			$data['breadcrums'] = 'Branch wise loan disbursement';
			$data['layout'] = 'reports/loan_disburshment.php';
			$this->load->view('employee/base', $data);
		}

	}

	public function branchWiseLoanDisburshment($tttGet = NULL) 
	{

		if ($tttGet == 'veiwList') {

			$post_data = $this->input->post();
			$record = $this->reports->branchLoanDisburshment_data($post_data, $this->brID);
			// echo $this->db->last_query();
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			$disbAmtDis = 0;
			foreach ($record as $row) {
                // intAmo   monEmi  
				$getDetails = $this->reports->getLoanDetailsToAll($row->cnID);

				if($getDetails['is_adv'] == 2)
				{
					if($getDetails['adv_amo']) {
                    	$extraAmt = $getDetails['adv_amo'];
					}
				} else {
					$extraAmt = "<span style='color:#a22121;font-weight:600;'>N/A</span>";
				}

				if($getDetails['monEmi'] - $getDetails['intAmo'])
				{
                    $paid_amount = $getDetails['monEmi'] - $getDetails['adv_amo'];
                    $loanMwithoutInt = $paid_amount - $getDetails['intAmo'];
				} else {
					$loanMwithoutInt = "<span style='color:#a22121;font-weight:600;'>N/A</span>";
				}

				if ($getDetails['intAmo']) {
					$intPaid = $getDetails['intAmo'];
				} else {
					$intPaid = '0.0';
				}

				if ($row->disBrAmt) {
					$disbAmt = $row->disBrAmt;
				} else {
					$disbAmt = '0';
				}
				
				if ($row->prFee) {
					$prFeeAmt = $row->prFee;
				} else {
					$prFeeAmt = '0';
				}
				
				if ($getDetails['prevEmiAmt']) {
					$prevEmiAmt = $getDetails['prevEmiAmt'];
				} else {
					$prevEmiAmt = "<span style='color:#a22121;font-weight:600;'>N/A</span>";
				}

				if ($row->loan_amt > 0) {
					if ($getDetails['montlyEmi']) {
						$duesRestAmt = $getDetails['od_amt'];
					} else {
						$duesRestAmt = "<span style='color:#a22121;font-weight:600;'>N/A</span>";
					}
				} else {
					$duesRestAmt ="<span style='color:#a22121;font-weight:600;'>N/A</span>";
				}
			
				$emi_total = $loanMwithoutInt + $intPaid;

				if($loanMwithoutInt+$intPaid+$emi_total)
				{
					$total = $emi_total+$extraAmt+$duesRestAmt+$prevEmiAmt;
				}else{
					$total = "<span style='color:#a22121; font-weight:600;'>N/A</span>";
				}
				$disbAmtDis=$disbAmtDis+$disbAmt;

                if($getDetails->created_at == date('Y-m-d'))   
				{
					$return['data'][] = array(
						'<strong>' . $i++ . '.</strong>',
						'<strong>' . $row->cCode . '</strong>',
						 $row->center_name,
						'<span">' . ($disbAmt) . '</span>',
						'<span>' . ($prFeeAmt) . '</span>',
						'<span>' . ($extraAmt) . '</span>',
						'<span>' . ($duesRestAmt) . '</span>',
						'<span>' . ($prevEmiAmt) . '</span>',
						'<span>' . ('0.00') . '</span>',
						'<span>' . ($loanMwithoutInt) . '</span>', 
						'<span>' . ($intPaid) . '</span>',
						'<span>' . ($emi_total) . '</span>',
						'<span>' . ($total) . '</span>',
					);
					
				} else if($post_data['strtDt'] != "" && $post_data['endDt'] !="") {
					$return['data'][] = array(

						'<strong>' . $i++ . '.</strong>',
						'<strong>' . $row->cCode . '</strong>',
						$row->center_name,
						'<span>' . ($disbAmt) . '</span>',
						'<span>' . ($prFeeAmt) . '</span>',
						'<span>' . ($extraAmt) . '</span>',
						'<span>' . ($duesRestAmt) . '</span>',
						'<span>' . ($prevEmiAmt) . '</span>',
						'<span style="color:#a22121;font-weight:600;">' . ('N/A') . '</span>',
						'<span>' . ($loanMwithoutInt) . '</span>',
						'<span>' . (round($intPaid)) . '</span>',
						'<span>' . ($emi_total) . '</span>',
						'<span>' . ($total) . '</span>',
					);
				}
			
			}
			$return['recordsTotal'] = $this->reports->branchLoanDisburshment_count($this->brID);
			$return['recordsFiltered'] = $this->reports->branchLoanDisburshment_filter_count($post_data, $this->brID);
			$return['draw'] = $post_data['draw'];

			echo json_encode($return);
		} else if ($tttGet == 'download') {
			sleep(2);
			$post = $this->input->post();
			$data['getReportList'] = $this->reports->printBrReport($this->brID,$post);
			$data['miActn'] = 'branchWiseLoanDisburshment';
			$this->load->view('employee/reports/print_details', $data);
		} else {
			$data['target'] = base_url('employee/reports/branchWiseLoanDisburshment/veiwList');
			$data['uriActn'] = base_url('employee/reports/branchWiseLoanDisburshment/download');
			$data['title'] = 'Branch wise';
			$data['miActn'] = 'branchWiseLoanDisReport';
			$data['breadcrums'] = 'Branch wise loan disbursement';
			$data['layout'] = 'reports/loan_disburshment.php';
			$this->load->view('employee/base', $data);
		}
	}

	public function field_schedule($tGet = NULL)
	{

		if ($tGet == 'viewList') {

			$post_data = $this->input->post();
			$record = $this->master->fSchedule_data($post_data);
			$i = $post_data['start'] + 1;
			$return['data'] = array();
			$amt = 0;
			foreach ($record as $row) {
				$return['data'][] = array(
					'<strong>' . $i++ . '.</strong>',
					"<strong>" . $row->centerCode . "</strong>",
					$row->center_name,
					date('d-M-Y', strtotime($row->schedule_date)),
					$row->schedule_day,
					"<strong>" . str_replace('', '  :  ', $row->schedule_time) . "</strong>",
					$row->full_name
				);
			}
			$return['recordsTotal'] = $this->master->fSchedule_count();
			$return['recordsFiltered'] = $this->master->fSchedule_filter_count($post_data);
			$return['draw'] = $post_data['draw'];
			echo json_encode($return);
		} else if ($tGet == 'download') {
			sleep(2);
			$post = $this->input->post();
			$getReportList = $this->reports->printFieldSchedule($this->brID, $post);
			$data['getReportList'] = $getReportList;
			$data['miActn'] = 'fieldScheduleReport';
			$this->load->view('employee/reports/print_details', $data);
		} else {
			$data['target'] = 'employee/reports/field_schedule/viewList';
			$data['uriActn'] = base_url('employee/reports/field_schedule/download');
			$data['title'] = 'Field Schedule Report';
			$data['miActn'] = 'fieldScheduleWiseReport';
			$data['breadcrums'] = 'Field Schedule Report';
			$data['layout'] = 'reports/loan_disburshment.php';
			$this->load->view('employee/base', $data);
		}
	}

	/** =========================================== Profile Report ===================================== **/

	public function profile_wise_report()
	{

		$data['title'] = 'Profile Report';
		$data['show_pro_data'] = base_url('employee/Reports/showData');
		$data['miActn'] = 'profileWiseReport';
		$data['uriActn'] = base_url('employee/Reports/print_profile_report');
		$data['uriActn'] = base_url('employee/Reports/open_pdf');
		$data['breadcrums'] = 'Profile Report';
		$data['center_data']     = $this->common->all_data('master_center', 'id, center_name, center_id');
		$data['layout'] = 'reports/profile_report.php';
		$this->load->view('employee/base', $data);
	}

	public function open_pdf()
	{
		$post = $this->input->post();
		$post_data['center_name'] = $post['miCode'];
		$record['print_data'] = $this->reports->print_branchName($post_data['center_name']);
		$record['profile_details'] = $this->reports->all_profile_data($post_data);
		$this->load->view('employee/reports/print_profile', $record);
	}

	public function print_profile_report()
	{

		$post = $this->input->post();
		$post_data['center_name'] = $post['miCode'];
		$record['print_data'] = $this->reports->print_branchName($post_data['center_name']);
		$record['profile_details'] = $this->reports->all_profile_data($post_data);
		$this->load->view('employee/reports/print_profile', $record);
	}

	public function profile_report_data()
	{

		$post_data = $this->input->post();
		$record = $this->reports->all_profile_data($post_data);
		$i = $post_data['start'] + 1;

		$return['data'] = array();
		foreach ($record as $row) {

			if ($row->religion == 1) {
				$relgn = "Hinduism";
			} else if ($row->religion == 2) {
				$relgn = "Islam";
			} else if ($row->religion == 3) {
				$relgn = "Christianity";
			} else if ($row->religion == 4) {
				$relgn = "Sikhism";
			} else if ($row->religion == 5) {
				$relgn = "Others";
			} else {
				$relgn = " ";
			}

			if ($row->disbursment_status == 1) {

				$active = '<a href="javascript:void(0);" class="text-danger"><b>In-active</b> <i class="fa fa-times text-danger"></i></a>';
			} else {

				$active = '<a href="javascript:void(0);" class="text-success"><b>Active</b> <i class="fa fa-check text-success"></i></a>';
			}

			$return['data'][] = array(

				$i++,
				$row->member_id,
				$row->grp_id,
				$row->center_name,
				$row->first_name . " " . $row->mid_name . " " . $row->last_name,
				$row->voter_card_no,
				$row->nominee_name,
				$row->nominee_voter,
				$row->relation_name,
				$relgn,
				$row->doj,
				$active,

			);
		}

		$return['recordsTotal'] = $this->reports->total_count();
		$return['recordsFiltered'] = $this->reports->total_filter_count($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}

	/** ==================================== Cash Submission Report ================================ */

	public function cash_submission_report()
	{

		$data['title']       = 'Weekly Cash Submission Report';
		$data['breadcrums']  = 'Weekly Cash Submission Report';
		$data['miActn']      = 'cashsubmissionWiseReport';
		$data['uriActn']     = base_url('employee/Reports/print_cash_submission_report');
		$data['center_data'] = $this->common->all_data('master_center', 'id, center_name, center_id');
		$data['layout']      = 'reports/cash_submission_report.php';
		$this->load->view('employee/base', $data);
	}

	public function print_cash_submission_report()
	{
		// $post_data['center_name'] = $post['miCode'];
		// $record['cash_submission'] = $this->reports->all_cash_submission_data($post_data);
		$post_data = $this->input->post();
		$record['cash_submission'] = $this->reports->all_cash_submission_data($post_data);
		$this->load->view('employee/reports/print_cash_submission', $record);
	}

	public function cash_submission_report_data()
	{

		$post_data = $this->input->post();
		$record = $this->reports->all_cash_submission_data($post_data);
		$i = $post_data['start'] + 1;

		$return['data'] = array();
		foreach ($record as $row) {

			$return['data'][] = array(

				$i++,
				$row->center_id,
				$row->center_name,
				$row->mem_id,
				$row->emi,

			);
		}

		$return['recordsTotal'] = $this->reports->cash_total_count();
		$return['recordsFiltered'] = $this->reports->cash_total_filter_count($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}

	/** ==================================== OD Payment Report ================================ */

	public function od_payment_report()
	{
		$data['title']       = 'Posting Report';
		$data['breadcrums']  = 'Posting Report';
		$data['uriActn']     = base_url('employee/Reports/print_od_payment_report');
		$data['layout']      = 'reports/od_payment_report.php';
		$this->load->view('employee/base', $data);
	}

	public function print_od_payment_report()
	{

		$post = $this->input->post();
		$post_data['center_name'] = $post['miCode'];
		$record['od_report'] = $this->reports->all_od_payment_report($post_data);
		$this->load->view('employee/reports/print_od_payment_report', $record);
	}

	public function od_payment_report_data()
	{

		$post_data = $this->input->post();
		$record = $this->reports->all_od_payment_report($post_data);
		$i = $post_data['start'] + 1;

		$return['data'] = array();
		foreach ($record as $row) {

			$return['data'][] = array(

				$i++,
				$row->center_id,
				$row->center_name,
				$row->member_id,
				$row->loan_no,
				$row->first_name,
				$row->pay_date,
				$row->paid_amount,
				$row->week,
				$row->emi_date,
				$row->rest_amount,
				$row->rest_amount,
			);
		}

		$return['recordsTotal'] = $this->reports->od_total_count();
		$return['recordsFiltered'] = $this->reports->od_total_filter_count($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}

	// ---------------------------------------------  Posting Report Section Start ----------------------

	public function posting_wise_report()
	{
		$data['title']       = 'Posting Report';
		$data['breadcrums']  = 'Posting Report';
		$data['uriActn']     = base_url('employee/Reports/print_Post_wiseReport');
		$data['miActn']      = 'post_wise_reportData';
		$data['layout']      = 'reports/posting_report.php';
		$this->load->view('employee/base', $data);
	}

	public function print_Post_wiseReport()
	{
		$post = $this->input->post();
		$post_data['center_name'] = $post['miCode'];
		$data['target']     = base_url('employee/Reports/posting_wise_report_data');
		$record['post_w_data'] = $this->reports->all_posting_rep_data($post_data);
		// print_r($record['post_w_data']);die;
		$this->load->view('employee/reports/print_post_report', $record);
	}

	public function posting_wise_report_data()
	{
		$post_data = $this->input->post();
		$record = $this->reports->all_posting_rep_data($post_data);
		// print_r($record);die;
		$i = $post_data['start'] + 1;

		$return['data'] = array();
		foreach ($record as $row) {

			$return['data'][] = array(

				'<div class="text-center">' . $i++ . '</div>',
				'<div class="text-center">' . $row->center_id . '</div>',
				'<div class="text-center">' . $row->center_name . '</div>',
				'<div class="text-center">' . $row->member_id . '</div>',
				'<div class="text-center">' . $row->first_name . '</div>',
				'<div class="text-center">' . $row->paid_amount . '</div>',

				// gmpd.id ,gmpd.is_od,mc.center_id,mc.center_name,m.member_id,m.first_name
			);
		}

		$return['recordsTotal'] = $this->reports->post_wise_total_count();
		$return['recordsFiltered'] = $this->reports->post_wise_total_filter_count($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}

	/** ==================================== Voucher Report ================================ */

	public function voucher_report()
	{

		$data['title']          = 'Weekly Voucher Report';
		$data['breadcrums']     = 'Weekly Voucher Report';
		$data['miActn']         = 'VoucherReport';
		$data['uriActn']        = base_url('employee/Reports/print_voucher_report');
		$data['voucher_loan_report'] = $this->reports->all_voucher_loan_data();
		// print_r($data['voucher_loan_report']);die;
		$data['voucher_od_report'] = $this->reports->all_voucher_od_data();
		$data['layout']         = 'reports/voucher_report.php';
		$this->load->view('employee/base', $data);
	}

	public function print_voucher_report()
	{

		$data['voucher_loan_report'] = $this->reports->all_voucher_loan_data();
		$data['voucher_old_report'] = $this->reports->all_voucher_od_data();
		$this->load->view('employee/reports/print_voucher', $data);
	}

	// ------------------------------------------- Advance Report Section Start ----------------------

	public function advance_report()
	{
		$data['title']       = 'Advance Report';
		$data['breadcrums']  = 'Advance Report';
		$data['uriActn']     = base_url('employee/Reports/print_advance_report');
		// print_r($data['uriActn']);die;
		// $data['target']     = base_url('employee/Reports/advance_report_manage');
		$data['layout']      = 'reports/advance_report.php';
		$this->load->view('employee/base', $data);
	}

	public function advance_report_manage()
	{
		$post_data = $this->input->post();
		$record = $this->reports->all_advance_report_manage($post_data);
		// print_r($record);die;
		// echo $this->db->last_query();die;
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		$radhe = array();

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


				$radhe[$i]['count'] = $count;
				$radhe[$i]['center_id'] = $row->center_id;
				$radhe[$i]['center_name'] = $row->center_name;
				$radhe[$i]['full_name'] = $row->full_name;
				$radhe[$i]['st_id'] = $row->st_id;
				$radhe[$i]['recu'] = ($recoAmount->total) ? $recoAmount->total : 0;
			}
		}

		foreach ($radhe as $row) {
			$return['data'][] = array(
				$i++,
				$row['center_id'],
				$row['center_name'],
				$row['full_name'],
				$row['count'],
				$row['recu']
			);
		}

		$return['recordsTotal'] = $this->reports->advance_report_total_count();
		$return['recordsFiltered'] = $this->reports->advance_report_total_filter_count($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}

	public function print_advance_report()
	{
		$record['advance_data'] = $this->reports->print_advance_report_model();
		// print_r($record['advance_data']);die;
		$this->load->view('employee/reports/print_advance_report', $record);
	}

	// ------------------------------------------- Advance Report Section End ------------------------



	// ------------------------------------------- Due Collection Section End ------------------------

	public function due_collection()
	{
		$data['title']       = 'Due Collection';
		$data['breadcrums']  = 'Due Collection';
		$data['uriActn']     = base_url('employee/Reports/print_due_collection');
		// $data['target']     = base_url('employee/Reports/due_collection_report');
		$data['layout']      = 'reports/due_collection.php';
		$this->load->view('employee/base', $data);
	}

	public function due_collection_report()
	{

		$post_data = $this->input->post();
		$record = $this->reports->all_due_collection_report($post_data);
		// echo "<pre>";print_r($record);
		$i = $post_data['start'] + 1;

		$return['data'] = array();
		$radhe = array();


		foreach ($record as $i => $row) {

			$count = $this->db->select('*')->where('staff_id', $row->st_id)->get('member')->num_rows();
			if ($count > 0) {
				$client_id = $this->db->select('id')->where('staff_id', $row->st_id)->get('member')->result();
				$staff = $this->db->select('full_name')->where('id', $row->staff_id)->get('staff')->row();

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




				$radhe[$i]['count'] = $count;
				$radhe[$i]['center_id'] = $row->center_id;
				$radhe[$i]['center_name'] = $row->center_name;
				$radhe[$i]['full_name'] = $staff->full_name;
				$radhe[$i]['paid_amount'] = ($recoAmount->total) ? ($recoAmount->total) : 0;
				$radhe[$i]['dues_total'] =  ($duesAmount->dues_total) ? ($duesAmount->dues_total) : 0;
				$radhe[$i]['sum_reco'] = ($recoAmount->total +  $duesAmount->dues_total) ? ($recoAmount->total +  $duesAmount->dues_total) : 0;
				$radhe[$i]['rec_Posting_amo'] =  ($RecPost->rec_Posting_amo) ? ($RecPost->rec_Posting_amo) : 0;
				$radhe[$i]['due_posting'] = ($duePost->due_posting) ? ($duePost->due_posting) : 0;
				$radhe[$i]['sum_rec_posting'] = (($RecPost->rec_Posting_amo) + ($duePost->due_posting)) ? (($RecPost->rec_Posting_amo) + ($duePost->due_posting)) : 0;
				$radhe[$i]['rec_Dues'] = (($recoAmount->total) - ($RecPost->rec_Posting_amo)) ? (($recoAmount->total) - ($RecPost->rec_Posting_amo)) : 0;
			}
		}

		foreach ($radhe as $row) {

			$return['data'][] = array(

				$i++,
				$row['center_id'],
				$row['center_name'],
				$row['full_name'],
				$row['count'],
				$row['paid_amount'],
				$row['dues_total'],
				$row['sum_reco'],
				$row['rec_Posting_amo'],
				$row['due_posting'],
				$row['sum_rec_posting'],
				$row['rec_Dues']

			);
		}

		$return['recordsTotal'] = $this->reports->due_collection_total_count();
		$return['recordsFiltered'] = $this->reports->due_collection_total_filter_count($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}

	public function print_due_collection()
	{
		$record['print_data'] = $this->reports->due_collection_report();

		// print_r($record['print_data']);die;
		$this->load->view('employee/reports/print_due_collection', $record);
	}

	// ------------------------------------------- Due Collection Section End ------------------------



	// ------------------------ fore close report section start ------------------------------ 

	public function fore_close_loan_report()
	{

		$data['uriActn']     = base_url('employee/Reports/print_fore_close');
		$data['target']     = 'employee/reports/all_fore_close_rep';
		$data['layout']      = 'reports/fore_close_loan_report.php';
		$this->load->view('employee/base', $data);
	}


	public function all_fore_close_rep()
	{
		$post_data = $this->input->post();
		$record = $this->reports->all_fore_close_rep_mod($post_data);
		$i = $post_data['start'] + 1;
		$return['data'] = array();
		foreach ($record as $row) {

			$return['data'][] = array(

				$i++,
				$row->center_id,
				$row->center_name,
				$row->member_id,
				$row->first_name . " " . $row->mid_name . " " . $row->last_name,
				$row->dob,
				$row->guardian_name,
				$row->loan_no,
				$row->disbursed_data,
				$row->disbursed_loan,
				$row->pre_close_date,
				$row->recovered_amount,
				$row->pre_close_date,
				$row->lst_rec_amount,
				$row->remark



			);
		}

		$return['recordsTotal'] = $this->reports->fore_close_rep_total_count();
		$return['recordsFiltered'] = $this->reports->fore_close_rep_total_filter_count($post_data);
		$return['draw'] = $post_data['draw'];
		echo json_encode($return);
	}

	public function print_fore_close()
	{

		$post_data = $this->input->post();
		$data['record'] = $this->reports->all_fore_close_rep_mod($post_data);
		$this->load->view('employee/reports/print_fore_close', $data);
	}

	public function showData()
	{
		$data = $this->input->post();
		$show_data = $this->reports->showData_mod($data);
		echo json_encode($show_data);
	}

	// ------------------------ fore close report section end --------------------------------

}
