																			
<?php
include('../Assets/connection/connection.php');
include("sessionValidation.php");
if(isset($_POST["btn_reg"]))
ob_start();
include("Head.php");
{
	$ais=$_POST["txt_name"];
	$aie=$_POST["txt_Email"];
	$aip=$_POST["txt_Password"];
	$aid=$_POST['txt_hidden'];
	if($aid=="")
	{
		
	$insqry="insert into tbl_admin(admin_name,admin_email,admin_password)values('".$ais."','".$aie."','".$aip."')";
     if($con->query($insqry))
	{
		?>
        <script>
		alert('inserted');
		window.location="AdminRegistration.php";
		</script>
        <?php
	}
}
else
{
	 $upqry="update tbl_admin set admin_name='".$ais."',admin_email='".$aie."',admin_password='".$aip."' Where admin_id='".$aid."'";
if($con->query($upqry))
{
	?>
    <script>
	alert('Update');
	window.location="AdminRegistration.php";
	</script>
    <?php
}
}
}

		if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_admin where admin_id='".$_GET["delID"]."'";
    if($con->query($delQry))
	{
		?>
 <script>
				alert('Deleted');
				window.location="AdminRegistration.php";
				</script>
                <?php
}
}
$aid="";
$ais="";
$aie="";
$aip="";
if(isset($_GET['eid']))
{
	$selEdit="select * from tbl_admin where admin_id ='".$_GET['eid']."'";
	$resEdit=$con->query($selEdit);
	$datEdit=$resEdit->fetch_assoc();
	$aid=$datEdit['admin_id'];
	$ais=$datEdit['admin_name'];
	$aie=$datEdit['admin_email'];
	$aip=$datEdit['admin_password'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="340" border="1">
   
    <tr>
      <td>Name</td>
      <td><input required type="text" name="txt_name" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$"/></td>
      <td><label for="txt_name"></label>
      
       <input type="text" name="txt_name" id="txt_name" value="<?php  echo $ais ?>"/>
      
       <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $aid ?>"/></td> 
     
      
    </tr>
    
    <tr>
      <td>Email</td>
      <td><label for="txt_Email"></label>
      <input type="text"  required name="txt_Email" id="txt_Email" value="<?php echo $aie ?>"/></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_Password"></label>
      <input type="password" name="txt_Password" id="txt_Password" value="<?php echo $aip ?>"/></td>
      <td><input type="text" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="txt_pass" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_reg" id="btn_reg" value="Register" />
        <label for="txt_Register"></label>
       </td>
    </tr>
  </table>
  <p>&nbsp;</p>

<table width="200" border="1">
  <tr>
    <td>#</td>
    <td>Name</td>
    <td>Email</td>
    <td>Password</td>
    <td>Action</td>
  </tr>
  
   <?php
	$i=0;
	$sel="select * from tbl_admin";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
      
  <tr>
   <td><?php echo $i?></td>
      <td><?php echo $data['admin_name']?></td>
      <td><?php echo $data['admin_email']?></td>
      <td><?php echo $data['admin_password']?></td>
      <td><a href="AdminRegistration.php?delID=<?php echo $data['admin_id']?>">Delete </a> || <a href="AdminRegistration.php?eid=<?php echo $data['admin_id']?>">Edit</a></td>
      
      
    </tr>
    <?php
	}
	?>
</table>
</form>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>  						
