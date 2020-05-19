<?php 
    include 'header.php';
    
    $title      = 'Add Item';
    $editData   = [];
    $submitType = 'store';

    if(isset($_GET['id'])){
        $title      = 'Edit Item';
        $companyListData = $commonModel->getData('product_master','edit',$_GET['id'],'product_id');
        $editData   = isset($companyListData[0]) ?  $companyListData[0] : [] ;
        $submitType = 'update';
    }
    
    $id          = isset($editData['product_id'])       ? $editData['product_id']      : '';
    $productName = isset($editData['product_name'])     ? $editData['product_name']      : '';
    $productCode = isset($editData['product_code'])  ? $editData['product_code']   : '';
    $unitOfMeasurement        = isset($editData['unit_of_measurement'])  ? $editData['unit_of_measurement']   : '';  
    $price       = isset($editData['price'])  ? $editData['price']          : '';
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
                    <a href="item.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="../Model/ProductMaster.php" method="post" id="addItem">
                    <input type="hidden" name="editId" id="editId" value='<?php echo $id; ?>' />
                    <div class="card">
                    <div class="card-body">
                                <div class="form-group">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="mb-0" for="">Item Code</label>
                                        <div class="custom-control custom-switch ml-4">
                                                <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1" value='A'  <?php echo $status=='A'? 'checked' :''; ?> >
                                                <label class="custom-control-label" for="customSwitch1">Status</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Item Code" required minlength=3 maxlength=100 value='<?php echo $productCode; ?>' >
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Item Name</label>
                                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Item Name" required minlength=3 maxlength=100 value='<?php echo $productName; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">Unit of measurement</label>
                                    <input type="text" class="form-control" name="unit_of_measurement" placeholder="Unit of measurement" required minlength=1 maxlength=10 value='<?php echo $unitOfMeasurement; ?>' >
                                </div>
                                <div class="form-group">
                                    <label for="">(₹) Amount</label>
                                    <input type="text" class="form-control" name="price" id="price" placeholder="Amount" required minlength=1 maxlength=15 value='<?php echo $price; ?>' >
                                    <small id="" class="form-text text-muted">Add the Rate per Kilogram</small>
                                </div>
                                <div class="form-group text-right"><button type="submit" name='<?php echo $submitType; ?>' class="btn btn-primary">Submit</button></div>
                                
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