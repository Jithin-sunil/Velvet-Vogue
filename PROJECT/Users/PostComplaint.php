<?php
include('../Assets/connection/connection.php');
ob_start();
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$product=$_GET['pid'];
	$photo=$_FILES['sel_file']['name'];
	$temp=$_FILES['sel_file']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/product/'.$photo);
	$title=$_POST["txt_title"];
	$discreption=$_POST["txt_discreption"];
	
	$insqry="insert into tbl_complaint(complaint_title,complaint_file,complaint_descrption,complaint_date,product_id,customer_id)values('".$title."','".$photo."','".$discreption."',curdate(),'".$product."','".$_SESSION['cid']."')";
     if($con->query($insqry))
	{
		?>
        <script>
		alert('complaint posted');
		window.location="PostComplaint.php";
		</script>
        <?php
	
	}
}

	
	?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post Complaints</title>
<style>
    body {
        background-color: white;
        color: #333;
        font-family: Arial, sans-serif;
    }

    .containers {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 50px auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        padding: 15px;
        text-align: left;
    }

    input[type="text"], 
    input[type="file"], 
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #F9A392;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    textarea {
        resize: vertical;
    }

    input[type="submit"] {
        background-color: #F9A392;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #f7876f;
    }

    .text-center {
        text-align: center;
    }
</style>
</head>

<body>

<div class="container">
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <table>
            <tr>
                <td><label for="txt_title">Title</label></td>
                <td><input type="text" name="txt_title" id="txt_title" /></td>
            </tr>
            <tr>
                <td><label for="sel_file">File</label></td>
                <td><input type="file" name="sel_file" id="sel_file" /></td>
            </tr>
            <tr>
                <td><label for="txt_discreption">Description</label></td>
                <td><textarea name="txt_discreption" id="txt_discreption" cols="45" rows="5"></textarea></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>  