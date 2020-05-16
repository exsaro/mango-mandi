<?php 
    include 'header.php';
    
    $title      = 'Add Customer';
    $editData   = [];
    $submitType = 'store';

    if(isset($_GET['id'])){
        $title      = 'Edit Customer';
        $customerEditData = $commonModel->getData('customer_master','edit',$_GET['id'],'customer_id');
        $editData   = isset($customerEditData[0]) ?  $customerEditData[0] : [] ;
        $submitType = 'update';
    }
    
    $id             = isset($editData['customer_id'])   ? $editData['customer_id']      : '';
    $customerCode   = isset($editData['customer_code'])  ? $editData['customer_code']      : '';
    $customerName   = isset($editData['customer_name'])  ? $editData['customer_name']   : '';
    $customerEmail  = isset($editData['customer_email'])  ? $editData['customer_email']   : '';
    $phone          = isset($editData['phone_number'])  ? $editData['phone_number']   : '';  
    $address        = isset($editData['customer_address'])  ? $editData['customer_address']   : '';
    $city           = isset($editData['customer_city'])  ? $editData['customer_city']   : '';  
    $district       = isset($editData['customer_district'])  ? $editData['customer_district']   : '';  
    $state          = isset($editData['customer_state'])  ? $editData['customer_state']   : 'Tamil Nadu';  
    $country        = isset($editData['customer_country'])  ? $editData['customer_country']   : 'India';  
    $bankAccountNo  = isset($editData['bank_account_number'])  ? $editData['bank_account_number']   : '';  
    $ifscCode       = isset($editData['bank_ifsc_code'])  ? $editData['bank_ifsc_code']   : '';  
    $status         = (isset($editData['status']) && $editData['status'] == 'IA')? 'IA': 'A'; 
    
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1><?php echo $title; ?></h1>
                    <a href="customer.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="../Model/CustomerMaster.php" method="post" id="addCustomer">
                    <input type="hidden" name="editId" value='<?php echo $id; ?>' />
                    <div class="card">
                    <div class="card-body">
                                <div class="form-group">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="mb-0" for="">Customer Code</label>
                                        <div class="custom-control custom-switch ml-4">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                                                <label class="custom-control-label" for="customSwitch1">Status</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="customer_code" placeholder="Customer Code" required minlength=3 maxlength=100 value='<?php echo $customerCode; ?>' >
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="customer_name" placeholder="Name" required minlength=3 maxlength=100 value='<?php echo $customerName; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" name="customer_email" placeholder="Email" required minlength=3 maxlength=100 value='<?php echo $customerEmail; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">Phone</label>
                                    <input type="tel" class="form-control" name="phone_number" placeholder="Phone" required minlength=3 maxlength=100 value='<?php echo $phone; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea class="form-control" name="customer_address" id="exampleTextarea" rows="3" autocomplete="off" spellcheck="false" required minlength=3 maxlength=100  ><?php echo $address; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">City</label>
                                    <input type="text" class="form-control" name="customer_city" placeholder="city" required minlength=3 maxlength=100 value='<?php echo $city; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">District</label>
                                    <input type="text" class="form-control" name="customer_district" placeholder="District" required minlength=3 maxlength=100 value='<?php echo $district; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" name="customer_state" placeholder="State" required minlength=3 maxlength=100 value='<?php echo $state; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" name="customer_country" placeholder="Country" required minlength=3 maxlength=100 value='<?php echo $country; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">Bank Account No</label>
                                    <input type="text" class="form-control" name="bank_account_number" placeholder="Bank Account No" required minlength=3 maxlength=100 value='<?php echo $bankAccountNo; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">IFSC Code</label>
                                    <input type="text" class="form-control" name="bank_ifsc_code" placeholder="IFSC Code" required minlength=3 maxlength=100 value='<?php echo $ifscCode; ?>' >
                                </div>
                                <div class="form-group text-right" ><button type="submit" name='<?php echo $submitType; ?>' class="btn btn-primary">Submit</button></div>
                                
                            </div>
                            
                        
                    </div>
                </div> 
                </form>  
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>

<?php include 'footer.php';?>