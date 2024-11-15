<?php

include("../Assets/connection/connection.php");
ob_start();
include("Head.php");


 $cus="select * from tbl_customerregistration c inner join tbl_place p on c.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where c.customer_id='".$_SESSION['cid']."'";
$rowuser=$con->query($cus);
$data=$rowuser->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
            max-width: 600px;
            margin: 50px auto;
        }

        .table-bordered td {
            border-color: #F9A392;
        }

        .table th,
        .table td {
            padding: 15px;
        }

        .table img {
            border-radius: 50%;
            max-width: 150px;
            height: auto;
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
    </style>
</head>

<body>
    <div class="container">
        <form id="form1" name="form1" method="post" action="">
            <table class="table table-bordered">
                <tr>
                    <td colspan="2" class="text-center">
                        <img src="../Assets/Files/User/Photo/<?php echo $data['customer_photo'] ?>" alt="Profile Photo">
                    </td>
                </tr>
                <tr>
                    <td><strong>Name</strong></td>
                    <td><?php echo $data['customer_name'] ?></td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td><?php echo $data['customer_email'] ?></td>
                </tr>
                <tr>
                    <td><strong>Address</strong></td>
                    <td><?php echo $data['customer_address'] ?></td>
                </tr>
                <tr>
                    <td><strong>District</strong></td>
                    <td><?php echo $data['district_name'] ?></td>
                </tr>
                <tr>
                    <td><strong>Place</strong></td>
                    <td><?php echo $data['place_name'] ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <a href="Editprofile.php" class="btn-custom">Edit</a>
                        <a href="ChangePassword.php" class="btn-custom">Change Password</a>
                    </td>
                </tr>
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