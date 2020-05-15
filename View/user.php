<?php include 'header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Welcome User</h1>
                    <a href="addUser.php" class="btn btn-primary">Add User</a>
                </div>
                

                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>User Type</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>45845ADRF45</td>
                            <td>Saravanan</td>
                            <td>Mugalivakkam</td>
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
                            <td>Mugalivakkam</td>
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
                            <td>Mugalivakkam</td>
                            
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
                            <td>Mugalivakkam</td>
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