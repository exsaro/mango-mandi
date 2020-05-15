<?php include 'header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Transaction</h1>
                    <a href="transaction.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="" id="addTransaction">
                    <div class="card">
                    <div class="card-body">
                                <div class="form-group">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="mb-0" for="">Transaction Code</label>
                                        <div class="custom-control custom-switch ml-4">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                                                <label class="custom-control-label" for="customSwitch1">Status</label>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="transcode" placeholder="Transaction Code" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Transaction Name</label>
                                    <input type="text" class="form-control" name="transname" placeholder="v" required>
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