<?php 
include('../Connection/Connection.php');
$sel="select * from tbl_services where service_id=".$_GET['did'];
$res=$con->query($sel);
$data=$res->fetch_assoc();
echo $data['service_rate']
?>
