<?php
    session_start();

    class TransactionMaster
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
                $sql ="update transaction_master set transaction_code='".$storeData['transaction_code']."',transaction_name='".$storeData['transaction_name']."', status='".$status."' where transaction_id='".$storeData['editId']."' ";
                $_SESSION['message']        = 'You have successfully updated the record';
            }else{
                $sql = "insert into transaction_master(company_id,transaction_name,transaction_code,status) values('".$_SESSION['company_id']."','".$storeData['transaction_name']."', '".$storeData['transaction_code']."','$status')";
                $_SESSION['message']        = 'You have successfully added the record'; 
            }
            $storeCompanyData = mysqli_query( $this->connected, $sql);
            if($storeCompanyData){
                $_SESSION['alert']          = 'alert-success';
            }else{
                $_SESSION['message']        = 'Something went wrong!';
                $_SESSION['alert']          = 'alert-danger';
            }

            header("Location:../View/transaction.php");       
        }
    
    }

    $transactionMaster       = new TransactionMaster();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $transactionMaster->storeData($_POST);
    }

?>