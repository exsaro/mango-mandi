<?php
    session_start();

    class CompanyMaster
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
                $storeCompanyData = mysqli_query( $this->connected, "update company_master set company_name='".$storeData['company_name']."',company_address='".$storeData['company_address']."',city='".$storeData['city']."',state='".$storeData['state']."',country='".$storeData['country']."',pincode='".$storeData['pincode']."', status='".$status."' where company_id='".$storeData['editId']."' ");
                $_SESSION['message']        = 'You have successfully updated the record';
            }else{
                $storeCompanyData = mysqli_query( $this->connected, "insert into company_master(company_name,company_address,city,state,country,pincode,status) values('".$storeData['company_name']."', '".$storeData['company_address']."','".$storeData['city']."', '".$storeData['state']."','".$storeData['country']."','".$storeData['pincode']."','$status')");
                $_SESSION['message']        = 'You have successfully added the record';
            }
            if($storeCompanyData){
                $_SESSION['alert']          = 'alert-success';
            }else{
                $_SESSION['message']        = 'Something went wrong!';
                $_SESSION['alert']          = 'alert-danger';
            }

            header("Location:../View/company.php");       
        }
    
    }

    $companyMaster       = new CompanyMaster();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $companyMaster->storeData($_POST);
    }

?>