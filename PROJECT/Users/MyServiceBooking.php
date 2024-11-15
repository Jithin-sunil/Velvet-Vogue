<?php
include('../Assets/connection/connection.php');
include("Head.php");
if(isset($_GET['aid']))
{
	$up=" update tbl_servicebooking set servicebooking_status='3' where servicebooking_id=".$_GET['aid'];
	if($con->query($up))
	{
		?>
        <script>
		alert('Confirmed');
		window.location="MyServiceBooking.php";
		</script>
        <?php
	}
}
 if(isset($_GET['rid']))
{
	$up=" update tbl_servicebooking set servicebooking_status='4' where servicebooking_id=".$_GET['rid'];
	if($con->query($up))
	{
		?>
         <script>
		alert('Rejected');
		window.location="MyServiceBooking.php";
		</script>
        <?php
	}
}
if(isset($_GET['cid']))
{
	$up=" update tbl_servicebooking set servicebooking_status='5' where servicebooking_id=".$_GET['cid'];
	if($con->query($up))
	{
		?>
         <script>
		alert('Booking Canceled');
		window.location="MyServiceBooking.php";
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
    <title>My Service Booking</title>
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

        .table-bordered td,
        .table-bordered th {
            border-color: #F9A392;
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

        a {
            color: #F9A392;
            text-decoration: none;
        }

        a:hover {
            color: #f7876f;
            text-decoration: underline;
        }

        .table {
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>SI. No</th>
                        <th>Service</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sel = "select * from tbl_servicebooking b inner join tbl_services s on b.service_id=s.service_id where b.customer_id=" . $_SESSION['cid'];
                    $row = $con->query($sel);
                    while ($data = $row->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i ?></td>
                            <td><?php echo $data['service_name'] ?></td>
                            <td><?php echo $data['service_rate'] ?></td>
                            <td><?php echo $data['servicebooking_fordate'] ?></td>
                            <td><?php echo $data['servicebooking_time'] ?></td>
                            <td>
                                <?php
                                if ($data['servicebooking_status'] == 1) {
                                    echo "Approved";
                                
                                    
                                    $bookingDate = $data['servicebooking_fordate']; 
                                    $bookingTime = $data['servicebooking_time'];
                                    $bookingDateTime = strtotime($bookingDate . ' ' . $bookingTime);
                                    $currentDateTime = time();
                                
                                    
                                    if ($bookingDateTime > $currentDateTime) {
                                        ?>
                                        <a href="MyServiceBooking.php?cid=<?php echo $data['servicebooking_id']?>">Cancel Booking</a>
                                        <?php
                                    }
                                } else if ($data['servicebooking_status'] == 2) {
                                    echo "Rescheduled to " . $data['service_newtime'];
                                ?>
                                    <br />
                                    <a href="MyServiceBooking.php?aid=<?php echo $data['servicebooking_id'] ?>" class="btn btn-custom btn-sm">Confirm</a>
                                    <a href="MyServiceBooking.php?rid=<?php echo $data['servicebooking_id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                                <?php
                                } else if ($data['servicebooking_status'] == 3) {
                                    echo "Scheduled to " . $data['service_newtime'];
                                } else if ($data['servicebooking_status'] == 4) {
                                    echo "Booking Cancelled";
                                } 
                                else if ($data['servicebooking_status']==5)
                                {
                                    echo "Booking Canceled";
                                }
                                else {
                                    echo "Pending";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
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