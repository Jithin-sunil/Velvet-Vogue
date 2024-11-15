<?php
include('../Assets/connection/connection.php');
include("Head.php");

if (isset($_POST['upload'])) {
    $photo = $_FILES['photo']['name'];
    $temp = $_FILES['photo']['tmp_name'];
    move_uploaded_file($temp, '../Assets/Files/Service/' . $photo);

    $ins = "INSERT INTO tbl_servicegallery (service_id, gallery_image) VALUES ('" . $_GET['gid'] . "', '" . $photo . "')";
    if ($con->query($ins)) {
        ?>
        <script>
            alert('Gallery Added..');
            window.location = "ServiceGallery.php?gid=<?php echo $_GET['gid']; ?>";
        </script>
        <?php
    }
}

// Handle deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Fetch image to delete the file
    

        // Delete the record from the database
        $del_query = "DELETE FROM tbl_servicegallery WHERE gallery_id = '$delete_id'";
        $con->query($del_query);
        ?>
        <script>
            alert('Photo Deleted..');
            window.location = "ServiceGallery.php?gid=<?php echo $_GET['gid']; ?>";
        </script>
        <?php
    }


$gid = $_GET['gid'];
$query = "SELECT * FROM tbl_servicegallery WHERE service_id = '$gid' ORDER BY gallery_id DESC"; // Show latest uploaded photos first
$result = $con->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Service Photo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lavender;
            margin: 0;
            padding: 0;
            height: auto;
        }

        .main {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        input[type="file"] {
            margin: 10px 0;
            padding: 5px;
            width: 100%;
        }

        input[type="submit"] {
            background-color: lavender;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color: #e0ccee;
        }

        .gallery {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .gallery .gallery-item {
            margin: 10px;
            text-align: center;
        }

        .gallery img {
            width: 150px;
            height: auto;
            border-radius: 5px;
            display: block;
            margin-bottom: 5px;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }

        .delete-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
<div class="main">

    <form action="" method="post" enctype="multipart/form-data">
        <h2>Upload Service Photo</h2>
        <input type="file" name="photo" accept="image/*" required>
        <input type="submit" name="upload" value="Upload">
    </form>

    <div class="gallery">
        <h2>Uploaded Photos</h2><br>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<div class="gallery-item">';
            echo '<img src="../Assets/Files/Service/' . $row['gallery_image'] . '" alt="Service Image">';
            echo '<a href="ServiceGallery.php?gid=' . $gid . '&delete_id=' . $row['gallery_id'] . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this photo?\')">Delete</a>';
            echo '</div>';
        }
        ?>
    </div>

</div>
</body>
</html>

<?php
include('Foot.php');
?>
