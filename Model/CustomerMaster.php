<?php
    session_start();

    class CustomerMaster
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
            print_r($storeData['editId']);
            if($storeData['editId'] != ""){
                $sql ="update customer_master set customer_code='".$storeData['customer_code']."',customer_name='".$storeData['customer_name']."',customer_email='".$storeData['customer_email']."',customer_address='".$storeData['customer_address']."',customer_city='".$storeData['customer_city']."',customer_district='".$storeData['customer_district']."',customer_state='".$storeData['customer_state']."',customer_country='".$storeData['customer_country']."',bank_account_number='".$storeData['bank_account_number']."',bank_ifsc_code='".$storeData['bank_ifsc_code']."',phone_number='".$storeData['phone_number']."', status='".$status."' where customer_id='".$storeData['editId']."' ";
                $_SESSION['message']        = 'You have successfully updated the record';
            }else{
                $sql = "insert into customer_master(company_id,customer_code,customer_name,customer_email,customer_address,customer_city, customer_district, customer_state,customer_country,bank_account_number,bank_ifsc_code,phone_number,status) values('".$_SESSION['company_id']."','".$storeData['customer_code']."', '".$storeData['customer_name']."', '".$storeData['customer_email']."','".$storeData['customer_address']."', '".$storeData['customer_city']."','".$storeData['customer_district']."','".$storeData['customer_state']."','".$storeData['customer_country']."','".$storeData['bank_account_number']."','".$storeData['bank_ifsc_code']."','".$storeData['phone_number']."','$status')";
                $_SESSION['message']        = 'You have successfully added the record'; 
            }
            $storeCompanyData = mysqli_query( $this->connected, $sql);

            if($storeCompanyData){
                $_SESSION['alert']          = 'alert-success';
            }else{
                $_SESSION['message']        = 'Something went wrong!';
                $_SESSION['alert']          = 'alert-danger';
            }

            header("Location:../View/customer.php");       
        }
    
    }

    $customerMaster       = new CustomerMaster();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $customerMaster->storeData($_POST);
    }

?>