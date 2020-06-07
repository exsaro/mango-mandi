<?php  
    session_start(); 
    if(!isset($_SESSION['company_id'])){
        header("Location:./login.php");
    }else if(!isset($_SESSION['customer_payment_id'])){ 
        header("Location:./customerPayment.php");
    }else{
        //DB Connection
        require "../DataBase/DBConnect.php";
        $dbConnection   = new DBConnect();
        $connection     = $dbConnection->dbConnect();
        $id = $_SESSION['customer_payment_id'];
        
        unset($_SESSION['customer_payment_id']);
        
        $customerPaymentDataSql = "SELECT * FROM customer_payment as cp INNER JOIN customer_master as cum ON cp.customer_id = cum.customer_id INNER JOIN company_master as cm ON  cp.company_id = cm.company_id WHERE cp.status != 'D' AND cum.status != 'D' AND cm.status != 'D' AND cm.company_id = '".$_SESSION['company_id']."' AND cp.customer_payment_id = '".$id."'";
        
        $executeQuery  = mysqli_query($connection,$customerPaymentDataSql);
        
        $customerPaymentData = [];

        if($executeQuery != '' && $executeQuery->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($executeQuery)){
                $customerPaymentData[] = $row ;
            }
        }

        $customerPaymentDetail = $customerPaymentData[0];
        
        $totalPaymentDetail = [];
        $totalPaymentSql = "SELECT * FROM customer_payment_detail  WHERE customer_payment_id = '".$id."'  AND status = 'A' ";
            
        $totalPaymentQuery  = mysqli_query($connection,$totalPaymentSql);
        if($totalPaymentQuery != '' && $totalPaymentQuery->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($totalPaymentQuery)){
                $totalPaymentDetail[] = $row ;
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
                <h4 class="text-white">Customer Payment Bill</h4>
            </header>
            <div class="container pt-2">
                <div class="row pb-4">
                    <div class="col-md-6">
                        <p class="font-weight-bold m-0 h4 text-primary"><?php echo $customerPaymentDetail['company_name']; ?></p>
                        <p class="m-0"><?php echo $customerPaymentDetail['company_address']; ?></p>
                        <p class="m-0"><?php echo $customerPaymentDetail['city']; ?></p>
                        <p class="m-0"><?php echo $customerPaymentDetail['state']; ?></p>
                        <p class="m-0"><?php echo $customerPaymentDetail['country']; ?></p>
                        <p class="m-0"><?php echo $customerPaymentDetail['pincode']; ?></p>
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
                            <td><?php echo $customerPaymentDetail['customer_name']; ?></td>
                            <td><?php echo $customerPaymentDetail['customer_code']; ?></td>
                            <td><?php echo $customerPaymentDetail['customer_email']; ?></td>
                            <td><?php echo $customerPaymentDetail['phone_number']; ?></td>
                            <td><?php echo $customerPaymentDetail['customer_address']; ?>,<br><?php echo $customerPaymentDetail['customer_city']; ?>,<br><?php echo $customerPaymentDetail['customer_district']; ?></td>
                            <td><?php echo $customerPaymentDetail['customer_state']; ?></td>
                            <td><?php echo $customerPaymentDetail['customer_country']; ?></td>
                        </tr>
                    </tbody>
                </table>
                    
                <h6 class="font-weight-bold h5">Sales Billing Detail</h6>
                <table class="table">
                    <tr>
                        <th>S.No</th>
                        <th>Sales No</th>
                        <th>Payment Date</th>
                        <th>Paid Amount(₹)</th>
                        <th>Sales Amount Amount(₹)</th>
                    </tr>
                    <tr>
                        <?php 
                            foreach($totalPaymentDetail as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $pi; ?></td>
                                    <td><?php echo $value['sales_no']; ?></td>
                                    <td><?php echo $value['payment_date']; ?></td>
                                    <td><?php echo $value['amount']; ?></td>
                                    <td><?php echo $value['customer_sales_net_amount']; ?></td>
                                </tr>
                        <?php $pi++; } ?>
                    </tr>
                </table>
                <p class="text-right"><span class="font-weight-bold h5">Sales Amount: </span><span class="h5"><?php echo $customerPaymentDetail['sales_amount']; ?> /-</span></p>
                <p class="text-right"><span class="font-weight-bold h5">Customer Paid Amount: </span><span class="h5"><?php echo $customerPaymentDetail['customer_paid_amount']; ?> /-</span></p>
                <p class="text-right"><span class="font-weight-bold h5">Balance: </span><span class="h5"><?php echo $customerPaymentDetail['balance_amount']; ?> /-</span></p>
                <p class="text-right"><span class="font-weight-bold h4">Total Amount: </span><span class="h4"><?php echo $customerPaymentDetail['total_amount']; ?> /-</span></p>
                
            </div>
            
        </div>
        <div id="printBtn" class="text-right pb-5">
            <button class="btn btn-primary" onclick="printCustomerPayment('printCheck')">Print</button>
            <button class="btn btn-secondary ml-3" onclick="printCustomerPayment('cancel')">Cancel</button>
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