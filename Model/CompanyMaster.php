<?php
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
            $status = isset($storeData['status']) && $storeData['status']!='' ?$storeData['status']:'IA';
            
            if($storeData['editId'] != ""){
                $storeCompanyData = mysqli_query( $this->connected, "update company_master set company_name='".$storeData['company_name']."',company_address='".$storeData['company_address']."',city='".$storeData['city']."',state='".$storeData['state']."',country='".$storeData['country']."',pincode='".$storeData['pincode']."', status='".$status."' where company_id='".$storeData['editId']."' ");
            }else{
                $storeCompanyData = mysqli_query( $this->connected, "insert into company_master(company_name,company_address,city,state,country,pincode,status) values('".$storeData['company_name']."', '".$storeData['company_address']."','".$storeData['city']."', '".$storeData['state']."','".$storeData['country']."','".$storeData['pincode']."','$status')");
            }
            header("Location:../View/company.php");
                
        }
    
    }

    $companyMaster       = new CompanyMaster();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        // print_r($_POST);
        //         exit;
        $companyMaster->storeData($_POST);
    }

?>