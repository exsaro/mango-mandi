<?php
    session_start();

    class VoucherTransactionDetail
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
            if(isset($storeData['voucher_date']) && $storeData['voucher_date'] != '' && isset($storeData['voucher_no']) && $storeData['voucher_no'] != ''  && isset($storeData['farmer_id']) && $storeData['farmer_id'] != ''  && isset($storeData['transaction_detail']) && $storeData['transaction_detail'] != ''){
                 
                $date = date('Y-m-d H:i:s');
                if($storeData['editId'] != ""){
                    $sql ="update voucher set farmer_id='".$storeData['farmer_id']."',voucher_date='".$storeData['voucher_date']."',voucher_no='".$storeData['voucher_no']."', status='".$status."',updated_at='".$date."',updated_by='".$_SESSION['user_id']."' where voucher_id='".$storeData['editId']."' ";
                    $_SESSION['message']        = 'You have successfully updated the record';
                }else{
                    $sql = "insert into voucher(company_id,farmer_id,voucher_date,voucher_no,status,created_at,updated_at,created_by,updated_by) values('".$_SESSION['company_id']."','".$storeData['farmer_id']."', '".$storeData['voucher_date']."', '".$storeData['voucher_no']."','$status','".$date."','".$date."','".$_SESSION['user_id']."','".$_SESSION['user_id']."')";
                    $_SESSION['message']        = 'You have successfully added the record'; 
                }
                $storeCompanyData = mysqli_query( $this->connected, $sql);

                if($storeCompanyData){
                    $transcationDetail = $storeData['transaction_detail'];

                    if($storeData['editId'] == ""){
                        $voucher_id  = mysqli_insert_id($this->connected);
                        $autoNumber  = $storeData['autoIncNumber']+1;
                        
                        $sql ="update auto_increment_number set voucher='".$autoNumber."' where company_id='".$_SESSION['company_id']."' ";
                        
                        mysqli_query( $this->connected, $sql);
                    }else{
                        $voucher_id  = $storeData['editId'];
                    }
                    $deleteSql = "DELETE FROM voucher_detail WHERE voucher_id = '".$voucher_id."'";
                    $deleteData = mysqli_query( $this->connected, $deleteSql);
                    
                    $multiRowInsert = "insert into voucher_detail(voucher_id,transaction_id,amount,description,status ) values";
                    $count = 1;
                    foreach($transcationDetail as $key => $value){
                        $multiRowInsert .= "('".$voucher_id."','".$value['transaction_id']."', '".$value['amount']."', '".$value['description']."','A')";
                        if(count($transcationDetail) != $count)
                            $multiRowInsert .= " , ";
                            $count++;
                    }

                   mysqli_query($this->connected, $multiRowInsert);

                    $_SESSION['alert']          = 'alert-success';
                }else{
                    $_SESSION['message']        = 'Something went wrong!';
                    $_SESSION['alert']          = 'alert-danger';
                }

                header("Location:../View/voucherTransaction.php");       
            }else{
                if($storeData['editId'] != ""){
                    $urlId  = '?id='.$storeData['editId'];
                }
                $_SESSION['message']        = 'Please enter all required fields!';
                $_SESSION['alert']          = 'alert-danger';
                header("Location:../View/addVoucher.php".$urlId);  
            }
        }
    }

    $voucherTransactionDetail       = new VoucherTransactionDetail();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $voucherTransactionDetail->storeData($_POST);
    }

?>