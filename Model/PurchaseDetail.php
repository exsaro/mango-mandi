<?php
    session_start();

    class PurchaseDetail
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
            if(isset($storeData['receipt_number']) && $storeData['receipt_number'] != '' && isset($storeData['receipt_date']) && $storeData['receipt_date'] != ''  && isset($storeData['farmer_id']) && $storeData['farmer_id'] != ''  && isset($storeData['purchase_details']) && $storeData['purchase_details'] != ''){
                 
                $date = date('Y-m-d H:i:s');
                if($storeData['editId'] != ""){
                    $sql ="update purchase set farmer_id='".$storeData['farmer_id']."',receipt_number='".$storeData['receipt_number']."',receipt_date='".$storeData['receipt_date']."',vehicle_no='".$storeData['vehicle_no']."',tractor_auto='".$storeData['tractor_auto']."',commission='".$storeData['commission']."',e_c='".$storeData['e_c']."',rent='".$storeData['rent']."',unloading='".$storeData['unloading']."',advanced='".$storeData['advanced']."', status='".$status."',updated_at='".$date."',updated_by='".$_SESSION['user_id']."' where purchase_id='".$storeData['editId']."' ";
                    $_SESSION['message']        = 'You have successfully updated the record';
                }else{
                    $sql = "insert into purchase(company_id,farmer_id,receipt_number,receipt_date,vehicle_no,tractor_auto,commission,e_c,rent,unloading,advanced,payment_status,status,created_at,updated_at,created_by,updated_by) values('".$_SESSION['company_id']."','".$storeData['farmer_id']."', '".$storeData['receipt_number']."', '".$storeData['receipt_date']."','".$storeData['vehicle_no']."','".$storeData['tractor_auto']."','".$storeData['commission']."','".$storeData['e_c']."','".$storeData['rent']."','".$storeData['unloading']."','".$storeData['advanced']."','B','$status','".$date."','".$date."','".$_SESSION['user_id']."','".$_SESSION['user_id']."')";
                    $_SESSION['message']        = 'You have successfully added the record'; 
                }
                $storePurchaseData = mysqli_query( $this->connected, $sql);

                if($storePurchaseData){
                    $purchaseDetails = $storeData['purchase_details'];

                    if($storeData['editId'] == ""){
                        $purchase_id  = mysqli_insert_id($this->connected);
                        $autoNumber  = $storeData['autoIncNumber']+1;
                        
                        $sql ="update auto_increment_number set purchase='".$autoNumber."' where company_id='".$_SESSION['company_id']."' ";
                        
                        mysqli_query( $this->connected, $sql);

                        $vocSql = "insert into voucher(company_id,farmer_id,purchase_id,voucher_date,voucher_no,payment_status ,status,created_at,updated_at,created_by,updated_by) values('".$_SESSION['company_id']."','".$storeData['farmer_id']."', '".$purchase_id."','".$storeData['receipt_date']."', '".$storeData['receipt_number']."','B','$status','".$date."','".$date."','".$_SESSION['user_id']."','".$_SESSION['user_id']."')";
                        mysqli_query( $this->connected, $vocSql);
                        $voucher_id  = mysqli_insert_id($this->connected);

                    }else{
                        $purchase_id  = $storeData['editId'];
                        $selVoc = "SELECT voucher_id FROM voucher WHERE purchase_id = '".$purchase_id."'";
                        $executeQuery  = mysqli_query($this->connected,$selVoc);
                        $voucher_id =  mysqli_fetch_assoc($executeQuery)['voucher_id'];
                    }
                    
                    //voucher details
                    $deleteVocSql = "DELETE FROM voucher_detail WHERE purchase_id = '".$purchase_id."'";
                    $deleteVoc = mysqli_query( $this->connected, $deleteVocSql);

                    $vocRowInsert = "insert into voucher_detail(voucher_id,purchase_id,transaction_id,amount,description,status ) values('".$voucher_id."','".$purchase_id."','".$this->getTransactionId('Tractor/Auto')."',".$storeData['tractor_auto'].",'Tractor Auto','A'),('".$voucher_id."','".$purchase_id."','".$this->getTransactionId('Commision')."',".$storeData['commission'].",'Commision','A'),('".$voucher_id."','".$purchase_id."','".$this->getTransactionId('EC')."',".$storeData['e_c'].",'EC','A'),('".$voucher_id."','".$purchase_id."','".$this->getTransactionId('Rent')."',".$storeData['rent'].",'Rent','A'),('".$voucher_id."','".$purchase_id."','".$this->getTransactionId('Unloading')."',".$storeData['unloading'].",'Unloading','A'),('".$voucher_id."','".$purchase_id."','".$this->getTransactionId('Advance')."',".$storeData['advanced'].",'Advance','A')";

                    mysqli_query($this->connected, $vocRowInsert);
                   
                    //purchase detail
                    $deleteSql = "DELETE FROM purchase_detail WHERE purchase_id = '".$purchase_id."'";
                    $deleteData = mysqli_query( $this->connected, $deleteSql);
                    
                    $multiRowInsert = "insert into purchase_detail(purchase_id,product_id,status ) values";
                    $count = 1;
                    foreach($purchaseDetails as $key => $value){
                        $multiRowInsert .= "('".$purchase_id."','".$value['product_id']."','A')";
                        if(count($purchaseDetails) != $count)
                            $multiRowInsert .= " , ";
                            $count++;
                    }

                   mysqli_query($this->connected, $multiRowInsert);

                    $_SESSION['alert']          = 'alert-success';
                }else{
                    $_SESSION['message']        = 'Something went wrong!';
                    $_SESSION['alert']          = 'alert-danger';
                }

                header("Location:../View/purchase.php");       
            }else{
                if($storeData['editId'] != ""){
                    $urlId  = '?id='.$storeData['editId'];
                }
                $_SESSION['message']        = 'Please enter all required fields!';
                $_SESSION['alert']          = 'alert-danger';
                header("Location:../View/addPurchase.php".$urlId);  
            }
        }

        public function getTransactionId($transaction_name){
            $transSel = "SELECT transaction_id FROM transaction_master WHERE transaction_name ='".$transaction_name."' AND company_id='".$_SESSION['company_id']."'";
            $transSelQuery  = mysqli_query($this->connected,$transSel);
       
            return mysqli_fetch_assoc($transSelQuery)['transaction_id'];
        }
    }

    $purchaseDetail       = new PurchaseDetail();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $purchaseDetail->storeData($_POST);
    }

?>
