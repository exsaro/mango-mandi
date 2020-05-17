<?php include 'header.php';?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Purchase</h1>
                    <a href="purchase.php" class="btn btn-secondary">Back</a>
                </div>
                <form method="post" id="addPurchase">
                    
                    <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Purchase No</label>
                            <input type="text" class="form-control" name="purchase_no" placeholder="purchase No" required />
                        </div>
                        <div class="form-group">
                            <label for="">Purchase Date</label>
                            <div class="input-group">
                            <input type="text" name="purchase_date" id="date_picker" data-datepicker="separateRange" class="form-control datetimepicker" />
                            <div class="input-group-append"><span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Select Farmer</label>
                            <select name="select_farmer" class="custom-select" required>
                                <option value="">Please select</option>
                                <option value="1">Saravaan1</option>
                                <option value="2">Saravaan2</option>
                                <option value="3">Saravaan3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Select Item</label>
                            <select name="select_item" class="custom-select" required>
                                <option value="">Please select</option>
                                <option value="1">Saravaan1</option>
                                <option value="2">Saravaan2</option>
                                <option value="3">Saravaan3</option>
                            </select>
                        </div>
                                
                        <div class="form-group text-right"><button type="submit" name='voucher_submit' class="btn btn-primary">Submit</button></div>
                                
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