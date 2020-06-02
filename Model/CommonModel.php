<?php
    class CommonModel
    {
        private $connected ="";
        function __construct()
        {
            //DB Connection
            require "../DataBase/DBConnect.php";
            $dbConnection       = new DBConnect();
            $this->connected    = $dbConnection->dbConnect();
        }

        //Get Company Name
        public function getData($tableName,$type,$id,$columName){
            
            $sql = "SELECT * FROM ".$tableName." WHERE status != 'D'";
            
            if($tableName != 'user_type_master' && $tableName !=  'voucher_detail' && $tableName != 'purchase_detail'  && $tableName != 'sales_detail'){
                $sql .= " AND company_id ='". $_SESSION['company_id']."'";
            }

            if($type == 'edit'){
                $sql .= " AND ".$columName." = '". $id."'";
            }

            if($tableName == 'user_master'){
                $sql .= " AND user_type_id != '".  $_SESSION['user_type_id']."'";
            }

            $executeQuery   = mysqli_query($this->connected ,$sql); 
            
            $getData = [];

            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            } 
            return $getData;
        }

        public function delete($tableName,$columName,$id){
            
            $sql        = "UPDATE ".$tableName." set status = 'D' WHERE ".$columName." = '".$id."'";
            $deletData  = mysqli_query($this->connected,$sql);
            return true;
        }
        //logout call
        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['company_id']);
            session_destroy();
            header("Location:../index.php");
        }

        // Check Unique Validation
        public function  checkUniqueValidation($checkData){
    
            $sql = "SELECT * FROM ".$checkData['tableName']." WHERE ".$checkData['checkColumn']."='".$checkData['checkColumnValue']."'";
            if($checkData['companyId'] == 'yes'){
                $sql .= " AND company_id = '".$checkData['companyIdValue']."'";
            }
            if($checkData['editColumnValue'] != ''){
                $sql .= " AND ".$checkData['editColumn']." != '".$checkData['editColumnValue']."'";
            }
            $executeQuery  = mysqli_query($this->connected,$sql);

            if($executeQuery->num_rows > 0){
                echo 'false';
            }else{
                echo 'true';
            }

        }

        // Get Voucher List Data
        public function getVoucherListData(){
            
            $sql = "SELECT * FROM voucher as vtd INNER JOIN farmer_master as fm ON vtd.farmer_id = fm.farmer_id WHERE fm.status != 'D' AND vtd.status != 'D' AND vtd.company_id = '".$_SESSION['company_id']."' AND fm.company_id = '".$_SESSION['company_id']."' AND vtd.purchase_id = '0'";
            $executeQuery  = mysqli_query($this->connected,$sql);
            $getData = [];

            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            }
            return $getData;
        }

        public function getPurchaseListData(){
            $sql = "SELECT * FROM purchase as pm INNER JOIN farmer_master as fm ON pm.farmer_id = fm.farmer_id WHERE fm.status != 'D' AND pm.status != 'D' AND pm.company_id = '".$_SESSION['company_id']."' AND fm.company_id = '".$_SESSION['company_id']."'";
            $executeQuery  = mysqli_query($this->connected,$sql);
            $getData = [];

            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            }
            return $getData;
        }

        public function getFinalRow($fields,$tableName,$id){
           $sql =  "SELECT ".$fields." FROM ".$tableName. " WHERE company_id = '".$_SESSION['company_id']."' ORDER BY ".$id." DESC LIMIT 1";
           $executeQuery  = mysqli_query($this->connected,$sql);
       
            return mysqli_fetch_assoc($executeQuery)[$fields];
        }

        public function getAutoDate(){
            $getDate            = getdate();
            $autoNumberFormat = strtoupper($getDate['month']).str_split($getDate['year'],2)[1];
            return $autoNumberFormat;
        }

        public function getSalesListData(){
            $sql = "SELECT * FROM sales as s INNER JOIN customer_master as cm ON s.customer_id = cm.customer_id WHERE cm.status != 'D' AND s.status != 'D' AND s.company_id = '".$_SESSION['company_id']."' AND cm.company_id = '".$_SESSION['company_id']."'";
            $executeQuery  = mysqli_query($this->connected,$sql);
            $getData = [];

            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            }
            return $getData;
        }

        public function getAmount($getRequest){
            $sql =  "SELECT ".$getRequest['field']." FROM ".$getRequest['table']. " WHERE company_id = '".$getRequest['company_id']."' AND ".$getRequest['column_name']." = '".$getRequest['column_value']."' AND status='A'";
            $executeQuery  = mysqli_query($this->connected,$sql);
             return mysqli_fetch_assoc($executeQuery)[$getRequest['field']];
        }

        public function getCompanyOptions(){
            $sql = "SELECT * FROM  company_master WHERE status != 'D'";
            $executeQuery   = mysqli_query($this->connected ,$sql); 
            $getData = [];
        
            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            } 
            return $getData; 
        }

        public function getFarmerPaymentDetail($id){
            $sql = "SELECT * FROM farmer_payment_detail as fpd INNER JOIN product_master as pm ON fpd.product_id = pm.product_id INNER JOIN farmer_payment as fp ON fpd.farmer_payment_id = fp.farmer_payment_id WHERE fpd.status != 'D' AND pm.status != 'D' AND fp.status != 'D' AND fpd.farmer_payment_id = '".$id."'" ;
            $executeQuery  = mysqli_query($this->connected,$sql);
            $getData = [];

            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            }
            return $getData;
        }
        public function getFarmerPaymentListData()
        {
            $sql = "SELECT * FROM farmer_payment as fp INNER JOIN farmer_master as fm ON fp.farmer_id = fm.farmer_id WHERE fp.status != 'D' AND fm.status != 'D'" ;
            $executeQuery  = mysqli_query($this->connected,$sql);
            $getData = [];

            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            }
            return $getData;
        }
        public function getSalesOptionData($farmerId)
        {
            $sql = "SELECT * FROM purchase as p INNER JOIN purchase_detail as pd ON p.purchase_id = p.purchase_id WHERE p.status != 'D' AND pd.status != 'D' AND p.farmer_id = '".$farmerId."'" ;
            $executeQuery  = mysqli_query($this->connected,$sql);
            $getData = [];

            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $row['product_name'] = $this->getProduct($row['product_id'])['product_name'];
                    $row['product_code'] = $this->getProduct($row['product_id'])['product_code'];
                    $getData[] = $row ;
                }
            }
            return $getData;
        }
        public function getProduct($productId){
            $sql = "SELECT product_name,product_code FROM product_master WHERE  product_id = '".$productId."' ORDER BY ".$productId." DESC LIMIT 1";
            $executeQuery  = mysqli_query($this->connected,$sql);
            $getData = [];

            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $getData[] = $row ;
                }
            }
            return $getData[0];
        }
    }


   //Delete Call
    if(isset($_REQUEST['dId']))
    {
        //Common config
        include "../Language/Lang.php";
        $configData   = new Lang();
        $config       = $configData->getConfigData();
        $commonObj       = new CommonModel();
        
        $id           = $_GET['dId'];
        $table        = $_GET['tb'];
        $commonObj->delete($config[$table],$config[$table.'_c'],$id);
        $pageName = $config[$table.'_p'];
        header("Location:../view/".$pageName.".php");
    }

    //common unique validation
    if(isset($_REQUEST['validation'])){
        $commonObj       = new CommonModel();
        $commonObj->checkUniqueValidation($_POST);
    }

    //Get Product Amount
    if(isset($_REQUEST['salesAmount'])){
        $commonObj       = new CommonModel();
        $amount = $commonObj->getAmount($_POST);
        $returnData['amount'] = $amount;
        echo json_encode($returnData);
    }

    // Get Farmer Product
    if(isset($_REQUEST['selectFarmerProduct'])){
        $commonObj       = new CommonModel();
        $salesData['purchase'] = $commonObj->getSalesOptionData($_REQUEST['farmerId']);
        echo json_encode($salesData);
    }
?>