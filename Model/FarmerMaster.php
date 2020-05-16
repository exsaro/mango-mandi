<?php
    session_start();

    class FarmerMaster
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
                $sql ="update farmer_master set farmer_code='".$storeData['farmer_code']."',farmer_name='".$storeData['farmer_name']."',farmer_address='".$storeData['farmer_address']."',farmer_city='".$storeData['farmer_city']."',farmer_district='".$storeData['farmer_district']."',farmer_state='".$storeData['farmer_state']."',farmer_country='".$storeData['farmer_country']."', status='".$status."' where farmer_id='".$storeData['editId']."' ";
                $_SESSION['message']        = 'You have successfully updated the record';
            }else{
                $sql = "insert into farmer_master(company_id,farmer_code,farmer_name,farmer_address,farmer_city, farmer_district, farmer_state,farmer_country,status) values('".$_SESSION['company_id']."','".$storeData['farmer_code']."', '".$storeData['farmer_name']."','".$storeData['farmer_address']."', '".$storeData['farmer_city']."','".$storeData['farmer_district']."','".$storeData['farmer_state']."','".$storeData['farmer_country']."','$status')";
                $_SESSION['message']        = 'You have successfully added the record'; 
            }
            $storeCompanyData = mysqli_query( $this->connected, $sql);

            if($storeCompanyData){
                $_SESSION['alert']          = 'alert-success';
            }else{
                $_SESSION['message']        = 'Something went wrong!';
                $_SESSION['alert']          = 'alert-danger';
            }

            header("Location:../View/farmer.php");       
        }
    
    }

    $farmerMaster       = new FarmerMaster();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $farmerMaster->storeData($_POST);
    }

?>