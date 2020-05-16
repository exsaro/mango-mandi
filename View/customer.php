<?php 
    include 'header.php';
    $customerListData = $commonModel->getData('customer_master','list','','');
    $i = 1;
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-10 mt-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Customer Master</h1>
                    <a href="addCustomer.php" class="btn btn-primary">Add Customer</a>
                </div>
                
                <div class="table-responsive">
                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Customer Name</th>
                            <th>Customer Code</th>
                            <th>Email</th>
                            <th>Phone no.</th>
                            <th>Bank Acc. No</th>
                            <th>Bank IFSC</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>District</th>
                            <th>State</th>
                            <th>Country</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($customerListData as $key => $value ){  ?> 
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['customer_name']; ?></td>
                                <td><?php echo $value['customer_code']; ?></td>
                                <td><?php echo $value['customer_email']; ?></td>
                                <td><?php echo $value['phone_number']; ?></td>
                                <td><?php echo $value['bank_account_number']; ?></td>
                                <td><?php echo $value['bank_ifsc_code']; ?></td>
                                <td><?php echo $value['customer_address']; ?></td>
                                <td><?php echo $value['customer_city']; ?></td>
                                <td><?php echo $value['customer_district']; ?></td>
                                <td><?php echo $value['customer_state']; ?></td>
                                <td><?php echo $value['customer_country']; ?></td>
                                <td class="text-right">
                                    <ul class="nav justify-content-end">
                                        <li class="mr-3"><a title='<?php echo $lang['edit']; ?>' href='addCustomer.php?id=<?php echo $value['customer_id'] ?>'><span class="material-icons">edit</span></a></li>
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
                                    <a href="../Model/CommonModel.php?dId=<?php echo $value['customer_id'] ?>&tb=cu_m" class="btn btn-primary">Delete</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php $i++; } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>