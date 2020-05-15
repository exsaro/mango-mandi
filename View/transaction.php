<?php include 'header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Welcome Transaction</h1>
                    <a href="addTransaction.php" class="btn btn-primary">Add Transaction</a>
                </div>
                

                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Transaction Code</th>
                            <th>Transaction Name</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>45845ADRF45</td>
                            <td>Saravanan</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>45845ADRF45</td>
                            <td>Saravanan</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>45845ADRF45</td>
                            <td>Saravanan</td>
                            
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>45845ADRF45</td>
                            <td>Saravanan</td>
                            
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>