<?php include 'header.php';?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Customer Payment</h1>
                    <a href="customerPayment.php" class="btn btn-secondary">Back</a>
                </div>
                <form method="post" id="addPayment">
                    
                    <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bill No</label>
                                    <input type="text" class="form-control" name="payment_no" placeholder="Bill No" readonly required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bill Date</label>
                                    <div class="input-group">
                                        <input type="text" name="payment_date" id="date_picker" data-datepicker="separateRange" class="form-control datetimepicker" />
                                        <div class="input-group-append"><span class="input-group-text"><span class="material-icons text-primary">calendar_today</span></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Select Customer</label>
                                    <select name="select_customer" class="custom-select" required>
                                        <option value="">Please select</option>
                                        <option value="1">Saravaan1</option>
                                        <option value="2">Saravaan2</option>
                                        <option value="3">Saravaan3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Sale No</label>
                                    <select name="select_customer" class="custom-select multi" multiple="multiple" required>
                                        <option value="1">Saravaan1</option>
                                        <option value="2">Saravaan2</option>
                                        <option value="3">Saravaan3</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Account Number</label>
                                    <div class="form-row">
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="From">
                                        </div>
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="To">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">IFSC Code</label>
                                    <div class="form-row">
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="From">
                                        </div>
                                        <div class="col">
                                        <input type="text" class="form-control" placeholder="To">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Payment Type</label>
                                    <select name="select_customer" class="custom-select" required>
                                        <option value="">Please select</option>
                                        <option value="1">Online</option>
                                        <option value="2">Credit/Debit Card</option>
                                        <option value="3">Cheque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Cheque No</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="inline-table mb-3">
                            <table class="table table-bordered table-primary"  id="payment_detail">
                                <thead>
                                    <tr>
                                        <th>S. No</th>
                                        <th>Item</th>
                                        <th>Qty (kg)</th>
                                        <th width="200">Amount (per kg)</th>
                                        <th width="200">(₹) Net Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>1</td>
                                    <td>Malgova</td>
                                    <td>250</td>
                                    <td>80</td>
                                    <td>1800</td>
                                </tbody>
                            </table>
                        </div>

                        <!-- <p class="text-right h5"> <strong><span>13500.00</span>/-</strong></p> -->

                           
                        <div class="d-flex justify-content-end">
                        <table class="table table-bordered w-50">
                            <tbody>
                                <tr>
                                    <td class="h5">Total Sales Amount</td>
                                    <td class="h5">₹ <span>9570.00</span>/-</td>
                                </tr>
                                <tr>
                                    <td class="h5">Customer Paid Amout</td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" name="" id="" class="form-control">
                                            
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="h5">Balance Amount</td>
                                    <td class="h5">₹ <span>9570.00</span>/-</td>
                                </tr>
                            </tbody>
                        </table>

                        </div>
                        
                        
                        

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" id="" rows="3" autocomplete="off" spellcheck="false"></textarea>
                        </div>

                        <p class="text-right h1 mb-5">
                        <span>Total: </span><strong>₹ <span id="totalPayAmount">3930.00</span>/-</strong>
                        <input type="hidden" id="totalAmt" name="total_amount" value="3930.00">
                        </p>
                        
                                
                        <div class="form-group text-right"><button type="submit" name='payment_submit' class="btn btn-primary">Submit</button></div>
                                
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