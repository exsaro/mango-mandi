<?php include 'header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Sales</h1>
                    <a href="addSales.php" class="btn btn-primary">Add Sales</a>
                </div>
                

                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Sales Date</th>
                            <th>Sales No</th>
                            <th>Farmer Name</th>
                            <th>Customer Name</th>
                            <th>Item Name</th>
                            <th>(kg) Qty</th>
                            <th>(₹) Amount</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>10/06/2020</td>
                            <td>654654654ASDASD</td>
                            <td>Saravanan</td>
                            <td>Saravanan</td>
                            <td>Malgova</td>
                            <td>300</td>
                            <td>1500</td>
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
                            <td>Saravanan</td>
                            <td>Malgova</td>
                            <td>300</td>
                            <td>1500</td>
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
                            <td>Saravanan</td>
                            <td>Malgova</td>
                            <td>300</td>
                            <td>1500</td>
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
                            <td>Saravanan</td>
                            <td>Malgova</td>
                            <td>300</td>
                            <td>1500</td>
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