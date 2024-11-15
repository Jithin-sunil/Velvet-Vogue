<?php
include('../Assets/connection/connection.php');
include("Head.php");
$distname="";
$distid="";
if(isset($_POST["btn_submit"]))
{
	$distid=$_POST['txt_id'];
	$district=$_POST["txt_district"];
	if($distid==""){
	$insqry="insert into tbl_district(district_name)values('".$district."')";
     if($con->query($insqry))
		{
		?>
        <script>
	alert('inserted');
	window.location="District.php";
	</script>
    <?php
		}

	}

else
{
	 $upqry="update tbl_district set district_name='".$district."' Where district_id='".$distid."'";
if($con->query($upqry))
{
	?>
    <script>
	alert('Update');
	window.location="District.php";
	</script>
    <?php
}
}
}
if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_district where district_id='".$_GET["delID"]."'";
    if($con->query($delQry))
	{
				?>
                <script>
				alert('Deleted');
				window.location="District.php";
				</script>
                <?php
	}
}



if(isset($_GET['eid'])){
	$selEdit="select * from tbl_district where district_id=".$_GET['eid'];
	$resEdit=$con->query($selEdit);
	$datEdit=$resEdit->fetch_assoc();
	$distname=$datEdit['district_name'];
	$distid=$datEdit['district_id'];


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District Management</title>
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

    select, input[type="text"], input[type="submit"], input[type="reset"] {
        padding: 8px;
        width: 95%;
        margin: 5px 0;
        border: 1px solid lavender;
        border-radius: 5px;
    }

    input[type="submit"], input[type="reset"] {
        width: 45%;
        background-color: lavender;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover, input[type="reset"]:hover {
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
    <td class="center"><p>District Name</p></td>
    <td>
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $distid ?>"/>
      <input type="text" name="txt_district" id="txt_district" value="<?php echo $distname?>" />
    </td>
  </tr>
  <tr>
    <td colspan="2" class="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
   </td>
  </tr>
</table>

<table>
  <tr>
    <th>#</th>
    <th>District</th>
    <th>Action</th>
  </tr>
  <?php
    $i=0;
    $sel="select * from tbl_district";
    $row=$con->query($sel);
    while($data=$row->fetch_assoc()) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i?></td>
    <td><?php echo $data['district_name']?></td>
    <td>
      <a href="District.php?delID=<?php echo $data['district_id']?>">Delete</a> ||
      <a href="District.php?eid=<?php echo $data['district_id']?>">Edit</a>
    </td>
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



