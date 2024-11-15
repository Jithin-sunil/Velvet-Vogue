<?php 
session_start();
include('../Assets/connection/connection.php');
    if(isset($_POST["btn_pay"]))
    {
        
          echo $UpQry="UPDATE tbl_booking SET booking_status='2' WHERE booking_id=".$_SESSION['bid'];
         if($con->query($UpQry))
         {
             $bid=$_SESSION['bid'];
           
            ?>
            <script>
                window.location="Success.php?bid=<?php echo $bid?>";
            </script>
            <?php
    
                    }
                }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare./com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: #f3f3f3;
            font-family: 'Arial', sans-serif;
        }

        .payment-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .payment-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .payment-header h3 {
            font-weight: bold;
            color: #333;
        }

        .payment-form {
            margin-top: 20px;
        }

        .payment-form .form-group label {
            font-weight: bold;
            color: #555;
        }

        .payment-form input {
            border-radius: 4px;
            height: 45px;
            border: 1px solid #ddd;
        }

        .payment-form .btn-pay {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-form .btn-pay:hover {
            background-color: #218838;
        }

        .secure-payment {
            text-align: center;
            margin-top: 20px;
            color: #888;
            font-size: 14px;
        }

        .secure-payment i {
            color: #28a745;
            font-size: 18px;
            margin-right: 5px;
        }

        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="payment-container">
        <div class="payment-header">
            <h3>Secure Payment</h3>
        </div>

        <form class="payment-form" id="paymentForm" action="" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="cardholder">Card Holder Name</label>
                <input type="text" class="form-control" id="cardholder" name="txtname" minlength="3"
                    placeholder="Enter Cardholder Name" required>
                <span class="error" id="cardholderError"></span>
            </div>
            <div class="form-group">
                <label for="cardnumber">Card Number</label>
                <input type="text" class="form-control" id="cardnumber" name="txtacno" maxlength="19"
                    data-mask="0000 0000 0000 0000" placeholder="XXXX XXXX XXXX XXXX" required>
                <span class="error" id="cardnumberError"></span>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="expiry">Expiry Date</label>
                    <input type="text" class="form-control" id="expiry" name="txtexpdate" data-mask="00/00"
                        minlength="5" maxlength="5" placeholder="MM/YY" required>
                    <span class="error" id="expiryError"></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="cvv">CVV</label>
                    <input type="password" class="form-control" id="cvv" name="txtccv" minlength="3" maxlength="3"
                        placeholder="CVV" required>
                    <span class="error" id="cvvError"></span>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-pay btn-block" name="btn_pay">Pay Now</input>
            </div>
        </form>

        <div class="secure-payment">
            <i class="fas fa-lock"></i> Your payment is secure and encrypted
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js'></script>

    <script>
        function validateForm() {
            let isValid = true;

            // Clear previous error messages
            document.getElementById("cardholderError").innerHTML = "";
            document.getElementById("cardnumberError").innerHTML = "";
            document.getElementById("expiryError").innerHTML = "";
            document.getElementById("cvvError").innerHTML = "";

            // Validate Card Holder Name
            const cardholder = document.getElementById("cardholder").value;
            if (cardholder === "") {
                document.getElementById("cardholderError").innerHTML = "Card holder name is required.";
                isValid = false;
            }

            // Validate Card Number
            const cardnumber = document.getElementById("cardnumber").value;
            const cardNumberRegex = /^\d{4}\s\d{4}\s\d{4}\s\d{4}$/; // Validate 16 digits with space between each 4 digits
            if (!cardNumberRegex.test(cardnumber)) {
                document.getElementById("cardnumberError").innerHTML = "Enter a valid 16-digit card number in the format XXXX XXXX XXXX XXXX.";
                isValid = false;
            }


            // Validate Expiry Date (MM/YY format)
            const expiry = document.getElementById("expiry").value;
            const expiryRegex = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/; // MM/YY format
            if (!expiryRegex.test(expiry)) {
                document.getElementById("expiryError").innerHTML = "Enter a valid expiry date (MM/YY).";
                isValid = false;
            }

            // Validate CVV (3 digits)
            const cvv = document.getElementById("cvv").value;
            const cvvRegex = /^[0-9]{3}$/;
            if (!cvvRegex.test(cvv)) {
                document.getElementById("cvvError").innerHTML = "CVV must be 3 digits.";
                isValid = false;
            }

            return isValid; // Submit form if all fields are valid
        }
    </script>

</body>

</html>