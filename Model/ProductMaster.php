<?php
    session_start();

    class ProductMaster
    {
        private $connected ="";
        function __construct()
        {
            //DB Connection
            require "../DataBase/DBConnect.php";
            $dbConnection       = new DBConnect();
            $this->connected    = $dbConnection->dbConnect();
        }

        //Store and update Company Data
        public function storeData($storeData){
            $status = isset($storeData['status']) ? 'A' : 'IA' ;
            
            if($storeData['editId'] != ""){
                $sql ="update product_master set product_code='".$storeData['product_code']."',product_name='".$storeData['product_name']."',unit_of_measurement='".$storeData['unit_of_measurement']."',price='".$storeData['price']."', status='".$status."' where product_id='".$storeData['editId']."' ";
                $_SESSION['message']        = 'You have successfully updated the record';
            }else{
                $sql = "insert into product_master(company_id,product_code,product_name,unit_of_measurement,price, status) values('".$_SESSION['company_id']."','".$storeData['product_code']."', '".$storeData['product_name']."','".$storeData['unit_of_measurement']."', '".$storeData['price']."','$status')";
                $_SESSION['message']        = 'You have successfully added the record'; 
            }
            $storeCompanyData = mysqli_query( $this->connected, $sql);

            if($storeCompanyData){
                $_SESSION['alert']          = 'alert-success';
            }else{
                $_SESSION['message']        = 'Something went wrong!';
                $_SESSION['alert']          = 'alert-danger';
            }

            header("Location:../View/item.php");       
        }
    
    }

    $productMaster       = new ProductMaster();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $productMaster->storeData($_POST);
    }

?>