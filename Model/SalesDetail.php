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
                    if($storeData['advance_amount'] == 0){
                       
                    }
                    $_SESSION['alert']          = 'alert-success';
                }else{
                    $_SESSION['message']        = 'Something went wrong!';
                    $_SESSION['alert']          = 'alert-danger';
                }

                header("Location:../View/sales.php");       
            }else{
                if($storeData['editId'] != ""){
                    $urlId  = '?id='.$storeData['editId'];
                }
                $_SESSION['message']        = 'Please enter all required fields!';
                $_SESSION['alert']          = 'alert-danger';
                header("Location:../View/addSales.php".$urlId);  
            }
        }
    }

    $salesDetail       = new SalesDetail();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $salesDetail->storeData($_POST);
    }

?>