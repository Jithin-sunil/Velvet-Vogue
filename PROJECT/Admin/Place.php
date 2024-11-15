
<?php
include('../Assets/connection/connection.php');
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$District=$_POST["sel_district"];
	$Place=$_POST["txt_place"];
	$Pincode=$_POST["txt_pincode"];
	$insqry="insert into tbl_place(place_name,place_pincode,district_id)values('".$Place."','".$Pincode."','".$District."')";
     if($con->query($insqry))
	{
	?>
    <script>
	alert('inserted');
	window.loction="Adminreg.php";
	</script>
    <?php
	}

}
if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_place where place_id='".$_GET["delID"]."'";
    if($con->query($delQry))
	{
				?>
                <script>
				alert('Deleted');
				window.location="Place.php";
				</script>
                <?php
	}
}




?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Styled Form</title>
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
      <th>District</th>
      <td>
        <label for="sel_district"></label>
        <select name="sel_district" id="sel_district">
        <option>--Select--</option>
         <?php
        $sel="select * from tbl_district";
        $row=$con->query($sel);
        while($data=$row->fetch_assoc()) {
        ?>
        <option value="<?php echo $data['district_id'] ?>"><?php echo $data['district_name'] ?></option>
        <?php
        }
        ?>
      </select></td>
    </tr>
    <tr>
      <th>Place</th>
      <td>
        <label for="txt_place"></label>
        <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $placeid?>" />
        <input type="text" name="txt_place" id="txt_place" />
      </td>
    </tr>
    <tr>
      <th>Pincode</th>
      <td>
        <label for="txt_pincode"></label>
        <input type="text" name="txt_pincode" id="txt_pincode" />
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div>
          <input type="submit" name="btn_submit" id="Submit" value="Save" />
          <input type="reset" name="btn_cancel" id="btn_cancel" value="Cancel" />
        </div>
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table>
    <tr>
      <th>SNo</th>
      <th>District</th>
      <th>Place</th>
      <th>Pincode</th>
      <th>Action</th>
    </tr>
     <?php
        $i=0;
        $sel="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
        $row=$con->query($sel);
        while($data=$row->fetch_assoc()) {
        $i++;
        ?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['district_name']?></td>
      <td><?php echo $data['place_name']?></td>
      <td><?php echo $data['place_pincode']?></td>
      <td><a href="Place.php?delID=<?php echo $data['place_id']?>">Delete</a></td>
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


