<?php
include('../Assets/connection/connection.php');
session_start();
include("Head.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

// Function to send an email
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

if (isset($_POST['btnsubmit'])) {
    // Get the new booking time from form submission
    $newTime = $_POST['txttime'];
    $bookingId = $_GET['rid'];

    // Update the booking with the new time
    $update = "UPDATE tbl_servicebooking SET servicebooking_status='2', service_newtime='$newTime' WHERE servicebooking_id=" . $bookingId;
    
    if ($con->query($update)) {
        // Fetch customer details and previous booking details for the email
        $sel = "SELECT c.customer_email, c.customer_contact, b.servicebooking_fordate, b.servicebooking_time, b.service_newtime, s.service_name 
                FROM tbl_servicebooking b 
                INNER JOIN tbl_customerregistration c ON b.customer_id = c.customer_id
                INNER JOIN tbl_services s ON b.service_id = s.service_id 
                WHERE b.servicebooking_id = " . $bookingId;

        $result = $con->query($sel);
        $data = $result->fetch_assoc();

        // Prepare email variables
        $to = $data['customer_email'];
        $customerContact = $data['customer_contact'];
        $serviceName = $data['service_name'];
        $previousTime = $data['servicebooking_time'];
        $previousDate = $data['servicebooking_fordate'];
        $newTime = $data['service_newtime'];

        // Email subject and body content
        $subject = "Booking Rescheduled for " . $serviceName;
        $body = "Dear Customer,<br><br>
                Your booking for the service <strong>$serviceName</strong> has been rescheduled.<br>
                <strong>Previous Date and Time:</strong> $previousDate at $previousTime<br>
                <strong>New Date and Time:</strong> $previousDate at $newTime<br>
                <strong>Contact:</strong> $customerContact<br><br>
                Thank you for choosing us!";

        // Send the email
        sendEmail($to, $subject, $body);

        // Redirect with a success message
        echo "<script>alert('Booking Rescheduled'); window.location='ViewCustomerBooking.php';</script>";
    } else {
        echo "<script>alert('Error updating booking');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reschedule Booking</title>
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
        input[type="time"], input[type="submit"] {
            padding: 8px;
            width: 95%;
            margin: 5px 0;
            border: 1px solid lavender;
            border-radius: 5px;
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
    <form action="" method="post">
        <table>
            <tr>
                <td>New Time</td>
                <td><input type="time" name="txttime" id="txttime" required></td>
            </tr>
            <tr>
                <td colspan="2" class="center">
                    <div>
                        <input type="submit" name="btnsubmit" value="Submit">
                    </div>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
