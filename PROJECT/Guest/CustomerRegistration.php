
<?php

include('../Assets/connection/connection.php');
include("Head.php");
if(isset($_POST["btn_submit"]))
{
	$Name=$_POST['txt_name'];
	$Gender=$_POST['radio'];
	$Contact=$_POST['txt_contact'];
	$Email=$_POST['txt_email'];
	$Password=$_POST['txt_password'];
	$ConfirmPassword=$_POST['txt_confirmpassword'];
	$address=$_POST['txt_address'];
	
	$photo=$_FILES['filephoto']['name'];
	$temp=$_FILES['filephoto']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/User/Photo/'.$photo);
	
	$place=$_POST['sel_place'];
	if($Password==$ConfirmPassword)
	{
		 $insQry="insert into	tbl_customerregistration(customer_name,customer_gender,customer_contact,customer_email,customer_password,customer_address,customer_photo,place_id) values('".$Name."','".$Gender."','".$Contact."','".$Email."','".$Password."','".$address."','".$photo."','".$place."')";
		if($con->query($insQry))
		
{
?>
<script>
alert("inserted")
window.location="login.php"
</script>
<?php
}
    }
else
{
	?>
	<script>
	alert("password mismatch")
	</script>
    <?php
}
    }
    
   
?>

<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Styled Form</title>

</head>

<body>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table>
    <tr>
      <td>District</td>
      <td>
        <select name="sel_district" id="sel_district" onChange="getPlace(this.value)">
          <option>--select--</option>
          <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- MATERIAL DESIGN ICONIC FONT -->
    <link rel="stylesheet" href="fonts/material-design-iconic-font/css/material-design-iconic-font.min.css">

<!-- STYLE CSS -->
<link rel="stylesheet" href="../Assets/Templates/Registration/css/style.css">
</head>
<body>

<div class="wrapper" style="background-image: url('../Assets/Templates/Registration/images/bg-registration-form-1.jpg');">
<div class="inner">
    <div class="image-holder">
        <img src="../Assets/Templates/Registration/images/registration-form-1.jpg" alt="">
    </div>
    <!-- Modified Form with additional fields -->
    <form action="" method="post" enctype="multipart/form-data" id="registration_form">
        <h3>Registration Form</h3>

        <!-- Name fields -->
        <div class="form-group">
            <input type="text" name="txt_name" placeholder="Full Name" class="form-control" title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" required>
            
        </div>

        <!-- Gender -->
        <div class="form-wrapper">
            <label>Gender:</label>
            <input type="radio" name="radio" value="Male"> Male
            <input type="radio" name="radio" value="Female"> Female
            <input type="radio" name="radio" value="Other"> Other
        </div>

        <!-- Contact -->
        <div class="form-wrapper">
            <input type="text" name="txt_contact" placeholder="Contact" class="form-control" required  name="txt_contact" pattern="[7-9]{1}[0-9]{9}" 
            title="Phone number with 7-9 and remaing 9 digit with 0-9"/></td>
           
        </div>

        <!-- Email -->
        <div class="form-wrapper">
            <input type="text" name="txt_email" placeholder="Email Address" class="form-control" required>
            <i class="zmdi zmdi-email"></i>
        </div>

        <!-- District and Place Dropdown -->
        <div class="form-wrapper">
            <label>District:</label>
            <select name="sel_district" id="sel_district" class="form-control" onChange="getPlace(this.value)" required>
                <option value="" disabled selected>--Select District--</option>
                <?php
                // Fetch districts dynamically from the database
                $sel = "select * from tbl_district";
                $row = $con->query($sel);
                while ($data = $row->fetch_assoc()) {
                    echo "<option value='" . $data['district_id'] . "'>" . $data['district_name'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-wrapper">
            <label>Place:</label>
            <select name="sel_place" id="sel_place" class="form-control" required>
                <option value="" disabled selected>--Select Place--</option>
            </select>
        </div>

        <!-- Address -->
        <div class="form-wrapper">
            <textarea name="txt_address" placeholder="Address" class="form-control" rows="4" required></textarea>
        </div>

        <!-- Password and Confirm Password -->
        <div class="form-wrapper">
            <input type="password" name="txt_password"  placeholder="Password" class="form-control" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required name="txt_pass" /></td>
            <i class="zmdi zmdi-lock"></i>
           
        </div>
        <div class="form-wrapper">
            <input type="password" name="txt_confirmpassword" placeholder="Confirm Password" class="form-control" required>
            <i class="zmdi zmdi-lock"></i>
        </div>

        <!-- Photo Upload -->
        <div class="form-wrapper">
            <input type="file" name="filephoto" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" name="btn_submit" id="btn_submit">Register
            <i class="zmdi zmdi-arrow-right"></i>
        </button>
    </form>
</div>
</div>

<!-- jQuery for dynamic district-place loading -->
<script src="../Assets/JQ/jQuery.js"></script>
<script>
function getPlace(did) {
    $.ajax({
        url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
        success: function (result) {
            $("#sel_place").html(result);
        }
    });
}
</script>

</body>


<!-- jQuery for dynamic district-place loading -->
<script src="../Assets/JQ/jQuery.js"></script>
<script>
    function getPlace(did) {
        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
            success: function (result) {
                $("#sel_place").html(result);
            }
        });
    }
</script>

</body>
</html>
<?include('Foot.php');?>
