<?php 
    include 'header.php';
    
    $title      = 'Add Farmer';
    $editData   = [];
    $submitType = 'store';

    if(isset($_GET['id'])){
        $title      = 'Edit Farmer';
        $farmerEditData = $commonModel->getData('farmer_master','edit',$_GET['id'],'farmer_id');
        $editData   = isset($farmerEditData[0]) ?  $farmerEditData[0] : [] ;
        $submitType = 'update';
    }
    
    $id          = isset($editData['farmer_id'])       ? $editData['farmer_id']      : '';
    $farmerCode  = isset($editData['farmer_code'])     ? $editData['farmer_code']      : '';
    $farmerName  = isset($editData['farmer_name'])  ? $editData['farmer_name']   : '';
    $address     = isset($editData['farmer_address'])  ? $editData['farmer_address']   : '';
    $city        = isset($editData['farmer_city'])  ? $editData['farmer_city']   : '';  
    $district    = isset($editData['farmer_district'])  ? $editData['farmer_district']   : '';  
    $state       = isset($editData['farmer_state'])  ? $editData['farmer_state']   : 'Tamil Nadu';  
    $country     = isset($editData['farmer_country'])  ? $editData['farmer_country']   : 'India';  
    // $pincode     = isset($editData['pincode'])  ? $editData['pincode']   : '';  
    $status      = (isset($editData['status']) && $editData['status'] == 'IA')? 'IA': 'A';  
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1><?php echo $title; ?></h1>
                    <a href="farmer.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="../Model/FarmerMaster.php" method="post" id="addFarmer">
                    <input type="hidden" id="editId" name="editId" value='<?php echo $id; ?>' />
                    <div class="card">
                    <div class="card-body">
                                <div class="form-group">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="mb-0" for="">Farmer Code</label>
                                        <div class="custom-control custom-switch ml-4">
                                            <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1" value='A'  <?php echo $status=='A'? 'checked' :''; ?> >

                                            <label class="custom-control-label" for="customSwitch1">Status</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="farmer_code" name="farmer_code" placeholder="Farmer Code" required minlength=3 maxlength=100 value='<?php echo $farmerCode; ?>' >
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Farmer Name</label>
                                    <input type="text" class="form-control" id="farmer_name" name="farmer_name" placeholder="Farmer Name" required minlength=3 maxlength=100 value='<?php echo $farmerName; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">Village</label>
                                    <input type="text" class="form-control" name="farmer_city" placeholder="Village" required minlength=3 maxlength=100 value='<?php echo $city; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea class="form-control" name="farmer_address" id="exampleTextarea" rows="3" autocomplete="off" spellcheck="false" required minlength=1  ><?php echo $address; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">District</label>
                                    <input type="text" class="form-control" name="farmer_district" placeholder="District" required minlength=3 maxlength=100 value='<?php echo $district; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" name="farmer_state" placeholder="State" required minlength=3 maxlength=100 value='<?php echo $state; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" name="farmer_country" placeholder="Country" required minlength=3 maxlength=100 value='<?php echo $country; ?>' >
                                </div>
                                <div class="form-group text-right"><button  type="submit" name='<?php echo $submitType; ?>'  class="btn btn-primary">Submit</button></div>
                                
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