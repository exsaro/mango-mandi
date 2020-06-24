<?php  
    session_start(); 
    if(!isset($_SESSION['company_id'])){
        header("Location:./login.php");
    }else if(!isset($_SESSION['purchase_id'])){ 
        header("Location:./purchase.php");
    }else{
        //DB Connection
        require "../DataBase/DBConnect.php";
        $dbConnection   = new DBConnect();
        $connection     = $dbConnection->dbConnect();
        $id = $_SESSION['purchase_id'];
        
        unset($_SESSION['purchase_id']);
        
        $purchaseSql = "SELECT * FROM purchase as p INNER JOIN farmer_master as fm ON p.farmer_id = fm.farmer_id INNER JOIN company_master as cm ON  p.company_id = cm.company_id WHERE p.status != 'D' AND fm.status != 'D' AND cm.status != 'D' AND cm.company_id = '".$_SESSION['company_id']."' AND p.purchase_id = '".$id."'";
        
        $executeQuery  = mysqli_query($connection,$purchaseSql);
        
        $purchase = [];

        if($executeQuery != '' && $executeQuery->num_rows > 0)
        {
            while($row = mysqli_fetch_assoc($executeQuery)){
                $purchase[] = $row ;
            }
        }

        $purchaseDetails = $purchase[0];


        $totalPaymentDetail = [];
        $totalPaymentSql = "SELECT * FROM purchase_detail as pd INNER JOIN product_master as pm ON pd.product_id = pm.product_id WHERE purchase_id = '".$id."' AND pd.status='A' AND pm.status = 'A' ";
            
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
    <link rel="stylesheet" href="../css/style.css" media="print">
    <title>purchase Preview</title>
</head>
<body>
    
    <div class="container">
        <div id="print_part">
            <header class="bg-dark p-2 text-center">
                <h4 class="text-white">purchase Details</h4>
            </header>
            <div class="container pt-2">
                <div class="row pb-4">
                    <div class="col-md-6">
                        <p class="font-weight-bold m-0 h4 text-primary"><?php echo $purchaseDetails['company_name']; ?></p>
                        <p class="m-0"><?php echo $purchaseDetails['company_address']; ?></p>
                        <p class="m-0"><?php echo $purchaseDetails['city']; ?></p>
                        <p class="m-0"><?php echo $purchaseDetails['state']; ?></p>
                        <p class="m-0"><?php echo $purchaseDetails['country']; ?></p>
                        <p class="m-0"><?php echo $purchaseDetails['pincode']; ?></p>
                    </div>
                </div>
                <h6 class="font-weight-bold h5">Farmer Detail</h6>
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
                            <td><?php echo $purchaseDetails['farmer_name']; ?></td>
                            <td><?php echo $purchaseDetails['farmer_code']; ?></td>
                            <td><?php echo $purchaseDetails['farmer_address']; ?>,<br><?php echo $purchaseDetails['farmer_city']; ?>,<br><?php echo $purchaseDetails['farmer_district']; ?></td>
                            <td><?php echo $purchaseDetails['farmer_state']; ?></td>
                            <td><?php echo $purchaseDetails['farmer_country']; ?></td>
                        </tr>
                    </tbody>
                </table>
                    
                <h6 class="font-weight-bold h5 pt-5">Farmer Product Detail</h6>
                <table class="table">
                    <tr>
                        <th>S.No</th>
                        <th>Farmer Name (Farmer Code)</th>
                        <th>Product Name (Product Code)</th>
                    </tr>
                    <tbody>
                        <?php 
                            foreach($totalPaymentDetail as $key => $value) { ?>
                                <tr>
                                    <td class="p-5 m-5"><?php echo $pi; ?></td>
                                    <td class="p-5 m-5"><?php echo $purchaseDetails['farmer_name']; ?> (<?php echo $purchaseDetails['farmer_code']; ?>)</td>
                                    <td class="p-5 m-5"><?php echo $value['product_name']; ?> (<?php echo $value['product_code']; ?>)</td>
                                </tr>
                        <?php $pi++; } ?>
                    </tbody>
                </table>
                
                
            </div>
            
        </div>
        <div id="printBtn" class="text-right pb-5">
            <button class="btn btn-primary" onclick="printPage('printCheck','purchase')">Print</button>
            <button class="btn btn-secondary ml-3" onclick="printPage('cancel','purchase')">Cancel</button>
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