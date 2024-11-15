<?php
include('../Assets/connection/connection.php');
if(isset($_POST["btn_submit"]))
{
	$brandname=$_POST["txt_brandname"];
	$insqry="insert into tbl_brand(brand_name)values('".$brandname."')";
     if($con->query($insqry))
	{
	?>
    <script>
	alert('inserted');
	window.loction="brand.php";
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
      <td>Brandname</td>
      <td><label for="txt_brandname"></label>
      <input type="text" name="txt_brandname" id="txt_brandname" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>