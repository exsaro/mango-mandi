<?php  
    session_start(); 
    if(!isset($_SESSION['company_id'])){
        header("Location:./login.php");
    }else if(!isset($_SESSION['sales_id'])){ 
        header("Location:./sales.php");
    }else{
        //DB Connection
        require "../DataBase/DBConnect.php";
        $dbConnection   = new DBConnect();
        $connection     = $dbConnection->dbConnect();
        $id = $_SESSION['sales_id'];
        
        unset($_SESSION['sales_id']);
        
        $salesPaymentDataSql = "SELECT * FROM sales as s INNER JOIN customer_master as cum ON s.customer_id = cum.customer_id INNER JOIN company_master as cm ON  s.company_id = cm.company_id WHERE s.status != 'D' AND cum.status != 'D' AND cm.status != 'D' AND cm.company_id = '".$_SESSION['company_id']."' AND s.sales_id = '".$id."'";
        
        $executeQuery  = mysqli_query($connection,$salesPaymentDataSql);
        
        $salesPaymentData = [];

        if($executeQuery != '' && $executeQuery->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($executeQuery)){
                $salesPaymentData[] = $row ;
            }
        }

        $salesPaymentDetail = $salesPaymentData[0];
        $productDetails = [];
        $productSql = "SELECT * FROM sales_detail as fpd INNER JOIN product_master as pm ON fpd.product_id = pm.product_id WHERE sales_id = '".$id."' AND fpd.status='A' AND pm.status = 'A' ";
            
        $productQuery  = mysqli_query($connection,$productSql);
        if($productQuery != '' && $productQuery->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($productQuery)){
                $productDetails[] = $row ;
            }
        }
        $pi = 1;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/themes/bootstrap1.min.css">
    <link rel="stylesheet" href="../css/style.css" media="print">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
        <div id="print_part">
            <header class="bg-dark p-2 text-center">
                <h4 class="text-white">Sales Payment Bill</h4>
            </header>
            <div class="container pt-2">
                <div class="row pb-4">
                    <div class="col-md-6">
                        <p class="font-weight-bold m-0 h4 text-primary"><?php echo $salesPaymentDetail['company_name']; ?></p>
                        <p class="m-0"><?php echo $salesPaymentDetail['company_address']; ?></p>
                        <p class="m-0"><?php echo $salesPaymentDetail['city']; ?></p>
                        <p class="m-0"><?php echo $salesPaymentDetail['state']; ?></p>
                        <p class="m-0"><?php echo $salesPaymentDetail['country']; ?></p>
                        <p class="m-0"><?php echo $salesPaymentDetail['pincode']; ?></p>
                    </div>
                </div>
                <h6 class="font-weight-bold h5">Customer Detail</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Customer Name</th>
                            <th>Customer Code</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>1</td>
                            <td><?php echo $salesPaymentDetail['customer_name']; ?></td>
                            <td><?php echo $salesPaymentDetail['customer_code']; ?></td>
                            <td><?php echo $salesPaymentDetail['customer_email']; ?></td>
                            <td><?php echo $salesPaymentDetail['phone_number']; ?></td>
                            <td><?php echo $salesPaymentDetail['customer_address']; ?>,<br><?php echo $salesPaymentDetail['customer_city']; ?>,<br><?php echo $salesPaymentDetail['customer_district']; ?></td>
                            <td><?php echo $salesPaymentDetail['customer_state']; ?></td>
                            <td><?php echo $salesPaymentDetail['customer_country']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <h6 class="font-weight-bold h5 pt-5">Product Detail</h6>
                <table class="table">
                    <tr>
                        <th>S.No</th>
                        <th>Product Name</th>
                        <th>Product Code</th>
                        <th>Quantity</th>
                        <th>Amount(per Qty)(₹)</th>
                        <th>Net Amount(₹)</th>
                    </tr>
                    <tr>
                        <?php 
                            foreach($productDetails as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $pi; ?></td>
                                    <td><?php echo $value['product_name']; ?></td>
                                    <td><?php echo $value['product_code']; ?></td>
                                    <td><?php echo $value['quantity']; ?></td>
                                    <td><?php echo $value['amount']; ?></td>
                                    <td><?php echo $value['quantity']*$value['amount']; ?></td>
                                </tr>
                        <?php $pi++; } ?>
                    </tr>
                </table>
                <h6 class="font-weight-bold h5 pt-5">Sales Billing Detail</h6>
                <table class="table">
                    <tr>
                        <th>S.No</th>
                        <th>Sales No</th>
                        <th>Payment Date</th>
                        <th>Addtion Amount(₹)</th>
                        <th>Sales Amount(₹)</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td><?php echo $salesPaymentDetail['billing_number']; ?></td>
                        <td><?php echo $salesPaymentDetail['billing_date']; ?></td>
                        <td><?php echo $salesPaymentDetail['other_addition_amount']; ?></td>
                        <td><?php echo $salesPaymentDetail['customer_net_amount']; ?></td>
                    </tr>
                </table>
                              
                
                <?php  if(isset($_SESSION['customer_payment_id'])) { 
                    $customer_payment_id = $_SESSION['customer_payment_id'];
                    unset($_SESSION['customer_payment_id']);
                    $totalPaymentDetail = [];
                    $totalPaymentSql = "SELECT * FROM customer_payment_detail  WHERE customer_payment_id = '".$customer_payment_id."'  AND status = 'A' ";

                        
                    $totalPaymentQuery  = mysqli_query($connection,$totalPaymentSql);
                    if($totalPaymentQuery != '' && $totalPaymentQuery->num_rows > 0)
                    {
                        while($row = mysqli_fetch_assoc($totalPaymentQuery)){
                            $totalPaymentDetail[] = $row ;
                        }
                    }
                    $si =1;
                    
                ?>
                    <h6 class="font-weight-bold h5 pt-5">Customer Paid Detail</h6>
                    <table class="table">
                        <tr>
                            <th>S.No</th>
                            <th>Sales No</th>
                            <th>Payment Date</th>
                            <th>Paid Amount(₹)</th>
                            <th>Sales Amount (₹)</th>
                        </tr>
                            <?php 
                                foreach($totalPaymentDetail as $key => $value) { ?>
                                    <tr>
                                        <td><?php echo $si; ?></td>
                                        <td><?php echo $value['sales_no']; ?></td>
                                        <td><?php echo $value['payment_date']; ?></td>
                                        <td><?php echo $value['amount']; ?></td>
                                        <td><?php echo $value['customer_sales_net_amount']; ?></td>
                                    </tr>
                            <?php $si++; } ?>
                    </table>
                    <p class="text-right"><span class="font-weight-bold h5">Customer Paid Amount: </span><span class="h5"><?php echo $salesPaymentDetail['advance_amount']; ?> /-</span></p>
                    <p class="text-right"><span class="font-weight-bold h5">Balance Amount: </span><span class="h5"><?php echo $salesPaymentDetail['customer_net_amount'] - $salesPaymentDetail['advance_amount']; ?> /-</span></p>
                <?php   } ?>
                <p class="text-right"><span class="font-weight-bold h5">Sales Amount: </span><span class="h5"><?php echo $salesPaymentDetail['customer_net_amount'] - $salesPaymentDetail['other_addition_amount']; ?> /-</span></p>
                <p class="text-right"><span class="font-weight-bold h5">Additional Amount: </span><span class="h5"><?php echo $salesPaymentDetail['other_addition_amount']; ?> /-</span></p>
                <p class="text-right"><span class="font-weight-bold h4">Total Amount: </span><span class="h4"><?php echo $salesPaymentDetail['customer_net_amount']; ?> /-</span></p>
            </div>
            
        </div>
        <div id="printBtn" class="text-right pb-5">
            <button class="btn btn-primary" onclick="printPage('printCheck','sales')">Print</button>
            <button class="btn btn-secondary ml-3" onclick="printPage('cancel','sales')">Cancel</button>
        </div>
    </div>
    <!-- Jquery  -->
    <script src="../js/jquery/jquery-3.3.1.min.js"></script>
    <!-- Validation Plug-in -->
    <script src="../js/Validation/jquery.validate.min.js"></script>
    <!--External Js  -->
    <script src="../js/script/login.js"></script>
    
</body>
</html>