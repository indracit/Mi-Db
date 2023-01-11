<?php
header("Access-Control-Allow-Origin: *");
session_start();
ini_set('max_execution_time', 30000000);
define('WP_MEMORY_LIMIT', '20000M');

require 'dc.php';
$db_connection = new Database();
$link_fistack = $db_connection->dbConnection();

// ===================================== ECORP MASTER ================================

if ($_POST['type'] == 'ALB_BCMASTER')
{
$sql ="SELECT 'eALLA' AS bank,
b.agentcode AS  id_terminal_info,
concat('eALLA',b.agentcode) AS id_customer_info,
b.branchcode,
b.Branchname,
b.state,
b.zonalname,
b.Roname,
''  circle,
b.district,
''  mandal,
''  gram_panchayat,
b.agentcode as agentcode,
b.agentcode as agentid,
b.cbsterminalid,
'' as terminal_status,
''  terminal_sl_no,
b.accountnumber,
''  bc_corporate_accno,
''  bc_carded_accno,
''  bc_card_id,
b.aadhaarnumber,
b.pannumber,
b.personalaccountno,
b.firstname,
''  appointed_date,
b.pin,
b.villagename,
b.AGENTTYPE type_of_bc,
b.mobilenumber,
'' bc_status,
'' as aadhaar_logon,
(CASE WHEN agent_status='3' THEN 'ACTIVE' WHEN agent_status='4' THEN 'BLOCKED' WHEN agent_status='5' THEN 'RESIGNED' END) bc_status1,
'ACTIVE' location_status,
b.villagecode,
b.remark,
b.modified_on,
b.vendorname,
'' type_of_location,
'' location_type,
''  mode_of_transaction,
''  bc_fp,
first_txn_time AS first_session_started_on,
last_txn_time AS last_session_started_on,
last_txn_time AS last_session_closed_on,
''  total_cust_cards,
''  total_active_cards,
''  migrated_cust_cards,
''  transacted_customers,
''  cust_cards_with_fp,
''  trans_cust_with_fp,
first_txn_time AS first_txn_date,
last_txn_time AS last_txn_date,
''  AS sweep_txn,
''  AS sweep_amt,
'' total_txn,
'' txn_amount,
'' scot_txn,
'' ifis_txn,
'' rupay_txn,
'' aeps_txn,
'' offline_txn,
'' total_cr_txn,
'' total_dr_txn,
'' total_cr_amt,
'' total_dr_amt,
'' scot_amt,
'' ifis_amt,
'' rupay_amt,
'' aeps_amt,
'' offline_amt,
'' total_error_count,
'' total_error_amt,
'' total_alert_txn_count,
'' total_alert_txn_amt,
'' fund_transfer_txn,
'' fund_transfer_amt,
'' bc_migrated,
''  migrated_on,
'' bc_id,
'' bca_id,
'' interface_,
'' terminal_application,
'' bccCode,
'' out_side_link,
'' sim_no,
'' atm_tid,
'' cbs_tid,
'' census_code,
'' po_no,
'' po_date,
'' hhm_deliver,
'' hhm_delivery_date,
'' inv_no,
'' inv_date,
'' service_provider,
'' supervisor_name,
b.created_on inserted_on,
'' last_updated_on,
'' rpt_exported_on,
FCCODE,
FCNAME,
BANKCODE
FROM  mis_agentmaster b 
LEFT JOIN mis_txn_report_bcwise_datewise c ON b.agentcode = c.AgentCode AND date(Transaction_Time)='".$_POST['txndate']."'
WHERE vendorname='INTEGRA' " ;
	
	$stmt = $link_fistack->prepare($sql); 
	$stmt->execute();
	$record = $stmt->fetchAll(PDO::FETCH_NUM);
	
	
	foreach ($record as $row => $data)
	{
	if($data)
     {
		$data1=[];
		foreach(range(0,$stmt->columnCount() - 1)as $column_index)
		{
		$data1[]=($data[$column_index]);  
		}
		$arr[]=$data1;
     }
    } 
echo json_encode($arr); 
}



//--------------------------------------TRANSACTION--------------------------------------------------------------*/

if ($_POST['type'] == 'ALB_BCTXN')
{
$sql ="
SELECT 'EALLA' AS bank,date(Transaction_Time),concat('EALLA',a.AgentCode) AS id_customer_info,
CASE WHEN txn_cnt NOT IN('0') THEN a.AgentCode ELSE '0' END AS id_terminal_info,'0' AS cust_cards,
'0' AS sweep_txn,
'0' AS  sweep_amt,
fin_success_cnt AS txn_cnt,
fin_success_amt AS txn_amt,
'0' AS scot_txn,
fin_success_ifis_cnt AS ifis_txn,
fin_success_rupay_onus_cnt+fin_success_rupay_offus_cnt AS rupay_txn,
fin_success_aeps_onus_cnt+fin_success_aeps_offus_cnt AS aeps_txn,
success_ft_cnt AS fund_transfer_txn,
'0' AS offline_txn,success_cr_cnt AS total_cr_txn,success_dr_cnt AS total_dr_txn,success_cr_amt AS total_cr_amt,success_dr_amt AS total_dr_amt,'0' AS scot_amt,'0' AS scot_cr_txn,
'0' AS scot_cr_amt,'0' AS scot_dr_txn,'0' AS scot_dr_amt,fin_success_ifis_amt AS ifis_amt,fin_success_ifis_cr_cnt AS ifis_cr_txn,fin_success_ifis_cr_amt AS ifis_cr_amt,
fin_success_ifis_dr_cnt AS ifis_dr_txn,fin_success_ifis_dr_amt AS ifis_dr_amt,fin_success_rupay_onus_amt+fin_success_rupay_offus_amt AS rupay_amt,fin_success_rupay_onus_cr_cnt+fin_success_rupay_offus_cr_cnt AS rupay_cr_txn,fin_success_rupay_onus_cr_amt+fin_success_rupay_offus_cr_amt AS rupay_cr_amt,fin_success_rupay_onus_dr_cnt+fin_success_rupay_offus_dr_cnt AS rupay_dr_txn,fin_success_rupay_onus_dr_amt+fin_success_rupay_offus_dr_amt AS rupay_dr_amt,fin_success_aeps_onus_amt+fin_success_aeps_offus_amt AS aeps_amt,
fin_success_aeps_onus_cr_cnt+fin_success_aeps_offus_cr_cnt AS aeps_cr_txn,fin_success_aeps_onus_cr_amt+fin_success_aeps_offus_cr_amt AS aeps_cr_amt,fin_success_aeps_onus_dr_cnt+fin_success_aeps_offus_dr_cnt AS aeps_dr_txn,fin_success_aeps_onus_dr_amt+fin_success_aeps_offus_dr_amt AS aeps_dr_amt,success_ft_amt AS fund_transfer_amt,'0' AS offline_amt,'0' AS offline_cr_txn,
'0' AS offline_cr_amt,'0' AS offline_dr_txn,'0' AS offline_dr_amt,
''  AS aadhaar_login, NOW() AS exported_on,

IFNULL((unique_txn_cust_count),'0') AS unique_txn_cust_count,
IFNULL(accom_txn_count,'0') AS accom_txn_count,
IFNULL(accom_txn_amt,'0.00') AS accom_txn_amt,
IFNULL(self_txn,'0') AS self_txn,
IFNULL(self_txn_amt,'0.00') AS self_txn_amt,
IFNULL(split_txn,'0') AS split_txn,
IFNULL(split_txn_amt,'0.00') AS split_txn_amt,
IFNULL(accom_ft_cnt,'0') AS accom_ft_cnt,
IFNULL(accom_ft_amt,'0.00') AS accom_ft_amt,
IFNULL(balance_zero,'0') AS balance_zero,
IFNULL(balance_zero_amt,'0.00') AS balance_zero_amt,
'0' as imps_count,
'0.00' as imps_amt,
IFNULL((`fin_success_aeps_onus_cnt`),'0')+IFNULL((`fin_success_rupay_onus_cnt`),'0') onus_txn_count,
IFNULL(`fin_success_aeps_onus_amt`,'0.00')+IFNULL(`fin_success_rupay_onus_amt`,'0.00') onus_txn_amt,
IFNULL((`fin_success_aeps_offus_cnt`),'0')+IFNULL((`fin_success_rupay_offus_cnt`),'0') offus_txn_count,
IFNULL(`fin_success_aeps_offus_amt`,'0.00')+IFNULL(`fin_success_rupay_offus_amt`,'0.00') offus_txn_amt,
IFNULL((`fin_success_aeps_onus_cnt`),'0') AS aeps_onus_count,
IFNULL((`fin_success_aeps_offus_cnt`),'0') AS aeps_offus_count,
IFNULL(`fin_success_aeps_onus_amt`,'0.00') AS aeps_onus_amt,
IFNULL(`fin_success_aeps_offus_amt`,'0.00') AS aeps_offus_amt,
IFNULL((`fin_success_rupay_onus_cnt`),'0') AS rupay_onus_count,
IFNULL((`fin_success_rupay_offus_cnt`),'0') AS rupay_offus_count,
IFNULL(`fin_success_rupay_onus_amt`,'0.00') AS rupay_onus_amt,
IFNULL(`fin_success_rupay_offus_amt`,'0.00') AS rupay_offus_amt,
IFNULL((`tpd_success_cnt`),'0') AS tpd_txn_count,
IFNULL(`tpd_success_amt`,'0.00') AS tpd_txn_amt,
IFNULL(BBPS_txn_cnt,'0') AS bbps_txn,
IFNULL(BBPS_txn_amt,'0.00') AS bbps_amt,
'0' AS shg_txn,
'0.00' AS shg_amt,
'0' AS shg_cr_txn,
'0.00' AS shg_cr_amt,
'0' AS shg_dr_txn,
'0.00' AS shg_dr_amt,
'0' as imps_cr_txn,
'0.00' imps_cr_amt,
fin_success_cnt AS total_fin_txn,
fin_success_amt AS total_fin_amt,
IFNULL((bal_enq_cnt)+(mini_stmt_cnt),'0') AS total_nonfin_cnt,
IFNULL((fin_success_aeps_onus_cr_cnt),'0') AS aeps_onus_cr_cnt ,
IFNULL((fin_success_aeps_onus_cr_amt),'0.00') AS aeps_onus_cr_amt ,
IFNULL((fin_success_aeps_onus_dr_cnt),'0') AS aeps_onus_dr_cnt ,
IFNULL((fin_success_aeps_onus_dr_amt),'0.00') AS aeps_onus_dr_amt ,
IFNULL((fin_success_aeps_onus_ft_cnt),'0') AS aeps_onus_ft_cnt ,
IFNULL((fin_success_aeps_onus_ft_amt),'0.00') AS aeps_onus_ft_amt ,
IFNULL((fin_success_aeps_offus_cr_cnt),'0') AS aeps_offus_cr_cnt ,
IFNULL((fin_success_aeps_offus_cr_amt),'0.00') AS aeps_offus_cr_amt ,
IFNULL((fin_success_aeps_offus_dr_cnt),'0') AS aeps_offus_dr_cnt ,
IFNULL((fin_success_aeps_offus_dr_amt),'0.00') AS aeps_offus_dr_amt ,
IFNULL((fin_success_aeps_offus_ft_cnt),'0') AS aeps_offus_ft_cnt ,
IFNULL((fin_success_aeps_offus_ft_amt),'0.00') AS aeps_offus_ft_amt ,
IFNULL((fin_success_rupay_onus_cr_cnt),'0') AS rupay_onus_cr_cnt ,
IFNULL((fin_success_rupay_onus_cr_amt),'0.00') AS rupay_onus_cr_amt ,
IFNULL((fin_success_rupay_onus_dr_cnt),'0') AS rupay_onus_dr_cnt ,
IFNULL((fin_success_rupay_onus_dr_amt),'0.00') AS rupay_onus_dr_amt ,
IFNULL((fin_success_rupay_offus_cr_cnt),'0') AS rupay_offus_cr_cnt ,
IFNULL((fin_success_rupay_offus_cr_amt),'0.00') AS rupay_offus_cr_amt ,
IFNULL((fin_success_rupay_offus_dr_cnt),'0') AS rupay_offus_dr_cnt ,
IFNULL((fin_success_rupay_offus_dr_amt),'0.00') AS rupay_offus_dr_amt ,
IFNULL((unique_txn_cust_count),'0') AS unique_txn_cust_count,
IFNULL((bal_enq_cnt),'0')  AS total_be_txn,
IFNULL((mini_stmt_cnt),'0') AS total_mini_stmt_txn,
IFNULL((nonfin_success_aeps_onus_cnt+nonfin_fail_aeps_onus_cnt),'0') AS aeps_onus_non_fin ,
IFNULL((nonfin_success_aeps_onus_bal_cnt+nonfin_fail_aeps_onus_bal_cnt),'0') AS aeps_onus_bal_enq ,
IFNULL((nonfin_success_aeps_onus_mini_cnt+nonfin_fail_aeps_onus_mini_cnt),'0') AS aeps_onus_mini_stmt ,
IFNULL((nonfin_success_aeps_offus_cnt+nonfin_fail_aeps_offus_cnt),'0') AS aeps_offus_non_fin ,
IFNULL((nonfin_success_aeps_offus_bal_cnt+nonfin_fail_aeps_offus_bal_cnt),'0') AS aeps_offus_bal_enq ,
IFNULL((nonfin_success_aeps_offus_mini_cnt+nonfin_fail_aeps_offus_mini_cnt),'0') AS aeps_offus_mini_stmt ,
IFNULL((nonfin_success_rupay_onus_cnt+nonfin_fail_rupay_onus_cnt),'0') AS rupay_onus_non_fin ,
IFNULL((nonfin_success_rupay_onus_bal_cnt+nonfin_fail_rupay_onus_bal_cnt),'0') AS rupay_onus_bal_enq ,
IFNULL((nonfin_success_rupay_onus_mini_cnt+nonfin_fail_rupay_onus_mini_cnt),'0') AS rupay_onus_mini_stmt ,
IFNULL((nonfin_success_rupay_offus_cnt+nonfin_fail_rupay_offus_cnt),'0') AS rupay_offus_non_fin ,
IFNULL((nonfin_success_rupay_offus_bal_cnt+nonfin_fail_rupay_offus_bal_cnt),'0') AS rupay_offus_bal_enq ,
IFNULL((nonfin_success_rupay_offus_mini_cnt+nonfin_fail_rupay_offus_mini_cnt),'0') AS rupay_offus_mini_stmt

FROM mis_txn_report_bcwise_datewise a
LEFT JOIN (
SELECT DATE(TransactionTime) AS date_,agentcode,IFNULL(COUNT(SerialNo),0) AS BBPS_txn_cnt, IFNULL(SUM(Amount),0) AS BBPS_txn_amt
FROM bbps_txnsummary b
WHERE (DATE(TransactionTime)='".$_POST['txndate']."') AND
Payment_Status='SUCCESS' AND VendorID='17'
GROUP BY b.agentcode,date_
) b ON b.agentcode= a.agentcode AND b.date_=Transaction_Time
LEFT JOIN mis_agentmaster c ON c.agentcode = a.agentcode
WHERE (DATE(Transaction_Time)='".$_POST['txndate']."') and vendor_name='INTEGRA'";
//echo $sql;
	$stmt = $link_fistack->prepare($sql); 
	$stmt->execute();
	$record = $stmt->fetchAll(PDO::FETCH_NUM); //print_r($record );
	
	
	foreach ($record as $row => $data)
	{
	if($data)
     {
		$data1=[];
		foreach(range(0,$stmt->columnCount() - 1)as $column_index)
		{
		$data1[]=($data[$column_index]);  
		}
		$arr[]=$data1;
     }
	} 
echo json_encode($arr);
}

?>
