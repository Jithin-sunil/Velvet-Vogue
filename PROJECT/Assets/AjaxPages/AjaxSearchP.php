<?php
include("../connection/connection.php");
?>
<div class="container mt-4">
    <div class="row">
        <?php
        $selQry = "SELECT p.*, sc.subcategory_name, c.category_name, 
        COALESCE(s.stock_quantity, 0) as available_stock, 
        COALESCE(SUM(cart.cart_quantity), 0) as cart_quantity,
        b.brand_name  
        FROM tbl_product p 
        INNER JOIN tbl_subcategory sc ON p.subcategory_id = sc.subcategory_id 
        INNER JOIN tbl_category c ON sc.category_id = c.category_id 
        LEFT JOIN tbl_stock s ON p.product_id = s.product_id 
        LEFT JOIN tbl_cart cart ON p.product_id = cart.product_id 
        LEFT JOIN tbl_brand b ON p.brand_id = b.brand_id  
        WHERE TRUE";

        if (!empty($_GET['category'])) {
            $selQry .= " AND c.category_id IN(" . $_GET['category'] . ")";
        }

        if (!empty($_GET['subcategory'])) {
            $selQry .= " AND sc.subcategory_id IN(" . $_GET['subcategory'] . ")";
        }

        if (!empty($_GET['search'])) {
            $name = $_GET['search'];
            $selQry .= " AND (p.product_name LIKE '%$name%' 
                    OR b.brand_name LIKE '%$name%' 
                    OR p.product_details LIKE '%$name%')";
        }
        

        $selQry .= " GROUP BY p.product_id";

        $reslt = $con->query($selQry);

        while ($data = $reslt->fetch_assoc()) {
            $remaining_stock = $data['available_stock'] - $data['cart_quantity'];
            ?>
        <div class="col-md-3 mb-4">
            <div class="product-card">
                <div class="product-image">
                    <img src="../Assets/Files/Product/<?php echo $data['product_photo']; ?>"
                        alt="<?php echo $data['product_name']; ?>">
                </div>
                <div class="product-info">
                    <h5 class="product-title">
                        <?php echo $data['product_name']; ?>
                    </h5>
                    <p class="product-brand">Details: <strong>
                            <?php echo $data['product_details']; ?>
                        </strong></p>
                    <p class="product-brand">Brand: <strong>
                            <?php echo $data['brand_name']; ?>
                        </strong></p>
                    <p class="product-price">Price: <strong>
                            <?php echo $data['product_price']; ?>
                        </strong></p>
                        <p class="product-price">Category: <strong>
                            <?php echo $data['category_name']; ?>
                        </strong></p>
                    <p class="product-subcategory">Subcategory:<strong>
                        <?php echo $data['subcategory_name']; ?>
                        </strong>
                    </p>
                    <?php


                        $average_rating = 0;
                        $total_review = 0;
                        $five_star_review = 0;
                        $four_star_review = 0;
                        $three_star_review = 0;
                        $two_star_review = 0;
                        $one_star_review = 0;
                        $total_user_rating = 0;
                        $review_content = array();

                        $query = "
                                        SELECT * FROM tbl_review where  product_id = '" . $data["product_id"] . "' ORDER BY review_id DESC
                                        ";

                        $result = $con->query($query);

                        while ($row = $result->fetch_assoc()) {


                            if ($row["customer_rating"] == '5') {
                                $five_star_review++;
                            }

                            if ($row["customer_rating"] == '4') {
                                $four_star_review++;
                            }

                            if ($row["customer_rating"] == '3') {
                                $three_star_review++;
                            }

                            if ($row["customer_rating"] == '2') {
                                $two_star_review++;
                            }

                            if ($row["customer_rating"] == '1') {
                                $one_star_review++;
                            }

                            $total_review++;

                            $total_user_rating = $total_user_rating + $row["customer_rating"];

                        }


                        if ($total_review == 0 || $total_user_rating == 0) {
                            $average_rating = 0;
                        } else {
                            $average_rating = $total_user_rating / $total_review;
                        }

                        ?>
                    <p align="center" style="color:#F96;font-size:20px">
                        <?php
                            if ($average_rating == 5 || $average_rating == 4.5) {
                                ?>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <?php
                            }
                            if ($average_rating == 4 || $average_rating == 3.5) {
                                ?>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <?php
                            }
                            if ($average_rating == 3 || $average_rating == 2.5) {
                                ?>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <?php
                            }
                            if ($average_rating == 2 || $average_rating == 1.5) {
                                ?>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <?php
                            }
                            if ($average_rating == 1) {
                                ?>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <?php
                            }
                            if ($average_rating == 0) {
                                ?>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                        <?php
                            }
                            ?>

                    </p>
                    <?php

                        $output = array(
                            'average_rating' => number_format($average_rating, 1),
                            'total_review' => $total_review,
                            'five_star_review' => $five_star_review,
                            'four_star_review' => $four_star_review,
                            'three_star_review' => $three_star_review,
                            'two_star_review' => $two_star_review,
                            'one_star_review' => $one_star_review,
                            'review_data' => $review_content
                        );
?>
                    <div class="product-action">
                        <?php if ($remaining_stock > 0): ?>
                        <button class="btn btn-cart" onclick="addCart(<?php echo $data['product_id']; ?>)">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                        <?php else: ?>
                        <p class="text-danger">Out of Stock</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>
<style>
    .product-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.2s;
    }

    .product-card:hover {
        transform: scale(1.02);
    }

    .product-image {
        height: 200px; /* Fixed height for the image area */
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f8f8; /* Light gray background for the image area */
        overflow: hidden; /* Hide overflow if the image is too large */
    }

    .product-image img {
        height: 100%; /* Fill the height of the container */
        width: auto; /* Maintain aspect ratio */
        max-width: 100%; /* Prevent overflow */
        object-fit: cover; /* Cover the entire area */
        border-radius: 8px 8px 0 0; /* Rounded top corners */
    }

    .product-info {
        padding: 15px;
        text-align: left;
    }

    .product-title {
        font-size: 1.5em;
        color: #333;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .product-brand {
        font-size: 1em;
        color: #777;
        margin-bottom: 5px;
    }

    .product-price {
        font-size: 1.2em;
        color: #28a745;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .product-subcategory {
        font-size: 0.9em;
        color: #555;
        margin-bottom: 10px;
    }

    .product-action {
        margin-top: auto; /* Push button to the bottom */
    }

    .btn-cart {
        width: 50px; /* Set a fixed width */
        height: 50px; /* Set a fixed height for a square button */
        background-color: #007bff; /* Primary button color */
        color: white;
        border: none;
        border-radius: 50%; /* Make it circular */
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        display: flex; /* Flexbox for alignment */
        align-items: center; /* Center icon vertically */
        justify-content: center; /* Center icon horizontally */
    }

    .btn-cart:hover {
        background-color: #0056b3; /* Darker shade on hover */
        transform: scale(1.05);
    }

    .text-danger {
        color: #dc3545; /* Bootstrap danger color */
        font-weight: bold;
        margin-top: 10px;
        text-align: center; /* Centered for better visibility */
    }

    /* Responsive design adjustments */
    @media (max-width: 768px) {
        .product-card {
            margin: 10px 0;
        }

        .product-title {
            font-size: 1.3em; /* Slightly smaller title on mobile */
        }

        .product-price {
            font-size: 1.1em; /* Slightly smaller price on mobile */
        }
    }
</style>
