<?php
include('../connection/connection.php');
$sel="select * from tbl_place where district_id='".$_GET['did']."'";
$row=$con->query($sel);
while($data=$row->fetch_assoc())
{
	?>
	<option value="<?php echo $data["place_id"]?>">
    <?php
	echo $data["place_name"]?></option>
    <?php
}
?>
