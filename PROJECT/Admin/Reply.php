<?php
include('../Assets/connection/connection.php');
include("Head.php");
if(isset($_POST["btn_Submit"]))
{
	$reply=$_POST['txt_reply'];
	
	 $upqry="update tbl_complaint   set complaint_reply='".$reply."' ,complaint_status='1' Where complaint_id=".$_GET['id'];	

if($con->query($upqry))
{
	?>
    <script>
	alert('Update');
	window.location="Reply.php";
	</script>
    <?php
}
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reply Management</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: lavender;
        margin: 0;
        padding: 0;
    }

    form {
        margin: 50px auto;
        padding: 20px;
        width: 50%;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid lavender;
    }

    th, td {
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f0e5ff;
    }

    td {
        background-color: #faf7ff;
    }

    input[type="text"], input[type="submit"], input[type="reset"] {
        padding: 8px;
        width: 95%;
        margin: 5px 0;
        border: 1px solid lavender;
        border-radius: 5px;
    }

    input[type="submit"] {
        width: 45%;
        background-color: lavender;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #e0ccee;
    }

    td a {
        color: #5d3a7a;
        text-decoration: none;
        font-weight: bold;
    }

    td a:hover {
        text-decoration: underline;
    }

    div {
        text-align: center;
    }
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table>
    <tr>
      <td>Reply</td>
      <td><input type="text" name="txt_reply" id="txt_reply" /></td>
    </tr>
    <tr>
      <td colspan="2" class="center">
        <div>
          <input type="submit" name="btn_Submit" id="btn_Submit" value="Submit" />
        </div>
      </td>
    </tr>
  </table>
</form>
</body>
</html>
<?php
include("Foot.php");

?>  						

