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
            $sql = "SELECT * FROM ".$table." WHERE ".$field."= '".$id."' AND company_id='".$_SESSION['company_id']."'";
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
            $sql = "SELECT * FROM voucher as v INNER JOIN voucher_detail as vd ON v.voucher_id = vd.voucher_id WHERE v.status  = 'A' AND vd.status = 'A' AND v.payment_status = 'B' AND v.voucher_id  IN (".$ids.")";
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

?>