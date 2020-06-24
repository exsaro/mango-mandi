<?php 
    session_start();
    if(!isset($_SESSION['company_id'])){
        header("Location:./login.php");
    }else if(!isset($_POST['printPage'])){
        header("Location:./dashboard.php");
    }else{
        //DB Connection
        require "../DataBase/DBConnect.php";
        $dbConnection   = new DBConnect();
        $connection     = $dbConnection->dbConnect();
        $sql    = '';
        $title  = '';
        $mi     = 1;
        $totalAmount = 0;
        $paid        = 0;
        $balance     = 0;
        $mainDetails = [];

        // Main Details
        if($_POST['report_type'] == 'purchase'){
            $sql .= "SELECT * FROM purchase as p INNER JOIN farmer_master as fm ON p.farmer_id = fm.farmer_id INNER JOIN company_master as cm ON  p.company_id = cm.company_id INNER JOIN sales_detail as sd ON sd.farmer_id = p.farmer_id  WHERE p.status != 'D' AND fm.status != 'D' AND cm.status != 'D' AND cm.company_id = '".$_SESSION['company_id']."'"; 
            if($_POST['selectType'] == 'specific'){
                $sql .= " AND p.farmer_id = '".$_POST['farmer_id']."'";
            }  
            $sql .= " AND p.receipt_date BETWEEN '" . $_POST['from_date'] . "' AND  '" . $_POST['to_date'] . "'";
            $title = 'Purchase Report';
            $title1 = 'Purchase Report Result';
        }else if($_POST['report_type'] == 'voucher'){
            $sql .= "SELECT * FROM voucher as v INNER JOIN farmer_master as fm ON v.farmer_id = fm.farmer_id INNER JOIN voucher_detail as vd ON vd.voucher_id = v.voucher_id  WHERE v.status != 'D' AND fm.status != 'D' AND v.company_id = '".$_SESSION['company_id']."' AND vd.amount != 0";
            if($_POST['selectType'] == 'specific'){
                $sql .= " AND v.farmer_id = '".$_POST['farmer_id']."'";
            }  
            $sql .= " AND v.voucher_date BETWEEN '" . $_POST['from_date'] . "' AND  '" . $_POST['to_date'] . "'";
             
            $title  = 'Voucher Report';
            $title1 = 'Voucher Report Result';
        }
        else if($_POST['report_type'] == 'sales'){
            $sql .= "SELECT * FROM sales as s INNER JOIN customer_master as cm ON s.customer_id = cm.customer_id INNER JOIN sales_detail as sd ON sd.sales_id = s.sales_id  WHERE s.status != 'D' AND cm.status != 'D' AND s.company_id = '".$_SESSION['company_id']."'";
            if($_POST['selectType'] == 'specific'){
                $sql .= " AND s.customer_id = '".$_POST['customer_id']."'";
            }  
            $sql .= " AND s.billing_date BETWEEN '" . $_POST['from_date'] . "' AND  '" . $_POST['to_date'] . "'";
             
            $title  = 'Sales Report';
            $title1 = 'Sales Report Result';
        }else if($_POST['report_type'] == 'farmer_payment'){
            $sql .= "SELECT * FROM farmer_payment as fp INNER JOIN farmer_master as fm ON fp.farmer_id = fm.farmer_id INNER JOIN farmer_payment_detail as fpd ON fpd.farmer_payment_id = fp.farmer_payment_id  WHERE fp.status != 'D' AND fm.status != 'D' AND fp.company_id = '".$_SESSION['company_id']."'";
            if($_POST['selectType'] == 'specific'){
                $sql .= " AND fp.farmer_id = '".$_POST['farmer_id']."'";
            }  
            $sql .= " AND fp.farmer_payment_date BETWEEN '" . $_POST['from_date'] . "' AND  '" . $_POST['to_date'] . "'";
             
            $title  = 'Farmer Payment Report';
            $title1 = 'Farmer Payment Report Result';
        }else if($_POST['report_type'] == 'payment_receive'){
            $sql .= "SELECT * FROM customer_payment as cp INNER JOIN customer_master as cm ON cp.customer_id = cm.customer_id INNER JOIN customer_payment_detail as cpd ON cpd.customer_payment_id = cp.customer_payment_id  WHERE cp.status != 'D' AND cm.status != 'D' AND cp.company_id = '".$_SESSION['company_id']."'";
            if($_POST['selectType'] == 'specific'){
                $sql .= " AND cp.customer_id = '".$_POST['customer_id']."'";
            }  
            $sql .= " AND cp.customer_payment_date BETWEEN '" . $_POST['from_date'] . "' AND  '" . $_POST['to_date'] . "'";
             
            $title  = 'Farmer Payment Report';
            $title1 = 'Farmer Payment Report Result';
        }
        // echo $sql;
        // exit;
        
        if($sql != ''){
            $executeQuery           = mysqli_query($connection,$sql);
            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){  
                    $mainDetails[] = $row;
                }
            }
        }
        // Product Details
        $productDetailsSql      = "SELECT * FROM product_master Where company_id = '".$_SESSION['company_id']."'";
        $productExecuteQuery    = mysqli_query($connection,$productDetailsSql);
        $product = [];
        if($productExecuteQuery != '' && $productExecuteQuery->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($productExecuteQuery)){
                $product[$row['product_id']] = ['product_name' => $row['product_name'],'product_code' => $row['product_code']];
            }
        }
        
        // Company Details
        $companyDetailsSql      = "SELECT * FROM company_master Where company_id = '".$_SESSION['company_id']."' LIMIT 1";
        $companyExecuteQuery    = mysqli_query($connection,$companyDetailsSql);
        $company = [];
        if($companyExecuteQuery != '' && $companyExecuteQuery->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($companyExecuteQuery)){  
                $company[] = $row;
            }
        }
        $companyDetails = $company[0];

        // echo '<pre>';
        // print_r($mainDetails);
        // exit;
        

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/themes/bootstrap1.min.css">
    <link rel="stylesheet" href="../css/style.css" media="print">
    <title><?php echo $title; ?></title>
</head>
<body>

<div class="container">
        <div id="print_part">
            <header class="bg-dark p-2 text-center">
                <h4 class="text-white"><?php echo $title1; ?></h4>
            </header>
            <div class="container pt-2">
                <div class="row pb-4">
                    <div class="col-md-6">
                        <p class="font-weight-bold m-0 h4 text-primary"><?php echo $companyDetails['company_name']; ?></p>
                        <p class="m-0"><?php echo $companyDetails['company_address']; ?></p>
                        <p class="m-0"><?php echo $companyDetails['city']; ?></p>
                        <p class="m-0"><?php echo $companyDetails['state']; ?></p>
                        <p class="m-0"><?php echo $companyDetails['country']; ?></p>
                        <p class="m-0"><?php echo $companyDetails['pincode']; ?></p>
                    </div>
                </div>
                <h6 class="font-weight-bold h5"><?php echo $title; ?></h6>
                
                <?php if(count($mainDetails) > 0) { ?>
                <?php if($_POST['report_type'] == 'purchase' || $_POST['report_type'] == 'sales' || $_POST['report_type'] == 'farmer_payment') { ?>
                    <table class="table">
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Bill No</th>
                            <?php if($_POST['report_type'] == 'purchase' ||  $_POST['report_type'] == 'farmer_payment'){ ?>
                                <th>Farmer Name</th>
                                <th>Farmer Code</th> 
                            <?php } ?>
                            <?php if($_POST['report_type'] == 'sales'){ ?>
                                <th>Customer Name</th>
                                <th>Customer Code</th> 
                            <?php } ?>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <?php if($_POST['report_type'] == 'farmer_payment'){ ?>
                                <th>Description</th>
                            <?php } ?>
                            <th>Payment Status</th>
                            <th>Quantity</th>
                            <th>Amount(per Qty)(₹)</th>
                            <th>Net Amount(₹)</th>
                        </tr>
                        <tr>
                            <?php foreach($mainDetails as $key => $value) { 
                                    $totalAmount += ($value['quantity']*$value['amount']);
                                    if($value['payment_status'] == 'P'){
                                        $paid += ($value['quantity']*$value['amount']);
                                        $paidStatus = 'Paid';
                                        $color='class= "text-success font-weight-bold"';
                                    }else{
                                        $balance +=($value['quantity']*$value['amount']);
                                        $paidStatus = 'Pending';
                                        $color='class= "text-danger font-weight-bold"';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $mi; ?></td>
                                        <td><?php echo isset($value['receipt_date'])?$value['receipt_date']:isset($value['billing_date'])?$value['billing_date']:$value['farmer_payment_date'];  ?></td>
                                        <td><?php echo isset($value['receipt_number'])?$value['receipt_number']:isset($value['billing_number'])?$value['billing_number']:$value['farmer_payment_number']; ?></td>
                                        <td><?php echo isset($value['farmer_name'])?$value['farmer_name']:$value['customer_name']; ?></td>
                                        <td><?php echo isset($value['farmer_code'])?$value['farmer_code']:$value['customer_code']; ?></td>
                                        <td><?php echo $product[$value['product_id']]['product_name']; ?></td>
                                        <td><?php echo $product[$value['product_id']]['product_code']; ?></td>
                                        <?php if($_POST['report_type'] == 'farmer_payment'){ ?>
                                            <td><?php echo $value['description']; ?></td>
                                        <?php } ?>
                                        <td><span <?php echo $color; ?> ><?php echo $paidStatus; ?></sapn></td>
                                        <td><?php echo $value['quantity']; ?></td>
                                        <td><?php echo $value['amount']; ?></td>
                                        <td><?php echo $value['quantity']*$value['amount']; ?></td>
                                    </tr>
                            <?php $mi++; } ?>
                        </tr>
                    </table>         
                <?php } else if($_POST['report_type'] == 'voucher') {?>
                    <table class="table">
                        <tr>
                            <th>S.No</th>
                            <th>Voucher Date</th>
                            <th>Voucher No</th>
                            <th>Farmer Name</th>
                            <th>Farmer Code</th>
                            <th>Description</th>
                            <th>Payment Status</th>
                            <th>Amount(per Qty)(₹)</th>
                        </tr>
                        <tr>
                            <?php foreach($mainDetails as $key => $value) { 
                                    $totalAmount +=  $value['amount'];
                                    if($value['payment_status'] == 'P'){
                                        $paid +=  $value['amount'];
                                        $paidStatus = 'Paid';
                                        $color='class= "text-success font-weight-bold"';
                                    }else{
                                        $balance += $value['amount'];
                                        $paidStatus = 'Pending';
                                        $color='class= "text-danger font-weight-bold"';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $mi; ?></td>
                                        <td><?php echo $value['voucher_date']; ?></td>
                                        <td><?php echo $value['voucher_no']; ?></td>
                                        <td><?php echo $value['farmer_name']; ?></td>
                                        <td><?php echo $value['farmer_code']; ?></td>
                                        <td><?php echo $value['description']; ?></td>
                                        <td><span <?php echo $color; ?> ><?php echo $paidStatus; ?></sapn></td>
                                        <td><?php echo $value['amount']; ?></td>
                                    </tr>
                            <?php $mi++; } ?>
                        </tr>
                    </table>      
                <?php }else if($_POST['report_type'] == 'payment_receive') {?>
                    <table class="table">
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Tranasaction No</th>
                            <th>Customer Name</th>
                            <th>Customer Code</th>
                            <th>Payment Type</th>
                            <th>Purpose</th>
                            <th>Payment Status</th>
                            <th>Amount(per Qty)(₹)</th>
                        </tr>
                        <tr>
                            <?php foreach($mainDetails as $key => $value) { 
                                    $totalAmount +=  $value['customer_paid_amount'];
                                    if($value['payment_status'] == 'P'){
                                        $paid +=  $value['customer_paid_amount'];
                                        $paidStatus = 'Paid';
                                        $color='class= "text-success font-weight-bold"';
                                    }else{
                                        $paidStatus = 'Pending';
                                        $color='class= "text-danger font-weight-bold"';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $mi; ?></td>
                                        <td><?php echo $value['customer_payment_date']; ?></td>
                                        <td><?php echo $value['customer_payment_number']; ?></td>
                                        <td><?php echo $value['customer_name']; ?></td>
                                        <td><?php echo $value['customer_code']; ?></td>
                                        <td><?php echo $value['payment_type']; ?></td>
                                        <td><?php echo $value['description']; ?></td>
                                        <td><span <?php echo $color; ?> ><?php echo $paidStatus; ?></sapn></td>
                                        <td><?php echo $value['customer_paid_amount']; ?></td>
                                    </tr>
                            <?php $mi++; } ?>
                        </tr>
                    </table>      

                <?php
                    $balance = $totalAmount - $paid;
                }?>
                    <p class="text-right"><span class="font-weight-bold h4">Total Amount: </span><span class="h4"><?php echo $totalAmount; ?> /-</span></p>
                    <?php if($_POST['report_type'] != 'payment_receive') { ?>
                    <p class="text-right"><span class="font-weight-bold h4">Paid Amount: </span><span class="h4 text-success"><?php echo $paid; ?> /-</span></p>
                    <p class="text-right"><span class="font-weight-bold h4">Balance Amount: </span><span class="h4 text-danger"><?php echo $balance; ?> /-</span></p>
                    <?php } ?>

                <?php } else {?>
                    <div class="row mb-2">
                        <div class= "col-12 text-center border p-3 m-1 font-weight-bold text-danger"> No Records Found</div>
                    </div>
                <?php } ?>
            </div>
            
        </div>
        <div id="printBtn" class="text-right pb-5">
            <button class="btn btn-primary" onclick="printPage('printCheck','dashboard')">Print</button>
            <button class="btn btn-secondary ml-3" onclick="printPage('cancel','dashboard')">Cancel</button>
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