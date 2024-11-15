<?php
include("../Assets/Connection/Connection.php");
$oid = $_GET['id'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Tax Invoice</title>
    <link rel="shortcut icon" type="image/png" href="./favicon.png" />
    <style>
        * {
            box-sizing: border-box;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            word-break: break-all;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        pre,
        p {
            /* width: 99%; */
            /* overflow: auto; */
            /* bpicklist: 1px solid #aaa; */
            padding: 0;
            margin: 0;
        }

        table {
            font-family: arial, sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
        }

        td,
        th {
            text-align: left;
            padding: 8px 6px;
        }

        .table-b td,
        .table-b th {
            border: 1px solid #ddd;
        }

        th {
            /* background-color: #ddd; */
        }

        .hm-p td,
        .hm-p th {
            padding: 3px 0px;
        }

        .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px;
            /* height of container */
            overflow: hidden;
        }

        .t1 {
            border-color: #4a4a4a;
        }

        .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #ddd;
            padding: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <?php
    $selqry = "select * from tbl_customerregistration customer inner join tbl_booking r on customer.customer_id = r.customer_id inner join tbl_cart c  on r.booking_id=c.booking_id inner join tbl_product p on c.product_id=p.product_id where r.booking_id=" . $oid . " ";
    $result = $con->query($selqry);
    $data = $result->fetch_assoc();

    ?>
    <button id="cmd" onClick="printDiv('content')"
        style="float:right;color:#FFF;background:#0C0;border:none;margin:20px;padding:10px;border-radius:10px">PDF
        Bill
    </button>
    <br /><br /><br /><br /><br /><br />


    <section class="main-pd-wrapper" style="width: 1000px; margin: auto" id="content">
        <div style="display: table-header-group">
            <h4 style="text-align: center; margin: 0">

            </h4>

            <table style="width: 100%; table-layout: fixed">
                <tr>
                    <td style="border-left: 1px solid #ddd; border-right: 1px solid #ddd">
                        <div style="text-align: center; margin: auto;line-height: 1.5;font-size: 14px;color: #4a4a4a;">

                            <!-- <img style="width: 100px;height: 100px;border-radius: 50%;overflow: hidden;"
                                src="../Assets/File/Admin/A.png" alt="logo" /><br> -->

                            <span style="font-family:garmond;color:#234A6F;font-size:56px">Velvet Vogue</span><br><br>



                    </td>
                    <td align="right" style="
                text-align: right;
                padding-left: 50px;
                line-height: 1.5;
                color: #323232;
              ">
                        <div>
                            <?php
                            $selad = "select * from tbl_customerregistration customer inner join tbl_place c on customer.place_id=c.place_id inner join tbl_district d on c.district_id=d.district_id where customer_id =" . $data['customer_id'] . "";
                            $resad = $con->query($selad);
                            $rowad = $resad->fetch_assoc();

                            ?>
                            <h4 style="margin-top: 5px; margin-bottom: 5px">
                                Billing Address
                            </h4>
                            <p style="font-size: 14px">
                                <b>
                                    <?php echo $data["customer_name"] ?>
                                </b><br>
                                <?php echo $data["customer_address"] ?>
                                <br />
                                <?php echo $rowad["place_name"] ?>
                                <br />
                                
                                <?php echo $rowad["district_name"] ?>
                                <br />
                                contact:
                                <?php echo $data["customer_contact"] ?>
                            </p>
                            <div>
                            </div>
                            <div>
                                <br>
                                <h4 style="margin-top: 5px; margin-bottom: 5px">
                                    Shipping Address
                                </h4>
                                <p style="font-size: 14px">
                                    <?php echo $data["customer_address"] ?>
                                </p>
                            </div>
                    </td>
                </tr>
            </table>
            <table class="t1" width=100%>

                <?php
                // Sample data
                $bill = [
                    'booking_id' => $data['booking_id'],
                    // Your order ID
                    'booking_datetime' => $data['booking_datetime'],
                    // Your order date in the format 'YYYY-MM-DD'
                ];

                // Reformat the booking_datetime to 'YYYYMMDD'
                $orderDate = date('Ymd', strtotime($bill['booking_datetime']));

                // Ensure that the order ID has enough preceding zeros to fit the length
                $billOrderID = str_pad($bill['booking_id'], 4, '0', STR_PAD_LEFT);

                // Concatenate the reformatted order date and the adjusted order ID
                $billNumber = $orderDate . $billOrderID;
                ?>
                <tr  style="
              margin: 0;
              background: #daf0f7;
              padding: 15px;
              padding-left: 20px;
              -webkit-print-color-adjust: exact;
            ">
                    <td style="width: 50%">
                        <p>order Date:
                            <?php echo $data["booking_datetime"] ?>
                        </p>
                        <p>ordered from: Velvet Vogue
                        </p>
                        
                    </td>
                    
                    <td style="width: 50%;text-align:right">
                    <p style="margin: 5px 0">Invoice Generated on : 
                            <?php echo date("Y-m-d"); ?>
                        </p>
                        <p>Bill number:
                            <?php echo $billNumber;?>
                        </p>
                    </td>
                  

            </table>
        </div>
        <table class="table table-bordered h4-14" style="width: 100%; -fs-table-paginate: paginate; margin-top: 15px">
            <thead style="display: table-header-group">

                </tr>

                <tr>
                    <th style="width: 30px">#</th>
                    <th style="width: 100px">Product</th>
                    <th style="width: 100px">description</th>
                    <!-- <th style="width: 200px">Sold by</th> -->
                    <th style="width: 50px">Price</th>
                    <th style="width: 50px">Qty</th>
                    <th style="width: 70px">
                        <h4>total price</h4>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                $i = 0;
                $sel4 = "select * from tbl_cart c inner join tbl_product p on c.product_id = p.product_id where booking_id = " . $data['booking_id']." ";
                $result4 = $con->query($sel4);
                while ($res1 = $result4->fetch_assoc()) {
                    $i++;
                    ?>

                    <tr>
                        <td>
                            <?php echo $i ?>
                        </td>
                        <td>
                            <?php echo $res1["product_name"] ?>
                        </td>
                        <td>
                            <?php echo $res1["product_details"] ?>
                        </td>
                        

                        <td>
                            <?php echo $res1["product_price"] ?>
                        </td>
                        <td>
                            <?php echo $res1["cart_quantity"] ?>
                        </td>
                        <td>
                            <?php echo $res1["product_price"] * $res1["cart_quantity"] ?>
                        </td>
                    </tr>

                    <?php
                    $total += ($res1["product_price"] * $res1['cart_quantity']);
                }
                ?>
            </tbody>
            <tfoot></tfoot>
        </table>


        <table class="hm-p table-bordered" style="width: 100%; margin-top: 30px">
            <tr style="background: #b4cbf0 ; -webkit-print-color-adjust: exact;">
                <th>Grand Total</th>
                <td style="width: 100px; text-align: right; border-right: none">
                    <b>
                        <?php echo $total . " Rs" ?>
                    </b>
                </td>
                <td colspan="5" style="border-left: none"></td>
            </tr>
        </table>
    </section>


    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js'></script>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            console.log(printContents);
            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>

</html>