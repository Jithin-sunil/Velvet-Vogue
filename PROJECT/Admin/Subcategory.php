
<?php
include('../Assets/connection/connection.php');
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$category=$_POST["sel_category"];
	$subcategory=$_POST["txt_subcategory"];
	$insQry="insert into tbl_subcategory(subcategory_name,category_id)values('".$subcategory."','".$category."')";
	 if($con->query($insQry))
	{
	?>
    <script>
	alert('inserted');
	window.loction="Subcategory.php";
	</script>
    <?php
	}

	if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_subcategory where subcategory_id='".$_GET["delID"]."'";
    if($con->query($delQry))
	{
				?>
                <script>
				alert('Deleted');
				window.location="Subcategory.php";
				</script>
                <?php
}
}
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subcategory Management</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: lavender;
        color: #333;
    }

    form {
        margin: 50px auto;
        padding: 20px;
        width: 50%; /* Reduced form width */
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 60%; /* Reduced table width */
        margin: 0 auto; /* Center the table */
        border-collapse: collapse;
        text-align: left;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th, td {
        padding: 6px; /* Reduced padding for cells */
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

    input[type="text"], select, input[type="submit"] {
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
        <select name="sel_category" id="sel_category">
          <option>--Select--</option>
          <?php
          $sel = "select * from tbl_category";
          $row = $con->query($sel);
          while ($data = $row->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['category_id'] ?>"><?php echo $data['category_name'] ?></option>
          <?php
          }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>SubCategory</td>
      <td><input type="text" name="txt_subcategory" id="txt_subcategory" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
      </td>
    </tr>
  </table>
</form>

<form id="form2" name="form2" method="post" action="">
  <table>
    <tr>
      <th>Sl.No</th>
      <th>Category</th>
      <th>Subcategory</th>
      <th>Action</th>
    </tr>
    <?php
    $i = 0;
    $sel = "select * from tbl_subcategory p inner join tbl_category d on p.category_id = d.category_id";
    $row = $con->query($sel);
    while ($data = $row->fetch_assoc()) {
      $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['category_name'] ?></td>
      <td><?php echo $data['subcategory_name'] ?></td>
      <td><a href="Subcategory.php?delID=<?php echo $data['category_id'] ?>">Delete</a></td>
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
