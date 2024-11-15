<?php 
session_start();
include("../Assets/Connection/connection.php");

// Get booking ID from GET parameters
$booking_id = $_GET['bid'];

// Prepare and execute the SQL query
$sel = "SELECT * FROM tbl_cart c 
        INNER JOIN tbl_booking b ON c.booking_id=b.booking_id 
        INNER JOIN tbl_product p ON p.product_id=c.product_id 
        WHERE c.booking_id = $booking_id";
$res = $con->query($sel);

// Generate a random order number for this booking
$order_number = rand(100000, 999999);

// Update the order number in the database
$up = "UPDATE tbl_booking SET order_id='$order_number' WHERE booking_id=$booking_id";
$con->query($up);

$order_items = [];
$total_amount = 0;

// Fetch the data
while ($row = $res->fetch_assoc()) {
    $order_items[] = $row;
    $total_amount += $row['product_price'] * $row['cart_quantity']; // Assuming 'product_price' and 'cart_quantity' fields exist
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #e2e2e2, #ffffff);
            font-family: 'Arial', sans-serif;
        }
        .success-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .success-container:hover {
            transform: scale(1.02);
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
        }
        h2 {
            color: #333;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-custom:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        .order-summary {
            border-top: 1px solid #dee2e6;
            margin-top: 20px;
            padding-top: 20px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
        }
        .summary-item:nth-child(even) {
            background-color: #f8f9fa;
        }
        footer {
            margin-top: 30px;
            text-align: center;
            color: #6c757d;
        }
    </style>
</head>

<body onLoad="Redirect()">

    <div class="container">
        <div class="success-container text-center">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="mt-3">Payment Successful!</h2>
            <p class="lead">Thank you for your payment. Your transaction has been completed successfully.</p>
            <p>Your order ID is <strong>#<?php echo $order_number; ?></strong>. You can view your order details in your account.</p>
            
            <div class="order-summary">
                <h5>Order Summary</h5>
                <?php foreach ($order_items as $item): ?>
                <div class="summary-item">
                    <span>Item Name:</span>
                    <span><?php echo $item['product_name']; ?></span>
                </div>
                <div class="summary-item">
                    <span>Quantity:</span>
                    <span><?php echo $item['cart_quantity']; ?></span>
                </div>
                <?php endforeach; ?>
                <div class="summary-item">
                    <span>Total Amount:</span>
                    <span>$<?php echo number_format($total_amount, 2); ?></span>
                </div>
            </div>

            <a href="MyProductBooking.php" class="btn btn-custom mt-2">View Order Details</a>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Your Company. All Rights Reserved.</p>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<script>
      function Redirect()
      {
          window.setTimeout(function() {
          window.location = "Homepage.php";
        }, 8000);
      }
</script>
