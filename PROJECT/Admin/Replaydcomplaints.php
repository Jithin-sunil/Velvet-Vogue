<?php
include('../Assets/connection/connection.php');
include("Head.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Replayd Complaints</title>
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
        width: 80%;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
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

    div {
        text-align: center;
    }
</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
    <table>
        <tr>
            <th>Sl.No</th>
            <th>Customer Name</th>
            <th>Title</th>
            <th>Content</th>
            <th>Reply</th>
        </tr>
        <?php
        $i = 0;
        $sel = "SELECT * FROM tbl_complaint c INNER JOIN tbl_customerregistration cu ON c.customer_id = cu.customer_id WHERE complaint_status='1'";
        $row = $con->query($sel);
        while ($data = $row->fetch_assoc()) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $data['customer_name'] ?></td>
            <td><?php echo $data['complaint_title'] ?></td>
            <td><?php echo $data['complaint_descrption'] ?></td>
            <td><?php echo $data['complaint_reply'] ?></td>
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

?>  						
