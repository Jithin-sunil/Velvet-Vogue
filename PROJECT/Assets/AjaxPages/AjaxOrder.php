<?php
include("../connection/connection.php");
session_start();
$sel = "select * from tbl_cart c 
inner join tbl_booking b on c.booking_id=b.booking_id 
inner join tbl_product p on p.product_id=c.product_id 
where customer_id=" . $_SESSION['cid'];


if ($_GET['search'] != "") {
    $name = $_GET['search'];
    $sel .= " and b.order_id like '$name%'";
}
$row = $con->query($sel);

?>

<table class="table table-bordered">
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
                                        echo '<br><a href="CancelBooking.php?cid=' . $data['booking_id'] . '" class="btn-custom">Cancel</a>';
                                    }
                                    ?>
                                    <a href="Bill.php?id=<?php echo $data['booking_id']?>"  class="btn-custom"  >Bill</a>

                                    <?php
                                } else if ($data['booking_status'] == 3) {
                                    echo "Product Packed";
                                } else if ($data['booking_status'] == 4) {
                                    echo "Product Shipped";
                                } else if ($data['booking_status'] == 5) {
                                    echo "Product Received";
                                    echo "<br>";
                                    // Show rating and complaint options
                                ?>
                                    <br>
                                    <a href="Rating.php?pid=<?php echo $data['product_id'] ?>" class="btn-custom me-2">Rating</a>
                                    <a href="PostComplaint.php?pid=<?php echo $data['product_id'] ?>" class="btn-custom">Complaint</a>
                                    <?php
                                    // Show return option only if it's within 7 days after the product is received
                                    if ($days_since_completed <= 7) {
                                        echo "<br>";
                                        echo '<br><a href="MyProductBooking.php?rid=' . $data['booking_id'] . '" class="btn-custom">Return</a>';
                                    } else {
                                        echo '<br><span class="btn-disabled">Return Period Expired</span>';
                                    }
                                    ?>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>