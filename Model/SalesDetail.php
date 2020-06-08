<?php
    session_start();

    class SalesDetail
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
            $status = 'A' ;
            $urlId  = '';
            if(isset($storeData['billing_number']) && $storeData['billing_number'] != '' && isset($storeData['billing_date']) && $storeData['billing_date'] != ''  && isset($storeData['customer_id']) && $storeData['customer_id'] != ''  && isset($storeData['sales_details']) && $storeData['sales_details'] != ''){
                // echo '<pre>';
                //         print_r($companyDetails);
                //         exit;
                $storeData['h_c'] = $storeData['h_c'] !=''?$storeData['h_c']:0;
                $storeData['m_c'] = $storeData['m_c'] !=''?$storeData['m_c']:0;
                $storeData['colli'] = $storeData['colli'] !=''?$storeData['colli']:0;
                $storeData['packing'] = $storeData['packing'] !=''?$storeData['packing']:0;
                $storeData['lorry_advance'] = $storeData['lorry_advance'] !=''?$storeData['lorry_advance']:0;
                $storeData['other_expenses'] = $storeData['other_expenses'] !=''?$storeData['other_expenses']:0;

                $date = date('Y-m-d H:i:s');
                if($storeData['editId'] != ""){
                    $sql ="update sales set customer_id='".$storeData['customer_id']."',billing_number='".$storeData['billing_number']."',billing_date='".$storeData['billing_date']."',vehicle_no='".$storeData['vehicle_no']."',h_c='".$storeData['h_c']."',m_c='".$storeData['m_c']."',colli='".$storeData['colli']."',packing='".$storeData['packing']."',lorry_advance='".$storeData['lorry_advance']."',other_expenses='".$storeData['other_expenses']."',other_addition_amount='".$storeData['other_addition_amount']."',customer_net_amount='".$storeData['customer_net_amount']."',advance_amount='".$storeData['advance_amount']."', status='".$status."',updated_at='".$date."',updated_by='".$_SESSION['user_id']."' where sales_id='".$storeData['editId']."' ";
                    $_SESSION['message']        = 'You have successfully updated the record';
                }else{
                    $sql = "insert into sales(company_id,customer_id,billing_number,billing_date,vehicle_no,h_c,m_c,colli,packing,lorry_advance,other_expenses,other_addition_amount,customer_net_amount,advance_amount,payment_status,status,created_at,updated_at,created_by,updated_by) values('".$_SESSION['company_id']."','".$storeData['customer_id']."', '".$storeData['billing_number']."', '".$storeData['billing_date']."','".$storeData['vehicle_no']."','".$storeData['h_c']."','".$storeData['m_c']."','".$storeData['colli']."','".$storeData['packing']."','".$storeData['lorry_advance']."','".$storeData['other_expenses']."','".$storeData['other_addition_amount']."','".$storeData['customer_net_amount']."','".$storeData['advance_amount']."','B','$status','".$date."','".$date."','".$_SESSION['user_id']."','".$_SESSION['user_id']."')";
                    $_SESSION['message']        = 'You have successfully added the record'; 
                }
                $storesalesData = mysqli_query( $this->connected, $sql);
                
                if($storesalesData){
                    $salesDetails = $storeData['sales_details'];

                    if($storeData['editId'] == ""){
                        $sales_id  = mysqli_insert_id($this->connected);
                        $autoNumber  = $storeData['autoIncNumber']+1;
                        $sql ="update auto_increment_number set sales='".$autoNumber."' where company_id='".$_SESSION['company_id']."' ";
                        
                        mysqli_query( $this->connected, $sql);
                    }else{
                        $sales_id  = $storeData['editId'];
                    }

                    $deleteSql = "DELETE FROM sales_detail WHERE sales_id = '".$sales_id."'";
                    $deleteData = mysqli_query( $this->connected, $deleteSql);
                    
                    $multiRowInsert = "insert into sales_detail(sales_id,farmer_id,product_id,quantity,amount,payment_status,status ) values";
                    $count = 1;
                    foreach($salesDetails as $key => $value){
                        $multiRowInsert .= "('".$sales_id."','".$value['farmer_id']."','".$value['product_id']."','".$value['quantity']."','".$value['amount']."','B','A')";
                        if(count($salesDetails) != $count)
                            $multiRowInsert .= " , ";
                            $count++;
                    }

                   mysqli_query($this->connected, $multiRowInsert);
                   
                    if($storeData['advance_amount'] != 0 && $storeData['editId'] == ""){
                        $customerDetails = $this->getBankData('customer_master','customer_id',$storeData['customer_id']);
                        $companyDetails  = $this->getBankData('company_master','company_id',$_SESSION['company_id']);      
                        $balance_amount  = $storeData['customer_net_amount'] - $storeData['advance_amount'];
                        if($balance_amount  != 0 ){
                            $payDesc = 'Advance Payment';
                        }else{
                            $payDesc = 'Full Payment';
                        }

                        $sql = "insert into customer_payment(customer_payment_number,customer_payment_date,company_id,customer_id,edit_sales_id,payment_type,payment_bank_account_no,payment_ifsc_code,payment_cheque,company_bank_account_no,company_ifsc_code,balance_amount,sales_amount,customer_paid_amount,total_amount,description,payment_status,status,created_at,updated_at,created_by,updated_by) values('APSAL".$sales_id."', '".$storeData['billing_date']."','".$_SESSION['company_id']."','".$storeData['customer_id']."','".$sales_id."','cash','".$customerDetails['bank_account_number']."','".$customerDetails['bank_ifsc_code']."','','".$companyDetails['company_bank_account_no']."','".$companyDetails['company_ifsc_code']."','".$balance_amount."','".$storeData['customer_net_amount']."','".$storeData['advance_amount']."','".$storeData['customer_net_amount']."','".$payDesc."','P','$status','".$date."','".$date."','".$_SESSION['user_id']."','".$_SESSION['user_id']."')";

                        $storeCustomerData = mysqli_query( $this->connected, $sql);

                        if($storeCustomerData){
                            $customer_payment_id    = mysqli_insert_id($this->connected);
                            $salseDetails           = $this->getBankData('sales','sales_id',$sales_id);      
                            $customerPayDetailInsertSql = "insert into customer_payment_detail(customer_payment_id,sales_id,sales_no,payment_date,amount,customer_sales_net_amount,status ) values('".$customer_payment_id."','".$sales_id."','".$salseDetails['billing_number']."','".$date."','".$storeData['advance_amount']."','".$storeData['customer_net_amount']."','A')";
                            $insertPaymentData          = mysqli_query( $this->connected, $customerPayDetailInsertSql);
                           
                            if($balance_amount  != 0 ){
                                $updateSalesSql             = "update sales set payment_status ='B' where sales_id = '".$sales_id."'";
                            }else{
                                $updateSalesSql             = "update sales set payment_status ='P' where sales_id = '".$sales_id."'";  
                            }
 
                            mysqli_query( $this->connected, $updateSalesSql);
                        }
                        $_SESSION['customer_payment_id']          = $customer_payment_id;
                                                
                    }
                    
                    $_SESSION['sales_id']          = $sales_id;
                    $_SESSION['alert']          = 'alert-success';
                    header("Location:../View/salesPaymentPrint.php");

                }else{
                    $_SESSION['message']        = 'Something went wrong!';
                    $_SESSION['alert']          = 'alert-danger';
                    header("Location:../View/sales.php");
                }

            }else{
                if($storeData['editId'] != ""){
                    $urlId  = '?id='.$storeData['editId'];
                }
                $_SESSION['message']        = 'Please enter all required fields!';
                $_SESSION['alert']          = 'alert-danger';
                header("Location:../View/addSales.php".$urlId);  
            }
        }

        public function getBankData($tableName,$field,$value){
            $commonSql          = "SELECT * FROM ".$tableName." WHERE ".$field." = '".$value."' LIMIT 1";
            $result             = mysqli_query( $this->connected, $commonSql);
            $resultData         = mysqli_fetch_assoc($result);
            return $resultData;
        }

    }

    $salesDetail       = new SalesDetail();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $salesDetail->storeData($_POST);
    }

?>