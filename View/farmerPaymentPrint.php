<?php  
    session_start(); 
    $_SESSION['farmer_payment_id'] = 16;

    if(!isset($_SESSION['company_id'])){
        header("Location:./login.php");
    }else if(!isset($_SESSION['farmer_payment_id'])){ 
        header("Location:./farmerPayment.php");
    }else{
        //DB Connection
        require "../DataBase/DBConnect.php";
        $dbConnection   = new DBConnect();
        $connection     = $dbConnection->dbConnect();
        $id = $_SESSION['farmer_payment_id'];
        
        unset($_SESSION['farmer_payment_id']);
        
        $farmerPaymentDataSql = "SELECT * FROM farmer_payment as fp INNER JOIN farmer_master as fm ON fp.farmer_id = fm.farmer_id INNER JOIN company_master as cm ON  fp.company_id = cm.company_id WHERE fp.status != 'D' AND fm.status != 'D' AND cm.status != 'D' AND cm.company_id = '".$_SESSION['company_id']."' AND fp.farmer_payment_id = '".
        $id."'";
        
        $executeQuery  = mysqli_query($connection,$farmerPaymentDataSql);
        
        $farmerPaymentData = [];

        if($executeQuery != '' && $executeQuery->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($executeQuery)){
                $farmerPaymentData[] = $row ;
            }
        }

        $farmerPaymentDetail = $farmerPaymentData[0];
        
        $voucherDisp = 'N';
        $voucherDetail = [];
        if(isset($farmerPaymentDetail['voucher_id']) && $farmerPaymentDetail['voucher_id'] != ''){
            $voucherDisp = 'Y';
            $voucherSql = "SELECT * FROM voucher as v INNER JOIN voucher_detail as vd ON v.voucher_id = vd.voucher_id WHERE v.status  = 'A' AND vd.status = 'A' AND v.voucher_id  IN (".$farmerPaymentDetail['voucher_id'].") ";
        
            $voucherQuery  = mysqli_query($connection,$voucherSql);
            if($voucherQuery != '' && $voucherQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($voucherQuery)){
                    $voucherDetail[] = $row ;
                }
            }
        }

        $totalPaymentDetail = [];
        $totalPaymentSql = "SELECT * FROM farmer_payment_detail as fpd INNER JOIN product_master as pm ON fpd.product_id = pm.product_id WHERE farmer_payment_id = '".$id."' AND fpd.status='A' AND pm.status = 'A' ";
            
        $totalPaymentQuery  = mysqli_query($connection,$totalPaymentSql);
        if($totalPaymentQuery != '' && $totalPaymentQuery->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($totalPaymentQuery)){
                $totalPaymentDetail[] = $row ;
            }
        }
        $pi = 1;
        $vi = 1;
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/themes/bootstrap1.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    
    <div class="container">
        <div id="print_part">
            <header class="bg-dark p-2 text-center">
                <h4 class="text-white">Farmer Payment Bill</h4>
            </header>
            <div class="container pt-2">
                <div class="row">
                    <div class="col-md-6">
                        <p><?php echo $farmerPaymentDetail['company_name']; ?></p>
                        <p><?php echo $farmerPaymentDetail['company_address']; ?></p>
                        <p><?php echo $farmerPaymentDetail['city']; ?></p>
                        <p><?php echo $farmerPaymentDetail['state']; ?></p>
                        <p><?php echo $farmerPaymentDetail['country']; ?></p>
                        <p><?php echo $farmerPaymentDetail['pincode']; ?></p>
                    </div>
                </div>
                <h6 class="font-weight-bold">Farmer Detail</h6>
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Farmer Name</th>
                            <th>Farmer Code</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>1</td>
                            <td><?php echo $farmerPaymentDetail['farmer_name']; ?></td>
                            <td><?php echo $farmerPaymentDetail['farmer_code']; ?></td>
                            <td><?php echo $farmerPaymentDetail['farmer_address']; ?>,<br><?php echo $farmerPaymentDetail['farmer_city']; ?>,<br><?php echo $farmerPaymentDetail['farmer_district']; ?></td>
                            <td><?php echo $farmerPaymentDetail['farmer_state']; ?></td>
                            <td><?php echo $farmerPaymentDetail['farmer_country']; ?></td>
                        </tr>
                    </tbody>
                </table>
                    
                <h6 class="font-weight-bold">Product Detail</h6>
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
                            foreach($totalPaymentDetail as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $pi; ?></td>
                                    <td><?php echo $value['product_name']; ?></td>
                                    <td><?php echo $value['product_code']; ?></td>
                                    <td><?php echo $value['quantity']; ?></td>
                                    <td><?php echo $value['amount']; ?></td>
                                    <td><?php echo $value['sale_net_amount']; ?></td>
                                </tr>
                        <?php $pi++; } ?>
                    </tr>
                </table>
                <p class="text-right"><span class="font-weight-bold">Total Sale Amount: </span><?php echo $farmerPaymentDetail['total_sales_amount']; ?> /-</p>
                <h6>Voucher Detail</h6>
                <table class="table">
                    <tr>
                        <th>S.No</th>
                        <th>Voucher No</th>
                        <th>Voucher Date</th>
                        <th>Amount(₹)</th>
                        <th>Description</th>
                    </tr>
                    <tr>
                        <?php 
                            foreach($voucherDetail as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $vi; ?></td>
                                    <td><?php echo $value['voucher_no']; ?></td>
                                    <td><?php echo $value['voucher_date']; ?></td>
                                    <td><?php echo $value['amount']; ?></td>
                                    <td><?php echo $value['description']; ?></td>
                                </tr>
                        <?php $vi++; } ?>
                    </tr>
                </table>
                <p class="text-right"><span class="font-weight-bold">Total Deduction Amount: </span><?php echo $farmerPaymentDetail['total_detection']; ?> /-</p>
                <p class="text-right"><span class="font-weight-bold">Total Amount: </span><?php echo $farmerPaymentDetail['total_amount']; ?> /-</p>
                
            </div>
            
        </div>
        <button class="btn btn-primary" onclick="printFarmerPayment()">print</button>
                <button class="btn btn-secondary">Go Back</button>
    </div>
    <!-- Jquery  -->
    <script src="../js/jquery/jquery-3.3.1.min.js"></script>
    <!-- Validation Plug-in -->
    <script src="../js/Validation/jquery.validate.min.js"></script>
    <!--External Js  -->
    <script src="../js/script/login.js"></script>
    
</body>
</html>