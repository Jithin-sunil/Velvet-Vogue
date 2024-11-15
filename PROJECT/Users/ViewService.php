<?php
include('../Assets/connection/connection.php');
include("Head.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Display</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lavender;
            margin: 0;
            padding: 20px;
        }

        .service-card {
            margin: 20px;
            border-radius: 10px;
        }

        .carousel-inner img {
            width: 100%;
            height: 300px;
            object-fit: inherit;
            border-radius: 10px;
        }

        .book-btn {
            background-color: #5d3a7a;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            margin-top: 15px;
        }

        .book-btn:hover {
            background-color: #4b2961;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- <h2 class="text-center my-4">Our Services</h2> -->

    <div class="row">
        <?php
        $sel = "SELECT * FROM tbl_services 
              ";
        $row = $con->query($sel);
        while ($service = $row->fetch_assoc()) {
        ?>
        <div class="col-md-4">
            <div class="card service-card">
                <!-- Image Carousel -->
                <div id="carousel<?php echo $service['service_id']; ?>" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $service_id = $service['service_id'];
                        $img_query = "SELECT * FROM tbl_servicegallery WHERE service_id='$service_id'";
                        $img_result = $con->query($img_query);
                        $firstImage = true;
                        while ($image = $img_result->fetch_assoc()) {
                            $activeClass = $firstImage ? 'active' : '';
                            echo '<div class="carousel-item ' . $activeClass . '">';
                            echo '<img src="../Assets/Files/Service/' . $image['gallery_image'] . '" alt="Service Image">';
                            echo '</div>';
                            $firstImage = false;
                        }
                        ?>
                    </div>
                    <!-- Controls for manually navigating -->
                    <a class="carousel-control-prev" href="#carousel<?php echo $service['service_id']; ?>" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel<?php echo $service['service_id']; ?>" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <!-- Card Body with Service Details -->
                <div class="card-body">
                    <h5 class="card-title"><?php echo $service['service_name']; ?></h5>
                    <p class="card-text"><strong>Rate:</strong> <?php echo $service['service_rate']; ?> RS</p>
                    <p class="card-text"><strong>Details:</strong> <?php echo $service['service_details']; ?></p>
                    <p class="card-text"><strong>Duration:</strong> <?php echo $service['service_duration']; ?> minutes</p>

                    <!-- Book Appointment Button -->
                    <a href="BookAppointment.php?service_id=<?php echo $service['service_id']; ?>" class="btn btn-primary book-btn">Book Appointment</a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS and dependencies (jQuery and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Enable auto-slide for the carousel -->
<script>
    $('.carousel').carousel({
        interval: 5000 // 3 seconds for each image transition
    });
</script>
</body>
</html>

<?php
include("Foot.php");
?>
