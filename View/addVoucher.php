<?php include 'header.php';?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Voucher</h1>
                    <a href="voucherTransaction.php" class="btn btn-secondary">Back</a>
                </div>
                <form method="post" id="addVoucher">
                    
                    <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Voucher No</label>
                            <input type="text" class="form-control" name="voucher_no" placeholder="Voucher No" required />
                        </div>
                        <div class="form-group">
                            <label for="">Voucher Date</label>
                            <div class="input-group">
                                <input type="text" name="voucher_date" id="date_picker" data-datepicker="separateRange" class="form-control datetimepicker" value="" />
                                <div class="input-group-append" >
                                    <span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Select Farmer</label>
                            <select class="custom-select" required>
                                <option value="">Please select</option>
                                <option value="1">Saravaan1</option>
                                <option value="2">Saravaan2</option>
                                <option value="3">Saravaan3</option>
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="">Voucher Title</label>
                            <select class="custom-select" required>
                                <option value="">Please select</option>
                                <option value="1">Saravaan1</option>
                                <option value="2">Saravaan2</option>
                                <option value="3">Saravaan3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="number" min="0" class="form-control" name="voucher_amount" placeholder="Amount" required />
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" id="" name="voucher_desc" rows="3" autocomplete="off" spellcheck="false"></textarea>
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