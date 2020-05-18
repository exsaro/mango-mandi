<?php 
    include 'header.php';

    $title      = 'add_company';
    $editData   = [];
    $submitType = 'store';

    if(isset($_GET['id'])){
        $title      = 'edit_company';
        $companyListData = $commonModel->getData('company_master','edit',$_GET['id'],'company_id');
        $editData   = isset($companyListData[0]) ?  $companyListData[0] : [] ;
        $submitType = 'update';
    }
    
    $id          = isset($editData['company_id'])       ? $editData['company_id']      : '';
    $companyName = isset($editData['company_name'])     ? $editData['company_name']      : '';
    $address     = isset($editData['company_address'])  ? $editData['company_address']   : '';
    $city        = isset($editData['city'])  ? $editData['city']   : '';  
    $state       = isset($editData['state'])  ? $editData['state']   : 'Tamil Nadu';  
    $country     = isset($editData['country'])  ? $editData['country']   : 'India';  
    $pincode     = isset($editData['pincode'])  ? $editData['pincode']   : '';  
    $status      = (isset($editData['status']) && $editData['status'] == 'IA')? 'IA': 'A';  
?>

<div class="container-fluid">
    <div class="row">
        <?php include 'sidebar.php';?>
        <div class="col-md-9 mt-5 ml-5">
            <div class="row justify-content-center">
            
                <div class="col-md-10">
                <div class="d-flex justify-content-between align-items-center mb-3">
                <h1><?php echo $lang[$title]; ?></h1>
                <a href="company.php" class="btn btn-secondary"><?php echo $lang['back'];?></a>
            </div>
            <form action="../Model/CompanyMaster.php" method="post" id="addCompany">
                <input type="hidden" name="editId" id="editId" value='<?php echo $id; ?>' />
                <div class="card">
                    <div class="card-body">
                    
                            <div class="form-group">
                                <div class="d-flex align-items-center mb-2">
                                    <label class="mb-0" for=""><?php echo $lang['company_name'];?></label>
                                    <div class="custom-control custom-switch ml-4">
                                            <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1" value='A'  <?php echo $status=='A'? 'checked' :''; ?> >
                                            <label class="custom-control-label" for="customSwitch1"><?php echo $lang['status'];?></label>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Name" value='<?php echo $companyName; ?>' required minlength=3 maxlength=100>
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo $lang['address'];?></label>
                                <textarea class="form-control" name="company_address" id="exampleTextarea" rows="3" autocomplete="off" spellcheck="false" required minlength=5><?php echo $address; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo $lang['city'];?></label>
                                <input type="text" class="form-control" name="city" placeholder="City" value='<?php echo $city; ?>' required minlength=3 maxlength=50>
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo $lang['state'];?></label>
                                <input type="text" class="form-control" name="state" placeholder="State" value='<?php echo $state; ?>' required minlength=3 maxlength=50>
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo $lang['country'];?></label>
                                <input type="text" class="form-control" name="country" placeholder="Country" value='<?php echo $country; ?>' required minlength=3 maxlength=50>
                            </div>
                            <div class="form-group">
                                <label for=""><?php echo $lang['pincode'];?></label>
                                <input type="text" class="form-control" name="pincode" id="pincode" placeholder="Pincode" value='<?php echo $pincode; ?>' required minlength=3 maxlength=10>
                            </div>
                            
                            <div class="form-group text-right"><button type="submit" name='<?php echo $submitType; ?>' class="btn btn-primary"><?php echo $lang['submit'];?></button></div>
                            
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