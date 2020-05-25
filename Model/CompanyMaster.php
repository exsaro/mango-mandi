<?php
    session_start();

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
            $status = isset($storeData['status']) ? 'A' : 'IA' ;
            $urlId  = '';
            
            if(isset($storeData['company_name']) && $storeData['company_name'] != '' && isset($storeData['company_address']) && $storeData['company_address'] != '' && isset($storeData['city']) && $storeData['city'] != '' && isset($storeData['state']) && $storeData['state'] != '' && isset($storeData['country']) && $storeData['country'] != '' && isset($storeData['pincode']) && $storeData['pincode'] != ''){
                if($storeData['editId'] != ""){
                    $companyId = $storeData['editId'];
                    $storeCompanyData = mysqli_query( $this->connected, "update company_master set company_name='".$storeData['company_name']."',company_address='".$storeData['company_address']."',city='".$storeData['city']."',state='".$storeData['state']."',country='".$storeData['country']."',pincode='".$storeData['pincode']."', status='".$status."' where company_id='".$storeData['editId']."' ");
                    $_SESSION['message']        = 'You have successfully updated the record';
                }else{
                    $storeCompanyData = mysqli_query( $this->connected, "insert into company_master(company_name,company_address,city,state,country,pincode,status) values('".$storeData['company_name']."', '".$storeData['company_address']."','".$storeData['city']."', '".$storeData['state']."','".$storeData['country']."','".$storeData['pincode']."','$status')");
                    $_SESSION['message']        = 'You have successfully added the record';
                }
                if($storeCompanyData){
                    if($storeData['editId'] == ""){
                        $companyId                  = mysqli_insert_id($this->connected);
                        $incSql = "insert into auto_increment_number(company_id,voucher,purchase,sales,payment,revived_payment) values('".$companyId."','0','0','0','0','0')";
                        mysqli_query($this->connected,$incSql);

                        $code = strtoupper(substr($storeData['company_name'],0,3));
                        $addVoc = "insert into transaction_master(company_id,transaction_name,transaction_code,status) values('".$companyId."','Tractor/Auto','".$code."TA','A'),('".$companyId."','Commision','".$code."COM','A'),('".$companyId."','EC','".$code."EC','A'),('".$companyId."','Rent','".$code."Rent','A'),('".$companyId."','Unloading','".$code."UL','A'),('".$companyId."','Advance','".$code."ADV','A')";
                        mysqli_query($this->connected,$addVoc);
                    }
                    $_SESSION['company_id']     = $companyId;
                    $_SESSION['company_name']   = $storeData['company_name'];
                    $_SESSION['alert']          = 'alert-success';
                }else{
                    $_SESSION['message']        = 'Something went wrong!';
                    $_SESSION['alert']          = 'alert-danger';
                }
                header("Location:../View/company.php");       
            }else{
                if($storeData['editId'] != ""){
                    $urlId  = '?id='.$storeData['editId'];
                }
                $_SESSION['message']    = 'Please enter all required fields!';
                $_SESSION['alert']      = 'alert-danger';
                header("Location:../View/addCompany.php".$urlId);       
            }
        }
    }

    $companyMaster       = new CompanyMaster();
    //Store or Update Call
    if(isset($_REQUEST['store']) || isset($_REQUEST['update']))
    {
        $companyMaster->storeData($_POST);
    }

?>