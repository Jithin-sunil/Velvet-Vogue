<?php
include('../Assets/connection/connection.php');
include("Head.php");
if(isset($_POST["btn_submit"]))

{
	$service=$_POST["txt_service"];
	$amount=$_POST["txt_amount"];
	// $category=$_POST["category_id"];
	$details=$_POST["txt_details"];
	$duration=$_POST["txt_duration"];
	
	
		
	$insqry="insert into tbl_services(service_name,service_rate,service_details,service_duration)values('".$service."','".$amount."','".$details."','".$duration."')";
     if($con->query($insqry))
	{
		?>
        <script>
		alert('inserted');
		window.location="Servicies.php";
		</script>
        <?php

	}
}
if(isset($_GET["delID"]))
{
	$delqry="delete from tbl_services where service_id=".$_GET["delID"];
	if($con ->query($delqry))
	{
		?>
        <script>
		alert('deleted')
		window.location="Servicies.php";
		</script>
        <?php
	}
}
?>

	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Service Management</title>
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
      <td>Service Name</td>
      <td>
        <label for="txt_service"></label>
        <input type="text" name="txt_service" id="txt_service" />
      </td>
    </tr>
    <tr>
      <td>Service Amount</td>
      <td>
        <label for="txt_amount"></label>
        <input type="text" name="txt_amount" id="txt_amount" />
      </td>
    </tr>
    <tr>
      <td>Service Details</td>
      <td>
        <label for="txt_details"></label>
        <textarea name="txt_details" id="txt_details" rows="4"></textarea>
      </td>
    </tr>
    <tr>
      <td>Service Duration</td>
      <td>
        <label for="txt_duration"></label>
        <input type="text" name="txt_duration" id="txt_duration" />
      </td>
    </tr>
    
    <tr>
      <td colspan="2" class="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </td>
    </tr>
  </table>
</form>

<form id="form2" name="form2" method="post" action="">
<table>
    <tr>
        <th>Sl.No</th>
        <th>Service</th>
        <th>Amount</th>
        <th>Service Details</th>
        <th>Service Duration</th>
        <th>Category</th>
        <th>Action</th>
    </tr>
    <?php
    $i = 0;
    $sel = "SELECT * FROM tbl_services s INNER JOIN tbl_category c ON s.category_id = c.category_id";
    $row = $con->query($sel);
    while ($data = $row->fetch_assoc()) {
        $i++;
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data['service_name']; ?></td>
        <td><?php echo $data['service_rate']; ?></td>
        <td><?php echo $data['service_details']; ?></td>
        <td><?php echo $data['service_duration']; ?></td>
        <td><?php echo $data['category_name']; ?></td>
        <td>
            <a href="Servicies.php?delID=<?php echo $data['service_id']; ?>">Delete</a>
            <a href="ServiceGallery.php?gid=<?php echo $data['service_id']?>">Work Gallery</a>
            
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

?>  						
