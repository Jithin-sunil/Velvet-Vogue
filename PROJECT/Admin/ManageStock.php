<?php
include('../Assets/connection/connection.php');
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$Quantity=$_POST["txt_quantity"];
	
	$insqry="insert into tbl_stock(stock_quantity,stock_date,product_id)values('".$Quantity."',curdate(),'".$_GET['pid']."')";
     if($con->query($insqry))
		{
		?>
        <script>
	alert('inserted');
	window.location="ManageStock.php?pid=<?php echo $_GET['pid'] ?>";
	</script>
    <?php
		}

	}


if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_stock where stock_id='".$_GET["delID"]."'";
    if($con->query($delQry))
	{
				?>
                <script>
				alert('Deleted');
				window.location="ManageStock.php";
				</script>
                <?php
	}
}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Stock</title>
</head><style>
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

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table width="200" border="1">
      <tr>
        <td>Quantity</td>
        <td><label for="txt_quantity"></label>
        <input type="text" name="txt_quantity" id="txt_quantity" /></td>
      </tr>
      <tr>
        <td><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <table width="200" border="1">
      <tr>
        <td>SI.NO</td>
        <td>Quantity</td>
        <td>Date</td>
        <td>Action</td>
      </tr>
      <tr>
      <?php
	$i=0;
	$sel="select * from tbl_stock";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
       
      
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['stock_quantity']?></td>
        <td><?php echo $data['stock_date']?></td>
      <td><a href="stock.php?delID=<?php echo $data['stock_id']?>">Delete</a>
      </td>
    </tr>
    <?php
	}
	?>
    </table>
  </div>
</form>
</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>  


