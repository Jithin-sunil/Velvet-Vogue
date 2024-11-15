<?php

//submit_rating.php
include("../connection/connection.php");

if(isset($_POST["rating_data"]))
{

	$ins = "INSERT INTO tbl_review(customer_name,customer_rating,customer_review,review_datetime,product_id)VALUES('".$_POST["user_name"]."','".$_POST["rating_data"]."','".$_POST["user_review"]."',NOW(),'".$_POST["product_id"]."')";
	
	if($con->query($ins))
{
	echo "Your Review & Rating Successfully Submitted";
}
else
{
	echo "Your Review & Rating Insertion Failed";
}

}

if(isset($_POST["action"]))
{
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
	SELECT * FROM tbl_review where product_id = '".$_POST["pid"]."' ORDER BY review_id DESC
	";

	$result = $con->query($query);

	while($row = $result->fetch_assoc())
	{
		$review_content[] = array(
			'user_name'		=>	$row["customer_name"],
			'user_review'	=>	$row["customer_review"],
			'rating'		=>	$row["customer_rating"],
			'datetime'		=>	$row["review_datetime"]
		);

		if($row["customer_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["customer_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["customer_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["customer_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["customer_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["customer_rating"];

	}

	$average_rating = $total_user_rating / $total_review;

	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>