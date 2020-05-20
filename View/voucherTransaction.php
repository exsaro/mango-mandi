<?php 
    include 'header.php';
    //Get List 
    $voucherListData = $commonModel->getVoucherListData();
    $i = 1;
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Voucher Transaction</h1>
                    <a href="addVoucher.php" class="btn btn-primary">Add Voucher</a>
                </div>
                

                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Voucher Date</th>
                            <th>Voucher No</th>
                            <th>Farmer Name</th>
                            <th>Farmer Code</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($voucherListData as $key => $value) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $value['voucher_date']; ?></td>
                                    <td><?php echo $value['voucher_no']; ?></td>
                                    <td><?php echo $value['farmer_name']; ?></td>
                                    <td><?php echo $value['farmer_code']; ?></td>
                                    <td class="text-right">
                                        <ul class="nav justify-content-end">
                                            <li class="mr-3"><a title='<?php echo $lang['edit']; ?>' href='addVoucher.php?id=<?php echo $value['voucher_transaction_detail_id'] ?>'><span class="material-icons">edit</span></a></li>
                                            <li><a id="delete" href='#delete<?php echo $i ?>' data-toggle="modal" title='<?php echo $lang['delete'] ?>' ><span class="material-icons">delete</span></a></li>
                                        </ul>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id='delete<?php echo $i ?>' tabindex="-1" role="dialog" aria-labelledby="delete1ModalModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete1ModalModalLabel">Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Do you want to Delete the Record.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="../Model/CommonModel.php?dId=<?php echo $value['voucher_transaction_detail_id'] ?>&tb=v_t_d" class="btn btn-primary">Delete</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                        <?php $i++; }  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>