<?php

include('../Assets/connection/connection.php');
session_start();
include("Head.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'salonmanagement456@gmail.com'; // Your gmail
        $mail->Password = 'vevq smpv uula rlmi'; // Your gmail app password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('salonmanagement456@gmail.com'); // Your email
        $mail->addAddress($to); // Recipient email

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        echo "<script>alert('Email sent successfully');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Email sending failed: {$mail->ErrorInfo}');</script>";
    }
}

if (isset($_GET['aid'])) {
    $update = "UPDATE tbl_servicebooking SET servicebooking_status='1' WHERE servicebooking_id=" . $_GET['aid'];
    if ($con->query($update)) {
        // Fetch customer details for email
        $sel = "SELECT c.customer_email, b.servicebooking_fordate, b.servicebooking_time, s.service_name FROM tbl_servicebooking b 
                INNER JOIN tbl_customerregistration c ON b.customer_id = c.customer_id
                INNER JOIN tbl_services s ON b.service_id = s.service_id 
                WHERE b.servicebooking_id = " . $_GET['aid'];
        $result = $con->query($sel);
        $data = $result->fetch_assoc();

        $to = $data['customer_email'];
        $subject = "Booking Approved";
        $body = "Dear Customer,<br>Your booking for " . $data['service_name'] . " on " . $data['servicebooking_fordate'] . " at " . $data['servicebooking_time'] . " has been approved.<br>Contact us for more details.<br>Thank you!";
        
        sendEmail($to, $subject, $body);

        echo "<script>alert('Booking Approved'); window.location='ViewCustomerBooking.php';</script>";
    }
}

// if (isset($_GET['rid'])) {
//     $update = "UPDATE tbl_servicebooking SET servicebooking_status='4' WHERE servicebooking_id=" . $_GET['rid'];
//     if ($con->query($update)) {
//         // Fetch customer details for email
//         $sel = "SELECT c.customer_email, s.service_name FROM tbl_servicebooking b 
//                 INNER JOIN tbl_customerregistration c ON b.customer_id = c.customer_id
//                 INNER JOIN tbl_services s ON b.service_id = s.service_id 
//                 WHERE b.servicebooking_id = " . $_GET['rid'];
//         $result = $con->query($sel);
//         $data = $result->fetch_assoc();

//         $to = $data['customer_email'];
//         $subject = "Booking Canceled";
//         $body = "Dear Customer,<br>Your booking for " . $data['service_name'] . " has been canceled.<br>Thank you for choosing us.";

//         sendEmail($to, $subject, $body);

//         echo "<script>alert('Booking Canceled'); window.location='ViewCustomerBooking.php';</script>";
//     }
// }


?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ViewCustomerBooking</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: lavender;
        color: #333;
    }
    form {
        margin: 50px auto;
        padding: 20px;
        width: 80%;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th, td {
        padding: 12px;
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
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table>
    <tr>
      <th>SI.NO</th>
      <th>Customer</th>
      <th>Date</th>
      <th>Time</th>
      <th>Service</th>
      <th>Action</th>
    </tr>
    
    <?php
    $i = 0;
    $sel = "select * from tbl_servicebooking b inner join tbl_services s on b.service_id=s.service_id inner join tbl_customerregistration c on b.customer_id=c.customer_id";
    $row = $con->query($sel);
    while ($data = $row->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $data['customer_name'] ?></td>
      <td><?php echo $data['servicebooking_fordate'] ?></td>
      <td><?php echo $data['servicebooking_time'] ?></td>
      <td><?php echo $data['service_name'] ?></td>
      <td>
        <?php
        if ($data['servicebooking_status'] == 1) {
            echo "Approved";
        } elseif ($data['servicebooking_status'] == 2) {
            echo "Reschedule to ".$data['service_newtime']."Wating too User Conformation..";
        } 
        
        elseif ($data['servicebooking_status'] == 3) {
            echo "Verified.. Reschedule to ".$data['service_newtime'];
        } 
        elseif ($data['servicebooking_status'] == 4) {
            echo "Booking Cancled";
        } 
        else {
        ?>
          <a href="ViewCustomerBooking.php?aid=<?php echo $data['servicebooking_id'] ?>">Accept</a>
          <a href="Reschedule.php?rid=<?php echo $data['servicebooking_id'] ?>">Reject</a>
        <?php
        }
        ?>
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
ob_flush();
?>  


