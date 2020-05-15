<?php include 'header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Welcome Company</h1>
                    <a href="addCompany.php" class="btn btn-primary">Add Company</a>
                </div>
                

                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Pincode</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Saravanan</td>
                            <td>No: 10, 2nd Avenue, AGS Colony 3rd phase, Mugalivakkam</td>
                            <td>Tamilnadu</td>
                            <td>India</td>
                            <td>600125</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Ananthi</td>
                            <td>No: 10, 2nd Avenue, AGS Colony 3rd phase, Mugalivakkam</td>
                            <td>Tamilnadu</td>
                            <td>India</td>
                            <td>600125</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Saravanan</td>
                            <td>No: 10, 2nd Avenue, AGS Colony 3rd phase, Mugalivakkam</td>
                            <td>Tamilnadu</td>
                            <td>India</td>
                            <td>600125</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Saravanan</td>
                            <td>No: 10, 2nd Avenue, AGS Colony 3rd phase, Mugalivakkam</td>
                            <td>Tamilnadu</td>
                            <td>India</td>
                            <td>600125</td>
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