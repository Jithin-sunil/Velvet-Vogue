<?php
include('../Assets/connection/connection.php');

include("Head.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../Assets/phpMail/src/Exception.php';
require '../Assets/phpMail/src/PHPMailer.php';
require '../Assets/phpMail/src/SMTP.php';

// Mail function to send email
function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'salonmanagement456@gmail.com'; // Your email
        $mail->Password = 'vevq smpv uula rlmi'; // Your Gmail app password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('salonmanagement456@gmail.com'); // Sender email
        $mail->addAddress($to); // Recipient email

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        // echo "<script>alert('Email sent successfully');</script>";
    } catch (Exception $e) {
        echo "<script>alert('Email sending failed: {$mail->ErrorInfo}');</script>";
    }
}

if (isset($_GET['cid'])) {
    // Booking cancelled
    $update = "UPDATE tbl_cart SET cart_status='0' WHERE cart_id=" . $_GET['cid'];
    if ($con->query($update)) {
    

        // Fetch customer and booking details
        $sel = "SELECT *
                FROM tbl_booking b
                INNER JOIN tbl_cart ca on b.booking_id=ca.booking_id
                INNER JOIN tbl_customerregistration c ON b.customer_id = c.customer_id
                INNER JOIN tbl_product p ON ca.product_id = p.product_id
                WHERE ca.cart_id = " . $_GET['cid'];
        $result = $con->query($sel);
        $data = $result->fetch_assoc();

        // Email content for cancellation
        $to = $data['customer_email'];
        $subject = "Booking Cancellation Confirmation";
        $body = "Dear " . $data['customer_name'] . ",<br><br>
                 Your booking for the product <strong>" . $data['product_name'] . "</strong> has been successfully canceled.<br>
                 The booking amount of <strong>" . $data['booking_amount'] . "</strong> will be refunded within 2 working days.<br><br>
                 Thank you for using our service!<br>Regards, Your Company Name";

        sendEmail($to, $subject, $body);

        echo "<script>alert('Booking Cancelled.'); window.location='MyProductBooking.php';</script>";
    }
}

if (isset($_GET['rid'])) {
    // Product returned
    $update = "UPDATE tbl_cart SET cart_status='6' WHERE cart_id=" . $_GET['rid'];
    if ($con->query($update)) {
        // Fetch customer and booking details
        $sel = "SELECT *
                FROM tbl_booking b
                INNER JOIN tbl_cart ca on b.booking_id=ca.booking_id
                INNER JOIN tbl_customerregistration c ON b.customer_id = c.customer_id
                INNER JOIN tbl_product p ON ca.product_id = p.product_id
                WHERE ca.cart_id = " . $_GET['rid'];
        $result = $con->query($sel);
        $data = $result->fetch_assoc();

        // Email content for return
        $to = $data['customer_email'];
        $subject = "Product Return Confirmation";
        $body = "Dear " . $data['customer_name'] . ",<br><br>
                 We have received your return request for the product <strong>" . $data['product_name'] . "</strong>.<br>
                 Our team will contact you soon for further instructions. You can reach us at <strong>+1234567890</strong> if you have any questions.<br><br>
                 Thank you for using our service!<br>Regards, Your Company Name";

        sendEmail($to, $subject, $body);

        echo "<script>alert('Product Returned.'); window.location='MyProductBooking.php';</script>";
    }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>MyProductBooking</title>
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
            max-width: 900px;
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

        .table img {
            border-radius: 5px;
            max-width: 50px;
            height: auto;
        }

        .btn-custom {
            background-color: #F9A392;
            color: #333;
            padding: 8px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-custom:hover {
            background-color: #f7876f;
            color: #333;
        }

        .btn-disabled {
            background-color: #ccc;
            color: #666;
            pointer-events: none;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">

        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <td><input type="search" name="search" id="search" onkeyup=getSearch()></td>
                </tr>
            </table>
            <table class="table table-bordered" id="result">
                <thead>
                    <tr>
                        <th>Sl.No</th>
                        <th>Photo</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sel = "select * from tbl_cart c 
                            inner join tbl_booking b on c.booking_id=b.booking_id 
                            inner join tbl_product p on p.product_id=c.product_id 
                            where customer_id=" . $_SESSION['cid'];
                    $row = $con->query($sel);
                    while ($data = $row->fetch_assoc()) {
                        $i++;
                        // Calculate time difference between current time and booking time
                        $booking_datetime = new DateTime($data['booking_datetime']);
                        $now = new DateTime();
                        $interval = $now->diff($booking_datetime);
                        $hours_diff = $interval->h + ($interval->days * 24);

                        // Calculate time difference for return option (7 days)
                        $completed_datetime = new DateTime($data['completed_datetime']); // Replace with actual datetime field when the product is received.
                        $days_since_completed = $completed_datetime->diff($now)->days;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><img src="../Assets/Files/product/<?php echo $data['product_photo'] ?>" /></td>
                            <td><?php echo $data['product_name'] ?></td>
                            <td><?php echo $data['cart_quantity'] ?></td>
                            <td><?php echo $data['product_price'] ?></td>
                            <td><?php echo $data['booking_amount'] ?></td>
                            <td>
                                <?php
                                if ($data['booking_status'] == 1) {
                                    echo "Payment Pending";
                                    // Show cancel option only if within 24 hours
                                    
                                } else if ($data['booking_status'] == 2) {
                                    echo "Payment Completed";echo "<br>";
                                    if ($hours_diff <= 24) {
                                        echo '<br><a href="MyProductBooking.php?cid=' . $data['cart_id'] . '" class="btn-custom">Cancel</a>';
                                    }
                                    ?>
                                    <a href="Bill.php?id=<?php echo $data['booking_id']?>"  class="btn-custom"  >Bill</a>

                                    <?php
                                } else if ($data['cart_status'] == 3) {
                                    echo "Product Packed";
                                } else if ($data['cart_status'] == 4) {
                                    echo "Product Shipped";
                                } 
                                
                               
                                 else if ($data['booking_status'] == 3) {
                                    echo "Booking Cancelled";
                                    echo "<br>";
                                 }

                                 else if ($data['cart_status'] == 5) {
                                    echo " Order Dceliverd";
                                
                                
                                    // Show rating and complaint options
                                ?>
                                    <br>
                                    <a href="Rating.php?pid=<?php echo $data['product_id'] ?>" class="btn-custom me-2">Rating</a>
                                    <a href="PostComplaint.php?pid=<?php echo $data['product_id'] ?>" class="btn-custom">Complaint</a>
                                    <?php
                                    // Show return option only if it's within 7 days after the product is received
                                    if ($days_since_completed <= 7) {
                                        echo "<br>";
                                        echo '<br><a href="MyProductBooking.php?rid=' . $data['cart_id'] . '" class="btn-custom">Return</a>';
                                    } else {
                                        echo '<br><span class="btn-disabled">Return Period Expired</span>';
                                    }
                                    ?>
                                <?php
                                }
                                else if ($data['cart_status'] == 6) {
                                    echo "Product Rerturned";
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getSearch() {
            
            const searchKeyword = document.getElementById("search").value;

            $.ajax({
                url: "../Assets/AjaxPages/AjaxOrder.php?search="+searchKeyword,
                method: "GET",
                success: function (response) {
                    document.getElementById("result").innerHTML = response;
                }
            });
        }
</script>
<?php
include("Foot.php");
ob_flush();
?>  
