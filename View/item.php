<?php include 'header.php';?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Welcome Item</h1>
                    <a href="addItem.php" class="btn btn-primary">Add Item</a>
                </div>
                

                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Item Code</th>
                            <th>Item Name</th>
                            <th>Unit of measurement</th>
                            <th>Rare (per kg)</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>45845ADRF45</td>
                            <td>Malgova</td>
                            <td>150 kg</td>
                            <td>₹ 70</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                        <td>2</td>
                            <td>45845ADRF45</td>
                            <td>Malgova</td>
                            <td>150 kg</td>
                            <td>₹ 70</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                        <td>3</td>
                            <td>45845ADRF45</td>
                            <td>Malgova</td>
                            <td>150 kg</td>
                            <td>₹ 70</td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title="Edit" href=""><span class="material-icons">edit</span></a></li>
                                    <li><a href="" title="Delete"><span class="material-icons">delete</span></a></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                        <td>4</td>
                            <td>45845ADRF45</td>
                            <td>Malgova</td>
                            <td>150 kg</td>
                            <td>₹ 70</td>
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