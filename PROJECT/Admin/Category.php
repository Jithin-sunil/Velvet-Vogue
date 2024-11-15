<?php
include('../Assets/connection/connection.php');
include("Head.php");
$categoryname="";
$categoryid=0;

if(isset($_POST["btn_submit"]))

{
	$categoryid=$_POST["txt_hidden"];
	$Category=$_POST["txt_category"];
	if($categoryid==0)
	{
	

	$insqry="insert into tbl_category(category_name)values('".$Category."')";
     if($con->query($insqry))
	{
	?>
    <script>
	alert('inserted');
	window.loction="Category.php";
	</script>
    <?php
	}
	}

else{
	echo $updqry="update tbl_category set category_name='".$Category."' Where category_id=".$categoryid;	
	if($con->query($updqry))
		{
		?>
                <script>
				alert("update");
				window.location="Category.php";
				</script>
                <?php
		}
	}
}


if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_category where category_id='".$_GET["delID"]."'";
    if($con->query($delQry))
	{
		?>
                <script>
				alert('Deleted');
				window.location="Category.php";
				</script>
                <?php
}
}

if(isset($_GET['eid'])){
	$selEdit="select * from tbl_category where category_id=".$_GET['eid'];
	$resEdit=$con->query($selEdit);
	$datEdit=$resEdit->fetch_assoc();
	$categoryname=$datEdit['category_name'];
	$categoryid=$datEdit['category_id'];
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category Management</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: lavender;
        color: #333;
    }

    form {
        margin: 50px auto;
        padding: 20px;
        width: 60%; /* Reduced form width */
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 80%; /* Reduced table width */
        margin: 0 auto; /* Center the table */
        border-collapse: collapse;
        text-align: left;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 8px; /* Reduced padding for cells */
    }

    th {
        background-color: lavender;
        color: #333;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    a {
        text-decoration: none;
        color: #6a5acd; /* Lavender color */
        font-weight: bold;
    }

    a:hover {
        color: #483d8b; /* Darker lavender */
    }

    td {
        font-size: 14px;
    }

    input[type="text"], input[type="submit"] {
        padding: 8px;
        width: 95%;
        margin: 5px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    input[type="submit"] {
        background-color: lavender;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #d4bbee;
    }

    td a {
        color: #6a5acd;
        font-weight: bold;
        text-decoration: none;
    }

    td a:hover {
        color: #483d8b;
        text-decoration: underline;
    }
</style>
</head>

<body>

<form id="form1" name="form1" method="post" action="">
  <table>
    <tr>
      <td>Category</td>
      <td>
        <input type="text" name="txt_category" id="txt_category" value="<?php echo $categoryname ?>" />
        <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $categoryid ?>" />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </td>
    </tr>
  </table>
</form>

<form id="form2" name="form2" method="post" action="">
  <table>
    <tr>
      <th>#</th>
      <th>Category</th>
      <th>Action</th>
    </tr>
    <?php
    $i = 0;
    $sel = "select * from tbl_category";
    $row = $con->query($sel);
    while ($data = $row->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['category_name'] ?></td>
      <td>
        <a href="Category.php?delID=<?php echo $data['category_id'] ?>">Delete</a> || 
        <a href="Category.php?eid=<?php echo $data['category_id'] ?>">Edit</a>
      </td>
    </tr>
    <?php
    }
    ?>
  </table>
</form>

</body>
</html>
</html>
<?php
include("Foot.php");

?>  						

