<?php include 'header.php';?>
<div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Add Farmer Payment</h1>
                    <a href="farmerPayment.php" class="btn btn-secondary">Back</a>
                </div>
                <form method="post" id="addPayment">
                    
                    <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Bill No</label>
                                    <input type="text" class="form-control" name="payment_no" placeholder="Payment No" required />
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
                                    <label for="">Select Farmer</label>
                                    <select name="select_farmer" class="custom-select" required>
                                        <option value="">Please select</option>
                                        <option value="1">Saravaan1</option>
                                        <option value="2">Saravaan2</option>
                                        <option value="3">Saravaan3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Purchase No</label>
                                    <select name="select_purchase" class="custom-select" required>
                                        <option value="">Please select</option>
                                        <option value="1">00001200</option>
                                        <option value="2">00001201</option>
                                        <option value="3">00001202</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Voucher No</label>
                                    <select name="select_purchase" class="custom-select multi" required multiple="multiple">
                                        <option value="1">00001200</option>
                                        <option value="2">00001201</option>
                                        <option value="3">00001202</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="inline-table mb-3">
                        <table class="table table-bordered table-primary">
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
                                <tr>
                                    <td>1</td>
                                    <td>Malgova</td>
                                    <td>450</td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="75" aria-label="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="18000" aria-label="" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Malgova</td>
                                    <td>450</td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="75" aria-label="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="18000" aria-label="" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Malgova</td>
                                    <td>450</td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="75" aria-label="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="18000" aria-label="" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Malgova</td>
                                    <td>450</td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="75" aria-label="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="18000" aria-label="" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Malgova</td>
                                    <td>450</td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="75" aria-label="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="18000" aria-label="" readonly>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Malgova</td>
                                    <td>450</td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="75" aria-label="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-0">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">₹</span>
                                            </div>
                                            <input type="text" class="form-control" value="18000" aria-label="" readonly>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <p class="text-right h5">Total Detection: ₹ <strong>1500/-</strong></p>

                        
                        
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" id="" rows="3" autocomplete="off" spellcheck="false"></textarea>
                        </div>

                        <p class="text-right h1 mb-5">
                        <span>Total: </span><strong>₹ <span>8000</span>/-</strong>
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