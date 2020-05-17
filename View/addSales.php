<?php include 'header.php';?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Sales</h1>
                    <a href="sales.php" class="btn btn-secondary">Back</a>
                </div>
                <form method="post" id="addPurchase">
                    
                    <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Sales No</label>
                            <input type="text" class="form-control" name="sales_no" placeholder="Sales No" required />
                        </div>
                        <div class="form-group">
                            <label for="">Sales Date</label>
                            <div class="input-group">
                            <input type="text" name="sales_date" id="date_picker" data-datepicker="separateRange" class="form-control datetimepicker" />
                            <div class="input-group-append"><span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Select Customer</label>
                            <select name="select_customer" class="custom-select" required>
                                <option value="">Please select</option>
                                <option value="1">Saravaan1</option>
                                <option value="2">Saravaan2</option>
                                <option value="3">Saravaan3</option>
                            </select>
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
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Qty</label>
                                    <input type="number" min="0" class="form-control" name="qty" placeholder="Qty" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="">Rate (₹)</label>
                                    <input type="number" min="0" class="form-control" name="rate" placeholder="Rate" required />
                                </div>
                            </div>    
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