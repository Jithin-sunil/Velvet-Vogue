<?php
include('../Assets/connection/connection.php');
session_start();
include("Head.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Complaints</title>
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
        width: 70%;
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

    a {
        color: #5d3a7a;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table>
    <tr>
      <th>Sl.No</th>
      <th>Date</th>
      <th>Description</th>
      <th>Status</th>
      <th>File</th>
      <th>Reply</th>
    </tr>
    <?php
    $i=0;
    $sel="select * from tbl_complaint p inner join tbl_product pr on p.product_id=pr.product_id where complaint_status='0'";
    $row=$con->query($sel);
    while($data=$row->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['complaint_date']?></td>
      <td><?php echo $data['complaint_descrption']?></td>
      <td><?php echo $data['complaint_status']?></td>
      <td><a href="../Assets/Files/product/<?php echo $data['complaint_file']?>">View File</a></td>
      <td><a href="Reply.php?id=<?php echo $data['complaint_id']?>">Reply</a></td>
    </tr>
    <?php } ?>
  </table>
</form>
</body>
</html>
<?php
include("Foot.php");

?>  						

