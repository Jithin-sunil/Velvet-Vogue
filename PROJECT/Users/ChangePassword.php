<?php

include("../Assets/connection/connection.php");
ob_start();
include("Head.php");
if(isset($_POST["btn_change"]))
{
	$cus="select * from tbl_customerregistration where customer_id='".$_SESSION['cid']."'";
	$recustomer=$con->query($cus);
	$data=$recustomer->fetch_assoc();
	$dbpass=$data['customer_password'];
	$old=$_POST['txt_password'];
	$new=$_POST['txt_newpassword'];
	$re=$_POST['txt_retypepassword'];
	
	

if($dbpass==$old)
{
	if($new==$re)
	{
		$upQry="update tbl_customerregistration set customer_password='".$new."' where customer_id='".$_SESSION['cid']."'";
		if($con->query($upQry))
		{
			
			?>
			<script>
			 alert("Updated");
			 window.location="MyProfile.php";
			 </script>
			 <?php
		}
		else
		{
			?>
            <script>
			 alert("Error");
 
             </script>
			 <?php
		}
	}
	else
	{
		?>
        <script>
		alert("Mis Match")
		</script>
        <?php
	}
}
else
{
	?>
    <script>
	alert("Incorrect")
	</script>
    <?php
}
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: white;
            color: #333;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }

        .table-bordered td {
            border-color: #F9A392;
        }

        .table th,
        .table td {
            padding: 15px;
        }

        .text-center {
            text-align: center;
        }

        .btn-custom {
            background-color: #F9A392;
            color: white;
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-custom:hover {
            background-color: #f7876f;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered">
                <tr>
                    <td><strong>Old Password</strong></td>
                    <td><input type="password" name="txt_password" id="txt_password" required /></td>
                </tr>
                <tr>
                    <td><strong>New Password</strong></td>
                    <td><input type="password" name="txt_newpassword" id="txt_newpassword" required /></td>
                </tr>
                <tr>
                    <td><strong>Retype Password</strong></td>
                    <td><input type="password" name="txt_retypepassword" id="txt_retypepassword" required /></td>
                </tr>
                <tr class="text-center">
                    <td colspan="2">
                        <input type="submit" name="btn_change" id="btn_change" value="Change" class="btn-custom" />
                        <input type="button" name="btn_cancel" id="btn_cancel" value="Cancel" class="btn-custom" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include("Foot.php");
ob_flush();
?>  						