<?php
    session_start();

    class CustomerPayment
    {
        private $connected ="";
        function __construct()
        {
            //DB Connection
            require "../DataBase/DBConnect.php";
            $dbConnection       = new DBConnect();
            $this->connected    = $dbConnection->dbConnect();
        }

        public function getSalesDetails($postData){
            $responseData = [];
            $responseData['sales_data'] = [];
            $sql = "SELECT * FROM  sales WHERE customer_id = '".$postData['customer_id']."' AND payment_status = 'B' AND status = 'A' AND company_id='".$_SESSION['company_id']."'";
            
            $executeQuery = mysqli_query($this->connected,$sql);
            
            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $responseData['sales_data'][] = $row ;
                }
            } 
            echo json_encode($responseData);    
        }

       

       

        //Store and update
        
    }


    $customerPayment       = new CustomerPayment();

    //Ajax Call For sales Details
    if(isset($_REQUEST['getSalesDetails']))
    {
        $customerPayment->getSalesDetails($_POST);
    }
    
    
?>