<?php
include('../connection/connection.php');
$sel="select * from tbl_subcategory where category_id IN(".$_GET["data"].")";
$row=$con->query($sel);
while($data=$row->fetch_assoc())
{
	?>
    <li class="list-group-item">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" onclick="productCheck()" class="form-check-input product_check" value="<?php echo $data["subcategory_id"]?>" id="category"><?php echo $data["subcategory_name"]; ?>
                                </label>
                            </div>
                        </li>
    <?php
}
?>