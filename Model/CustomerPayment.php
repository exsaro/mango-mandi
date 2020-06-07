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
            $responseData['customer_data'] = [];
            $sql = "SELECT * FROM  sales WHERE customer_id = '".$postData['customer_id']."' AND payment_status = 'B' AND status = 'A' AND company_id='".$_SESSION['company_id']."'";
            
            $executeQuery = mysqli_query($this->connected,$sql);
            
            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $responseData['sales_data'][] = $row ;
                }
            } 

            $customerSql ="SELECT * FROM  customer_master WHERE customer_id = '".$postData['customer_id']."' AND  company_id='".$_SESSION['company_id']."'";
            $customerExecuteQuery = mysqli_query($this->connected,$customerSql);
            
            if($customerExecuteQuery != '' && $customerExecuteQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($customerExecuteQuery)){
                    $responseData['customer_data'][] = $row ;
                }
            } 

            echo json_encode($responseData);    
        }

        public function getSalesTableData($postData){
            $responseData   = [];
            $responseData['sales_detail_data'] = [];
            $responseData['sales_detail'] = [];
            $ids            = implode(",",$postData['sales_id']); 
            $sql            = "SELECT * FROM customer_payment_detail as cpd INNER JOIN  sales as s ON cpd.sales_id = cpd.sales_id WHERE cpd.status  = 'A' AND s.status  = 'A' AND  s.payment_status = 'B' AND cpd.sales_id  IN (".$ids.") AND s.sales_id  IN (".$ids.") ";
            $executeQuery = mysqli_query($this->connected,$sql);
            
            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $row['balance_amount'] = $this->getBalanceAmount($row['customer_payment_id']);
                    $responseData['sales_detail_data'][] = $row ;
                }
            } 

            $salesSql = "SELECT * FROM sales WHERE payment_status = 'B' AND status  = 'A' AND  sales_id  IN (".$ids.") ";
            $saleQuery = mysqli_query($this->connected,$salesSql);
            
            if($saleQuery != '' && $saleQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($saleQuery)){
                    $responseData['sales_detail'][] = $row ;
                }
            }
            echo json_encode($responseData); 
        }

        public function getBalanceAmount($customer_payment_id)
        {
            $responseData   = [];
            $sql            = "SELECT * FROM customer_payment WHERE  status  = 'A' AND customer_payment_id  = '".$customer_payment_id."' ";

             $executeQuery = mysqli_query($this->connected,$sql);
            
            if($executeQuery != '' && $executeQuery->num_rows > 0)
            {
                while($row = mysqli_fetch_assoc($executeQuery)){
                    $responseData[] = $row ;
                }
            } 

            return $responseData[0]['balance_amount'];
        }
        
        //Store and update
        public function customerPaymentEntry($storeData){
            $status = 'A' ;
            $urlId  = '';
            if(isset($storeData['customer_payment_number']) && $storeData['customer_payment_number'] != '' && isset($storeData['customer_payment_date']) && $storeData['customer_payment_date'] != ''  && isset($storeData['customer_id']) && $storeData['customer_id'] != ''  && isset($storeData['sales_id']) && $storeData['sales_id'] != '' && isset($storeData['payment_type']) && $storeData['payment_type'] != ''  && isset($storeData['payment_bank_account_no']) && $storeData['payment_bank_account_no'] != ''  && isset($storeData['payment_ifsc_code']) && $storeData['payment_ifsc_code'] != '' && isset($storeData['company_bank_account_no']) && $storeData['company_bank_account_no'] != '' && isset($storeData['company_ifsc_code']) && $storeData['company_ifsc_code'] != '' && isset($storeData['customer_paid_amount']) && $storeData['customer_paid_amount'] != ''  && isset($storeData['description']) && $storeData['description'] != ''){
                
                $date = date('Y-m-d H:i:s');
                if($storeData['editId'] != ""){
                    // Sales Payment Status Changes
                    $storeData['hidden_sales_id'] = explode(',',$storeData['hidden_sales_id']);
                    foreach($storeData['hidden_sales_id'] as $vKey => $vValue){
                        $updateVoucherSql = "update sales set payment_status ='B' where sales_id='".$vValue."'";
                        mysqli_query( $this->connected, $updateVoucherSql);
                    }

                    $deleteCustomerPaymentDetailSql = "DELETE FROM customer_payment_detail WHERE customer_payment_id = '".$storeData['editId']."'";
                    mysqli_query( $this->connected, $deleteCustomerPaymentDetailSql);

                    $deleteCustomerPaymentSql = "DELETE FROM customer_payment WHERE customer_payment_id = '".$storeData['editId']."'";
                    $data = mysqli_query( $this->connected, $deleteCustomerPaymentSql);
                    $_SESSION['message']        = 'You have successfully updated the record';
                }else{
                    $_SESSION['message']        = 'You have successfully added the record';
                }
                    $edit_sales_id = implode(',',$storeData['sales_id']);
                    $storeData['payment_cheque']  = isset($storeData['payment_cheque'])&&$storeData['payment_cheque']!=''?$storeData['payment_cheque']:'';
                    $sql = "insert into customer_payment(customer_payment_number,customer_payment_date,company_id,customer_id,edit_sales_id,payment_type,payment_bank_account_no,payment_ifsc_code,payment_cheque,company_bank_account_no,company_ifsc_code,balance_amount,sales_amount,customer_paid_amount,total_amount,description,payment_status,status,created_at,updated_at,created_by,updated_by) values('".$storeData['customer_payment_number']."', '".$storeData['customer_payment_date']."','".$_SESSION['company_id']."','".$storeData['customer_id']."','".$edit_sales_id."','".$storeData['payment_type']."','".$storeData['payment_bank_account_no']."','".$storeData['payment_ifsc_code']."','".$storeData['payment_cheque']."','".$storeData['company_bank_account_no']."','".$storeData['company_ifsc_code']."','".$storeData['balance_amount']."','".$storeData['sales_amount']."','".$storeData['customer_paid_amount']."','".$storeData['total_amount']."','".$storeData['description']."','P','$status','".$date."','".$date."','".$_SESSION['user_id']."','".$_SESSION['user_id']."')";

                    $storeCustomerData = mysqli_query( $this->connected, $sql);
                if($storeCustomerData){
                    $customer_payment_id  = mysqli_insert_id($this->connected);

                    if($storeData['editId'] == ""){
                        $autoNumber  = $storeData['autoIncNumber']+1;
                        
                        $auto_increment_number_sql ="update auto_increment_number set revived_payment='".$autoNumber."' where company_id='".$_SESSION['company_id']."' ";
                        
                        mysqli_query( $this->connected, $auto_increment_number_sql);

                    }

                    //Customer payment detail
                    $count = 1;
                    if($storeData['editId'] != ""){
                        $customerPaymentDetails = $storeData['customer_payment_detail'];

                        $multiRowInsert = "insert into customer_payment_detail(customer_payment_id,sales_id,sales_no,payment_date,amount,customer_sales_net_amount,status ) values";

                        foreach($customerPaymentDetails as $key => $value){
                            // $salNo = $storeData['sales_payment_detail'][$value['sales_id']]['sales_no'];
                            // $salNetAmt = $storeData['sales_payment_detail'][$value['sales_id']]['customer_sales_net_amount'];

                            $multiRowInsert .= "('".$customer_payment_id."','".$value['sales_id']."','".$value['sales_no']."','".$value['payment_date']."','".$value['amount']."','".$value['customer_sales_net_amount']."','A')";
                            if(count($customerPaymentDetails) != $count)
                                $multiRowInsert .= " , ";
                                $count++;
                        }
                        $storeEntry = mysqli_query($this->connected, $multiRowInsert);
                    }

                    $multiRowInsert = "insert into customer_payment_detail(customer_payment_id,sales_id,sales_no,payment_date,amount,customer_sales_net_amount,status ) values";
                    $count = 1;
                    $reduction = 0;
                    foreach($storeData['sales_id'] as $sKey => $sVal){
                        $salNo = $storeData['sales_payment_detail'][$sVal]['sales_no'];
                        $salNetAmt = $storeData['sales_payment_detail'][$sVal]['customer_sales_net_amount'];

                        // if($storeData['balance_amount'] == 0){
                        //     $multiRowInsert .= "('".$customer_payment_id."','".$sVal."','".$salNo."','".$date."','".$salNetAmt."','".$salNetAmt."','A')";
                        // }else{
                            $reduction += $salNetAmt;
                            if((count($storeData['sales_id'])-1) == $sKey){
                                $balance =  $reduction - $storeData['customer_paid_amount'];
                                $salNetAmtBal = $salNetAmt -  $balance;
                                $multiRowInsert .= "('".$customer_payment_id."','".$sVal."','".$salNo."','".$date."','".$salNetAmtBal."','".$salNetAmt."','A')";
                            }else{
                                $multiRowInsert .= "('".$customer_payment_id."','".$sVal."','".$salNo."','".$date."','".$salNetAmt."','".$salNetAmt."','A')";
                            }
                        // }

                        if(count($storeData['sales_id']) != $count)
                            $multiRowInsert .= " , ";

                        $count++;
                    }
                    
                    // echo $multiRowInsert;
                    // exit;
                  
                   $storeEntry = mysqli_query($this->connected, $multiRowInsert);
                   if($storeEntry){
                        //Sales Status Change
                        
                        if($storeData['balance_amount'] == 0){
                            foreach($storeData['sales_id'] as $sKey => $sVal){
                                $updateSaleseSql = "update sales set payment_status ='P' where customer_id='".$storeData['customer_id']."' AND sales_id = '".$sVal."'";
                                mysqli_query( $this->connected, $updateSaleseSql);
                            }
                        }else{
                            foreach($storeData['sales_id'] as $key => $value){

                                if((count($storeData['sales_id'])-1) == $key){
                                    $updateSaleseSql = "update sales set payment_status ='B' ,where customer_id='".$storeData['customer_id']."' AND sales_id = '".$value."'";
                                }else{
                                    $updateSaleseSql = "update sales set payment_status ='P' where customer_id='".$storeData['customer_id']."' AND sales_id = '".$value."'";
                                }
                                mysqli_query( $this->connected, $updateSaleseSql);
                            }
                        }
                   }

                    $_SESSION['alert']          = 'alert-success';
                    $_SESSION['customer_payment_id'] = $customer_payment_id;
                    header("Location:../View/customerPaymentPrint.php");
                    // header("Location:../View/customerPayment.php");
                }else{
                    $_SESSION['message']        = 'Something went wrong!';
                    $_SESSION['alert']          = 'alert-danger';
                    header("Location:../View/customerPayment.php");       
                }



            }else{
                if($storeData['editId'] != ""){
                    $urlId  = '?id='.$storeData['editId'];
                }
                $_SESSION['message']        = 'Please enter all required fields!';
                $_SESSION['alert']          = 'alert-danger';
                header("Location:../View/addCustomerPayment.php".$urlId); 
            }
        }
    }


    $customerPayment       = new CustomerPayment();

    //Ajax Call For sales Details
    if(isset($_REQUEST['getSalesDetails']))
    {
        $customerPayment->getSalesDetails($_POST);
    }
    
    // Ajax Call For sale Data
    if(isset($_REQUEST['getSalesData']))
    {
        $customerPayment->getSalesTableData($_POST);
    }
    
    //Payment Entry Store and update
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $customerPayment->customerPaymentEntry($_POST);
    }
?>