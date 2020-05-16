<?php
    session_start();

    class UserMaster
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
                $sql ="update user_master set user_name='".$storeData['user_name']."',user_password='".$storeData['user_password']."', status='".$status."' where user_id='".$storeData['editId']."' ";
                $_SESSION['message']        = 'You have successfully updated the record';
            }else{
                $sql = "insert into user_master(company_id,user_type_id,user_name,user_password,status) values('".$_SESSION['company_id']."','2', '".$storeData['user_name']."','".$storeData['user_password']."','$status')";
                $_SESSION['message']        = 'You have successfully added the record'; 
            }
            $storeCompanyData = mysqli_query( $this->connected, $sql);

            if($storeCompanyData){
                $_SESSION['alert']          = 'alert-success';
            }else{
                $_SESSION['message']        = 'Something went wrong!';
                $_SESSION['alert']          = 'alert-danger';
            }

            header("Location:../View/user.php");       
        }
    
    }

    $userMaster       = new UserMaster();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $userMaster->storeData($_POST);
    }

?>