<?php
$result='';
if(isset($_POST['btn_Add']))
{
	$no1=$_POST['txt_num1'];
	$no2=$_POST['txt_no2'];
	$result=$no1+$no2;
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
      <td>No1</td>
      <td><label for="txt_num1"></label>
      <label for="txt_no2"></label></td>
    </tr>
    <tr>
      <td>No2</td>
      <td>
      <input type="text" name="txt_no2" id="txt_no2" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_Add" id="btn_Add" value="+" /></td>
    </tr>
    <tr>
      <td >Result</td>
      <td><?php echo $result ?></td>
    </tr>
  </table>
  <input type="text" name="txt_num1" id="txt_num1" />
</form>
</body>
</html>