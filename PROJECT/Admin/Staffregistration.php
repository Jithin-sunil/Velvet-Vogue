<?php

include('../Assets/connection/connection.php');
include("Head.php");
if(isset($_POST["btn_Register"]))
{
  $photo=$_POST['file_photo'];
	$Name=$_POST['txt_name'];
	$Gender=$_POST['radio'];
	$service=$_POST['sel_service'];
	
	$insqry="insert into tbl_staff( staff_photo,staff_name,staff_gender,service_id)values('".$photo."','".$Name."','".$Gender."','".$service."')";
     if($con->query($insqry))
	{
		?>
        <script>
		alert('inserted');
		window.location="Staffregistration.php";
		</script>
        <?php
	}
	
}
if(isset($_GET["delID"]))
{
	$delqry="delete from tbl_staff where staff_id=".$_GET["delID"];
	if($con ->query($delqry))
	{
		?>
        <script>
		alert('deleted')
		window.location="Staffregistration.php";
		</script>
        <?php
	}
}


?>

	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Staff Registration</title>
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

    select, input[type="text"], input[type="file"], input[type="submit"] {
        padding: 8px;
        width: 95%;
        margin: 5px 0;
        border: 1px solid lavender;
        border-radius: 5px;
    }

    input[type="radio"] {
        transform: scale(0.8); /* Reduces the size of the radio button */
        margin-right: 5px; /* Adds a bit of spacing after the button */
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
      <td>Photo</td>
      <td><input type="file" name="file_photo" id="file_photo" required /></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><input type="text" name="txt_name" id="txt_name" title="Name allows only alphabets, spaces, and first letter must be capitalized" pattern="^[A-Z]+[a-zA-Z ]*$" required /></td>
    </tr>
    <tr>
      <td>Gender</td>
      <td>
        <input type="radio" name="radio" id="btn_male" value="male" /> M
        <input type="radio" name="radio" id="btn_female" value="female" /> F
      </td>
    </tr>
    <tr>
      <td>Service</td>
      <td>
        <select name="sel_service" id="sel_service">
          <option>-----select-----</option>
          <?php
            $sel="select * from tbl_services";
            $row=$con->query($sel);
            while($data=$row->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['service_id']?>"><?php echo $data['service_name']?></option>
          <?php
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div>
          <input type="submit" name="btn_Register" id="btn_Register" value="Register" />
        </div>
      </td>
    </tr>
  </table>

  <table>
    <tr>
      <th>Sl. No</th>
      <th>Photo</th>
      <th>Name</th>
      <th>Gender</th>
      <th>Service</th>
      <th>Action</th>
    </tr>
    <?php
      $i=0;
      $sel="select * from tbl_staff s inner join tbl_services se on s.service_id=se.service_id";
      $row=$con->query($sel);
      while($data=$row->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i?></td>
      <td><img src="../Assets/Files/staff/<?php echo $data['staff_photo']?>" Width="50" height="50" /></td>
      <td><?php echo $data['staff_name']?></td>
      <td><?php echo $data['staff_gender']?></td>
      <td><?php echo $data['service_name']?></td>
      <td>
        <a href="Staffregistration.php?delID=<?php echo $data['staff_id']?>">Delete</a> ||
        <a href="Staffregistration.php?eid=<?php echo $data['staff_id']?>">Edit</a>
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

