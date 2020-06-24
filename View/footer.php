<?php  
    if(isset($_SESSION['message'])){
        unset($_SESSION['message']);
        unset($_SESSION['alert']);
        $display        ='d-none';
        $displayMessage = '';
    }
    $farmerOptionData   = $commonModel->getData('farmer_master','list','','');
    $customerOptionData = $commonModel->getData('customer_master','list','','');

    
?> 



<!-- Modal -->
<div class="modal fade" id="reportModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="reportModalLabel">Preview Report</h5>
        </div>
        <form action="./allReport.php" method="post" id="printReport">
        <div class="modal-body">
            <div class="form-group">
                <label for="">Select Report Type</label>
                <select class="custom-select" id="report_type" name="report_type" required>
                    <option value="" disabled>Select Report</option>
                    <option value="purchase">Purchase Report</option>
                    <option value="voucher">Voucher Report</option>
                    <option value="sales">Sales Report</option>
                    <option value="farmer_payment">Farmer payment Report</option>
                    <option value="payment_receive">Payment Receive Report</option>
                    <option value="ledger">Ledger Report</option>
                </select>
            </div>
            <div class="form-group row m-2">
                <div class="col">
                    <input class="form-check-input" type="radio" name="selectType" id="all" value="all" onclick="selectReportUserType()" checked>
                    <label class="form-check-label" for="allsss">
                        ALL
                    </label>
                </div>
                <div class="col">
                    <input class="form-check-input" type="radio" name="selectType" id="specific" value="specific"  onclick="selectReportUserType()" >
                    <label class="form-check-label" for="specific">
                        Specific
                    </label>
                </div>
            </div>
            <div class="form-group d-none" id='farmer'>
                <label for="">Select Farmer</label>
                <select name="farmer_id" id="farmer_id" class="custom-select" required>
                    <option value="" disable>Select Farmer</option>
                    <?php foreach($farmerOptionData as $fKey => $fValue) {  ?>
                        <option  value="<?php echo $fValue['farmer_id']; ?>"> <?php echo $fValue['farmer_name']." - " ; ?><?php echo $fValue['farmer_code']; ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group d-none" id='customer'>
                <label for="">Select Customer</label>
                <select  name="customer_id" id="customer_id" class="custom-select" required>
                    <option value="" disable>Select Customer</option>
                        <?php foreach($customerOptionData as $fKey => $fValue) {  ?>
                            <option value="<?php echo $fValue['customer_id']; ?>"> <?php echo $fValue['customer_name']." - " ; ?><?php echo $fValue['customer_code']; ?> </option>
                        <?php } ?>
                </select>
            </div>
            <div class="form-group row">
                <div class="col">
                    <input type="text" name="from_date" id="report_picker1" data-datepicker="separateRange" class="form-control datetimepicker reportpicker" placeholder="From Date" required />
                </div>
                <div class="col">
                    <input type="text" name="to_date" id="report_picker2" data-datepicker="separateRange" class="form-control datetimepicker reportpicker" placeholder="To Date" required />
                </div>
            </div>
            <div class="form-group row ml-4 d-none"  id="summary">
                <input class="form-check-input" type="checkbox" value="summary" name="summary" >
                <label class="form-check-label" for="defaultCheck1">
                    Summary
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="printPage" class="btn btn-primary">Preview</button>
        </div>
        </form>
        </div>
    </div>
</div>


<div class="change-theme">
    <a id="change-theme" class="icn" href=""><span class="material-icons">settings</span></a>
    <div class="choose">
        <ul>
            <li class="bootstrap1"><a href="#"><span>theme1</span></a></li>
            <li class="bootstrap2"><a href="#"><span>theme2</span></a></li>
            <li class="bootstrap3"><a href="#"><span>theme3</span></a></li>
            <li class="bootstrap4"><a href="#"><span>theme4</span></a></li>
            <li class="bootstrap5"><a href="#"><span>theme5</span></a></li>
            <li class="bootstrap6"><a href="#"><span>theme6</span></a></li>
            <li class="bootstrap7"><a href="#"><span>theme7</span></a></li>
            <li class="bootstrap8"><a href="#"><span>theme8</span></a></li>
            <li class="bootstrap9"><a href="#"><span>theme9</span></a></li>
            <li class="bootstrap10"><a href="#"><span>theme10</span></a></li>
        </ul>
    </div>
</div>




    <script src="../js/jquery/jquery-3.3.1.min.js"></script>
    <script src="../js/jquery/popper.min.js"></script>
    <script src="../js/jquery/bootstrap.min.js"></script>
    <script src="../js/Validation/jquery.validate.min.js"></script>
    <script src="../js/jquery/datatables.min.js"></script>
    <script src="../js/jquery/dataTables.responsive.min.js"></script>
    <script src="../js/jquery/moment.js"></script>
    <script src="../js/jquery/bootstrap-datetimepicker.min.js"></script>
    <script src="../js/jquery/select2.min.js"></script>
    <script src="../js/app.js"></script>


    
</body>
</html>