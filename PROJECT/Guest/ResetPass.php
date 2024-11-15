
<?php
session_start();
include("../Assets/connection/connection.php");


if(isset($_POST['btn_submit'])){
    $pass=$_POST['txt_pass'];
    $cpass=$_POST['txt_cpass'];
    if($pass==$cpass){
        if(isset($_SESSION['ruid'])){ //User
            $updQry="update tbl_customerregistration set customer_password='".$pass."' where customer_id=".$_SESSION['ruid'];
            if($con->query($updQry)){
                ?>
                <script>
                    alert("Password Updated")
                    window.location="../Logout.php"
                    </script>
                <?php
            }
        }
        
        else{
            ?>
            <script>
                alert('Something went wrong')
                    window.location="../Logout.php"
                </script>
            <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../Assets/Templates/Search/bootstrap.min.css">
    <style>
        .container {
            margin-top: 50px;
        }

        .custom-alert-box {
            z-index: 1;
            width: 20%;
            height: 10%;
            position: fixed;
            bottom: 0;
            right: 0;
            left: auto;
        }

        .success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
            display: none;
        }

        .failure {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
            display: none;
        }

        .warning {
            color: #8a6d3b;
            background-color: #fcf8e3;
            border-color: #faebcc;
            display: none;
        }

        .form-control {
            width: 100%;
        }

        .btn {
            background-color: #007bff;
            color: white;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="custom-alert-box">
            <div class="alert-box success">Password Changed Successfully!</div>
            <div class="alert-box failure">Password Change Failed!</div>
            <div class="alert-box warning">Passwords Do Not Match!</div>
        </div>
        <form action="" method="post">
            <table class="table table-bordered">
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="txt_pass" class="form-control" required></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="txt_cpass" class="form-control" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit" value="Change Password" class="btn btn-primary w-100">
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <script src="../Assets/Templates/Search/jquery.min.js"></script>
    <script src="../Assets/Templates/Search/bootstrap.min.js"></script>
    <script src="../Assets/Templates/Search/popper.min.js"></script>

    <script>
        // You can add alert display functionality here if needed based on form validation
    </script>
</body>

</html>
