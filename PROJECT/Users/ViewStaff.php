<?php
include('../Assets/Connection/Connection.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td>#</td>
            <td>photo</td>
            <td>Name</td>
            <td>Gender</td>
            <!-- <td>Service</td> -->
            <td>Action</td>
        </tr>
        <?php
          $i=0;
        $sel=" select * from tbl_staff s inner join tbl_services p on s.service_id=p.service_id ";
        $res=$con->query($sel);
        while($row=$res->fetch_assoc())
        {
            $i++;
            ?>
            
        
        <tr>
            <td><?php echo $i; ?></td>
            <td><img src="../Assets/Files/staff/<?php echo $row['staff_photo']?>" Width="50" height="50" /></td>
            <td><?php echo $row['staff_name']?></td>
            <td><?php echo $row['staff_gender']?></td>
            <!-- <td><?php echo $row['service_name']?></td> -->
            <td>
            
               <a href="BookServices.php?id=<?php echo $row['staff_id']?>">Book</a>
             
            
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>