<?php
include('../connection/connection.php');

$category = $_GET['category'];
if (!empty($category)) {
    
    $selQry = "SELECT * FROM tbl_subcategory WHERE category_id IN ($category)";
    $result = $con->query($selQry);

    while ($data = $result->fetch_assoc()) {
        echo '<div class="form-check">
            <input class="form-check-input" type="checkbox" value="' . $data['subcategory_id'] . '" id="subcategory' . $data['subcategory_id'] . '" name="subcategory" onchange="getSearch()">
            <label class="form-check-label" for="subcategory' . $data['subcategory_id'] . '">' . $data['subcategory_name'] . '</label>
        </div>';
    }
} else {
    echo '<p>No categories Available</p>';
}
?>
