<?php
include('../Assets/connection/connection.php');
include("Head.php");
// include("SessionValidation.php");
if(isset($_POST["btn_submit"]))
{
	
	$product=$_POST["txt_product"];
	$details=$_POST["txt_details"];
	$price=$_POST["txt_price"];
	$brand=$_POST["sel_brand"];
	$subcategory=$_POST["sel_subcategory"];
	$photo=$_FILES['file_photo']['name'];
	$temp=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/product/'.$photo);
	
		  $insQry="insert into	tbl_product(product_name,product_details,product_price,product_photo,subcategory_id,brand_id) values('".$product."','".$details."','".$price."','".$photo."','".$subcategory."','".$brand."')";
		if($con->query($insQry))
		
	{
		?>
		<script>
		alert("inserted")
		window.location="ManageProduct.php"
		</script>
		<?php
	}
}
	
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Manage Product</title>
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

    select, input[type="text"], input[type="file"], input[type="submit"], input[type="reset"] {
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

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table>
    <tr>
      <td>Product</td>
      <td><input type="text" name="txt_product" id="txt_product" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required/></td>
    </tr>
    <tr>
      <td>Brand</td>
      <td>
        <select name="sel_brand" id="sel_brand" required>
          <option>--select--</option>
          <?php
            $sel="select * from tbl_brand";
            $row=$con->query($sel);
            while($data=$row->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['brand_id']?>"><?php echo $data['brand_name']?></option>
          <?php
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Details</td>
      <td><input type="text" name="txt_details" id="txt_details" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required/></td>
    </tr>
    <tr>
      <td>Price</td>
      <td><input type="text" name="txt_price" id="txt_price"  minlength="2" maxlength="5" pattern="^\d+$" title="Please enter a valid price (e.g., 100)" required/></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr>
      <td>Category</td>
      <td>
        <select name="sel_category" id="sel_category" onChange="getSubcategory(this.value)">
          <option>--select--</option>
          <?php
            $sel="select * from tbl_category";
            $row=$con->query($sel);
            while($data=$row->fetch_assoc()) {
          ?>
          <option value="<?php echo $data['category_id']?>"><?php echo $data['category_name']?></option>
          <?php
            }
          ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Sub Category</td>
      <td>
        <select name="sel_subcategory" id="sel_subcategory">
          <option>-----select----</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <div>
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </div>
      </td>
    </tr>
  </table>
</form>

<table>
  <tr>
    <th>SI.NO</th>
    <th>Photo</th>
    <th>Product</th>
    <th>Details</th>
    <th>Category</th>
    <th>Sub Category</th>
   
    <th>Action</th>
  </tr>
  <?php
    $i=0;
       $sel="select * from tbl_product p inner join tbl_subcategory s on p.subcategory_id=s.subcategory_id inner join tbl_category c on s.category_id=c.category_id";
    $row=$con->query($sel);
    while($data=$row->fetch_assoc()) {
      $i++;
     


  ?>
  <tr>
    <td><?php echo $i ?></td>
    <td><img src="../Assets/Files/product/<?php echo $data['product_photo']?>" Width="50" height="50"/></td>
    <td><?php echo $data['product_name'] ?></td>
    <td><?php echo $data['product_details'] ?></td>
    <td><?php echo $data['category_name'] ?></td>
    <td><?php echo $data['subcategory_name'] ?></td>
    
    <td>
      <a href="ManageProduct.php?delID=<?php echo $data['product_id']?>">Delete</a> ||
      <a href="ManageStock.php?pid=<?php echo $data['product_id']?>">Add</a>
    </td>
  </tr>
  <?php
    }
  
  ?>
</table>

</body>
</html>
<?php
include("Foot.php");
ob_flush();
?>  



 <script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getSubcategory(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxSubcategory.php?did=" + did,
      success: function (result) {

        $("#sel_subcategory").html(result);
      }
    });
  }

</script>