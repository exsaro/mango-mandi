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
                        <div class="card mb-2">
                            <div class="card-body alert-secondary">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="">Select Farmer</label>
                                        <select name="select_farmer" class="custom-select" required>
                                            <option value="">Please select</option>
                                            <option value="1">Saravaan1</option>
                                            <option value="2">Saravaan2</option>
                                            <option value="3">Saravaan3</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Select Item</label>
                                        <select name="select_item" class="custom-select" required>
                                            <option value="">Please select</option>
                                            <option value="1">Saravaan1</option>
                                            <option value="2">Saravaan2</option>
                                            <option value="3">Saravaan3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="">Qty</label>
                                        <input type="number" min="0" class="form-control" name="qty" placeholder="Qty" required />
                                    </div>
                                    <div class="col">
                                        <label for="">Rate (₹)</label>
                                        <input type="number" min="0" class="form-control" name="rate" placeholder="Rate" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-right fz12">
                            <a style="" class="addClass badge badge-success" href="javascript:void(0);" >Add </a> 
                            <a style="" class="removeClass badge badge-danger" href="javascript:void(0);">  Remove</a>
                        </p>
                        </div>

                        <div class="form-group">
                            <div class="card border-primary">
								<div class="card-header">Other Detection</div>
								<div class="card-body">
									<div class="row mb-3">
										<div class="col-md-3">
											<label for="">Vehicle No</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">H.C</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">M.C</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">Colli.</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<label for="">Packing</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">Lorry Adv.</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
										<div class="col-md-3">
											<label for="">Other expenses</label>
											<input type="text" class="form-control" id="" name="" />
										</div>
									</div>
								</div>
								<div class="card-footer text-right">
									<span>Total Detection: </span><strong>₹ 1500/-</strong>
								</div>
                            </div>
                        </div>

						<div class="my-5">
							<p class="text-right h1"><span class="h3">Total Amount: </span><strong>₹ 14500/-</strong></p>
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