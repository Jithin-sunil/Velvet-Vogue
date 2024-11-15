<?php
session_start();
include('../Assets/connection/connection.php');

if(isset($_POST["btn_Login"]))
{
	$Email=$_POST['txt_email'];
	$Password=$_POST['txt_password'];
	
	$cus="select * from tbl_customerregistration where customer_email='".$Email."' and customer_password='".$Password."'";
	$rowuser=$con->query($cus);
	
	if($datauser=$rowuser->fetch_assoc())
	{
		$_SESSION['cid']=$datauser['customer_id'];
		header('location:../Users/Homepage.php');
	}
	else if($datauser=$rowuser->fetch_assoc())
	{
		
	  $_SESSION['aid']=$datauser['admin_id'];
	  header('location:../Admin/Homepage.php');
	}
	else
	{
		?>
        <script>
		alert('invalid data')
		window.location="login.php";
		</script>
        <?php
	}
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
  <table width="200" border="1">
    <tr>
      <td width="123">Email</td>
      <td width="61"><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_Login" id="btn_Login" value="Login" />
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>