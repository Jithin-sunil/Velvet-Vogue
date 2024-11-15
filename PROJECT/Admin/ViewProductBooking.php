<?php
include('../Assets/connection/connection.php');
include("Head.php");

if(isset($_GET['pid']))
{
  $up="update tbl_cart set cart_status='3' where cart_id=".$_GET['pid'];
  if($con->query($up))
  {
    ?>
    <script>
      alert('Product Packed')
      window.location="ViewProductBooking.php";
    </script>
    <?php
  }
}
if(isset($_GET['sid']))
{
  $up="update tbl_cart set cart_status='4'where cart_id=".$_GET['sid'];
  if($con->query($up))
  {
    ?>
    <script>
      alert('Product Shipped')
      window.location="ViewProductBooking.php";
    </script>
    <?php
  }
}
if(isset($_GET['did']))
{
  $up="update tbl_cart set cart_status='5',completed_datetime=NOW() where cart_id=".$_GET['did'];
  if($con->query($up))
  {
    ?>
    <script>
      alert('Product Delivered')
      window.location="ViewProductBooking.php";
    </script>
    <?php
  }
}


?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>ViewProductcart</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: lavender;
      color: #333;
      margin: 0;
      padding: 20px;
    }

    form {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 90%;
      margin: 50px auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid #ddd;
    }

    th,
    td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: lavender;
      color: #333;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    img {
      border-radius: 5px;
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
        <th>Photo</th>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Total Price</th>
        <th>User Details</th>
        <th>Status</th>
      </tr>
      <?php
      $i = 0;
      $sel = "select * from tbl_cart c inner join tbl_booking b on c.booking_id=b.booking_id inner join tbl_product p on p.product_id=c.product_id inner join tbl_customerregistration cu on b.customer_id=cu.customer_id";
      $row = $con->query($sel);
      while ($data = $row->fetch_assoc()) {

        $quantity=$data["cart_quantity"];
		$price=$data["product_price"];
		$totalamount=$quantity*$price;
		$i++;
      ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><img src="../Assets/Files/product/<?php echo $data['product_photo'] ?>" Width="50" height="50" /></td>
          <td><?php echo $data['product_name'] ?></td>
          <td><?php echo $data['cart_quantity'] ?></td>
          <td><?php echo $data['product_price'] ?></td>
          <td><?php echo  $totalamount ?></td>
          <td><?php echo $data['customer_name'] ?></td>
          <td>
    <?php
    if ($data['cart_status'] == 1) {
        echo "Payment Pending";
    } elseif ($data['cart_status'] == 2) {
        echo "Payment Completed";
        echo '<a href="ViewProductBooking.php?pid=' . $data['cart_id'] . '">Packed</a>';
    } elseif ($data['cart_status'] == 3) {
        echo "Product Packed";
        echo '<a href="ViewProductBooking.php?sid=' . $data['cart_id'] . '">Shipped</a>';
    } elseif ($data['cart_status'] == 4) {
        echo "Product Shipped";
        echo '<a href="ViewProductBooking.php?did=' . $data['cart_id'] . '">Delivered</a>';
    } elseif ($data['cart_status'] == 5) {
        echo "Order Completed";
    } elseif ($data['booking_status'] == 3) {
        echo "Order Cancelled";
    } elseif ($data['cart_status'] == 6) {
        echo "Product Returned";
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


