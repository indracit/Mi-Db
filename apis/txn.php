<?php
header("Access-Control-Allow-Origin: *");
session_start();
ini_set('max_execution_time', 300000);
define('WP_MEMORY_LIMIT', '20000M');

require 'dc.php';
$db_connection = new Database();
$link_fistack = $db_connection->dbConnection();




$sql ="select SerialNo,RRN,GatewayRRN,VendorID,RespToClient,Amount,ServiceName,ONUS,ServerTime from txn_txnsummary order by 1 desc limit 32" ;
	
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





?>
