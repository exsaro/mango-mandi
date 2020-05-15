<?php include 'header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Farmer</h1>
                    <a href="farmer.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="" id="addFarmer">
                    <div class="card">
                    <div class="card-body">
                                <div class="form-group">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="mb-0" for="">Farmer Code</label>
                                        <div class="custom-control custom-switch ml-4">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                                                <label class="custom-control-label" for="customSwitch1">Status</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="farmercode" placeholder="Item Code" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Village</label>
                                    <input type="text" class="form-control" name="village" placeholder="Village" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <textarea class="form-control" name="address" id="exampleTextarea" rows="3" autocomplete="off" spellcheck="false" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">District</label>
                                    <input type="text" class="form-control" name="district" placeholder="District" required>
                                </div>
                                <div class="form-group">
                                    <label for="">State</label>
                                    <input type="text" class="form-control" name="state" placeholder="State" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control" name="country" placeholder="Country" required>
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