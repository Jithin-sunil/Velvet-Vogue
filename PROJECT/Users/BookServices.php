<?php

include("Head.php");
include('../Assets/connection/connection.php');

if(isset($_POST["btn_submit"]))

{
	$service=$_POST['sel_service'];
	$date=$_POST['txt_date'];
	$time=$_POST['txt_time'];
		  $insQry="insert into tbl_Servicebooking(service_id,servicebooking_fordate,customer_id,servicebooking_time,servicebooking_date,staff_id)values('".$service."','".$date."','".$_SESSION['cid']."','".$time."',curdate(),'".$_GET['id']."')";	
		 if($con->query($insQry))
         {
           
               
         
		
		?>	
                    <script>
                    alert("Booking successful.")
                    window.location="MyServiceBooking.php"
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
    <title>Book Services</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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
            max-width: 800px;
            margin: 50px auto;
        }

        .table th,
        .table td {
            padding: 15px;
            vertical-align: middle;
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

        select,
        input[type="text"],
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            margin-bottom: 10px;
        }

        .table {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered">
                <tr>
                    <td><strong>Service</strong></td>
                    <td>
                        <select name="sel_service" id="sel_service" class="form-select" onChange="getServices(this.value)">
                            <option>--select--</option>
                            <?php
                            $sel = "select * from tbl_services";
                            $row = $con->query($sel);
                            while ($data = $row->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $data['service_id'] ?>">
                                    <?php echo $data['service_name'] ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><strong>Amount</strong></td>
                    <td><input type="text" name="txt_rate" id="txtrate" readonly /></td>
                </tr>
                <tr>
                    <td><strong>Date</strong></td>
                    <td><input type="date" name="txt_date" id="txt_date" min="<?php echo date('Y-m-d') ?>" /></td>
                </tr>
                <tr>
                    <td><strong>Time</strong></td>
                    <td><input type="time" name="txt_time" id="txt_time" /></td>
                </tr>
                <tr class="text-center">
                    <td colspan="2">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn-custom" />
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getServices(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxServices.php?did=" + did,
      success: function (result) {

         $("#txtrate").val(result);
      }
    });
  }

</script>
<?php
include("Foot.php");
ob_flush();
?>  