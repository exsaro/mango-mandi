<?php include 'header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Item</h1>
                    <a href="item.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="" id="addItem">
                    <div class="card">
                    <div class="card-body">
                                <div class="form-group">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="mb-0" for="">Item Code</label>
                                        <div class="custom-control custom-switch ml-4">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                                                <label class="custom-control-label" for="customSwitch1">Status</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="itemcode" placeholder="Item Code" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Item Name</label>
                                    <input type="text" class="form-control" name="itemname" placeholder="Item Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Unit of measurement</label>
                                    <input type="text" class="form-control" name="unit" placeholder="Unit of measurement" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Rate</label>
                                    <input type="text" class="form-control" name="pincode" placeholder="Rate" required>
                                    <small id="" class="form-text text-muted">Add the Rate per Kilogram</small>
                                </div>
                                <div class="form-group text-right"><button class="btn btn-primary">Submit</button></div>
                                
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