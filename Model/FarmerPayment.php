<?php
    session_start();

    class FarmerPayment
    {
        private $connected ="";
        function __construct()
        {
            //DB Connection
            require "../DataBase/DBConnect.php";
            $dbConnection       = new DBConnect();
            $this->connected    = $dbConnection->dbConnect();
        }

        public function getVoucherAndPurchaseNumber($postData){
            $responseData = [];

            $responseData['voucher'] = $this->getOptionData('voucher','farmer_id',$postData['farmer_id']);
            $responseData['purchase'] = $this->getOptionData('purchase','farmer_id',$postData['farmer_id']);
            $selSql = "SELECT * FROM sales_detail WHERE farmer_id = '".$postData['farmer_id']."'";

            $selSql = "SELECT * FROM sales_detail as sd INNER JOIN product_master as pm ON sd.product_id = pm.product_id WHERE pm.status  = 'A' AND sd.status = 'A' AND sd.payment_status = 'B'";

            $selExecute = mysqli_query($this->connected,$selSql);
            $getList = [];
            
            if($selExecute != '' && $selExecute->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($selExecute)){
                    $getList[] = $row ;
                }
            } 
            $responseData['sales_data'] = $getList;
            echo json_encode($responseData);    
        }

        public function getOptionData($table,$field,$id){
            $sql = "SELECT * FROM ".$table." WHERE ".$field."= '".$id."' AND payment_status = 'B' AND status = 'A' AND company_id='".$_SESSION['company_id']."'";
            
            $executeQuery = mysqli_query($this->connected,$sql);
            $getData = [];
            
            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            } 
            return $getData;
        }

        public function getReduction($reductionData)
        {
            $responseData = [];

            $ids = implode(",",$reductionData['voucher_id']); 
            $sql = "SELECT * FROM voucher as v INNER JOIN voucher_detail as vd ON v.voucher_id = vd.voucher_id WHERE v.status  = 'A' AND vd.status = 'A' AND v.voucher_id  IN (".$ids.") ";
            
            if($reductionData['editId'] == 0){
                $sql .= " AND v.payment_status = 'B'";
            }

            $executeQuery = mysqli_query($this->connected,$sql);
            $getData = [];
            
            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            } 
            $responseData['reduction'] = $getData;
            echo json_encode($responseData);
        }

        //Store and update
        public function farmerPaymentEntry($storeData){
            $status = 'A' ;
            $urlId  = '';
            // print_r($storeData);
            // exit;
            if(isset($storeData['farmer_payment_number']) && $storeData['farmer_payment_number'] != '' && isset($storeData['farmer_payment_date']) && $storeData['farmer_payment_date'] != ''  && isset($storeData['farmer_id']) && $storeData['farmer_id'] != ''  && isset($storeData['purchase_id']) && $storeData['purchase_id'] != ''&& isset($storeData['description']) && $storeData['description'] != ''){
                 
                $date = date('Y-m-d H:i:s');
                if($storeData['editId'] != ""){
                    //Voucher Payment Status Changes
                    $storeData['hidden_voucher_id'] = explode(',',$storeData['hidden_voucher_id']);
                    foreach($storeData['hidden_voucher_id'] as $vKey => $vValue){
                        $updateVoucherSql = "update voucher set payment_status ='B' where voucher_id='".$vValue."'";
                        mysqli_query( $this->connected, $updateVoucherSql);
                    }
                    
                    $deleteFarmerPaymentDetailSql = "DELETE FROM farmer_payment_detail WHERE farmer_payment_id = '".$storeData['editId']."'";
                    mysqli_query( $this->connected, $deleteFarmerPaymentDetailSql);
                    
                    $deleteFarmerPaymentSql = "DELETE FROM farmer_payment WHERE farmer_payment_id = '".$storeData['editId']."'";
                    $data = mysqli_query( $this->connected, $deleteFarmerPaymentSql);
                    $_SESSION['message']        = 'You have successfully updated the record';
                }else{
                    $_SESSION['message']        = 'You have successfully added the record'; 
                }
                $storeVoucherId  = implode(',',$storeData['voucher_id']);

                $sql = "insert into farmer_payment(farmer_payment_number,farmer_payment_date,company_id,farmer_id,purchase_id,voucher_id,total_sales_amount,total_detection,total_amount,description,payment_status,status,created_at,updated_at,created_by,updated_by) values('".$storeData['farmer_payment_number']."', '".$storeData['farmer_payment_date']."','".$_SESSION['company_id']."','".$storeData['farmer_id']."','".$storeData['purchase_id']."','".$storeVoucherId."','".$storeData['total_sales_amount']."','".$storeData['total_detection']."','".$storeData['total_amount']."','".$storeData['description']."','P','$status','".$date."','".$date."','".$_SESSION['user_id']."','".$_SESSION['user_id']."')";

                $storePurchaseData = mysqli_query( $this->connected, $sql);

                if($storePurchaseData){
                    $farmerPaymentDetails = $storeData['farmer_payment'];
                    $farmer_payment_id  = mysqli_insert_id($this->connected);

                    if($storeData['editId'] == ""){
                        $autoNumber  = $storeData['autoIncNumber']+1;
                        
                        $auto_increment_number_sql ="update auto_increment_number set payment='".$autoNumber."' where company_id='".$_SESSION['company_id']."' ";
                        
                        mysqli_query( $this->connected, $auto_increment_number_sql);
                        

                    }
                    
                    //Purcahse Status Change
                    $updatePurcahseSql = "update purchase set payment_status ='P' where purchase_id='".$storeData['purchase_id']."'";
                    mysqli_query( $this->connected, $updatePurcahseSql);

                    //Voucher Payment Status Changes
                    foreach($storeData['voucher_id'] as $vKey => $vValue){
                        $updateVoucherSql = "update voucher set payment_status ='P' where voucher_id='".$vValue."'";
                        mysqli_query( $this->connected, $updateVoucherSql);
                    }

                    //farmer payment detail
                    $multiRowInsert = "insert into farmer_payment_detail(farmer_payment_id,sales_id,sales_detail_id,product_id,quantity,amount,sale_net_amount,status ) values";
                    $count = 1;
                    foreach($farmerPaymentDetails as $key => $value){
                        $sales_id = $value['sales_id'];

                        $multiRowInsert .= "('".$farmer_payment_id."','".$value['sales_id']."','".$value['sales_detail_id']."','".$value['product_id']."','".$value['quantity']."','".$value['amount']."','".$value['sale_net_amount']."','A')";
                        if(count($farmerPaymentDetails) != $count)
                            $multiRowInsert .= " , ";
                            $count++;
                    }
                   $storeEntry = mysqli_query($this->connected, $multiRowInsert);
                   if($storeEntry){
                        //Sales Status Change
                        $updateSaleseSql = "update sales_detail set payment_status ='P' where farmer_id='".$storeData['farmer_id']."' AND sales_id = '".$sales_id."'";
                        mysqli_query( $this->connected, $updateSaleseSql);
                   }

                    $_SESSION['alert']          = 'alert-success';
                }else{
                    $_SESSION['message']        = 'Something went wrong!';
                    $_SESSION['alert']          = 'alert-danger';
                }

                header("Location:../View/farmerPayment.php");       
            }else{
                if($storeData['editId'] != ""){
                    $urlId  = '?id='.$storeData['editId'];
                }
                $_SESSION['message']        = 'Please enter all required fields!';
                $_SESSION['alert']          = 'alert-danger';
                header("Location:../View/addFarmerPayment.php".$urlId);  
            }
        }
    }


    $farmerPayment       = new FarmerPayment();

    //Ajax Call For Voucher and Purchase
    if(isset($_REQUEST['getVoucherAndPurchase']))
    {
        $farmerPayment->getVoucherAndPurchaseNumber($_POST);
    }
    
    //Ajax Call For Reduction Amount
    if(isset($_REQUEST['getReduction']))
    {
        $farmerPayment->getReduction($_POST);
    }

    //Payment Entry Store and update
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $farmerPayment->farmerPaymentEntry($_POST);
    }
?>