<?php
include('../Assets/connection/connection.php');

include("Head.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Complaints</title>
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
                <thead>
                    <tr class="text-center">
                        <th>Sl. No</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>File</th>
                        <th>Reply</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sel = "select * from tbl_complaint p inner join tbl_product pr on p.product_id=pr.product_id where p.customer_id=" . $_SESSION['cid'];
                    $row = $con->query($sel);
                    while ($data = $row->fetch_assoc()) {
                        $i++;
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i ?></td>
                            <td><?php echo $data['complaint_title'] ?></td>
                            <td><?php echo $data['complaint_descrption'] ?></td>
                            <td><a href="../Assets/Files/product/<?php echo $data['complaint_file'] ?>">View File</a></td>
                            <td>
                                <?php
                                if ($data['complaint_status'] == 1) {
                                    echo $data['complaint_reply'];
                                } else {
                                    echo "Not Replied";
                                }
                                ?>
                            </td>
                            <td><?php echo $data['complaint_date'] ?></td>
                            <td><a href="Mycomplaints.php?delID=<?php echo $data['complaint_id'] ?>" class="btn-custom">Delete</a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>
<?php
include("Foot.php");
ob_flush();
?>  						