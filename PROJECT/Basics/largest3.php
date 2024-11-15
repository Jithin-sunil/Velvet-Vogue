<?php
$Largest="";
$smallest="";
if (isset($_POST["btn_submit"]))
{
	$a=$_POST["txt_num1"];
	$b=$_POST["txt_num2"];
	$c=$_POST["txt_num3"];
	{
		if($a>$c)
	
		$Largest=$a;
		else if($b>$c)
		$Largest=$b;
		else
		$Largest=$c;
	}
{
		
if($a<$c)
	
		$Smallest=$a;
		else if($b<$c)
		$Smallest=$b;
		else
		$Smallest=$c;
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
      <td>No1</td>
      <td><label for="txt_num1"></label>
      <input type="text" name="txt_num1" id="txt_num1" /></td>
    </tr>
    <tr>
      <td>No2</td>
      <td><label for="txt_num2"></label>
      <input type="text" name="txt_num2" id="txt_num2" /></td>
    </tr>
    <tr>
      <td>No3</td>
      <td><label for="txt_num3"></label>
      <input type="text" name="txt_num3" id="txt_num3" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
    <tr>
      <td>Largest</td>
      <td><?php echo $Largest ?>
      </td>
    </tr>
    <tr>
      <td>Smallest</td>
      <td><?php echo $Smallest ?></td>
    </tr>
  </table>
</form>
</body>
</html>