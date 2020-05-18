<?php include 'header.php';?>
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
                            <th>Transaction Title</th>
                            <th>(₹) Amount</th>
                            <th>Description</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>10/06/2020</td>
                            <td>654654654ASDASD</td>
                            <td>Saravanan</td>
                            <td>Tractor Charges</td>
                            <td>3500</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title='Edit' href=''><span class="material-icons">edit</span></a></li>
                                    <li><a id="delete" href='#delete' data-toggle="modal" title='Delete' ><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                        <td>1</td>
                            <td>10/06/2020</td>
                            <td>654654654ASDASD</td>
                            <td>Saravanan</td>
                            <td>Tractor Charges</td>
                            <td>3500</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title='Edit' href=''><span class="material-icons">edit</span></a></li>
                                    <li><a id="delete" href='#delete' data-toggle="modal" title='Delete' ><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                        <td>1</td>
                            <td>10/06/2020</td>
                            <td>654654654ASDASD</td>
                            <td>Saravanan</td>
                            <td>Tractor Charges</td>
                            <td>3500</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title='Edit' href=''><span class="material-icons">edit</span></a></li>
                                    <li><a id="delete" href='#delete' data-toggle="modal" title='Delete' ><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                        <td>1</td>
                            <td>10/06/2020</td>
                            <td>654654654ASDASD</td>
                            <td>Saravanan</td>
                            <td>Tractor Charges</td>
                            <td>3500</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title='Edit' href=''><span class="material-icons">edit</span></a></li>
                                    <li><a id="delete" href='#delete' data-toggle="modal" title='Delete' ><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>