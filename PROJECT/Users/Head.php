<?php
include("SessionValidation.php");
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Velvet Vogue</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../Assets/Templates/MainNew/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../Assets/Templates/MainNew/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../Assets/Templates/MainNew/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../Assets/Templates/MainNew/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../Assets/Templates/MainNew/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <!-- <div class="container-fluid bg-light d-none d-lg-block">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-left mb-2 mb-lg-0"> -->
                <!-- <div class="d-inline-flex align-items-center">
                    <small><i class="fa fa-phone-alt mr-2"></i>+012 345 6789</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>info@example.com</small>
                </div> -->
            <!-- </div>
            <div class="col-lg-6 text-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-primary px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-primary px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-primary px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-primary px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-primary pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="index.html" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-primary"><span class="text-dark">Velvet</span>Vogue</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav m-auto py-0">
                    <a href="Homepage.php" class="nav-item nav-link active">Home</a>
                    <a href="MyProductBooking.php" class="nav-item nav-link">Mybooking</a> 
                    <a href="Mycomplaints.php" class="nav-item nav-link">My Complaints</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Services</a>
                        <div class="dropdown-menu rounded-0 m-0">
                        <a href="BookServices.php" class="nav-item nav-link">Book Services</a>
                        <a href="MyServiceBooking.php" class="nav-item nav-link">My Services</a>
                           
                        </div>
                    </div>
                    <a href="Myprofile.php" class="nav-item nav-link"><i class="fa-solid fa-user"></i></a>
                    <a href="MYCart.php" class="nav-item nav-link"><i class="fa-solid fa-cart-shopping"></i></a>
                    <a href="SearchNew.php" class="nav-item nav-link"><i class="fa-solid fa-magnifying-glass"></i></a>
                    <!-- <a href="contact.html" class="nav-item nav-link">Contact</a> -->
                </div>
                <a href="../Logout.php" class="btn btn-primary d-none d-lg-block">LogOut</a>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->