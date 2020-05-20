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
            
            if($tableName != 'user_type_master' && $tableName !=  'voucher_transaction_group'){
                $sql .= " AND company_id ='". $_SESSION['company_id']."'";
            }

            if($type == 'edit'){
                $sql .= " AND ".$columName." = '". $id."'";
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
            
            $sql = "SELECT * FROM voucher_transaction_detail as vtd INNER JOIN farmer_master as fm ON vtd.farmer_id = fm.farmer_id WHERE fm.status != 'D' AND vtd.status != 'D' AND vtd.company_id = '".$_SESSION['company_id']."' AND fm.company_id = '".$_SESSION['company_id']."'";
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
    
?>