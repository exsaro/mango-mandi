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
            
            if($_SESSION['user_type_id'] != 1){
                $sql .= " AND company_id ='". $_SESSION['company_id']."'";
            }

            if($type == 'edit'){
                $sql .= " AND ".$columName." = '". $id."'";
            }
               
            $executeQuery   = mysqli_query($this->connected ,$sql); 
            
            $getData = [];

            if($executeQuery->num_rows > 0)
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
    }
   //Delete Call
   if(isset($_REQUEST['dId']))
   {
     //Common config
     include "../Language/Lang.php";
     $configData   = new Lang();
     $config       = $configData->getConfigData();
     
      $id           = $_GET['dId'];
      $table        = $_GET['tb'];
      $delete       = new CommonModel();
      $delete->delete($config[$table],$config[$table.'_c'],$id);
      $pageName = $config[$table.'_p'];
      header("Location:../view/".$pageName.".php");
   }
?>