<?php
include('Head.php'); // Include your header
include('../Assets/Connection/Connection.php'); // Assuming you have a file to manage your DB connection

// Query to get the number of users from tbl_customerregistration
$user_query = "SELECT COUNT(*) AS total_users FROM tbl_customerregistration";
$user_result = $con->query($user_query);
$user_data = $user_result->fetch_assoc();
$total_users = $user_data['total_users'];

// Query to get the total service bookings from tbl_servicebooking
$service_booking_query = "SELECT COUNT(*) AS total_service_bookings FROM tbl_servicebooking";
$service_booking_result = $con->query($service_booking_query);
$service_booking_data = $service_booking_result->fetch_assoc();
$total_service_bookings = $service_booking_data['total_service_bookings'];

// Query to get the total product bookings from tbl_booking
$product_booking_query = "SELECT COUNT(*) AS total_product_bookings FROM tbl_booking";
$product_booking_result = $con->query($product_booking_query);
$product_booking_data = $product_booking_result->fetch_assoc();
$total_product_bookings = $product_booking_data['total_product_bookings'];
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    a{
        text-decoration: none;
    }
    
</style>
<div class="container mt-5">
    <!-- <h1 class="text-center mb-4">Admin Dashboard</h1> -->

    <!-- Unified Dashboard Statistics Card -->
    <div class="card text-white bg-dark mb-3">
        <div class="card-header text-center">
            <!-- <h3>Dashboard Statistics</h3> -->
        </div>
        <div class="card-body">
            <div class="row text-center">
                <!-- Total Users -->
                <div class="col-md-4 mb-3">
                    <div class="p-3 bg-primary rounded shadow-sm">
                        <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">Total Users</h4>
                        <p class="h2">
                            <?php echo $total_users; ?>
                        </p>
                    </div>
                </div>

                <!-- Total Service Bookings -->
                <div class="col-md-4 mb-3">
                    
                    <div class="p-3 bg-success rounded shadow-sm">
                        <i class="bi bi-tools" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">Total Service Bookings</h4>
                        <p class="h2">
                            <?php echo $total_service_bookings; ?>
                        </p>
                    </div>
                    
                </div>

                <!-- Total Product Bookings -->
                <div class="col-md-4 mb-3">
                <a href="UserReport.php">
                    <div class="p-3 bg-warning rounded shadow-sm">
                        <i class="bi bi-cart-fill" style="font-size: 2rem;"></i>
                        <h4 class="mt-2">Total Product Bookings</h4>
                        <p class="h2">
                            <?php echo $total_product_bookings; ?>
                        </p>
                    </div>
                    </a>
                </div>
            </div>
        </div>


    </div>
    
    <section class="main_content dashboard_part">
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="QA_section">
                            <div class="QA_table mb_30">
                                <iframe style="border: none; border-radius: 15px; width: 100%; height: 653px ;"
                                    src="ProductSalesReport.php" ></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
include('Foot.php'); // Include your footer
?>