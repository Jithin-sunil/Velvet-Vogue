<?php

include("../Assets/connection/connection.php");
ob_start();
include("Head.php");
$cus = "select * from tbl_customerregistration where customer_id='" . $_SESSION['cid'] . "'";
$rowuser = $con->query($cus);
$data = $rowuser->fetch_assoc();

if (isset($_POST["btn_Edit"])) {
    $Name = $_POST['txt_name'];
    $Email = $_POST['txt_email'];
    $Contact = $_POST['txt_contact'];
    $Address = $_POST['txt_address'];
    $update = "update tbl_customerregistration set customer_name='" . $Name . "', customer_email='" . $Email . "', customer_contact='" . $Contact . "', customer_address='" . $Address . "' where customer_id='" . $_SESSION['cid'] . "'";
    if ($con->query($update)) {
        ?>
        <script>
        alert('Updated');
        window.location="MYProfile.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            color: #333;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
        }

        .form-container h2 {
            color: #F9A392;
        }

        .btn-custom {
            background-color: #F9A392;
            color: white;
        }

        .btn-custom:hover {
            background-color: #f7876f;
        }

        input, textarea {
            border: 1px solid #F9A392 !important;
        }

        label {
            color: #333;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container form-container">
    <h2 class="text-center">Edit Profile</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label for="txt_name" class="form-label">Name</label>
            <input type="text" name="txt_name" id="txt_name" class="form-control" required 
                   pattern="^[A-Z]+[a-zA-Z ]*$" title="Name allows only alphabets, spaces, and the first letter must be capital" 
                   value="<?php echo $data['customer_name']; ?>">
        </div>
        <div class="mb-3">
            <label for="txt_email" class="form-label">Email</label>
            <input type="email" name="txt_email" id="txt_email" class="form-control" required 
                   value="<?php echo $data['customer_email']; ?>">
        </div>
        <div class="mb-3">
            <label for="txt_contact" class="form-label">Contact</label>
            <input type="text" name="txt_contact" id="txt_contact" class="form-control" required 
                   pattern="[7-9]{1}[0-9]{9}" title="Phone number must start with 7-9 and be followed by 9 digits" 
                   value="<?php echo $data['customer_contact']; ?>">
        </div>
        <div class="mb-3">
            <label for="txt_address" class="form-label">Address</label>
            <textarea name="txt_address" id="txt_address" cols="30" rows="5" class="form-control" required><?php echo $data['customer_address']; ?></textarea>
        </div>
        <div class="d-grid">
            <button type="submit" name="btn_Edit" id="btn_Edit" class="btn btn-custom">Update</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS (Optional but useful for components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include("Foot.php");
ob_flush();
?>
