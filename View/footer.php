<?php  
    if(isset($_SESSION['message'])){
        unset($_SESSION['message']);
        unset($_SESSION['alert']);
        $display        ='d-none';
        $displayMessage = '';
    }

?> 



<!-- Modal -->
<div class="modal fade" id="reportModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="reportModalLabel">Print Report</h5>
        </div>
        <form action="" id="printReport">
        <div class="modal-body">
            <div class="form-group">
                <select class="custom-select" required>
                    <option value="">Select Report</option>
                    <option value="Voucher Report">Voucher Report</option>
                    <option value="Purchase Report">Purchase Report</option>
                    <option value="Sales Report">Sales Report</option>
                    <option value="Payment Report">Payment Report</option>
                    <option value="Payment Receive Report">Payment Receive Report</option>
                    <option value="Day Book">Day Book</option>
                    <option value="Farmer payment Pending">Farmer payment Pending</option>
                    <option value="Customer Payment Pending">Customer Payment Pending</option>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Print</button>
        </div>
        </form>
        </div>
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
    <script src="../js/app.js"></script>
</body>
</html>